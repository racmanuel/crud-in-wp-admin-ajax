jQuery(document).ready(function ($) {
    
    $('#alerts').hide();

    $('#data-form').submit(function (e) { 
        e.preventDefault();
        var marca = $('#marca').val();
        var modelo = $('#modelo').val();
        var año = $('#año').val();
        var placa = $('#placa').val();
        var serie = $('#serie').val();

        $.ajax({
            type: "POST",
            url: ajax_object.ajax_url,
            data: {
                action: 'registrar_auto_in_db',
                marca: marca,
                modelo: modelo,
                año: año,
                placa: placa,
                serie: serie
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