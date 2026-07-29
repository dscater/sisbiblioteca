let btnConfirmaPrestamo = $('#btnConfirmaPrestamo');
let btnConfirmaPrestamoSolicitud = $('#btnConfirmaPrestamoSolicitud');
let libro_id = $('#libro_id');
let lector_id = $('#lector_id');
let solicitud_id = $('#solicitud_id');
let formStorePrestamo = $('#formStorePrestamo');
let modal_confirma_prestamo = $('#modal-confirma_prestamo');
let mensaje_confirma_prestamo_libro = $('#mensaje_confirma_prestamo_libro');
let mensaje_confirma_prestamo_lector = $('#mensaje_confirma_prestamo_lector');

let fecha_devolucion = $('#fecha_devolucion');
let observaciones = $('#observaciones');

$(document).ready(function () {
    libro_id.change(validaSelects);
    lector_id.change(validaSelects);
    fecha_devolucion.on('change keyup', validaSelects);
    
    solicitud_id.change(validaSelectsSolicitud);
    fecha_devolucion.on('change keyup', validaSelectsSolicitud);

    formStorePrestamo.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.after(error);
        },
        rules: {},
    });

    btnConfirmaPrestamo.click(function () {
        infoLibro();
    });

    btnConfirmaPrestamoSolicitud.click(function () {
        infoSolicitud();
    });

    $('#btnRegistraPrestamo').click(function () {
        formStorePrestamo.submit();
    });
});

function validaSelects() {
    btnConfirmaPrestamo.prop('disabled', true);
    if (libro_id.val() != '' && lector_id.val() != '' && fecha_devolucion.val() != '') {
        btnConfirmaPrestamo.prop('disabled', false);
    }
}

function validaSelectsSolicitud() {
    btnConfirmaPrestamoSolicitud.prop('disabled', true);
    if (solicitud_id.val() != '' && fecha_devolucion.val() != '') {
        btnConfirmaPrestamoSolicitud.prop('disabled', false);
    }
}

function infoSolicitud() {
    $.ajax({
        type: "GET",
        url: $('#urlInfoSolicitud').val(),
        data: {
            id: solicitud_id.val()
        },
        dataType: "json",
        success: function (response) {
            infoLector();
            mensaje_confirma_prestamo_libro.html(`
            <b>Título:</b> ${response.libro.titulo}<br>
            <b>Tipo:</b> ${response.libro.tipo}<br>
            <b>Autor:</b> ${response.autor.nombre}<br>
            <b>Editorial:</b> ${response.editorial.nombre}<br>
            <b>Volumen:</b> ${response.volumen.nombre}
            <hr>
            `);

            mensaje_confirma_prestamo_lector.html(`
            <b>Código Solicitud:</b> ${response.solicitud.codigo}<br>
            <b>Fecha solicitud:</b> ${response.solicitud.fecha_solicitud}<br>
            <hr>
            <b>Nombre Lector:</b> ${response.lector.nombre} ${response.lector.apellidos}<br>
            <b>C.I.:</b> ${response.lector.ci} ${response.lector.ci_exp}
            <hr>
            <b>Fecha de devolución:</b> ${fecha_devolucion.val()}<br>
            <b>Observaciones:</b> ${observaciones.val()}<br>
            `);

            modal_confirma_prestamo.modal('show');
        }
    });
}

function infoLibro() {
    $.ajax({
        type: "GET",
        url: $('#urlInfoLibro').val(),
        data: {
            id: libro_id.val()
        },
        dataType: "json",
        success: function (response) {
            infoLector();
            mensaje_confirma_prestamo_libro.html(`
            <b>Título:</b> ${response.libro.titulo}<br>
            <b>Tipo:</b> ${response.libro.tipo}<br>
            <b>Autor:</b> ${response.autor.nombre}<br>
            <b>Editorial:</b> ${response.editorial.nombre}<br>
            <b>Volumen:</b> ${response.volumen.nombre}
            <hr>
            `)
        }
    });
}

function infoLector() {
    $.ajax({
        type: "GET",
        url: $('#urlInfoLector').val(),
        data: {
            id: lector_id.val()
        },
        dataType: "json",
        success: function (response) {
            mensaje_confirma_prestamo_lector.html(`<b>Nombre Lector:</b> ${response.lector.nombre} ${response.lector.apellidos}<br>
            <b>C.I.:</b> ${response.lector.ci} ${response.lector.ci_exp}<br>
            <b>Celular:</b> ${response.lector.cel}<br>
            <hr>
            <b>Fecha de devolución:</b> ${fecha_devolucion.val()}<br>
            <b>Observaciones:</b> ${observaciones.val()}<br>
            `);
            modal_confirma_prestamo.modal('show');
        }
    });
}
