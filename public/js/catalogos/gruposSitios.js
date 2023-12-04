var tabla_Grupos_Sitios;
var procesoValidacion;

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const btnNuevoGrupoSitio = document.querySelector('#btnNuevoGrupoSitio');
    const btnGuardar = document.querySelector('#btnGuardar');

    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_Grupos_Sitios = $("#TbGruposSitios").DataTable({
        // Petición para llenar la tabla
        "ajax": {
            url: '/gruposSitios/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Grupo_Sitios', visible:false},
            {data: 'Id_Cliente', render: function(data, type, row) {
                return row.nombreCliente;
                }
            },
            {data: 'Grupo'},
            {data: 'Estatus', visible: false},
            {data: 'Creado_Por', visible:false},
            {data: 'Fecha_Creacion', visible:false},
            {data: 'Modificado_Por', visible:false},
            {data: 'Fecha_Mod', visible:false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    return `<button class="btn btn-info btn-sm EditarGrupo" value="${row.Id_Grupo_Sitios}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm EliminarGrupo" value="${row.Id_Grupo_Sitios}" onclick="eliminarGrupo(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                }
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        order: [[0, 'desc']],
        // Habilitar o deshabilitar el ordenable en las columnas
        'columnDefs': [ {
            'targets': [7], /* table column index */
            'orderable': false, /* true or false */
         }],
        // Cambiamos a espeañol el idioma de los mensajes
        language: {
            info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty:      "Mostrando 0 a 0 de 0 registros",
            lengthMenu:     "Mostrar _MENU_ registros",
            search:         "Buscar:",
            loadingRecords: "Loading...",
            processing:     "Procesando...",
            zeroRecords:    "No hay registros aún",
            paginate: {
                // previous: "Anterior",
                // next: "Siguiente"
                next: '>',
                previous: '<',
                first:'Inicio',
                last:'Ultimo'
            },
        },
        // Mostrar los botones de paginación Inicio y Ultimo
        pagingType: 'full_numbers',
        // Botones para exportar información
        // dom: '<"row"<"col"B><"col"f>>rt<"row"<"col"l><"col"p>>',
        dom: '<"row"<"col"f>>rt<"row"<"col"l><"col"p>>',
        buttons: [
            {
                extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    columns: [1,2]
                },
                styles: {
                    tableHeader: {
                        alignment: 'center'
                    },
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: [1,2]
                },
                styles: {
                    tableHeader: {
                        alignment: 'center'
                    },
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: [1,2]
                },
                styles: {
                    tableHeader: {
                        alignment: 'center'
                    },
                },
                customize: function(doc) {
                    /** this line changes the alignment of 'messageBottom' and 'messageTop' **/
                    doc.styles.message.alignment = "right"
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: [1,2]
                },
                styles: {
                    tableHeader: {
                        alignment: 'center'
                    },
                }
            }
        ],
        // Hacer el datatable responsive
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        /* Para habilitar el scroll's, quitar las lineas de responsive */
        // scrollY: 200, //Scroll vertial
        // scrollX: true, //Scroll horizonta
    })

    // Obtiene todos los datos del registro en el datatable al dar clic en editar
    $('#TbGruposSitios tbody').on('click', '.EditarGrupo', function () {
        var dataRow = tabla_Grupos_Sitios.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarGrupo(dataRow);
    });

    crearSelectClientes('Id_Cliente');
    validarFrm()
    cargarEventListeners();
});

/* Listeners */
function cargarEventListeners() {
    // Se activa cuando se presiona "Nuevo"
    btnNuevoGrupoSitio.addEventListener('click', () =>{
        cambiarAction('create');
    });
    // Se activa cuando se hace clic en el boton guardar del modal
    btnGuardar.addEventListener('click', guardarDatosGrupo);
}

/* Funciones */

// Función que agrega un cliente nuevo a la BD o edita un cliente
function guardarDatosGrupo(){
    console.log("entro a guardar")
    if($("#FrmGrupos").valid()){
        // Obtenemos la operacion a realizar create ó update
        var form_action = $("#FrmGrupos").attr("action");
        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("FrmGrupos"));
        $.ajax({
            data: formData,
            url: form_action,
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res)
                // Despues de crearse el registro en BD se actualiza la tabla
                $('#TbGruposSitios').DataTable().ajax.reload();
                // Se limpia el formulario
                limpiarFrm()
                // Se cierra el modal
                $('#modalAgregarGrupo').modal('hide');
                // Mostramos mensaje de operacion exitosa
                Toast.fire({
                    icon: 'success',
                    title: 'Agregado'
                })
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
};

function eliminarGrupo(id){
    $.ajax({
        url: 'gruposSitios/delete/'+id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            // Despues de eliminar el registro en BD se actualiza la tabla
            $('#TbGruposSitios').DataTable().ajax.reload();
            // Mensaje de operacion exitosa
            Toast.fire({
                icon: 'success',
                title: 'Eliminado'
            })
        },
        error: function (err) {
            console.log(err);
        }
    });
}

// Función que cargar los datos del row clickeado y los coloca en el form y abre el modal
function editarGrupo(dataRow){
    console.log(dataRow);
    document.querySelector('#Id_Grupo_Sitios').value = dataRow.Id_Grupo_Sitios;
    document.querySelector('#Id_Cliente').value = dataRow.Id_Cliente;
    document.querySelector('#Grupo').value = dataRow.Grupo;

    if(dataRow.Estatus == "Inactivo"){
        document.querySelector('#Estatus').checked = false;
    }

    $('#modalAgregarGrupo').modal('show');
}

// Función que limpia el formulario y cambia el action
// cuando se va a agregar o editar un registro
function cambiarAction(operacion){
    limpiarFrm();
    document.querySelector("#FrmGrupos").removeAttribute("action");
    document.querySelector("#FrmGrupos").setAttribute("action",`/gruposSitios/${operacion}`);
}

// Función que restablece todo el form
function limpiarFrm(){
    // Limpia los valores del form
    $('#FrmGrupos')[0].reset();
    // Quita los mensajes de error y limpia los valodes del form
    procesoValidacion.resetForm();
    // Quita los estilos de error de los inputs
    $('#FrmGrupos').find(".is-invalid").removeClass("is-invalid");
}

function validarFrm(){
    procesoValidacion = $('#FrmGrupos').validate({
        rules: {
            Id_Cliente: {
                required: true
            },
            Grupo: {
                required: true,
            }
        },
        messages: {
            Id_Cliente: {
                required: "Seleccionar cliente"
            },
            Grupo: {
                required: "Ingresar grupo"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });
}