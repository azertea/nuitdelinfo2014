
$(document).ready(function() {
    var btn = $('.btn-login');
    var form = $('.form-login');

    btn.click(function(){

      if (btn.hasClass('clicked') === false) {
        form.css('visibility','visible');
        btn.addClass('clicked');
        btn.parent().addClass('well');

      }
      else {
        form.css('visibility','hidden');
        btn.removeClass('clicked');
        btn.parent().removeClass('well');
      }
    });
  var type = 0;
  if ($("#isONG").checked == true) {
     type = 1;
  }
  $("#index_submit_btn").click(function(event) {
    event.preventDefault();

    var formData = $('#form-login').serialize();

    $.ajax({
      url: '/core/api/api.php?type=' + type + '&method=20',
      type: 'POST',
      data: formData
    })
    .success(function() {
      
      console.log("success");
      window.location.reload();

    })
    .fail(function() {
      console.log("error");
    })
  });
  
});