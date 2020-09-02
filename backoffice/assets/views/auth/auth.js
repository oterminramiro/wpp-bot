grecaptcha.ready(function () {
	let public_key = $('#public_key').val();
	grecaptcha.execute(public_key, { action: 'homepage' })
	.then(function (token) {
		var recaptchaResponse = document.getElementById('recaptchaResponse');
		recaptchaResponse.value = token;
		$('#loginbtn').prop('disabled', false);
	});
});
