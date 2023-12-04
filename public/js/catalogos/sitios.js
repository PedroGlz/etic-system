var tabla_Sitios;
var procesoValidacion;

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const select_id_cliente = document.querySelector("#Id_Cliente");
    const btnNuevoSitio = document.querySelector('#btnNuevoSitio');
    const btnGuardar = document.querySelector('#btnGuardar');

    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_Sitios = $("#TbSitios").DataTable({
        // Petición para llenar la tabla
        "ajax": {
            url: '/sitios/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Sitio', visible:false},
            {data: 'Id_Cliente', render: function(data, type, row) {
                return row.nombreCliente;
                }
            },
            {data: 'Id_Grupo_Sitios', render: function(data, type, row) {
                return row.nombreGrupoSitio;
                }
            },
            {data: 'Sitio'},
            {data: 'Desc_Sitio'},
            // {data: 'Folder'},
            {data: "Direccion"},
            {data: "Colonia", visible:false},
            {data: "Estado", visible:false},
            {data: "Municipio", visible:false},
            {data: "Contacto_1", visible:false},
            {data: "Puesto_Contacto_1", visible:false},
            {data: "Contacto_2", visible:false},
            {data: "Puesto_Contacto_2", visible:false},
            {data: "Contacto_3", visible:false},
            {data: "Puesto_Contacto_3", visible:false},
            {data: 'Estatus', visible: false},
            {data: 'Creado_Por', visible:false},
            {data: 'Fecha_Creacion', visible:false},
            {data: 'Modificado_Por', visible:false},
            {data: 'Fecha_Mod', visible:false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    return `<button class="btn btn-info btn-sm EditarSitio" value="${row.Id_Sitio}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm EliminarSitio" value="${row.Id_Sitio}" onclick="eliminarSitio(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                }
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        order: [[10, 'desc']],
        // Habilitar o deshabilitar el ordenable en las columnas
        'columnDefs': [ {
            'targets': [12], /* table column index */
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
    $('#TbSitios tbody').on('click', '.EditarSitio', function () {
        var dataRow = tabla_Sitios.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarSitio(dataRow);
    });

    crearSelectClientes('Id_Cliente');
    validarFrm();
    cargarEventListeners();
});

/* Listeners */
function cargarEventListeners() {
    // Se activa cuando se presiona "Nuevo"
    btnNuevoSitio.addEventListener('click', () =>{
        cambiarAction('create');
    });
    // Se activa cuando se hace clic en el boton guardar del modal
    btnGuardar.addEventListener('click', guardarDatosSitio);
    document.querySelector("#Id_Cliente").addEventListener('change', (event) =>{
      crearSelectGruposSitios('Id_Grupo_Sitios', event.target.value)
    })
}

/* Funciones */

// Función que agrega un cliente nuevo a la BD o edita un cliente
function guardarDatosSitio(){
    if($("#FrmSitios").valid()){
        // Obtenemos la operacion a realizar create ó update
        var form_action = $("#FrmSitios").attr("action");
        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("FrmSitios"));
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
                $('#TbSitios').DataTable().ajax.reload();
                // Se limpia el formulario
                limpiarFrm()
                // Se cierra el modal
                $('#modalAgregarSitio').modal('hide');
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

function eliminarSitio(id){
    $.ajax({
        url: 'sitios/delete/'+id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            // Despues de eliminar el registro en BD se actualiza la tabla
            $('#TbSitios').DataTable().ajax.reload();
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
function editarSitio(dataRow){
    crearSelectGruposSitios('Id_Grupo_Sitios', dataRow.Id_Cliente).then(() => {
        document.querySelector('#Id_Grupo_Sitios').value = dataRow.Id_Grupo_Sitios;
    })
    
    document.querySelector('#Id_Sitio').value = dataRow.Id_Sitio;
    document.querySelector('#Id_Cliente').value = dataRow.Id_Cliente;
    document.querySelector('#Sitio').value = dataRow.Sitio;
    document.querySelector('#Desc_Sitio').value = dataRow.Desc_Sitio;
    // document.querySelector('#Folder').value = dataRow.Folder;
    document.querySelector('#Direccion').value = dataRow.Direccion;
    document.querySelector('#Colonia').value = dataRow.Colonia;
    document.querySelector('#Municipio').value = dataRow.Municipio;
    document.querySelector('#Estado').value = dataRow.Estado;
    document.querySelector('#Contacto_1').value = dataRow.Contacto_1;
    document.querySelector('#Puesto_Contacto_1').value = dataRow.Puesto_Contacto_1;
    document.querySelector('#Contacto_2').value = dataRow.Contacto_2;
    document.querySelector('#Puesto_Contacto_2').value = dataRow.Puesto_Contacto_2;
    document.querySelector('#Contacto_3').value = dataRow.Contacto_3;
    document.querySelector('#Puesto_Contacto_3').value = dataRow.Puesto_Contacto_3;

    if(dataRow.Estatus == "Inactivo"){
        document.querySelector('#Estatus').checked = false;
    }

    $('#modalAgregarSitio').modal('show');
}

// Función que limpia el formulario y cambia el action
// cuando se va a agregar o editar un registro
function cambiarAction(operacion){
    limpiarFrm();
    document.querySelector("#FrmSitios").removeAttribute("action");
    document.querySelector("#FrmSitios").setAttribute("action",`/sitios/${operacion}`);
}

// Función que restablece todo el form
function limpiarFrm(){
    // Limpia los valores del form
    $('#FrmSitios')[0].reset();
    // Quita los mensajes de error y limpia los valodes del form
    procesoValidacion.resetForm();
    // Quita los estilos de error de los inputs
    $('#FrmSitios').find(".is-invalid").removeClass("is-invalid");
}

function validarFrm(){
    procesoValidacion = $('#FrmSitios').validate({
        rules: {
          Id_Cliente: {
            required: true
          },
          Id_Grupo_Sitios: {
            required: true
          },
          Direccion: {
            required: true
          },
          Colonia: {
            required: true
          },
          Municipio: {
            required: true
          },
          Estado: {
            required: true
          },
          Sitio: {
            required: true
          },
          Desc_Sitio: {
            required: false
          },
          // Folder: {
          //   required: true
          // },
          Contacto_1: {
            required: true
          },
          Puesto_Contacto_1: {
            required: true
          },
        },
        messages: {
          Id_Cliente: {
            required: "Seleccionar cliente"
          },
          Id_Grupo_Sitios: {
            required: "Seleccionar grupo"
          },
          Direccion: {
            required: "Ingresar dirección"
          },
          Colonia: {
            required: "Ingresar dirección"
          },
          Municipio: {
            required: "Ingresar municipio"
          },
          Estado: {
            required: "Ingresar estado"
          },
          Sitio: {
            required: "Ingresar sitio"
          },
          Desc_Sitio: {
            required: "Ingresar descripción"
          },
          // Folder: {
          //   required: "Ingresar folder"
          // },
          Contacto_1: {
            required: "Ingresar nombre del contacto"
          },
          Puesto_Contacto_1: {
            required: "Ingresar puesto"
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