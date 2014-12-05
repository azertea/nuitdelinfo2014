var main = function(){

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
};

$(document).ready(main);

