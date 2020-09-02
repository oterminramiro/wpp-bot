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


@app.route("/")
def hello():
	return "Hello World!"

@app.route('/bot', methods=['POST'])
def bot():

	incoming_msg = request.values.get('Body', '').lower()
	sender = request.values.get("From").split(':')
	sender = sender[1]

	resp = MessagingResponse()
	msg = resp.message()
	responded = False

	if cache.hget('customers',sender) == None:
		if ('ailu' in incoming_msg)  or ('1' in incoming_msg):
			msg.body('ailu hermosa')
			responded = True
		if ('gatito' in incoming_msg) or ('2' in incoming_msg):
			# return a cat pic
			msg.media('https://cataas.com/cat')
			responded = True
		if ('sender' in incoming_msg)  or ('3' in incoming_msg):
			msg.body(sender)
			responded = True
		if ('mas' in incoming_msg)  or ('4' in incoming_msg):
			msg.body("""Mas opciones:
1) inicio
2) pepito
3) ramiro""")
			responded = True
	else:
		cache.hset('customers',sender, incoming_msg)

		if ('inicio' in incoming_msg)  or ('1' in incoming_msg):
			responded = False
		if ('pepito' in incoming_msg)  or ('2' in incoming_msg):
			msg.body('pepito')
			responded = True

	if not responded:
		msg.body("""Hola! Tus opciones son:
1) 'ailu'
2) 'gatito'
3) 'sender'
4) 'mas'
""")
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

@app.route('/org/<username>', methods=['POST'])
def org(username):
	answer = request.form.get("Answer")

	conn = mysql.connect()
	cursor = conn.cursor()

	# Get Organization
	cursor.execute("SELECT * from Organization WHERE Name=%s", username)
	org = cursor.fetchone()

	get_cache = cache.hget('customers','+5491141461868')
	if get_cache == None:
		cursor.execute("SELECT IdBotOption, Guid, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org[0])
		option = cursor.fetchall()

		cache.hset('customers','+5491141461868', pickle.dumps(option))

		return jsonify({"desired": option})
	else:
		# Convertir a lista
		response = list(pickle.loads(get_cache))
		if response:
			# Result devuelve una lista con el tuple q concuerda al filtro
			result = [item for item in response if item[3] == answer]

			# Buscar las opciones siguentes a la anterior
			cursor.execute("SELECT IdBotOption, Guid, Name, KeyWord, IdOptionValue from BotOption WHERE IdOptionValue=%s ORDER BY OrderKey", result[0][0])
			option = cursor.fetchall()

			if option == None:
				return jsonify({"desired": "no option"})
			else:
				return jsonify({"desired": option})
		else:
			cursor.execute("SELECT IdBotOption, Guid, Name, KeyWord, IdOptionValue from BotOption WHERE IdOrganization=%s AND IdOptionValue IS NULL ORDER BY OrderKey", org[0])
			option = cursor.fetchall()

			cache.hset('customers','+5491141461868', pickle.dumps(option))

			return jsonify({"desired": option})


if __name__ == '__main__':
	app.run()
