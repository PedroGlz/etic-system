var tabla_Inspecciones;
var validarCampos = false;
var procesoValidacion;
const selectEstatus = document.querySelector('#Id_Status_Inspeccion');

window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables del DOM */
    const btnNuevoInspecciones = document.querySelector('#btnNuevoInspecciones');
    const btnGuardar = document.querySelector('#btnGuardar');

    // Creando el cuerpo de la tabla con dataTable y ajax
    tabla_Inspecciones = $("#TbInspecciones").DataTable({
        // Petición para llenar la tabla
        "ajax": {
            url: '/inspecciones/show',
            dataSrc: ''
        },
        "columns": [
            {data: 'Id_Inspeccion', visible:false},
            {data: 'No_Inspeccion'},
            {data: 'Id_Cliente', render: function(data, type, row) {
                    return row.nombreCliente;
                }
            },
            {data: 'Id_Grupo_Sitios', render: function(data, type, row) {
                return row.nombreGrupoSitio;
                }
            },
            {data: 'Id_Sitio', render: function(data, type, row) {
                    return row.nombreSitio;
                }
            },
            {data: 'Fecha_Inicio', render: function(data, type, row) {
                    return new Date(data).toLocaleDateString();
                }
            },
            {data: 'Fecha_Fin', render: function(data, type, row) {
                    var fechaFinStr;    
                    
                    fechaFinStr = data == "0000-00-00 00:00:00" ? "-" : new Date(data).toLocaleDateString();;

                    return fechaFinStr;
                }
            },
            {data: 'Id_Status_Inspeccion',"render": function(data, type, row) {
                    // if(data == '73F27007-76B3-11D3-82BF-00104BC75DC2'){
                    //     return row.nombreEstatusInspeccion;
                    // }else{
                        return `<a href="#" onclick="abrirInspeccion(
                                    '${row.Id_Inspeccion}',
                                    ${row.No_Inspeccion},
                                    '${row.nombreSitio}',
                                    '${row.Id_Status_Inspeccion}',
                                    '${row.Id_Sitio}')">
                                    ${row.nombreEstatusInspeccion}
                                </a>`;
                    // }
                }
            },
            {data: 'Fotos_Ruta', visible:false},
            {data: 'No_Dias', visible:false},
            {data: 'Unidad_Temp', visible:false},
            {data: 'No_Inspeccion_Ant', visible:false},
            {data: 'Estatus', visible:false},
            {data: 'Creado_Por', visible:false},
            {data: 'Fecha_Creacion', visible:false},
            {data: 'Modificado_Por', visible:false},
            {data: 'Fecha_Mod', visible:false},
            // Botones para editar y eliminar
            { data: null, render: function ( data, type, row ) {
                    var opciones = "";
                    
                    if (row.Id_Status_Inspeccion == "73F27003-76B3-11D3-82BF-00104BC75DC2") {
                        opciones += `<button class="btn btn-warning btn-sm Exportar_Inspeccion_DB mr-1" value="${row.Id_Inspeccion}" title="Exportar Inspección"><i class="fas fa-download"></i></button>`;
                        opciones += `<button class="btn btn-info btn-sm EditarInspecciones" value="${row.Id_Inspeccion}"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm EliminarInspecciones" value="${row.Id_Inspeccion}" onclick="eliminarInspecciones(this.value)"><i class="fas fa-trash-alt"></i></button>`;
                    }
                    
                    
                    return opciones;
                
                }
            },
        ],
        // Indicamos el indice de la columna a ordenar y tipo de ordenamiento
        order: [[1, 'desc']],
        // Habilitar o deshabilitar el ordenable en las columnas
        columnDefs: [
             /* table column index */ /* true or false */
            {'targets': [16], 'orderable': false},
            { className: 'noWrap', targets: '_all'}
        ],
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
                        columns: [1,2,3,4,5,6,7]
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
                        columns: [1,2,3,4,5,6,7]
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
                        columns: [1,2,3,4,5,6,7]
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
                        columns: [1,2,3,4,5,6,7]
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
    $('#TbInspecciones tbody').on('click', '.EditarInspecciones', function () {
        var dataRow = tabla_Inspecciones.row($(this).parents('tr')).data();
        cambiarAction('update');
        editarInspecciones(dataRow);
    });

    // Obtiene todos los datos del registro y exporta la BD
    $('#TbInspecciones tbody').on('click', '.Exportar_Inspeccion_DB', function () {
        onlyClick(this)

        Toast.fire({
            icon: 'info',
            title: 'Exportando..'
        })

        var dataRow = tabla_Inspecciones.row($(this).parents('tr')).data();
        var nombre_cliente = dataRow.nombreCliente.replaceAll(" ","")
        var nombre_sitio = dataRow.nombreSitio.replaceAll(" ","")
        var num_inspeccion = dataRow.No_Inspeccion
        var nombre_backup_inspeccion = `ETIC_${num_inspeccion}_${nombre_cliente}_${nombre_sitio}.sql`;
        
        exportar_inspeccion_db(nombre_backup_inspeccion, this.value);
    });

    crearSelectClientes('Id_Cliente');
    validarFrm();
    cargarEventListeners();
});

