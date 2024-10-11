var tabla_CausaPrincipal;
var procesoValidacion;

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const btnNuevoCausaPrincipal = document.querySelector('#btnNuevoCausaPrincipal');
    const btnGuardar = document.querySelector('#btnGuardar');
    const selectTipoInspeccion = document.querySelector('#Id_Tipo_Inspeccion');
    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_CausaPrincipal = $("#TbCausaPrincipal").DataTable({
        // Petición para llenar la tabla
        "ajax": {
            url: '/causaPrincipal/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Causa_Raiz', visible:false},
            {data: 'Id_Tipo_Inspeccion', render: function(data, type, row) {
                    return row.nombreTipoInspeccion;
                }
            },
            {data: 'Id_Falla', render: function(data, type, row) {
                    return row.nombreFalla;
                }
            },
            {data: 'Causa_Raiz'},
            {data: 'Estatus', visible: false},
            {data: 'Creado_Por', visible:false},
            {data: 'Fecha_Creacion', visible:false},
            {data: 'Modificado_Por', visible:false},
            {data: 'Fecha_Mod', visible:false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    return `<button class="btn btn-info btn-sm EditarCausaPrincipal" value="${row.Id_Causa_Raiz}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm EliminarCausaPrincipal" value="${row.Id_Causa_Raiz}" onclick="eliminarCausaPrincipal(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                }
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        order: [[0, 'desc']],
        // Habilitar o deshabilitar el ordenable en las columnas
        'columnDefs': [ {
            'targets': [9], /* table column index */
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
                    columns: [1,2,3,4]
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
                    columns: [1,2,3,4]
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
                    columns: [1,2,3,4]
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
                    columns: [1,2,3,4]
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
    $('#TbCausaPrincipal tbody').on('click', '.EditarCausaPrincipal', function () {
        var dataRow = tabla_CausaPrincipal.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarCausaPrincipal(dataRow);
    });

    crearSelectTipoInpecciones('Id_Tipo_Inspeccion');
    validarFrm();
    cargarEventListeners();


    /* Listeners */
    function cargarEventListeners() {

        console.log('en ellos listenerrrr')
        console.log(selectTipoInspeccion)
        // Se activa cuando se presiona "Nuevo"
        btnNuevoCausaPrincipal.addEventListener('click', () =>{
            cambiarAction('create');
        });
        // Se activa cuando se hace clic en el boton guardar del modal
        btnGuardar.addEventListener('click', guardarDatosCausaPrincipal);
        selectTipoInspeccion.addEventListener('change', (event) => {
            crearSelectFallas('Id_Falla', event.target.value);
        })

    }

    /* Funciones */

    // Función que agrega un cliente nuevo a la BD o edita un cliente
    function guardarDatosCausaPrincipal(){
        if($("#FrmCausaPrincipal").valid()){
            // Obtenemos la operacion a realizar create ó update
            var form_action = $("#FrmCausaPrincipal").attr("action");
            // Guardamos el form con los input file para subir archivos
            var formData = new FormData(document.getElementById("FrmCausaPrincipal"));
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
                    $('#TbCausaPrincipal').DataTable().ajax.reload();
                    // Se limpia el formulario
                    limpiarFrm()
                    // Se cierra el modal
                    $('#modalAgregarCausaPrincipal').modal('hide');
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

    function eliminarCausaPrincipal(id){
        $.ajax({
            url: 'causaPrincipal/delete/'+id,
            type: "GET",
            dataType: 'json',
            success: function (res) {
                // Despues de eliminar el registro en BD se actualiza la tabla
                $('#TbCausaPrincipal').DataTable().ajax.reload();
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
    function editarCausaPrincipal(dataRow){
        console.log(dataRow);
        document.querySelector('#Id_Causa_Raiz').value = dataRow.Id_Causa_Raiz;
        document.querySelector('#Id_Tipo_Inspeccion').value = dataRow.Id_Tipo_Inspeccion;
        document.querySelector('#Id_Falla').value = dataRow.Id_Falla;
        document.querySelector('#Causa_Raiz').value = dataRow.Causa_Raiz;

        if(dataRow.Estatus == "Inactivo"){
            document.querySelector('#Estatus').checked = false;
        }

        $('#modalAgregarCausaPrincipal').modal('show');
    }

    // Función que limpia el formulario y cambia el action
    // cuando se va a agregar o editar un registro
    function cambiarAction(operacion){
        limpiarFrm();
        document.querySelector("#FrmCausaPrincipal").removeAttribute("action");
        document.querySelector("#FrmCausaPrincipal").setAttribute("action",`/causaPrincipal/${operacion}`);
    }

    // Función que restablece todo el form
    function limpiarFrm(){
        // Limpia los valores del form
        $('#FrmCausaPrincipal')[0].reset();
        // Quita los mensajes de error y limpia los valodes del form
        procesoValidacion.resetForm();
        // Quita los estilos de error de los inputs
        $('#FrmCausaPrincipal').find(".is-invalid").removeClass("is-invalid");
    }

    function validarFrm(){
        procesoValidacion = $('#FrmCausaPrincipal').validate({
            rules: {
                Id_Tipo_Inspeccion: {
                    required: true,
                },
                Id_Falla: {
                    required: true,
                },
                Causa_Raiz: {
                    required: true,
                }
            },
            messages: {
                Id_Tipo_Inspeccion: {
                    required: "Seleccionar inspección",
                },
                Id_Falla: {
                    required: "Seleccionar falla",
                },
                Causa_Raiz: {
                    required: "Ingresar causa",
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

});