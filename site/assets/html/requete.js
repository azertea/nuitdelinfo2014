//connect en tant que ong


// recherche ONG
$(document).ready(function($) {


    var data ={0 : {'nom':'Hugo', 'prenom':'Patate'},
						  1 : {'nom':'jules', 'prenom':'Caca'}};
	console.log(data.length);
	for (var i = 0 ; i < 2 ; i++ ) {
				$("#result").append('<div type="button" class="lookingfor"><p>'+data[i]['nom']+'</p><p>'+data[i]['prenom']+'</p></div>');
			}

	$("#form_submit").click(function(event) {

		$.ajax({
			url: '../../core/api/api.php?type=2',
			type: 'POST',
			dataType: 'json',
			data: {	name: $("#form_name").val(),
					forename: $("#form_surname").val(),
					desc: $("#form_desc").val(),
					loc: $("#form_location").val(),
					phone: $("#form_phonenumber").val(),
				},
		})
		.done(function(data) {
			console.log("success");

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
});
// recherche public