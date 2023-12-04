var tabla_Clientes;
var procesoValidacion;
var validarCampos = true;

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const btnNuevoCliente = document.querySelector('#btnNuevoCliente');
    const btnGuardar = document.querySelector('#btnGuardar');

    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_Clientes = $("#TbClientes").DataTable({
        // Botones para exportar información
        dom: 'Bfrtip',
        // Petición para llenar la tabla
        "ajax": {
            url: '/clientes/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Cliente', visible: false},
            {data: 'Razon_Social'},
            {data: 'Nombre_Comercial'},
            {data: 'RFC'},
            {data: "Imagen_Cliente", "render": function(data, type, row) {
                    if (data != "" && data != null){
                        return `<img src="Archivos_ETIC/clientes_img/${data}" width="40" height="40"/>`;
                    }else{
                        return "";
                    }
                }
            },
            {data: 'Estatus', visible: false},
            {data: 'Creado_Por', visible: false},
            {data: 'Fecha_Creacion', visible: false},
            {data: 'Modificado_Por', visible: false},
            {data: 'Fecha_Mod', visible: false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    return `<button class="btn btn-info btn-sm EditarCliente" value="${row.Id_Cliente}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm EliminarCliente" value="${row.Id_Cliente}" onclick="eliminarCliente(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                } 
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        // ORDENAMIENTO POR LA COLUMNA FECHACREACION ASC COLUMNA 9
        order: [7, 'DESC'],
        // Habilitar o deshabilitar el ordenable en las columnas
        'columnDefs': [ {
            'targets': [10], /* table column index */
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
                    columns: [1,2,3,4,5,6]
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
                    columns: [1,2,3,4,5,6]
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
                    columns: [1,2,3,4,5,6]
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
                    columns: [1,2,3,4,5,6]
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
    $('#TbClientes tbody').on('click', '.EditarCliente', function () {
        var dataRow = tabla_Clientes.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarCliente(dataRow);
    });

    validarFrm();
    cargarEventListeners();
});

/* Listeners */
function cargarEventListeners() {
    // Se activa cuando se presiona "Nuevo"
    btnNuevoCliente.addEventListener('click', () =>{
        cambiarAction('create');
    });
    // Se activa cuando se hace clic en el boton guardar del modal
    btnGuardar.addEventListener('click', guardarDatosCliente);
}

/* Funciones */

// Función que agrega un cliente nuevo a la BD o edita un cliente
function guardarDatosCliente(){
    if($("#FrmClientes").valid()){
        // Obtenemos la operacion a realizar create ó update
        var form_action = $("#FrmClientes").attr("action");
        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("FrmClientes"));
        $.ajax({
            data: formData,
            url: form_action,
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res)
                if(res.status == true){
                    // Despues de crearse el registro en BD se actualiza la tabla
                    $('#TbClientes').DataTable().ajax.reload();
                    // Se limpia el formulario
                    limpiarFrm()
                    // Se cierra el modal
                    $('#modalAgregarCliente').modal('hide');
                    // Mostramos mensaje de operacion exitosa
                    Toast.fire({
                        icon: 'success',
                        title: 'Agregado'
                    })
                }else{
                    // Mostramos mensaje de error
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrió un problema'
                    })
                }
            },
            error: function (err) {
                console.log(err);
                // Mostramos mensaje de error
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrió un problema 2'
                })
            }
        });
    }
};

function eliminarCliente(id){
    $.ajax({        
        url: 'clientes/delete/'+id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            // Despues de eliminar el registro en BD se actualiza la tabla
            $('#TbClientes').DataTable().ajax.reload();
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
function editarCliente(dataRow){
    console.log(dataRow);
    document.querySelector('#Id_Cliente').value = dataRow.Id_Cliente;
    document.querySelector('#Razon_Social').value = dataRow.Razon_Social;
    document.querySelector('#Nombre_Comercial').value = dataRow.Nombre_Comercial;
    document.querySelector('#RFC').value = dataRow.RFC;
    document.querySelector('#Imagen_Cliente_actual').value = dataRow.Imagen_Cliente;
    
    if(dataRow.Estatus == "Inactivo"){
        document.querySelector('#Estatus').checked = false;
    }

    $('#modalAgregarCliente').modal('show');
}

// Función que limpia el formulario y cambia el action
// cuando se va a agregar o editar un registro
function cambiarAction(operacion){
    limpiarFrm();

    //Op ternario para indicar que campos validar en crear o editar
    operacion.indexOf('update') >= 0 ? validarCampos = false : validarCampos = true;

    document.querySelector("#FrmClientes").removeAttribute("action");
    document.querySelector("#FrmClientes").setAttribute("action",`/clientes/${operacion}`);
}

// Función que restablece todo el form
function limpiarFrm(){
    // Limpia los valores del form
    $('#FrmClientes')[0].reset();
    // Quita los mensajes de error y limpia los valodes del form
    procesoValidacion.resetForm();
    // Quita los estilos de error de los inputs
    $('#FrmClientes').find(".is-invalid").removeClass("is-invalid");
}

function validarFrm(){
    procesoValidacion = $('#FrmClientes').validate({
        rules: {
          Razon_Social: {
            required: true
          },
          Nombre_Comercial: {
            required: true
          },
          RFC: {
            required: false
          },
          Imagen_Cliente: {
            required: function () {
                return validarCampos
            },
            extension: "jpg|jpeg|png|JPG|JPEG|PNG"
          },
        },
        messages: {
          Razon_Social: {
            required: "Ingresar razón social"
          },
          Nombre_Comercial: {
            required: "Ingresar nombre comercial"
          },
          RFC: {
            required: "Ingresar RFC"
          },
          Imagen_Cliente: {
            required: "Seleccionar imagen",
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