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

@app.route('/bot/<guid>', methods=['POST'])
def bot(guid):

	answer = request.values.get('Body', '').lower()
	sender = request.values.get("From").split(':')
	sender = sender[1]

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
			cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org[0])
			option = cursor.fetchall()

			cache.hset('customers',sender, pickle.dumps(option))

			text = []
			for respuesta in option:
				text.append(respuesta[2] + ") " + respuesta[1])

			final_text = ' '.join(text)

			msg.body(final_text)
			responded = True
		else:
			# Convertir a lista
			response = list(pickle.loads(get_cache))
			if response:
				# Result devuelve una lista con el tuple q concuerda al filtro
				result = [item for item in response if item[2] == answer]
				if result:
					# Buscar las opciones siguentes a la anterior
					cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", result[0][0])
					option = cursor.fetchall()
					if option:
						cache.hset('customers',sender, pickle.dumps(option))

						text = []
						for respuesta in option:
							text.append(respuesta[2] + ") " + respuesta[1])

						final_text = ' '.join(text)

						msg.body(final_text)
						responded = True

					else:
						msg.body('no hay mas opciones')
						responded = True
				else:
					msg.body('la opcion enviada no corresponde')
					responded = True

			else:
				# No cache
				cursor.execute("SELECT IdBotOption, Guid, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org[0])
				option = cursor.fetchall()

				cache.hset('customers',sender, pickle.dumps(option))

				text = []
				for respuesta in option:
					text.append(respuesta[2] + ") " + respuesta[1])

				final_text = ' '.join(text)

				msg.body(final_text)
				responded = True

		if not responded:
			msg.body('responded false')

		return str(resp)


@app.route('/db', methods=['GET'])
def db():
	conn = mysql.connect()
	cursor = conn.cursor()

	cursor.execute("SELECT * from Test")
	data = cursor.fetchone()
	return jsonify({"desired": data})

@app.route('/redis', methods=['GET'])
def redis():

	delcache = cache.hdel('customers','+5491141461868')
	get_cache = cache.hget('customers','+5491141461868')
	if get_cache == None:
		return 'es null'
	else:
		pass

@app.route('/org/<guid>', methods=['POST'])
def org(guid):
	answer = request.form.get("Answer")
	conn = mysql.connect()
	cursor = conn.cursor()

	# Get Organization
	cursor.execute("SELECT * from Organization WHERE Guid=%s", guid)
	org = cursor.fetchone()

	if org:
		get_cache = cache.hget('customers','+5491141461868')
		if get_cache == None:
			cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org[0])
			option = cursor.fetchall()

			cache.hset('customers','+5491141461868', pickle.dumps(option))

			text = []
			for respuesta in option:
				text.append(respuesta[2] + ") " + respuesta[1])

			final_text = ' '.join(text)

			return final_text
		else:
			# Convertir a lista
			response = list(pickle.loads(get_cache))
			if response:
				# Result devuelve una lista con el tuple q concuerda al filtro
				result = [item for item in response if item[2] == answer]
				if result:
					# Buscar las opciones siguentes a la anterior
					cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", result[0][0])
					option = cursor.fetchall()
					if option:
						cache.hset('customers','+5491141461868', pickle.dumps(option))

						text = []
						for respuesta in option:
							text.append(respuesta[2] + ") " + respuesta[1])

						final_text = ' '.join(text)

						return final_text

					else:
						return 'no hay mas opciones'
				else:
					return 'la opcion enviada no corresponde'

			else:
				# No cache
				cursor.execute("SELECT IdBotOption, Guid, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org[0])
				option = cursor.fetchall()

				cache.hset('customers','+5491141461868', pickle.dumps(option))

				text = []
				for respuesta in option:
					text.append(respuesta[2] + ") " + respuesta[1])

				final_text = ' '.join(text)

				return final_text

@app.route("/")
def hello():
	return "Hello World!"

if __name__ == '__main__':
	app.run()
