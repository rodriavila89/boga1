
var base = $( 'base' ).attr( 'href' );

$(document).ready(function () {
    $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
    });
});
// recuperamos la informacion que nos ha enviado el servidor
function process(ajaxResponse){ 
    // asumimos que el resultado es un objeto 
    // serializado en JSON, razón por la cual tomamos este dato
    // y lo procesamos para recuperar un objeto que podamos
    // manejar fácilmente
    if (typeof ajaxResponse == "string")
        ajaxResponse = $.parseJSON(ajaxResponse);
    return ajaxResponse;
}

//----------------------------------------------------------------------------//
//----------------------------------------------------------------------------//
//@ok 
(function($) {
    $.fn.serializar = function() {
        var toReturn    = [];
        var els         = $(this).find(':input').get();
        $.each(els, function() {
            if (this.name && !this.disabled && (this.checked || /select|textarea/i.test(this.nodeName) || /text|hidden|password/i.test(this.type))) {
                var val = $(this).val();
                //toReturn.push('p_'+ encodeURIComponent(this.name) + "=" + encodeURIComponent( val ) );
                toReturn.push( encodeURIComponent(this.name) + "=" + encodeURIComponent( val ) );
            }
        });   
        return toReturn.join("&").replace(/%20/g, "+");
    }
})(jQuery); 

//----------------------------------------------------------------------------//
//----------------------------------------------------------------------------//
//@ok 

function ir(url){

  window.location=url;
}
