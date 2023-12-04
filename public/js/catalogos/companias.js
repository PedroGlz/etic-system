var tabla_Companias;
var validarCampos = true;
var procesoValidacion;

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const btnNuevoCompanias = document.querySelector('#btnNuevoCompanias');
    const btnGuardar = document.querySelector('#btnGuardar');

    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_Companias = $("#TbCompanias").DataTable({
        // Petición para llenar la tabla
        "ajax": {
            url: '/companias/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Compania', visible:false},
            {data: 'Id_Giro', render: function(data, type, row) {
                    return row.nombreGiro;
                }
            },
            {data: 'Id_Pais', render: function(data, type, row) {
                    return row.nombrePais;
                }
            },
            {data: 'Compania'},
            {data: 'Logotipo',"render": function(data, type, row) {
                    if (data != "" && data != null){
                        return `<img src="Archivos_ETIC/companias_logotipos/${data}" width="40" height="40"/>`;
                    }else{
                        return "";
                    }
                }
            },
            {data: 'Pagina_web'},
            {data: 'Estatus', visible: false},
            {data: 'Creado_Por', visible:false},
            {data: 'Fecha_Creacion', visible:false},
            {data: 'Modificado_Por', visible:false},
            {data: 'Fecha_Mod', visible:false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    return `<button class="btn btn-info btn-sm EditarCompanias" value="${row.Id_Compania}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm EliminarCompanias" value="${row.Id_Compania}" onclick="eliminarCompanias(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                }
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        order: [[0, 'desc']],
        // Habilitar o deshabilitar el ordenable en las columnas
        'columnDefs': [ {
            'targets': [11], /* table column index */
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
                        columns: [1,2,3,6,8]
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
                        columns: [1,2,3,6,8]
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
                        columns: [1,2,3,6,8]
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
                        columns: [1,2,3,6,8]
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
    $('#TbCompanias tbody').on('click', '.EditarCompanias', function () {
        var dataRow = tabla_Companias.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarCompanias(dataRow);
    });
    
    crearSelectGiros('Id_Giro');
    crearSelectPaises('Id_Pais');
    validarFrm()
    cargarEventListeners();
});

/* Listeners */
function cargarEventListeners() {
    // Se activa cuando se presiona "Nuevo"
    btnNuevoCompanias.addEventListener('click', () =>{
        cambiarAction('create');
    });
    // Se activa cuando se hace clic en el boton guardar del modal
    btnGuardar.addEventListener('click', guardarDatosCompanias);
}

/* Funciones */

// Función que agrega un cliente nuevo a la BD o edita un cliente
function guardarDatosCompanias(){
    if($("#FrmCompanias").valid()){
        // Obtenemos la operacion a realizar create ó update
        var form_action = $("#FrmCompanias").attr("action");
        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("FrmCompanias"));
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
                $('#TbCompanias').DataTable().ajax.reload();
                // Se limpia el formulario
                limpiarFrm()
                // Se cierra el modal
                $('#modalAgregarCompanias').modal('hide');
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

function eliminarCompanias(id){
    $.ajax({
        url: 'companias/delete/'+id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            // Despues de eliminar el registro en BD se actualiza la tabla
            $('#TbCompanias').DataTable().ajax.reload();
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
function editarCompanias(dataRow){
    console.log(dataRow);
    document.querySelector('#Id_Compania').value = dataRow.Id_Compania;
    document.querySelector('#Compania').value = dataRow.Compania;
    document.querySelector('#Id_Giro').value = dataRow.Id_Giro;
    document.querySelector('#Id_Pais').value = dataRow.Id_Pais;
    document.querySelector('#Pagina_web').value = dataRow.Pagina_web;
    document.querySelector('#foto_Actual').value = dataRow.Logotipo;

    if(dataRow.Estatus == "Inactivo"){
        document.querySelector('#Estatus').checked = false;
    }

    $('#modalAgregarCompanias').modal('show');
}

// Función que limpia el formulario y cambia el action
// cuando se va a agregar o editar un registro
function cambiarAction(operacion){
    limpiarFrm();
    
    //Op ternario para indicar que campos validar en crear o editar
    operacion.indexOf('update') >= 0 ? validarCampos = false : validarCampos = true;
        
    document.querySelector("#FrmCompanias").removeAttribute("action");
    document.querySelector("#FrmCompanias").setAttribute("action",`/companias/${operacion}`);    
}

// Función que restablece todo el form
function limpiarFrm(){
    // Limpia los valores del form
    $('#FrmCompanias')[0].reset();
    // Quita los mensajes de error y limpia los valodes del form
    procesoValidacion.resetForm();
    // Quita los estilos de error de los inputs
    $('#FrmCompanias').find(".is-invalid").removeClass("is-invalid");
}

function validarFrm(){
    procesoValidacion = $('#FrmCompanias').validate({
        rules: {
          Compania: {
            required: true
          },
          Id_Giro: {
            required: true
          },
          Id_Pais: {
            required: true
          },
          Pagina_web: {
            required: true,
          },
          Logotipo: {
            required: function () {
                return validarCampos
            },
            extension: "jpg|jpeg|png|JPG|JPEG|PNG"
          },
        },
        messages: {
          Compania: {
            required: "Ingresar compañía"
          },
          Id_Giro: {
            required: "Seleccionar giro"
          },
          Id_Pais: {
            required: "Seleccionar país"
          },
          Pagina_web: {
            required: "Ingresar pagina web",
          },
          Logotipo: {
            required: "Seleccionar foto",
            extension: "Archivo no valido"
          },
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