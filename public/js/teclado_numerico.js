var input_numerico_activo = "";

$(".btn_teclado_numerico").click((event) => {
    abrir_teclado_numerico(event)
});

$("#contenedor_teclado_numerico").click((event) => {
    ingresar_numeros(event)
});

function abrir_teclado_numerico(event){
    let btn_teclado_numerico = event.target

    if (btn_teclado_numerico.classList.contains('fas')) {
        btn_teclado_numerico = event.target.parentElement;
    }

    let elemento_activo = btn_teclado_numerico.parentElement.previousElementSibling;
    
    if (elemento_activo.tagName.toLowerCase() !== 'input') {
        elemento_activo = btn_teclado_numerico.parentElement.previousElementSibling.previousElementSibling;
    }
    
    input_numerico_activo = elemento_activo;
    console.log(elemento_activo);
    
    $('#modal_teclado_numerico').modal('show');
}

function ingresar_numeros(event){
    console.log(event.target)
    let boton_clickeado = event.target;
    // console.log(event.target.classList.contains(''))
    
    switch (true) {
        case boton_clickeado.classList.contains('boton_tn_numero'):
            input_numerico_activo.value += boton_clickeado.value;
        break;
        case boton_clickeado.classList.contains('boton_tn_borrar'):
            input_numerico_activo.value = input_numerico_activo.value.slice(0, -1);
        break;
        case boton_clickeado.classList.contains('boton_tn_limpiar'):
            input_numerico_activo.value = "";
        break;
    }
}