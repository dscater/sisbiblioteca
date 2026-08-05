var e_input = `<input value="" class="form-control">`;
// var e_edit = `<span class="edit" data-toggle="tooltip" title="Agregar registro"><i class="fa fa-edit"></i></span>`;
var e_edit = `<span class="edit" title="Agregar registro"><i class="fa fa-edit"></i></span>`;
// var e_check = `<span class="check oculto" data-toggle="tooltip" title="Guardar"><i class="fa fa-check"></i></span>`;
var e_check = `<span class="check oculto" title="Guardar"><i class="fa fa-check"></i></span>`;
// var e_cancel = `<span class="cancel oculto" data-toggle="tooltip" title="Cancelar"><i class="fa fa-times"></i></span>`
var e_cancel = `<span class="cancel oculto" title="Cancelar"><i class="fa fa-times"></i></span>`;
$(document).ready(function () {
    iniciaElementos();
    iniciaAños();
    $(document).on("click", ".info_editable span.edit", function () {
        // al presionar en el boton edit mostrar un input
        // y mostrar los otros botones
        let info_editable = $(this).parent();
        let select = info_editable.children("select");
        let check = info_editable.children(".check");
        let cancel = info_editable.children(".cancel");

        // OCULTAR EL ELEMENTO SELECT
        ocultarElemento(select);
        let input = info_editable.children("input");
        if (input.length == 0) {
            // comprobar si el input ya existe
            $(this).before(e_input);
            input = info_editable.children("input");
        }
        // poner en foco el input
        input.focus();

        // ocultar y mostrar elementos
        ocultarElemento($(this));
        mostrarElemento(check);
        mostrarElemento(cancel);
    });

    $(document).on("click", ".info_editable span.cancel", function () {
        // al presionar en el boton cancel eliminar el input
        // ocultar los 2 botones edit,check y mostrar el edit
        let info_editable = $(this).parent();
        let select = info_editable.children("select");
        let check = info_editable.children(".check");
        let edit = info_editable.children(".edit");
        let input = info_editable.children("input");
        if (input.length > 0) {
            // comprobar si el input ya existe
            input.remove();
        }
        mostrarElemento(select);
        mostrarElemento(edit);
        ocultarElemento(check);
        ocultarElemento($(this));
    });

    $(document).on("click", ".info_editable span.check", function () {
        // si presiona el boton check debe guardar el nuevo registro
        let info_editable = $(this).parent();
        let select = info_editable.children("select");
        let cancel = info_editable.children(".cancel");
        let check = $(this);
        let edit = info_editable.children(".edit");
        let input = info_editable.children("input");
        let url = info_editable.attr("data-url");
        let col = info_editable.attr("data-col");
        let value = input.val();
        data = {};
        if (value.trim() != "") {
            data[col] = value;
            // REGISTRAR ELEMENTO
            $.ajax({
                headers: { "X-CSRF-TOKEN": $("#token").val() },
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    // AGREGAR LA NUEVA OPCION
                    select.append(
                        `<option value="${response.id}">${response.valor}</option>`,
                    );
                    // REINICIAR TODO
                    input.remove();
                    ocultarElemento(check);
                    ocultarElemento(cancel);
                    mostrarElemento(edit);
                    select.val(`${response.id}`); //PONER EN FOCO EL NUEVO ELEMENTO
                    mostrarElemento(select);
                    mensajeNotificacion(`${response.msj}`, "success");
                },
            }).fail(function (e) {
                mensajeNotificacion(
                    "Error. Algo salio mal intente mas tarde por favor",
                    "error",
                );
            });
        }
    });
});

function ocultarElemento(e) {
    e.addClass("oculto");
}

function mostrarElemento(e) {
    e.removeClass("oculto");
}

function iniciaElementos() {
    let info_editables = $(".info_editable");
    info_editables.each(function () {
        let edit = $(this).children(".edit");
        let check = $(this).children(".check");
        let cancel = $(this).children(".cancel");
        if (edit.length == 0) {
            $(this).append(e_edit);
        }
        if (check.length == 0) {
            $(this).append(e_check);
        }
        if (cancel.length == 0) {
            $(this).append(e_cancel);
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
}

function iniciaAños() {
    let select_anios = $("#fecha_anio");
    let anio_inicial = 1000;
    let fecha = new Date();
    let anio_actual = fecha.getFullYear();
    for (let i = anio_inicial; i <= parseInt(anio_actual); i++) {
        select_anios.append(`<option value="${i}">${i}</option>`);
    }

    setTimeout(function () {
        $(".overlay.dark").addClass("oculto");
    }, 500);
}
