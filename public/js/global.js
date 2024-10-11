let $modal = $(".modal");
$modal.draggable({
  handle: "#mover_modal , .modal-header",
});
$modal.resizable();

// //Initialize Select2 Elements
// $('.select2').select2()

// variable cofiguracion sweetalert2
const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',    
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: false,
})

/* Funciones para crear selects de catalogos */
function crearSelectGiros(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/giros/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Giro}">${data.Giro}</option>`;            
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectCompanias(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/companias/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Compania}">${data.Compania}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectPaises(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/paises/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Pais}">${data.Pais}</option>`;            
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectClientes(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/clientes/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Cliente}">${data.Razon_Social}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectTipoInpecciones(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/tipoInspecciones/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Tipo_Inspeccion}">${data.Tipo_Inspeccion}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectFallas(id_select, id_tipo_inspeccion){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: `/fallas/obtenerRegistros/${id_tipo_inspeccion}`,
        type: "get",
        data: '',
        dataType: 'json',
        success: function (data){
            console.log(data)
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Falla}">${data.Falla}</option>`;            
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectTipoFallas(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/tipoFallas/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Tipo_Falla}">${data.Tipo_Falla}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectTipoPrioridades(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/tipoPrioridades/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Tipo_Prioridad}">${data.Tipo_Prioridad} - ${data.Desc_Prioridad}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectGruposSitios(id_select, id_cliente){
    return new Promise((resolve, reject) => {
        // obteniendo el select a modificar
        var select = document.getElementById(`${id_select}`);

        if(id_cliente.length == ''){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            resolve('ok');
            
            return;
        }

        // peticion a la base
        $.ajax({
            url: `/gruposSitios/show/${id_cliente}`,
            type: "get",
            data:'',
            dataType: 'json',
            success: function (data){
                // // Limpiando el select
                $(`#${id_select}`).empty();

                // creando el select con los productos en la OC
                select.innerHTML += '<option value="">Selecionar...</option>';
                data.forEach(data => {
                    select.innerHTML += `<option value="${data.Id_Grupo_Sitios}">${data.Grupo}</option>`;
                });

                resolve('ok');
            },
            error: function (error) {
                console.log(error);
                reject(error)
            },
        });
    });
}

function crearSelectSitios(id_select, id_grupo_sitios){
    return new Promise((resolve, reject) => {

        // obteniendo el select a modificar
        var select = document.getElementById(`${id_select}`);

        if(id_grupo_sitios == ''){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            resolve('ok');
            
            return;
        }

        // peticion a la base
        $.ajax({
            url: `/sitios/show/${id_grupo_sitios}`,
            type: "get",
            data:'',
            dataType: 'json',
            success: function (data){
                // // Limpiando el select
                $(`#${id_select}`).empty();

                // creando el select con los productos en la OC
                select.innerHTML += '<option value="">Selecionar...</option>';
                data.forEach(data => {
                    select.innerHTML += `<option value="${data.Id_Sitio}">${data.Sitio}</option>`;            
                });

                resolve('ok');
            },
            error: function (error) {
                console.log(error);
                reject(error);
            },
        });
    });
}

function crearSelectStatusInspecciones(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/estatusInspeccion/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Status_Inspeccion}">${data.Status_Inspeccion}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectGrupos(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/grupos/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Grupo}">${data.Grupo}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectInspecciones(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/inspecciones/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Inspeccion}">${data.No_Inspeccion}</option>`;            
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectFabricantes(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/fabricantes/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Fabricante}">${data.Fabricante}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

/* Función para crear select de la vista de inspecciones */
function crearSelectStatusInspeccionDetalle(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/inventarios/obtenerEstatusInspecDet',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){            
            // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar estatus</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Status_Inspeccion_Det}">${data.Estatus_Inspeccion_Det} - ${data.Desc_Estatus_Det}</option>`;
            });
        },
        error: function (error) {
            console.log(error)
        },
    });
}

function crearSelectFases(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/fases/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Fase}">${data.Nombre_Fase}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectTipoAmbientes(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/tipoAmbientes/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Tipo_Ambiente}">${data.Nombre}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

/* Alerta que muestra mensaje de cargando */
function alertLodading(msj_titulo = 'Cargando información...', icono = "", tiempo = ""){
    Swal.fire({
        title: msj_titulo,
        icon: icono,
        timer: tiempo,
        // html: '',//añadir codigo html
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    });
};

/* Alerta para indicar que se ha finalizado la carga */
function cerrarAlertLoading(msj_titulo = 'Carga finalizada!', icono = "success", tiempo = 2500){
    Swal.fire({
        title: msj_titulo,
        icon: icono,
        timer: tiempo,
        // html: '',//añadir codigo html
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
    });
    // Se puede cerrar con:
    // swal.close();
}

function setFechaHoraActual(idElemento){
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = day + "-" + month + "-" + year;
    console.log(today)
    console.log(date)
    console.log(new Date().toISOString().substring(0, 10))
    document.querySelector(`#${idElemento}`).value = new Date().toISOString().substring(0, 10);
}

// Función para evitar dobleclic y evitar enviar doble submit
function onlyClick(idBoton){
    idBoton.disabled = true;
    setTimeout(() => {
      idBoton.disabled = false;
    }, 1350);
}

// Previsualizar una foto subida al input file
function previewImg(verEn_idElemento,event){
    // get file and preview image

    var inputFile = event.target;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(`#${verEn_idElemento}`).attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(inputFile.files[0]);
    }
}

/* Funcion que agrega digitos a un string
primer parametro: string a rellenar
segundo parametro numero todal del string rellenado
tercer parametro(opcional): caracter para rellenar
ejemplo: 00012 */
function rellenarString(str,numDigitos,caracter) {
	var strFinal = str.toString();
	if (!caracter){
        caracter = '0';
    }

	while (strFinal.length < numDigitos) {
		strFinal = caracter + strFinal;
	}
	return strFinal;
};

function imgError(image) {
    image.src = "img/sistema/imagen-no-disponible.jpeg";
    return true;
}

function formDataToObjet(formData){
    var object = {};
    formData.forEach(function(value, key){
        object[key] = value;
    });

    return object;
}

function cambiar_size_fuente(size){

    document.querySelector("#size_fuente").innerHTML = `*{font-size:${size}rem}`
}

function crearSelectRecomendaciones(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/recomendaciones/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();

            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Recomendacion}">${data.Recomendacion}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function crearSelectCausasPrincipal(id_select){
    // obteniendo el select a modificar
    var select = document.getElementById(`${id_select}`);

    // peticion a la base
    $.ajax({
        url: '/causaPrincipal/show',
        type: "get",
        data:'',
        dataType: 'json',
        success: function (data){
            // // Limpiando el select
            $(`#${id_select}`).empty();
            // creando el select con los productos en la OC
            select.innerHTML += '<option value="">Selecionar...</option>';
            data.forEach(data => {
                select.innerHTML += `<option value="${data.Id_Causa_Raiz}">${data.Causa_Raiz}</option>`;
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}