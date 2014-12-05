var main = function() {

    var place = $('#map-form');
    var loc = "";
    var curr = "https://www.google.com/maps/embed/v1/place?key=AIzaSyA-ww8bbI0RaGe1Q927-pdxRDuZ-s6Wh3c&q=";

    place.keyup(function(e) {
            if (e.keyCode == 13) {
                loc = curr.concat(loc);
                $('.map').attr("src",loc);
              }
            else {
                
                loc = place.val();
            }
    });

};

$(document).ready(main);