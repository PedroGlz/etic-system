// Variales globales
var ctrl_id_inspeccion_valor = "";
var menu_ctrl_estatus_inspeccion= "";

window.addEventListener('DOMContentLoaded', (event) => {
    
    // VARIABLES
    ctrl_id_inspeccion_valor = document.querySelector("#ctrl_id_inspeccion").value;
    const select_actualizar_estatus_inspeccion = document.querySelector("#select_actualizar_estatus_inspeccion");
    menu_ctrl_estatus_inspeccion = document.querySelector("#ctrl_estatus_inspeccion");
    const btn_estatus_inspeccion = document.querySelector("#btn_estatus_inspeccion");
    const btn_inicializar_imagenes = document.querySelector("#btn_inicializar_imagenes");
    const btn_guardar_estatus_inspeccion = document.querySelector("#btn_guardar_estatus_inspeccion");
    // const btn_exportar_inspeccion_finalizada = document.querySelector("#btn_exportar_inspeccion_finalizada");
    const btn_guardar_inicializar_imagenes = document.querySelector("#btn_guardar_inicializar_imagenes");
    cargarEventListeners_menu();
});

function cargarEventListeners_menu(){
    $(".btn_abrir_carpeta_archivos").click((event) => {abrir_carpeta_archivos(event)});
    btn_estatus_inspeccion.addEventListener('click', abrir_modal_esatus_inspeccion);
    btn_inicializar_imagenes.addEventListener('click', abrir_modal_inicializar_imagenes);
    btn_guardar_estatus_inspeccion.addEventListener('click', guardar_estatus_inspeccion);
    // btn_exportar_inspeccion_finalizada.addEventListener('click', exportar_inspeccion_db);
    btn_guardar_inicializar_imagenes.addEventListener('click', guardar_nombres_img);
    // select_actualizar_estatus_inspeccion.addEventListener('change', cambio_select_estatus);
}

// FUNCIONES DEL MENU LATERAL

function abrir_carpeta_archivos(event){

    let btn_abrir_carpeta = "";
    let ruta = "";

    if(event.target.classList.contains('btn_abrir_carpeta_archivos')) {
        btn_abrir_carpeta = event.target;
    }else{
        btn_abrir_carpeta = event.target.offsetParent;
    }

    switch (true) {
        case btn_abrir_carpeta.classList.contains('imagenes'):
            ruta = "imagenes";
        break;
        case btn_abrir_carpeta.classList.contains('reportes'):
            ruta = "reportes";
        break;
        case btn_abrir_carpeta.classList.contains('documentacion'):
            ruta = "documentacion";
        break;
    }


    $.ajax({
        url: `/abrir_carpeta_archivos`,
        type: "POST",
        dataType: 'json',
        data:{ruta:ruta},
        success: function (res) {
            console.log(res)
            if(res == 500){
                Toast.fire({
                    icon: 'error',
                    title: 'La carpeta no ha sido creada, o no se ha abierto una inspección'
                })
            }
        }
    });
}

function abrir_modal_esatus_inspeccion (){
    // Solo si el estatus es cerrado mostramos el boton de esportar BD
    // if(menu_ctrl_estatus_inspeccion.value == "73F27007-76B3-11D3-82BF-00104BC75DC2"){
        // btn_exportar_inspeccion_finalizada.style.display = "";
    // }
    // Del text del menu con el estatus actual de la inspeccion tomamos el valor y se lo asignamos al select
    select_actualizar_estatus_inspeccion.value = menu_ctrl_estatus_inspeccion.value;
    // mostramos el modal
    $('#modal_estatus_inspeccion').modal('show');
}

function guardar_estatus_inspeccion(){
    onlyClick(btn_guardar_estatus_inspeccion)

    let estatus_inspeccion = select_actualizar_estatus_inspeccion.value;
    
    if(estatus_inspeccion == "73F27007-76B3-11D3-82BF-00104BC75DC2"){
        alertLodading("Cerrando y generando archivo de la inspección..","info",2300)
    }
    
    setTimeout(() => {
        $.ajax({
            url: '/inspecciones/actualizar_estatus_inspeccion',
            type: "POST",
            dataType: 'json',
            data: {Id_Status_Inspeccion: estatus_inspeccion, Id_Inspeccion: ctrl_id_inspeccion_valor},
            // processData: false,
            // contentType: false,
            success: function (res) {
    
                menu_ctrl_estatus_inspeccion.value = estatus_inspeccion;
                // btn_exportar_inspeccion_finalizada.style.display = "none";
                
                switch (estatus_inspeccion) {
                    // En progreso
                    case "73F27003-76B3-11D3-82BF-00104BC75DC2":
                        document.querySelector("#contenedor_modulo_inspeccion_actual").classList.remove("disable");
                    break;
                    // Cerrada
                    case "73F27007-76B3-11D3-82BF-00104BC75DC2":
                        // Primero se crea la copia de la inspeccion finalizada
                        exportar_inspeccion_db().then((res) => {
                            console.log(res)
                            // Despues se limpia la bd en los datos de la inspeccion
                            if(res == 200){
                                // btn_exportar_inspeccion_finalizada.style.display = "";
                                document.querySelector("#contenedor_modulo_inspeccion_actual").classList.add("disable");
                                limpiar_bd()
                            }
                        })
                    break;
                    // Pospuesta
                    case "73F27006-76B3-11D3-82BF-00104BC75DC2":
                        document.querySelector("#contenedor_modulo_inspeccion_actual").classList.remove("disable");
                    break;
                    // Terminada
                    case "73F27004-76B3-11D3-82BF-00104BC75DC2":
                        document.querySelector("#contenedor_modulo_inspeccion_actual").classList.remove("disable");
                    break;
                    default:
                        document.querySelector("#contenedor_modulo_inspeccion_actual").classList.add("disable");
                    break;
                }

                Toast.fire({
                    icon: 'success',
                    title: 'Estatus actualizado'
                })

                $('#modal_estatus_inspeccion').modal('hide');
            },
            error: function (err) {
                cerrarAlertLoading("Evento inesperado","error")
            }
        });
    }, "1500");

}

