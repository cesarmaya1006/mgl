$(document).ready(function() {
    //==========================================================================
    $('#proyecto').on('change', function(event) {
        const url_t = $(this).attr('data_url');
        const id = $(this).val();
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                console.log(respuesta);
                respuesta_html = '';
                respuesta_html += '<option value="">Seleccione un usuario</option>';
                $.each(respuesta['empleados'], function(index, item) {
                    respuesta_html += '<option value="' + item['id'] + '">' + item['usuario']['nombres'] + ' ' + item['usuario']['apellidos'] + '</option>';
                });
                $('#usuarios').html(respuesta_html);
            },
            error: function() {

            }
        });

    });
    //==========================================================================
    //==========================================================================
    $('#cargar_tareas').on('click', function(event) {
        const url_t = $(this).attr('data_url');
        const id_usu = $('#usuarios').val();
        const id_pro = $('#proyecto').val();
        if (id_usu && id_pro) {
            window.location.href = url_t + '/' + id_pro + '/' + id_usu;
        } else {
            window.location.href = url_t;
        }


    });
    //==========================================================================
});