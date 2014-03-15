
// Obtiene el div que contiene la colección de etiquetas
//var collectionHolder = $('#content_data ul');
var domicilioCount = 0;
$('#midbox ul').each(function(i, e) {
    var collectionHolder = $(e);

    // configura una enlace "Agregar una etiqueta"
    var $addTagLink = $('<a href="#" class="add_link">Agregar</a>');
    var $newLinkLi = $('<li></li>').append($addTagLink);



    jQuery(document).ready(function() {
        collectionHolder.find('li').each(function() {
            addTagFormDeleteLink($(this));
        });

        // Añade el ancla "Agregar una etiqueta" y las etiquetas li y ul
        collectionHolder.append($newLinkLi);

        $addTagLink.on('click', function(e) {
            // evita crear el enlace con una "#" en la URL
            e.preventDefault();

            // añade una nueva etiqueta form (ve el siguiente bloque de código)
            addTagForm(collectionHolder, $newLinkLi);
        });
    });

});
function addTagForm(collectionHolder, $newLinkLi) {
    if (collectionHolder.attr('class') == 'domicilio') {
        domicilioCount++;
        if (domicilioCount > 2) {
            return false;
        }
    }

    // Obtiene el data-prototype explicado anteriormente
    var prototype = collectionHolder.attr('data-prototype');

    // cuenta las entradas actuales en el formulario (p. ej. 2),
    // lo usa como el nuevo índice (p. ej. 2)
    var newIndex = collectionHolder.find(':input').length;


    // Reemplaza el '__name__' en el prototipo HTML para que
    // en su lugar sea un número basado en cuántos elementos hay
    var newForm = prototype.replace(/__name__/g, newIndex);

    // Muestra el formulario en la página en un elemento li,
    // antes del enlace 'Agregar una etiqueta'
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#" class="close">Eliminar</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // evita crear el enlace con una "#" en la URL
        e.preventDefault();

        // quita el li de la etiqueta del formulario
        $tagFormLi.remove();


        domicilioCount--;


    });
}



$(document).on('change', '.province_selector', function() {
    var $this = $(this);
    var data = {
        province_id: $this.val()
    };

    $.ajax({
        type: 'post',
        url: '{{ path("select_localidades") }}',
        data: data,
        success: function(data) {
            var $address = $this.closest('.domicilio');
            $address.find('.city_selector').html(data);
        }
    });
});

$(document).on('change', '.area_selector', function() {
    var $this = $(this);

    var data = {
        area_id: $this.val(),
    };

    $.ajax({
        type: 'post',
        url: '{{ path("select_subareas") }}',
        data: data,
        success: function(data) {

            var $address = $this.closest('.conocimientos');
            $address.find('.subArea_selector').html(data);
        }
    });
});

/*$(document).on('click', '.close', function() {
 $(this).closest('.domicilio').fadeOut(500, function() {
 alert("hola");
 $(this).remove();
 });
 });*/