/* Listeners */
function cargarEventListeners() {
    // Se activa cuando se presiona "Nuevo"
    btnNuevoInspecciones.addEventListener('click', () =>{
        cambiarAction('create');
    });
    // Se activa cuando se hace clic en el boton guardar del modal
    btnGuardar.addEventListener('click', guardarDatosInspecciones);
    selectEstatus.addEventListener('change',habilitarFechaFin);
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
function guardarDatosInspecciones(){
    
    onlyClick(btnGuardar)

    if($("#FrmInspecciones").valid()){
        // Obtenemos la operacion a realizar create ó update
        var form_action = $("#FrmInspecciones").attr("action");

        if (form_action == "/inspecciones/create") {
            alertLodading("Creando inspección..","info")
        }

        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("FrmInspecciones"));
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
                $('#TbInspecciones').DataTable().ajax.reload();

                // Mostramos nuevo mensaje de operacion exito
                if (form_action == "/inspecciones/create") {
                    cerrarAlertLoading("Inspección creada!")
                }else{
                    Toast.fire({
                        icon: 'success',
                        title: 'Guardado'
                    })
                }
                
                // Se limpia el formulario
                limpiarFrm()
                // Se cierra el modal
                $('#modalAgregarInspecciones').modal('hide');
                // Creamos de nuevo el selec actualizado
                crearSelectInspecciones('No_Inspeccion_Ant');
                // Mostramos mensaje de operacion exitosa

            },
            error: function (err) {
                // Mostramos nuevo mensaje de error
                cerrarAlertLoading("Evento inesperado","error")
                console.log(err);
            }
        });
    }
};