function exportar_inspeccion_db(){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `/exportar_inspeccion_db`,
            type: "POST",
            dataType: 'json',
            success: function (res) {
                console.log(res)
                
                if(res.status == 200){
                    window.location.href = `inspecciones/descargar_bd_exportar/${res.nombre_backup}`
                    Toast.fire({
                        icon: 'success',
                        title: 'Archivo Backup generado'
                    })
                    
                    resolve(200);
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: 'Evento inesperado: Error al crear archivo Backup',
                        timer: 5500
                    })
                    resolve(500);
                }

            },
            error: function (error) {
            reject(error)
            },
        });
    })
}

function limpiar_bd(){
    console.log("entro a limpiar")
    $.ajax({
        url: `inspecciones/limpiar_bd`,
        type: "POST",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (res) {
            window.location = "/inventarios";
        },
        error: function (error) {
        },
    });
}

// FUNCIONES PARA INICIALIZAR IMAGENES
function abrir_modal_inicializar_imagenes (){

    // (function($, window) {
    //     'use strict';
    
    //     var MultiModal = function(element) {
    //         this.$element = $(element);
    //         this.modalCount = 0;
    //     };
    
    //     MultiModal.BASE_ZINDEX = 1040;
    
    //     MultiModal.prototype.show = function(target) {
    //         var that = this;
    //         var $target = $(target);
    //         var modalIndex = that.modalCount++;
    
    //         $target.css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20) + 10);
    
    //         // Bootstrap triggers the show event at the beginning of the show function and before
    //         // the modal backdrop element has been created. The timeout here allows the modal
    //         // show function to complete, after which the modal backdrop will have been created
    //         // and appended to the DOM.
    //         window.setTimeout(function() {
    //             // we only want one backdrop; hide any extras
    //             if(modalIndex > 0)
    //                 $('.modal-backdrop').not(':first').addClass('hidden');
    
    //             that.adjustBackdrop();
    //         });
    //     };
    
    //     MultiModal.prototype.hidden = function(target) {
    //         this.modalCount--;
    
    //         if(this.modalCount) {
    //            this.adjustBackdrop();
    //             // bootstrap removes the modal-open class when a modal is closed; add it back
    //             $('body').addClass('modal-open');
    //         }
    //     };
    
    //     MultiModal.prototype.adjustBackdrop = function() {
    //         var modalIndex = this.modalCount - 1;
    //         $('.modal-backdrop:first').css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20));
    //     };
    
    //     function Plugin(method, target) {
    //         return this.each(function() {
    //             var $this = $(this);
    //             var data = $this.data('multi-modal-plugin');
    
    //             if(!data)
    //                 $this.data('multi-modal-plugin', (data = new MultiModal(this)));
    
    //             if(method)
    //                 data[method](target);
    //         });
    //     }
    
    //     $.fn.multiModal = Plugin;
    //     $.fn.multiModal.Constructor = MultiModal;
    
    //     $(document).on('show.bs.modal', function(e) {
    //         $(document).multiModal('show', e.target);
    //     });
    
    //     $(document).on('hidden.bs.modal', function(e) {
    //         $(document).multiModal('hidden', e.target);
    //     });
    // }(jQuery, window));

    validar_form_inicializar_img()
    $('#modal_inicializar_imagenes').modal('show');
}

function guardar_nombres_img(){
    onlyClick(btn_inicializar_imagenes)

    if($("#form_inicializar_imagenes").valid()){
        // Guardamos el form con los input file para subir archivos
        var formData = new FormData(document.getElementById("form_inicializar_imagenes"));
        formData.append('Id_Inspeccion',ctrl_id_inspeccion_valor);

        $.ajax({
            data: formData,
            url: 'inspecciones/inicializar_imagenes',
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res)

                Toast.fire({
                    icon: 'success',
                    title: 'Imágenes inicializadas'
                })
                
                // Se cierra el modal
                $('#modal_inicializar_imagenes').modal('hide');

            },
            error: function (err) {
                // Mostramos nuevo mensaje de error
                cerrarAlertLoading("Evento inesperado","error")
                console.log(err);
            }
        });
    }
}

function validar_form_inicializar_img(){
    $('#form_inicializar_imagenes').validate({
        rules: {
            Ir_Imagen: {
                required: true
            },
            Dig_Imagen: {
                required: true
            },
        },
        messages: {
            Ir_Imagen: {
                required: 'Ingresar nombre de imagen térmica'
            },
            Dig_Imagen: {
                required: 'Ingresar nombre de imagen digital'
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

function optimizar_imagenes(){
    return new Promise((resolve, reject) => {
        alertLodading("Optimizando imágenes...",'info',9000000);
        $.ajax({
            url: `/inventarios/optimizar_imagenes`,
            type: 'get',
            dataType: "json",
            success: function(data){
                resolve()
                cerrarAlertLoading('Optimización finzalizada!')
            },
            error: function (error) {
                reject()
                cerrarAlertLoading('Evento inesperado, revisar imágenes', 'error')
            },
        });
    });
}