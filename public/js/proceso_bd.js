window.addEventListener('DOMContentLoaded', (event) => {
    /* Variables elementos DOM */
    validar_archivo_sql();
    var btn_cargar_bd_inspeccion = document.querySelector('#btn_cargar_bd_inspeccion');
    btn_cargar_bd_inspeccion.addEventListener('click', cargar_bd_inspeccion);
    
    var btn_script_bd = document.querySelector('#btn_script_bd');
    var btn_convertir_sql = document.querySelector('#btn_convertir_sql');

    btn_script_bd.addEventListener('click', mostrar_modal_cargar_script);
    btn_convertir_sql.addEventListener('click', sript_to_sql);
    
});

function mostrar_modal_cargar_script(){
    $('#modal_cargar_script_bd').modal('show');
}

async function sript_to_sql(){
    var script_sql_server = document.querySelector('#script_sql_server').value;
    if (script_sql_server == "") {
        Toast.fire({
            icon: 'warning',
            title: 'Ingresar script original'
        })
        return;
    }

    Toast.fire({
        icon: 'info',
        title: 'Procesando datos...',
        timer: 7000
    })
    // var script_resultado = document.querySelector('#script_resultado');
    
    const nombre_db_inicio = 5;
    var nombre_db_final = script_sql_server.indexOf("]");
    var nombre_db = script_sql_server.slice(nombre_db_inicio,nombre_db_final);
    console.log(nombre_db)
    
    var sql_script = "";
    sql_script = script_sql_server.replaceAll(/(\r\n|\n|\r)/gm, "");
    sql_script = sql_script.replaceAll(`USE [${nombre_db}]`,"");
    sql_script = sql_script.replaceAll("[dbo].","");
    sql_script = sql_script.replaceAll("[","`");
    sql_script = sql_script.replaceAll("]","`");
    sql_script = sql_script.replaceAll("CAST(N'","'");
    sql_script = sql_script.replaceAll("' AS DateTime)","'");
    sql_script = sql_script.replaceAll("' AS SmallDateTime)","'");
    sql_script = sql_script.replaceAll("(N'","('");
    sql_script = sql_script.replaceAll(", N'",", '");
    sql_script = sql_script.replaceAll("INSERT",";INSERT");
    sql_script = sql_script.replaceAll("CAST(","");
    sql_script = sql_script.replaceAll("AS Numeric(28, 2))","");
    sql_script = sql_script.replaceAll("GO","");
    sql_script = sql_script.replaceAll("\\","/");
    sql_script = sql_script.replaceAll("INSERT","\nINSERT INTO ");

    $.ajax({
        url: `/procesobd`,
        type: "POST",
        dataType: 'json',
        data: {script_transformado: sql_script, nombre_db: nombre_db},

        success: function (res) {
            
            window.location.href = `descargar_bd_procesada/${nombre_db}.sql`
            // window.open(`descargar_bd_procesada/${nombre_db}.sql`);
            
            Toast.fire({
                icon: 'success',
                title: 'Script generado'
            })

            setTimeout(() => {
                $('#modal_cargar_script_bd').modal('hide');
                document.querySelector('#script_sql_server').value = "";
            }, 700);
        },
        error: function (err) {
            console.log(err)
            Toast.fire({
              icon: 'error',
              title: 'Error al generar script'
            })
        }
    });
}

function cargar_bd_inspeccion(){
    
    if($("#form_restaurar_db_inspeccion").valid()){

        alertLodading("Cargando datos de inspección...","info")

        var formData = new FormData(document.getElementById("form_restaurar_db_inspeccion"));
        $.ajax({
            data: formData,
            url: "/cargar_bd_inspeccion",
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (res) {
                window.location.reload()
            },
            error: function (err) {
                console.log(err)
                cerrarAlertLoading("Error al cargar inspección","error")
            }
        });
    }
}

function validar_archivo_sql(){
    $('#form_restaurar_db_inspeccion').validate({
        rules: {
          bd_inspeccion: {
            required: function () {
                return true
            },
            extension: "sql"
          },
        },
        messages: {

          bd_inspeccion: {
            required: "Seleccionar un archivo",
            extension: "Archivo no valido, solo archivos .sql"
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });
}