function eliminarInspecciones(id){
    $.ajax({
        url: 'inspecciones/delete/'+id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            // Despues de eliminar el registro en BD se actualiza la tabla
            $('#TbInspecciones').DataTable().ajax.reload();
            // Creamos de nuevo el selec actualizado
            crearSelectInspecciones('No_Inspeccion_Ant');
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
function editarInspecciones(dataRow){
    console.log(dataRow);

    crearSelectGruposSitios('Id_Grupo_Sitios', dataRow.Id_Cliente).then(() => {
        document.querySelector('#Id_Grupo_Sitios').value = dataRow.Id_Grupo_Sitios;
    })
    crearSelectSitios('Id_Sitio', dataRow.Id_Grupo_Sitios).then(() => {
        document.querySelector('#Id_Sitio').value = dataRow.Id_Sitio;
    })

    document.querySelector('#Id_Inspeccion').value = dataRow.Id_Inspeccion;
    document.querySelector('#Id_Cliente').value = dataRow.Id_Cliente;
    document.querySelector('#Id_Status_Inspeccion').value = dataRow.Id_Status_Inspeccion;
    document.querySelector('#No_Inspeccion').value = dataRow.No_Inspeccion;
    document.querySelector('#No_Inspeccion_Ant').value = dataRow.No_Inspeccion_Ant;
    document.querySelector('#Unidad_Temp').value = dataRow.Unidad_Temp;
    document.querySelector('#Fecha_Inicio').value = dataRow.Fecha_Inicio;
    document.querySelector('#Fecha_Fin').value = dataRow.Fecha_Fin;

    if(dataRow.Estatus == "Inactivo"){
        document.querySelector('#Estatus').checked = false;
    }

    $('#modalAgregarInspecciones').modal('show');
}

function abrirInspeccion(idInspeccion,numInspeccion,nombreSitio,estatusInspeccion,idSitio){

    $.ajax({
        // url: 'inspecciones/abririnspeccion/'+numInspeccion,
        url: 'inspecciones/abririnspeccion',
        type: "POST",
        dataType: 'json',
        data: {Id_Inspeccion: idInspeccion,inspeccion: numInspeccion, nombreSitio: nombreSitio,Id_Status_Inspeccion: estatusInspeccion, Id_Sitio: idSitio},
        success: function (res) {
            // Mensaje de operacion exitosa
            Toast.fire({
                icon: 'info',
                title: 'Abriendo inspección'
            })
            // Redirijimos al modulo de inventarios con la inpseccion ya abierta
            location.href = '/inventarios';
        },
        error: function (err) {
            console.log(err);
        }
    });
}

// Función que limpia el formulario y cambia el action
// cuando se va a agregar o editar un registro
function cambiarAction(operacion){
    limpiarFrm();
    
    //Op ternario para indicar que campos validar en crear o editar
    operacion.indexOf('update') >= 0 ? validarCampos = true : validarCampos = false;

    document.querySelector("#FrmInspecciones").removeAttribute("action");
    document.querySelector("#FrmInspecciones").setAttribute("action",`/inspecciones/${operacion}`);
}

// Función que restablece todo el form
function limpiarFrm(){
    // Limpia los valores del form
    $('#FrmInspecciones')[0].reset();
    // Quita los mensajes de error y limpia los valodes del form
    procesoValidacion.resetForm();
    // Quita los estilos de error de los inputs
    $('#FrmInspecciones').find(".is-invalid").removeClass("is-invalid");
}

// Funcion que exporta la copia de la base de datos en un script sql para eviarse a un inspector y la carue en su equipo
function exportar_inspeccion_db(nombre_backup, id_inspeccion){
    console.log(nombre_backup)
    console.log(id_inspeccion)
    $.ajax({
        url: `/exportar_inspeccion_db`,
        type: "POST",
        dataType: 'json',
        data:{nombre_archivo:nombre_backup, id_inspeccion:id_inspeccion},
        success: function (res) {
            console.log(res)
            
            if(res == 200){

                window.location.href = `inspecciones/descargar_bd_exportar/${nombre_backup}`

                Toast.fire({
                    icon: 'success',
                    title: 'Inspeccion Exportada'
                })
            }else{
                Toast.fire({
                    icon: 'error',
                    title: 'Evento inesperado'
                })
            }

        }
    });
}

// Función que activa o desactiva el campo de fecha fin
// cada que el select de estatus cambia
function habilitarFechaFin(){
    console.log(selectEstatus.value)
    var Fecha_Fin = document.querySelector('#Fecha_Fin');
    selectEstatus.value == '73F27007-76B3-11D3-82BF-00104BC75DC2' ? Fecha_Fin.removeAttribute('readonly') : Fecha_Fin.setAttribute('readonly', true);
}

function validarFrm(){
    procesoValidacion = $('#FrmInspecciones').validate({
        rules: {
            Id_Cliente: {
                required: true
            },
            Id_Sitio: {
                required: true
            },
            Id_Status_Inspeccion: {
                required: true
            },
            No_Inspeccion: {
                required: function () {
                    return validarCampos
                },
            },
            No_Inspeccion_Ant: {
                required: function () {
                    return validarCampos
                },
            },
            Unidad_Temp: {
                required: true
            },
            Fecha_Inicio: {
                required: true
            },
            Fecha_Fin: {
                required: function () {
                    // La fecha fin solo es requerida cuando el estatus es closed
                    return parseInt(Id_Status_Inspeccion.value) == 4
                },
            },
            Ir_Imagen: {
                required: false
            },
            Dig_Imagen: {
                required: false
            },
        },
        messages: {
            Id_Cliente: {
                required: "Seleccionar cliente"
            },
            Id_Sitio: {
                required: "Seleccionar sitio"
            },
            Id_Status_Inspeccion: {
                required: "Seleccionar estatus"
            },
            No_Inspeccion: {
                required: "Ingresar número de inspeccion"
            },
            No_Inspeccion_Ant: {
                required: "Seleccionar inspección anteriror"
            },
            Unidad_Temp: {
                required: "Seleccionar unidad"
            },
            Fecha_Inicio: {
                required: "Ingresar fecha de inicio"
            },
            Fecha_Fin: {
                required: "Ingresar fecha fin"
            },
            Ir_Imagen: {
                required: 'Seleccionar Imagen'
            },
            Dig_Imagen: {
                required: 'Seleccionar Imagen'
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