//connect en tant que ong


// recherche Public
$(document).ready(function($) {


	$("#form_submit").click(function(event) {
		$("#result").empty();
		$.ajax({
			url: '../../core/api/api.php?type=2&user=0',
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
			/*for (var i = 0; i < data.length; ++i) 
				$("#result").append('<p>'+data[i]['prenom']+'</p>');*/

			$("#result").append('</p></div>');

		})
		.fail(function() {
			console.log("error");
		})
	});
});
// recherche public