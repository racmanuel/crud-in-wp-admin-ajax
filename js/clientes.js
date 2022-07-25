jQuery(document).ready(function ($) {
    $('#data-form').submit(function (e) { 
        e.preventDefault();
        var nombres = $('#nombre').val();
        var apellido_mat = $('#apellido_materno').val();
        var apellido_pat = $('#apellido_paterno').val();

        alert(nombres + apellido_mat +apellido_pat);
    });
});