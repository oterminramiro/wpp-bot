from flask import Flask, request, jsonify
from flaskext.mysql import MySQL
import redis
import requests
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
	#cache.hset('customers','+5491141461868', 'hola')
	#delcache = cache.hdel('customers','+5491141461868')
	get = cache.hget('customers','+5491141461868')
	if get == None:
		return 'es null'
	else:
		return get



if __name__ == '__main__':
	app.run()
