from flask import Flask, request, jsonify
from flaskext.mysql import MySQL
import requests
from twilio.twiml.messaging_response import MessagingResponse

mysql = MySQL()
app = Flask(__name__)

app.config['MYSQL_DATABASE_HOST'] = 'database'
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'password'
app.config['MYSQL_DATABASE_DB'] = 'flask'

mysql.init_app(app)

@app.route("/")
def hello():
	return "Hello World! aca aca"

@app.route('/bot', methods=['POST'])
def bot():
	incoming_msg = request.values.get('Body', '').lower()
	resp = MessagingResponse()
	msg = resp.message()
	responded = False
	if 'ailu' in incoming_msg:
		msg.body('ailu hermosa')
		responded = True
	if 'gatito' in incoming_msg:
		# return a cat pic
		msg.media('https://cataas.com/cat')
		responded = True
	if 'quote' in incoming_msg:
		# return a quote
		r = requests.get('https://api.quotable.io/random')
		if r.status_code == 200:
			data = r.json()
			quote = f'{data["content"]} ({data["author"]})'
		else:
			quote = 'I could not retrieve a quote at this time, sorry.'
		msg.body(quote)
		responded = True
	if not responded:
		msg.body('escribi "ailu" o "gatito"')
	return str(resp)


@app.route('/db', methods=['GET'])
def db():
	conn = mysql.connect()
	cursor = conn.cursor()

	cursor.execute("SELECT * from Test")
	data = cursor.fetchone()
	return jsonify({"desired": data})



if __name__ == '__main__':
	app.run()
