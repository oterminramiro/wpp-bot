
let eventStatus = false;

$(document).ready(function () {
	$('.gc-container').groceryCrud({
		onRowMount: function (primaryKeyField) {
			if (eventStatus == false) {
				eventClick()
				eventStatus = true
			}
		},
	});

	function eventClick() {
		$('.modal-open').parent().click(function (event) {
			event.preventDefault();
			let href = $(this).attr('href');
			let title = $(this).html();
			let text = $(this).attr('title');
			$('#iframe').attr('src', href)
			$('#title').html(title)
			$('#title').append(text)
			$('.gc-iframe-modal').gc_modal('show');
		});

		$('.send-mail').parent().click(function (event) {
			event.preventDefault();
			let href = $(this).attr('href');
			$.ajax({
				type: "POST",
				url: href,
				success: function (data) {
					swal("Mail enviado", "Revisa tu correo!", "success").then((data) => {
						//
					});
				},
				error: function (data) {
					swal("Error interno", "Intente mas tarde", "error").then((data) => {
						console.log(data);
					});
				}
			})
		});
	}

});
