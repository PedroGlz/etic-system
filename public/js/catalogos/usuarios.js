var tabla_Usuarios;
var validarCampos = true;
var procesoValidacion;

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const btnNuevoUsuario = document.querySelector('#btnNuevoUsuario');
    const btnGuardar = document.querySelector('#btnGuardar');

    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_Usuarios = $("#TbUsuarios").DataTable({
        // Petición para llenar la tabla
        "ajax": {
            url: '/usuarios/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Usuario', visible:false},
            {data: 'Id_Grupo', render: function(data, type, row) {
                return row.nombreGrupo;
                }
            },
            {data: 'Usuario'},
            {data: 'Nombre'},
            {data: 'Password', visible:false},
            {data: 'Telefono'},
            {data: 'Foto', render: function(data, type, row) {
                    if(data == null){
                        return "";
                    }else{
                        return `<img src="Archivos_ETIC/fotos_usuarios/${data}" width="40" height="40"/>`;
                    }
                }, visible: false
            },
            {data: 'Email'},
            {data: 'Ultimo_login', visible:false},
            {data: 'Estatus', visible: false},
            {data: 'Creado_Por', visible:false},
            {data: 'Fecha_Creacion', visible:false},
            {data: 'Modificado_Por', visible:false},
            {data: 'Fecha_Mod', visible:false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    return `<button class="btn btn-info btn-sm EditarUsuario" value="${row.Id_Usuario}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm EliminarUsuario" value="${row.Id_Usuario}" onclick="eliminarUsuario(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                }
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        order: [[0, 'desc']],
        // Habilitar o deshabilitar el ordenable en las columnas
        'columnDefs': [ {
            'targets': [13], /* table column index */
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
    $('#TbUsuarios tbody').on('click', '.EditarUsuario', function () {
        var dataRow = tabla_Usuarios.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarUsuario(dataRow);
    });
    
    crearSelectGrupos('Id_Grupo');
    crearSelectClientes('Id_Cliente');
    validarFrm();
    cargarEventListeners();
});

/* Listeners */
function cargarEventListeners() {
    // Se activa cuando se presiona "Nuevo"
    btnNuevoUsuario.addEventListener('click', () =>{
        cambiarAction('create');
    });
    // Se activa cuando se hace clic en el boton guardar del modal
    btnGuardar.addEventListener('click', guardarDatosUsuario);
    document.querySelector('#Id_Grupo').addEventListener('change', (event) => {
        campos_tipos_usuario(event.target.value)
    })

    document.querySelector("#Id_Cliente").addEventListener('change', (event) =>{
        crearSelectGruposSitios('Id_Grupo_Sitios', event.target.value)
        document.querySelector("#Id_Sitio").value = ""
    })
    document.querySelector("#Id_Grupo_Sitios").addEventListener('change', (event) =>{
        crearSelectSitios('Id_Sitio', event.target.value)
    })
}

/* Funciones */

// Función que agrega un cliente nuevo a la BD o edita un cliente
function guardarDatosUsuario(){
    if($("#FrmUsuarios").valid()){
        // Obtenemos la operacion a realizar create ó update
        var form_action = $("#FrmUsuarios").attr("action");
        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("FrmUsuarios"));
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
                $('#TbUsuarios').DataTable().ajax.reload();
                // Se limpia el formulario
                limpiarFrm()
                // Se cierra el modal
                $('#modalAgregarUsuario').modal('hide');
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

function eliminarUsuario(id){
    $.ajax({
        url: 'usuarios/delete/'+id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            // Despues de eliminar el registro en BD se actualiza la tabla
            $('#TbUsuarios').DataTable().ajax.reload();
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
function editarUsuario(dataRow){
    console.log(dataRow);
    
    // Validando que tipo de usuario es para mostrar  colocar la info correspondiente
    campos_tipos_usuario(dataRow.Id_Grupo)
    switch (dataRow.Id_Grupo) {
        case '5I78A4EH-ZR3Q-K6PS-XJMW-T91OGYL2UBNV':
        //Cliente
            document.querySelector('#Id_Cliente').value = dataRow.Id_Cliente;
        
            crearSelectGruposSitios('Id_Grupo_Sitios', dataRow.Id_Cliente).then(() => {
                document.querySelector('#Id_Grupo_Sitios').value = dataRow.Id_Grupo_Sitios;
            })
            crearSelectSitios('Id_Sitio', dataRow.Id_Grupo_Sitios).then(() => {
                document.querySelector('#Id_Sitio').value = dataRow.Id_Sitio;
            })

        break;
        case '3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K':
        // Termografo
            document.querySelector('#nivelCertificacion').value = dataRow.nivelCertificacion;
        break;
        default:
        break;
    }

    document.querySelector('#Id_Usuario').value = dataRow.Id_Usuario;
    document.querySelector('#Id_Grupo').value = dataRow.Id_Grupo;
    document.querySelector('#Usuario').value = dataRow.Usuario;
    document.querySelector('#Nombre').value = dataRow.Nombre;
    document.querySelector('#Telefono').value = dataRow.Telefono;
    document.querySelector('#Email').value = dataRow.Email;
    document.querySelector('#foto_Actual').value = dataRow.Foto;

    if(dataRow.Estatus == "Inactivo"){
        document.querySelector('#Estatus').checked = false;
    }

    $('#modalAgregarUsuario').modal('show');
}

// Función que limpia el formulario y cambia el action
// cuando se va a agregar o editar un registro
function cambiarAction(operacion){
    limpiarFrm();
    
    //Op ternario para indicar que campos validar en crear o editar
    operacion.indexOf('update') >= 0 ? validarCampos = false : validarCampos = true;
        
    document.querySelector("#FrmUsuarios").removeAttribute("action");
    document.querySelector("#FrmUsuarios").setAttribute("action",`/usuarios/${operacion}`);    
}

function campos_tipos_usuario(id = ''){
    
    const contenedor_campos_cliente = document.querySelector('#contenedor_campos_cliente')
    const contenedor_campos_termografo = document.querySelector('#contenedor_campos_termografo')

    switch (id) {
        case '5I78A4EH-ZR3Q-K6PS-XJMW-T91OGYL2UBNV':
            contenedor_campos_cliente.style.display = ''
        break;
        case '3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K':
            contenedor_campos_termografo.style.display = ''
        break;
        default:
            contenedor_campos_cliente.style.display = 'none'
            contenedor_campos_termografo.style.display = 'none'
        break;
    }
}

// Función que restablece todo el form
function limpiarFrm(){
    campos_tipos_usuario()
    // Limpia los valores del form
    $('#FrmUsuarios')[0].reset();
    // Quita los mensajes de error y limpia los valodes del form
    procesoValidacion.resetForm();
    // Quita los estilos de error de los inputs
    $('#FrmUsuarios').find(".is-invalid").removeClass("is-invalid");
}

function validarFrm(){
    procesoValidacion = $('#FrmUsuarios').validate({
        rules: {
          Nombre: {
            required: true
          },
          Usuario: {
            required: true
          },
          Id_Grupo: {
            required: true
          },
          Id_Cliente: {
            required: true
          },
          Id_Grupo_Sitios: {
            required: true
          },
          Id_Sitio: {
            required: true
          },
          nivelCertificacion: {
            required: true
          },
          Email: {
            required: true,
            email: true,
          },
          Password: {
            required: function () {
                return validarCampos
            },
            // minlength : 5,
          },
          rPassword: {
            required: function () {
                return validarCampos
            },
            // minlength : 5,
            equalTo: "#Password"
          },
          Foto: {
            required: function () {
                // return validarCampos
                return false
            },
            extension: "jpg|jpeg|png|JPG|JPEG|PNG"
          },
        },
        messages: {
          Nombre: {
            required: "Ingresar nombre"
          },
          Usuario: {
            required: "Ingresar usuario"
          },
          Id_Grupo: {
            required: "Seleccionar grupo"
          },
          Id_Cliente: {
            required: "Seleccionar Cliente"
          },
          Id_Grupo_Sitios: {
            required: "Seleccionar grupo sitio"
          },
          Id_Sitio: {
            required: "Seleccionar sitio"
          },
          nivelCertificacion: {
            required: "Ingresar nivel"
          },
          Email: {
            required: "Ingresar correo electrónico",
            email: "Ingresar dirección de correo valida"
          },
          Password: {
            required: "Ingresar contraseña"
          },
          rPassword: {
            required: "Ingresar contraseña",
            equalTo : "Las contraseñas no coinciden"
          },
          Foto: {
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