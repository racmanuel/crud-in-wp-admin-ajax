jQuery(document).ready(function ($) {
    $('#data-form').submit(function (e) { 
        e.preventDefault();
        var nombre = $('#nombre').val();
        var apellido_mat = $('#apellido_materno').val();
        var apellido_pat = $('#apellido_paterno').val();
        var telefono_1 = $('#telefono_1').val();
        var telefono_2 = $('#telefono_2').val();
        var direccion = $('#direccion').val();

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
                direccion: direccion
            },
            success: function (response) {
                alert(response);
            }
        });
    });
});