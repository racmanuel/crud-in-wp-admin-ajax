jQuery(document).ready(function ($) {
    
    $('#alerts').hide();

    $('#data-form').submit(function (e) { 
        e.preventDefault();
        var nombre = $('#nombre').val();
        var apellido_mat = $('#apellido_materno').val();
        var apellido_pat = $('#apellido_paterno').val();
        var telefono_1 = $('#telefono_1').val();
        var telefono_2 = $('#telefono_2').val();
        var direccion = $('#direccion').val();
        var auto = $('#auto').val();

        $.ajax({
            type: "POST",
            url: ajax_object.ajax_url,
            data: {
                action: 'my_save_custom_form',
                nombre: nombre,
                apellido_mat: apellido_mat,
                apellido_pat: apellido_pat,
                telefono_1: telefono_1,
                telefono_2: telefono_2,
                direccion: direccion,
                auto: auto
            },
            beforeSend: function (response) {
                $('#alerts').addClass('is-info');
                $('#alerts').show();
                $('#alerts .message-header').html('Enviando datos...');
                $('#alerts .message-body').html('Tomara unos segundos...');
            },
            success: function (response) {
                 // Actualiza el mensaje con la respuesta
                 $('#alerts').addClass('is-success');
                 $('#alerts').show();
                 $('#alerts .message-header').html('Enviado');
                 $('#alerts .message-body').html('Tu datos se han almacenado correctamente en la Base de Datos.');
                 alert(response);
            },
            error: function (response) {
                // Actualiza el mensaje con la respuesta
                $('#alerts').addClass('is-danger');
                $('#alerts').show();
                $('#alerts .message-header').html('Error');
                $('#alerts .message-body').html('Ha ocuriido un error al enviar los datos a la Base de Datos, intentelo nuevamente.');
                alert(response);
           }
        });
    });
});