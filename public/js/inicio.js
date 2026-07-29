var inicio_sesion = false;
var btnReservarClickeado = null;

$(document).ready(function () {
    setInterval(reloj, 1000);
    compruebaSesion();
    reservarLibro();

    $('#buscador').keyup(function () {
        buscador();
    });

    // $('#formConfirmaPrestamo').validate({
    //     errorPlacement: function errorPlacement(error, element) {
    //         element.after(error);
    //     },
    //     rules: {},
    // });

    $('#btnConfirmaPrestamos').click(function () {
        enviaConfirmacion();
    });
});

// Funcion para comprobar si existe una sesion iniciada
function compruebaSesion() {
    $.ajax({
        type: "GET",
        url: $('#urlCompruebaSesion').val(),
        data: {
            data: ''
        },
        dataType: "json",
        success: function (response) {
            inicio_sesion = response;
            if (response) {
                console.log(response);
                compruebaSolicitudes();
            }
        }
    });
}

// Funcion para comprobar si la "sesion iniciada" tiene "solicitudes" 
function compruebaSolicitudes() {
    $.ajax({
        type: "GET",
        url: $('#urlCompruebaSolicitudesLector').val(),
        dataType: "json",
        success: function (response) {
            let link = $('#_solicitudes_lector').children('a');
            let span = link.children('span');
            if (response.sw) {
                link.tooltip('hide')
                    .attr('data-original-title', 'Solicitudes');
                span.text(response.cantidad);
            } else {
                // No tienes solicitudes realizadas
                link.tooltip('hide')
                    .attr('data-original-title', 'No tienes solicitudes realizadas');
            }
        }
    });
}

function iniciaToggleTooltipo() {
    $('[data-toggle="tooltip"]').tooltip();
}

// Funcion para asignar el evento click para obtener la informacion
// del libro al momento de "RESERVAR"
function reservarLibro() {
    $('.opciones a.reservar').click(function (e) {
        e.preventDefault();
        btnReservarClickeado = $(this);
        compruebaSesion();
        if (inicio_sesion) {
            $('#mensaje_acceder_lector').html(``);
            $('#modal-confirma_prestamo').modal('show');
            let id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "GET",
                url: $('#urlInfoLibro').val(),
                data: {
                    id: id
                },
                dataType: "json",
                success: function (response) {
                    $('#libro_id').val(response.libro.id);
                    $('#informacionLibroPrestamo').html(`
                        <div class="contenedor_info_prestamo">
                            <div class="info_titulo">
                            ${response.libro.tipo}: ${response.libro.titulo}
                            </div>
                            <div class="informacion_libro">
                                <table border="1">
                                    <tbody>
                                        <tr>
                                            <td width="100px">Área:</td>
                                            <td>${response.area.nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Autor:</td>
                                            <td>${response.autor.nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Edición:</td>
                                            <td>${response.edicion.nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Volumen:</td>
                                            <td>${response.volumen.nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Lugar:</td>
                                            <td>${response.lugar.nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Editorial:</td>
                                            <td>${response.editorial.nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Año:</td>
                                            <td>${response.libro.fecha_anio}</td>
                                        </tr>
                                        <tr>
                                            <td>Nro. páginas:</td>
                                            <td>${response.libro.nro_paginas}</td>
                                        </tr>
                                        <tr>
                                            <td>ISBN:</td>
                                            <td>${response.libro.isbn}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `);
                }
            });
        } else {
            $('#modal-confirma_prestamo').modal('hide');
            $('#mensaje_acceder_lector').html(`Debes acceder para poder reservar/solicitar un préstamo`);
            $('#modal-acceder_lector').modal('show');
        }
    });
}

// Funcion para enviar el formulario de registro "CONFIRMAR RESERVACION"
function enviaConfirmacion() {
    let data = $('#formConfirmaPrestamo').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#tokven').val()
        },
        type: "POST",
        url: $('#urlStoreSolicitud').val(),
        data: data,
        dataType: "json",
        success: function (response) {
            mensajeNotificacion(`${response.bien}`, 'success');
            compruebaSolicitudes();
            // cambiar el boton reservar por el NO DISPONIBLE
            let no_disponible = `<a href="" class="btn bg-danger btn-sm" style="color:white!important;">NO DISPONIBLE</a>`;
            let info = btnReservarClickeado.siblings('a.info');
            btnReservarClickeado.remove();
            btnReservarClickeado = null;
            info.before(no_disponible);
            $('#modal-confirma_prestamo').modal('hide');
            let link = $('#_solicitudes_lector').children('a');
            link.tooltip('hide')
                    .attr('data-original-title', 'Solicitudes')
                    .tooltip('show');
        }
    });
}

// Funcion para realizar las busquedas de libros/revistas del "BUSCADOR"
function buscador() {
    $('#contenedorInicioLibros').html('Cargando...');
    $.ajax({
        type: "GET",
        url: $('#urlBuscadorLibros').val(),
        data: {
            buscador: $('#buscador').val()
        },
        dataType: "json",
        success: function (response) {
            $('#contenedorInicioLibros').html(response.vista);
            reservarLibro();
        }
    });
}

// Reloj de inicio
function reloj() {
    let meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");;
    let fecha_hora = new Date();
    dia = (fecha_hora.getDate() < 10) ? '0' + fecha_hora.getDate() : fecha_hora.getDate();
    mes = fecha_hora.getMonth();
    anio = fecha_hora.getFullYear();
    $('#fecha').text((dia + " de " + meses[mes] + " de " + anio));
    mes++;
    mes = (mes < 10) ? '0' + mes : mes;
    hora = (fecha_hora.getHours() < 10) ? '0' + fecha_hora.getHours() : fecha_hora.getHours();
    minutos = (fecha_hora.getMinutes() < 10) ? '0' + fecha_hora.getMinutes() : fecha_hora.getMinutes();
    let segundos = (fecha_hora.getSeconds() < 10) ? '0' + fecha_hora.getSeconds() : fecha_hora.getSeconds();
    am_pm = (fecha_hora.getHours() < 12) ? 'a.m.' : 'p.m.';
    $('#reloj').html(`${hora} : ${minutos} : ${segundos} ${am_pm}`);
}

// Activa el reloj
function iniciaConteo() {
    contador = 10;
    conteo = setInterval(function () {
        $('#conteo').text(contador);
        contador--;
        if (contador == -1) {
            clearInterval(conteo);
            $('#m_ingreso1').modal('hide');
            $('#rfid').val('');
            $('#rfid').focus();
        }
    }, 1000);
}
