let nroNotificaciones = $("#nroNotificaciones");
let contenedorNotificaciones = $("#contenedorNotificaciones");
let totalNotificaciones = $("#totalNotificaciones");

$(document).ready(function () {
    totalNotificaciones.val("0");
    notificaciones();
    setInterval(notificaciones, 5000);
});

function notificaciones() {
    $.ajax({
        type: "GET",
        url: $("#urlNotificaciones").val(),
        dataType: "json",
        success: function (response) {
            // console.log(response);
            const notificacions = response;
            if (notificacions.length > 0) {
                totalNotificaciones.text(notificacions.length);
                nroNotificaciones.text(notificacions.length);
                contenedorNotificaciones.html("");
                notificacions.forEach((notificacion) => {
                    let template = `<a href="${notificacion.notificacion.url}" class="dropdown-item">
                                        <i class="fas fa-info-circle mr-2"></i> ${notificacion.notificacion.descripcion}
                                        <span class="float-right text-muted text-sm">${notificacion.notificacion.hace}</span>
                                    </a>
                                    <div class="dropdown-divider"></div>`;
                    contenedorNotificaciones.append(template);
                });
            }
            // if (parseInt(totalNotificaciones.val()) != response.total) {
            //     totalNotificaciones.val(response.total);
            //     nroNotificaciones.text(response.sinVer);
            //     contenedorNotificaciones.html(response.html);
            // }
        },
    });
}
