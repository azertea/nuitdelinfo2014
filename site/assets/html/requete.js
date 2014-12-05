//connect en tant que ong


// recherche ONG
$(document).ready(function($) {
		$("#form_submit").click(function(event) {
		$("#result").empty();
		$.ajax({
			url: '../../core/api/api.php?type=2&user=1',
			type: 'POST',
			dataType: 'json',
			data: {	name: $("#form_name").val(),
					forename: $("#form_surname").val(),
					desc: $("#form_desc").val(),
					loc: $("#form_location").val(),
					phone: $("#form_phonenumber").val(),
				}
		})
		.done(function(data) {
			
			console.log("success");
			$("#result").append('<div type="button" class="lookingfor"><p>Number of persons matching your request : '+data.length+'</p>');
			for (var i = 0 ; i < data.length ; i++ ) {
				$("#result").append('<div type="button" class="lookingfor"><p>'+data[i]['nom']+' '+data[i]['prenom']+'</p></div>');
			}
			$("#result").append('</p></div>');

		})
		.fail(function() {
			console.log("error");
		})
	});
	
});
// recherche public