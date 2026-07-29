let nroNotificaciones = $('#nroNotificaciones');
let contenedorNotificaciones= $('#contenedorNotificaciones');
let totalNotificaciones = $('#totalNotificaciones');

$(document).ready(function () {
    totalNotificaciones.val('0');
    notificaciones();
    setInterval(notificaciones,2000);
});

function notificaciones()
{
    $.ajax({
        type: "GET",
        url: $('#urlNotificaciones').val(),
        dataType: "json",
        success: function (response) {
            if(parseInt(totalNotificaciones.val()) != response.total)
            {
                totalNotificaciones.val(response.total);
                nroNotificaciones.text(response.sinVer);
                contenedorNotificaciones.html(response.html);
            }
        }
    });
}
