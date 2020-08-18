//funcion de google maps para API
function initMap() {
  console.log(opciones);
  var myLatLng = {lat:parseFloat(opciones.latitud), 
    lng: parseFloat(opciones.longitud)};

  // Create a map object and specify the DOM element
  // for display.
  var map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: parseFloat(opciones.zoom)
  });

  // Create a marker and set its position.
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    title: 'Ortopedia Guanajuato'
  });
}



$ = jQuery.noConflict();

$(document).ready(function(){
  $('.mobile-menu a').on('click', function() {
      $('nav.menu-sitio').toggle('slow');
  });
  var breakpoint = 768;

  $(window).resize(function() {
    ajustarCajas();

    if($(document).width() >= breakpoint){
      $('nav.menu-sitio').show();
    } else {
      $('nav.menu-sitio').hide();
    }
  });
  //ajustarCajas();

  jQuery('.blocks-gallery-item a').each(function(){
    jQuery(this).attr({'data-fluidbox' : ''});
  });
  if(jQuery('[data-fluidbox]').length > 0){
    jQuery('[data-fluidbox]').fluidbox();
  }
});

//ajustar cajas segun tamaño de imagen

function ajustarCajas() {
    var imagenes = $('.imagen-caja');
    if (imagenes.length > 0) {
        var altura = imagenes[0].height;
        var cajas = $('div.contenido-caja');
        $(cajas).each(function(i, elemento) {
            $(elemento).css({'height' : altura +'px'});
            console.log($(elemento).css({'height' : altura +'px'}));
        });
    }
}
