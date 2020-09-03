from flask import Flask, request, jsonify
from flaskext.mysql import MySQL
import redis
import requests
import pickle
from twilio.twiml.messaging_response import MessagingResponse

mysql = MySQL()
app = Flask(__name__)

app.config['MYSQL_DATABASE_HOST'] = 'database'
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'password'
app.config['MYSQL_DATABASE_DB'] = 'flask'

mysql.init_app(app)
cache = redis.Redis(host='redis', port=6379)

def fetch_options_by_org(cursor,org,cache,sender):
	cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue, Guid, IdOptionType from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org)
	option = cursor.fetchall()

	cache.hset('customers',sender, pickle.dumps(option))

	text = []
	for respuesta in option:
		text.append(respuesta[2] + ") " + respuesta[1])

	final_text = '\n'.join(text)

	return final_text

@app.route('/bot/<guid>', methods=['POST'])
def bot(guid):
	answer = request.values.get('Body', '').lower()
	sender = request.values.get("From").split(':')
	sender = sender[1]

	#delcache = cache.hdel('customers',sender)
	#delcache = cache.hdel('answers',sender)

	resp = MessagingResponse()
	msg = resp.message()
	responded = False

	conn = mysql.connect()
	cursor = conn.cursor()

	# Get Organization
	cursor.execute("SELECT * from Organization WHERE Guid=%s", guid)
	org = cursor.fetchone()

	if org:
		get_cache = cache.hget('customers',sender)
		if get_cache == None:

			final_text = fetch_options_by_org(cursor,org[0],cache,sender)

			msg.body(final_text)
			responded = True
		else:
			# Convertir a lista
			response = list(pickle.loads(get_cache))
			if response:
				# Result devuelve una lista con el tuple q concuerda al filtro
				result = [item for item in response if item[2] == answer]
				if result:

					# Type Text
					if result[0][5] == 1:

						# Guardar en cache por si se quiere volver
						get_options = cache.hget('answers',sender)
						if get_options:
							response_options = list(pickle.loads(get_options))
							response_options.append(result[0][4])
						else:
							response_options = [ result[0][4] ]

						seleccionadas = cache.hset('answers',sender, pickle.dumps(response_options))

						# Buscar las opciones siguentes a la anterior
						cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue , Guid, IdOptionType from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", result[0][0])
						option = cursor.fetchall()
						if option:
							cache.hset('customers',sender, pickle.dumps(option))

							text = []
							for respuesta in option:
								text.append(respuesta[2] + ") " + respuesta[1])

							final_text = '\n'.join(text)

							msg.body(final_text)
							responded = True

						else:
							msg.body('no hay mas opciones')
							responded = True

					# Type Return
					if result[0][5] == 2:
						# Me traigo a la opcion padre
						cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue , Guid, IdOptionType from BotOption WHERE IdBotOption=%s ORDER BY OrderKey", result[0][3])
						option_padre = cursor.fetchone()
						# Traer las opciones conjuntas al padre
						cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue , Guid, IdOptionType from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", option_padre[3])
						option = cursor.fetchall()

						if option:
							cache.hset('customers',sender, pickle.dumps(option))

							text = []
							for respuesta in option:
								text.append(respuesta[2] + ") " + respuesta[1])

							final_text = '\n'.join(text)

							msg.body(final_text)
							responded = True

						else:
							msg.body('no more options')
							responded = True

					# Type Finish
					if result[0][5] == 3:

						get_options = cache.hget('answers',sender)
						response_options = list(pickle.loads(get_options))

						text = ['Tus opciones elegidas son:']
						for respuesta in response_options:
							text.append(respuesta)

						final_text = '\n'.join(text)

						# Delete cache for fresh start
						delcache = cache.hdel('customers',sender)
						delcache = cache.hdel('answers',sender)

						msg.body(final_text)
						responded = True
				else:
					msg.body('la opcion enviada no corresponde')
					responded = True

			else:
				# No cache
				final_text = fetch_options_by_org(cursor,org[0],cache,sender)

				msg.body(final_text)
				responded = True

		if not responded:
			msg.body('responded false')

		return str(resp)

@app.route('/org/<guid>', methods=['POST'])
def org(guid):
	answer = request.form.get("Answer")
	sender = '+5491141461868'

	#delcache = cache.hdel('customers',sender)
	#delcache = cache.hdel('answers',sender)

	conn = mysql.connect()
	cursor = conn.cursor()

	# Get Organization
	cursor.execute("SELECT * from Organization WHERE Guid=%s", guid)
	org = cursor.fetchone()


	if org:
		get_cache = cache.hget('customers',sender)
		if get_cache == None:

			final_text = fetch_options_by_org(cursor,org[0],cache,sender)

			return jsonify({"desired": final_text})
		else:
			# Convertir a lista
			response = list(pickle.loads(get_cache))
			if response:
				# Result devuelve una lista con el tuple q concuerda al filtro
				result = [item for item in response if item[2] == answer]
				if result:


					# Type Text
					if result[0][5] == 1:


						# Guardar en cache por si se quiere volver
						get_options = cache.hget('answers',sender)
						if get_options:
							response_options = list(pickle.loads(get_options))
							response_options.append(result[0][4])
						else:
							response_options = [ result[0][4] ]

						seleccionadas = cache.hset('answers',sender, pickle.dumps(response_options))



						# Buscar las opciones siguentes a la anterior
						cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue , Guid, IdOptionType from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", result[0][0])
						option = cursor.fetchall()
						if option:
							cache.hset('customers',sender, pickle.dumps(option))

							text = []
							for respuesta in option:
								text.append(respuesta[2] + ") " + respuesta[1])

							final_text = '\n'.join(text)

							return jsonify({"desired": final_text})

						else:
							get_options = cache.hget('answers',sender)
							response_options = list(pickle.loads(get_options))

							text = ['Tus opciones elegidas son:']
							for respuesta in response_options:
								text.append(respuesta)

							final_text = '\n'.join(text)

							# Delete cache for fresh start
							delcache = cache.hdel('customers',sender)
							delcache = cache.hdel('answers',sender)

							#return jsonify({"desired": 'no more option'})
							return jsonify({"desired": final_text})

					# Type Return
					if result[0][5] == 2:

						# Me traigo a la opcion padre
						cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue , Guid, IdOptionType from BotOption WHERE IdBotOption=%s ORDER BY OrderKey", result[0][3])
						option_padre = cursor.fetchone()
						# Traer las opciones conjuntas al padre
						cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue , Guid, IdOptionType from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", option_padre[3])
						option = cursor.fetchall()

						if option:
							cache.hset('customers',sender, pickle.dumps(option))

							text = []
							for respuesta in option:
								text.append(respuesta[2] + ") " + respuesta[1])

							final_text = '\n'.join(text)

							return jsonify({"desired": final_text})\

						else:
							return jsonify({"desired": 'no more option'})

					# Type Finish
					if result[0][5] == 3:

						get_options = cache.hget('answers',sender)
						response_options = list(pickle.loads(get_options))

						text = ['Tus opciones elegidas son:']
						for respuesta in response_options:
							text.append(respuesta)

						final_text = '\n'.join(text)

						# Delete cache for fresh start
						delcache = cache.hdel('customers',sender)
						delcache = cache.hdel('answers',sender)

						return jsonify({"desired": final_text})
				else:
					return jsonify({"desired": 'no corresponde'})

			else:
				# No cache
				final_text = fetch_options_by_org(cursor,org[0],cache,sender)

				responded = True
				return jsonify({"desired": final_text})


if __name__ == '__main__':
	app.run()
