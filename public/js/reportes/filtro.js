$(document).ready(function () {
    iniciaAños();
    usuarios();
    libros();
    libros_mas_prestados();
    lista_solicitudes();
    lista_devoluciones();
    lista_estado();
});

function usuarios() {
    var role = $('#m_usuarios #role').parents('.form-group');

    role.hide();
    $('#m_usuarios select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                role.hide();
                break;
            case 'role':
                role.show();
                break;
        }
    });
}

function libros() {
    var area = $('#m_libros #area').parents('.form-group');
    var autor = $('#m_libros #autor').parents('.form-group');
    var editorial = $('#m_libros #editorial').parents('.form-group');
    var lugar = $('#m_libros #lugar').parents('.form-group');
    var anio = $('#m_libros #anio').parents('.form-group');
    var ubicacion = $('#m_libros #ubicacion').parents('.form-group');
    var estado = $('#m_libros #estado').parents('.form-group');
    var portal = $('#m_libros #portal').parents('.form-group');

    area.hide();
    autor.hide();
    editorial.hide();
    lugar.hide();
    anio.hide();
    ubicacion.hide();
    estado.hide();
    portal.hide();
    $('#m_libros select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                area.hide();
                autor.hide();
                editorial.hide();
                lugar.hide();
                anio.hide();
                ubicacion.hide();
                estado.hide();
                portal.hide();
                break;
            case 'area':
                area.show();
                autor.hide();
                editorial.hide();
                lugar.hide();
                anio.hide();
                ubicacion.hide();
                estado.hide();
                portal.hide();
                break;
            case 'autor':
                autor.show();
                area.hide();
                editorial.hide();
                lugar.hide();
                anio.hide();
                ubicacion.hide();
                estado.hide();
                portal.hide();
                break;
            case 'editorial':
                editorial.show();
                area.hide();
                autor.hide();
                lugar.hide();
                anio.hide();
                ubicacion.hide();
                estado.hide();
                portal.hide();
                break;
            case 'lugar':
                lugar.show();
                area.hide();
                autor.hide();
                editorial.hide();
                anio.hide();
                ubicacion.hide();
                estado.hide();
                portal.hide();
                break;
            case 'anio':
                anio.show();
                area.hide();
                autor.hide();
                editorial.hide();
                lugar.hide();
                ubicacion.hide();
                estado.hide();
                portal.hide();
                break;
            case 'ubicacion':
                ubicacion.show();
                area.hide();
                autor.hide();
                editorial.hide();
                lugar.hide();
                anio.hide();
                estado.hide();
                portal.hide();
                break;
            case 'estado':
                estado.show();
                area.hide();
                autor.hide();
                editorial.hide();
                lugar.hide();
                anio.hide();
                ubicacion.hide();
                portal.hide();
                break;
            case 'portal':
                portal.show();
                area.hide();
                autor.hide();
                editorial.hide();
                lugar.hide();
                anio.hide();
                ubicacion.hide();
                estado.hide();
                break;
        }
    });
}

function libros_mas_prestados() {
    var fecha_ini = $('#m_libros_mas_prestados #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_libros_mas_prestados #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    $('#m_libros_mas_prestados select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function lista_solicitudes() {
    var fecha_ini = $('#m_lista_solicitudes #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_lista_solicitudes #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    $('#m_lista_solicitudes select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function lista_devoluciones() {
    var fecha_ini = $('#m_lista_devoluciones #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_lista_devoluciones #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    $('#m_lista_devoluciones select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function lista_estado() {
    var area = $('#m_lista_estado #area').parents('.form-group');
    var estado = $('#m_lista_estado #estado').parents('.form-group');
    var portal = $('#m_lista_estado #portal').parents('.form-group');

    area.hide();
    estado.hide();
    portal.hide();
    $('#m_lista_estado select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                area.hide();
                estado.hide();
                portal.hide();
                break;
            case 'area':
                area.show();
                estado.hide();
                portal.hide();
                break;
            case 'estado':
                estado.show();
                area.hide();
                portal.hide();
                break;
            case 'portal':
                portal.show();
                area.hide();
                estado.hide();
                break;
        }
    });
}

function iniciaAños() {
    let select_anios = $('#anio');
    let anio_inicial = 1000;
    let fecha = new Date();
    let anio_actual = fecha.getFullYear();
    for (let i = anio_inicial; i <= parseInt(anio_actual); i++) {
        select_anios.append(`<option value="${i}">${i}</option>`);
    }
}
