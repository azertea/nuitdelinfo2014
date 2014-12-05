var main = function(){

  var btn = $('.btn-login');
  var form = $('.form-login');

  btn.click(function(){

    if (btn.hasClass('clicked') === false) {
      form.css('visibility','visible');
      btn.addClass('clicked');
    }
    else {
      form.css('visibility','hidden');
      btn.removeClass('clicked');
    }
  });
};

$(document).ready(main);

