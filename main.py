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
	cursor.execute("SELECT IdBotOption, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org)
	option = cursor.fetchall()

	cache.hset('customers',sender, pickle.dumps(option))

	text = []
	for respuesta in option:
		text.append(respuesta[2] + ") " + respuesta[1])

	final_text = ' '.join(text)

	return final_text

@app.route('/bot/<guid>', methods=['POST'])
def bot(guid):
	answer = request.values.get('Body', '').lower()
	sender = request.values.get("From").split(':')
	sender = sender[1]

	delcache = cache.hdel('customers',sender)
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
				final_text = fetch_options_by_org(cursor,org[0],cache,sender)

				msg.body(final_text)
				responded = True

		if not responded:
			msg.body('responded false')

		return str(resp)

if __name__ == '__main__':
	app.run()
