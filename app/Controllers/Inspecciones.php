<?php

namespace App\Controllers;
require(ROOTPATH.'vendor/autoload.php');

use App\Controllers\BaseController;
use App\Models\InspeccionesMdl;
use App\Models\UbicacionesMdl;
use App\Models\InspeccionesDetMdl;
helper('filesystem');

class Inspecciones extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/inspecciones.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/inspecciones");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $inspeccionesMdl = new InspeccionesMdl();
        echo (json_encode($inspeccionesMdl->obtenerRegistros()));
    }

    public function create(){
        $inspeccionesMdl = new InspeccionesMdl();
        $ubicacionesMdl = new UbicacionesMdl();
        $inspeccionesDetMdl = new InspeccionesDetMdl();
        $session = session();

        $ultima_inspeccion = $inspeccionesMdl->selectMax('No_Inspeccion')->get();
        $ultima_inspeccion = $ultima_inspeccion[0]['No_Inspeccion'];

        $numerosInspeccion = $inspeccionesMdl->select('No_Inspeccion AS Inspeccion_Anterior, (No_Inspeccion + 1) AS Num_Inspeccion')->where('No_Inspeccion',$ultima_inspeccion)->get();
        
        //Si ya existen inspecciones en la BD se sigue l consecutivo, si no, se inicializan en algún número
        if(count($numerosInspeccion) > 0){
            $numero_inspeccion = $numerosInspeccion[0]['Num_Inspeccion'];
            $numero_inspeccion_anterior = $numerosInspeccion[0]['Inspeccion_Anterior'];
        }else{
            $numero_inspeccion = 3500;
            $numero_inspeccion_anterior = 0;
        }

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // Obtenemos la diferencia de dias entre la fecha de inicio y la fecha fin
        if(!empty($this->request->getPost('Fecha_Fin'))){
            $dias = $this->diferenciaFechas($this->request->getPost('Fecha_Inicio'),$this->request->getPost('Fecha_Fin'));
        }else{
            $dias = 1;
        }

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Inspeccion_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Inspeccion_insert = crear_id();

        $save = $inspeccionesMdl->insert([
            'Id_Inspeccion'       =>$Id_Inspeccion_insert,
            'Id_Cliente'          =>$this->request->getPost('Id_Cliente'),
            'Id_Grupo_Sitios'     =>$this->request->getPost('Id_Grupo_Sitios'),
            'Id_Sitio'            =>$this->request->getPost('Id_Sitio'),
            'Id_Status_Inspeccion'=>$this->request->getPost('Id_Status_Inspeccion'),
            'No_Inspeccion_Ant'   =>$numero_inspeccion_anterior,
            'Fecha_Inicio'        =>$this->request->getPost('Fecha_Inicio'),
            'Fecha_Fin'           =>$this->request->getPost('Fecha_Fin'),
            'Fotos_Ruta'          =>'public/Archivos_ETIC/inspecciones/'.$numero_inspeccion,
            'No_Dias'             =>$dias,
            'Unidad_Temp'         =>$this->request->getPost('Unidad_Temp'),
            'No_Inspeccion'       =>$numero_inspeccion,
            'Estatus'             =>$estatus,
            'Creado_Por'          =>$session->Id_Usuario,
            'Fecha_Creacion'      => date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($inspeccionesMdl->get($Id_Inspeccion_insert));

        // Creamos la carpeta con el nombre de la inspeccion solo offline
        if (!is_dir(ROOTPATH.'public/Archivos_ETIC/inspecciones/'.$numero_inspeccion)) {
            $this->crearCarpeta($numero_inspeccion);
        }

        // Obteniendo el id de la nueva inspección
        $idInspeccion = $Id_Inspeccion_insert;
        $ubicaciones = $ubicacionesMdl->ubicaciones($this->request->getPost('Id_Sitio'));

        foreach ($ubicaciones as $key => $value) {

            // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Inspeccion_insert
            // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
            $Id_Inspeccion_det_insert = crear_id();

            $inspeccionesDetMdl->insert([
                'Id_Inspeccion_Det'       =>$Id_Inspeccion_det_insert,
                'Id_Inspeccion'           =>$idInspeccion,
                'Id_Ubicacion'            =>$value['Id_Ubicacion'],
                'Id_Status_Inspeccion_Det'=>'568798D1-76BB-11D3-82BF-00104BC75DC2',
                'Notas_Inspeccion'        =>'',
                'Estatus'                 =>$value['Estatus'],
                'Id_Estatus_Color_Text'   =>'1',
                'Creado_Por'              =>$session->Id_Usuario,
                'Fecha_Creacion'          =>date("Y-m-d H:i:s"),
                'Id_Sitio'                =>$session->Id_Sitio,
            ]);
        }

        // Para que entre al succes del ajax
        if($save != false){
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $inspeccionesMdl = new InspeccionesMdl();
        $session = session();

        $Id_Inspeccion = $this->request->getPost('Id_Inspeccion');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        if(!empty($this->request->getPost('Fecha_Fin'))){
            $dias = $this->diferenciaFechas($this->request->getPost('Fecha_Inicio'),$this->request->getPost('Fecha_Fin'));
        }else{
            $dias = 1;
        }

        $data = [
            'Id_Cliente'          =>$this->request->getPost('Id_Cliente'),
            'Id_Grupo_Sitios'     =>$this->request->getPost('Id_Grupo_Sitios'),
            'Id_Sitio'            =>$this->request->getPost('Id_Sitio'),
            'Id_Status_Inspeccion'=>$this->request->getPost('Id_Status_Inspeccion'),
            'No_Inspeccion_Ant'   =>$this->request->getPost('No_Inspeccion_Ant'),
            'Fecha_Inicio'        =>$this->request->getPost('Fecha_Inicio'),
            'Fecha_Fin'           =>$this->request->getPost('Fecha_Fin'),
            'No_Dias'             =>$dias,
            'Unidad_Temp'         =>$this->request->getPost('Unidad_Temp'),
            'No_Inspeccion'       =>$this->request->getPost('No_Inspeccion'),
            'Estatus'             =>$estatus,
            'Modificado_Por'      =>$session->Id_Usuario,
            'Fecha_Mod'           => date("Y-m-d H:i:s"),
        ];

        $update = $inspeccionesMdl->update($Id_Inspeccion,$data);

        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }

    public function delete($id = null){
        $inspeccionesMdl = new InspeccionesMdl();

        $inspeccionesMdl->select('Fotos_Ruta');
        $inspeccionesMdl->where('Id_Inspeccion',$id);
        $carpeta = $inspeccionesMdl->obtenerRegistros();

        $this->eliminarCarpeta(ROOTPATH.$carpeta[0]['Fotos_Ruta']);

        $delete = $inspeccionesMdl->where('Id_Inspeccion',$id)->delete();

        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }

    public function borrarImagen($img){
        if($img != "sin_imagen.png"){
            unlink("Archivos_ETIC/fotos_rutas/".$img);
        }
        return;
    }

    /*==========================================================================================
    TABLA DE VISUALIZACION DEL ARBOL
    ==========================================================================================*/
    public function listado(){
        $inspeccionesMdl = new InspeccionesMdl();

        $row1 = [];
        $row = $inspeccionesMdl->obtenerLista();

        foreach($row as $key => $value){
            $row1[$key]['Id_Inspeccion'] = $value['ID_INSPECCION'];
            $row1[$key]['No_Inspeccion'] = $value['NO_INSPECCION'];
            $row1[$key]['Nombre_Comercial'] = $value['NOMBRE_COMERCIAL'];
            $row1[$key]['Sitio'] = $value['SITIO'];
            $row1[$key]['Fecha_Inicio'] = $value['FECHA_INICIO'];
            $row1[$key]['Fecha_Fin'] = $value['FECHA_FIN'];
            $row1[$key]['Status_Inspeccion'] = $value['STATUS_INSPECCION'];
            $row1[$key]['Fotos_Ruta'] = $value['FOTOS_RUTA'];
        }
        return json_encode($row1);
    }

    public function abririnspeccion(){
        $session = session();

        $session->set('inspeccion', $this->request->getPost('inspeccion'));
        $session->set('nombreSitio', $this->request->getPost('nombreSitio'));
        $session->set('Id_Sitio', $this->request->getPost('Id_Sitio'));
        $session->set('Id_Inspeccion', $this->request->getPost('Id_Inspeccion'));
        $session->set('Id_Status_Inspeccion', $this->request->getPost('Id_Status_Inspeccion'));
        $dataMenu = datos_menu($session);
        echo json_encode(array("status" => true));
    }

    public function diferenciaFechas($fecha_1,$fecha_2){
        // Calculando diferencia entre las dos fechas y pasandolas a entero con abs()
        $dias = abs((strtotime($fecha_1)-strtotime($fecha_2))/86400);
        // Pasando al entero mas bajo
        $dias = floor($dias);
        return $dias;
    }

    public function crearCarpeta($carpeta){
        mkdir(ROOTPATH.'public/Archivos_ETIC/inspecciones/'.$carpeta.'/Imagenes',0777,true);
        mkdir(ROOTPATH.'public/Archivos_ETIC/inspecciones/'.$carpeta.'/Imagenes_optimizadas',0777,true);
        mkdir(ROOTPATH.'public/Archivos_ETIC/inspecciones/'.$carpeta.'/Reportes',0777,true);
    }

    /* Funcion que elimina todos los elementos y subcapetas es necesario enviar
    toda la ubicacion del archivo como parametro*/
    public function eliminarCarpeta($directorio){
        // var_dump(ROOTPATH."$directorio/*");
        // Si es una carpeta
        if(is_dir($directorio)){
            // obtiene todos los elementos dentro
            $files = glob("$directorio/*");

            // Llamamos a la funcion por cada elemento encontrado dentro de la carpeta
            foreach( $files as $file ){
                $this->eliminarCarpeta( $file );
            }

            rmdir( $directorio );
        // Si no es una carpeta valida que sea un archivo y entra a eliminar el archivo
        } elseif(is_file($directorio)) {
            unlink( $directorio );
        }
    }

    public function exportar_inspeccion_db(){
        $session = session();

        $nombre_backup_inspeccion = "ETIC_".$session->inspeccion."_".str_replace(' ', '_',$session->nombreSitio)."_INSPECCIONADA.sql";
        $usuario = "root";
        $password = "";
        $database = "u695808356_etic_system_db";
        $ruta_guardar_script = ROOTPATH."public\\Archivos_ETIC\\bd_exportar_inspecciones\\".$nombre_backup_inspeccion;

        shell_exec("C:\\xampp\\mysql\\bin\\mysqldump -h localhost -u root --no-create-info u695808356_etic_system_db --replace >".$ruta_guardar_script);

        if(file_exists($ruta_guardar_script)){
            return json_encode(["status" => 200, "nombre_backup" => $nombre_backup_inspeccion]);
        }else{
            return json_encode(["status" => 500]);
        }

    }

    public function descargar_bd_exportar($nombre_backup_inspeccion){
        $filePath = ROOTPATH.'public/Archivos_ETIC/bd_exportar_inspecciones/'.$nombre_backup_inspeccion;

        return $this->response->download($filePath, null);
    }

    public function cargar_bd_inspeccion(){
        $inspeccionesMdl = new InspeccionesMdl();
        $session = session();

        // Recibimos el sql de la base de datos
        $bd_inspeccion = $this->request->getFile('bd_inspeccion');
        // Lo movemos a la carpeta de importacion de inspecciones
        $bd_inspeccion->move(ROOTPATH.'public/Archivos_ETIC/bd_inspecciones_cargadas/', $bd_inspeccion->getName());
        // Creamos la ruta para hacer la restauracion en linea de comandos
        $ruta_bd_inspeccion = "C:\\xampp\\htdocs\\etic-system\\public\\Archivos_ETIC\\bd_inspecciones_cargadas\\".$bd_inspeccion->getName();
        // Ejecutmos el comando
        shell_exec("C:\\xampp\\mysql\\bin\\mysql -u root u695808356_etic_system_db < ".$ruta_bd_inspeccion);
        
        // Obteneindo los datos de la inspeccion restaurada
        $datos_inspeccion = $inspeccionesMdl->datos_inspeccion_restaurar();

        // Asignando a las variables de sesion
        $session->set('inspeccion', $datos_inspeccion[0]['No_Inspeccion']);
        $session->set('nombreSitio', $datos_inspeccion[0]['nombreSitio']);
        $session->set('Id_Sitio', $datos_inspeccion[0]['Id_Sitio']);
        $session->set('Id_Inspeccion', $datos_inspeccion[0]['Id_Inspeccion']);
        $session->set('Id_Status_Inspeccion', $datos_inspeccion[0]['Id_Status_Inspeccion']);

        if (!is_dir(ROOTPATH.'public/Archivos_ETIC/inspecciones/'.$session->inspeccion)) {
            $this->crearCarpeta($datos_inspeccion[0]['No_Inspeccion']);
        }

        return json_encode(200);
    }

    public function actualizar_estatus_inspeccion(){
        $inspeccionesMdl = new InspeccionesMdl();
        $session = session();

        $data = [
            'Id_Status_Inspeccion'=>$this->request->getPost('Id_Status_Inspeccion'),
            'Modificado_Por'      =>$session->Id_Usuario,
            'Fecha_Mod'           => date("Y-m-d H:i:s"),
        ];
        
        // Si el estatus es cerrado se manda la fecha en que se esta cerrando la inspección
        if ($this->request->getPost('Id_Status_Inspeccion')  == "73F27007-76B3-11D3-82BF-00104BC75DC2") {
            date_default_timezone_set("America/Mexico_City");
            $fecha_de_cierre = date("Y-m-d . H:i");
            $fecha_de_cierre = str_replace(" . ","T",strval($fecha_de_cierre));

            $fecha_inicio = $inspeccionesMdl->get($this->request->getPost('Id_Inspeccion'));
            $fecha_inicio = str_replace(" ","T",strval($fecha_inicio["Fecha_Inicio"]));

            $dias = $this->diferenciaFechas($fecha_inicio,$fecha_de_cierre);

            $data['Fecha_Fin']=$fecha_de_cierre;
            $data['No_Dias']=$dias;
        }
        
        $update = $inspeccionesMdl->update($this->request->getPost('Id_Inspeccion'),$data);
        // Actualizano la variable de session con el estatus
        $session->set('Id_Status_Inspeccion', $this->request->getPost('Id_Status_Inspeccion'));

        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }

    public function limpiar_bd(){
        $session = session();

        // Si es desde el perfil administrador no borrar datos de la BD
        if (!empty($session->grupo) && $session->grupo !== "Administradores") {
            shell_exec('C:\\xampp\\mysql\\bin\\mysql -h localhost -u root u695808356_etic_system_db -e "TRUNCATE TABLE u695808356_etic_system_db.causa_principal;TRUNCATE TABLE u695808356_etic_system_db.clientes;TRUNCATE TABLE u695808356_etic_system_db.datos_reporte;TRUNCATE TABLE u695808356_etic_system_db.equipos;TRUNCATE TABLE u695808356_etic_system_db.estatus_color_text;TRUNCATE TABLE u695808356_etic_system_db.estatus_inspeccion;TRUNCATE TABLE u695808356_etic_system_db.estatus_inspeccion_det;TRUNCATE TABLE u695808356_etic_system_db.fabricantes;TRUNCATE TABLE u695808356_etic_system_db.fallas;TRUNCATE TABLE u695808356_etic_system_db.fases;TRUNCATE TABLE u695808356_etic_system_db.grupos;TRUNCATE TABLE u695808356_etic_system_db.grupos_sitios;TRUNCATE TABLE u695808356_etic_system_db.historial_problemas;TRUNCATE TABLE u695808356_etic_system_db.inspecciones;TRUNCATE TABLE u695808356_etic_system_db.inspecciones_det;TRUNCATE TABLE u695808356_etic_system_db.linea_base;TRUNCATE TABLE u695808356_etic_system_db.problemas;TRUNCATE TABLE u695808356_etic_system_db.severidades;TRUNCATE TABLE u695808356_etic_system_db.sitios;TRUNCATE TABLE u695808356_etic_system_db.tipo_ambientes;TRUNCATE TABLE u695808356_etic_system_db.tipo_fallas;TRUNCATE TABLE u695808356_etic_system_db.tipo_inspecciones;TRUNCATE TABLE u695808356_etic_system_db.tipo_prioridades;TRUNCATE TABLE u695808356_etic_system_db.ubicaciones;TRUNCATE TABLE u695808356_etic_system_db.v_historial_baseline;TRUNCATE TABLE u695808356_etic_system_db.v_ubicaciones;TRUNCATE TABLE u695808356_etic_system_db.v_ubicaciones_arbol;TRUNCATE TABLE u695808356_etic_system_db.v_ubicaciones_path;TRUNCATE TABLE u695808356_etic_system_db.v_ubicaciones_tree;"');
        }

        $session->remove('inspeccion');
        $session->remove('nombreSitio');
        $session->remove('Id_Sitio');
        $session->remove('Id_Inspeccion');
        $session->remove('Id_Status_Inspeccion');
        
        echo json_encode(array("status" => true));
    }

    public function inicializar_imagenes(){
        $inspeccionesMdl = new InspeccionesMdl();
        
        $nombreImagenIR = $this->request->getPost('Ir_Imagen');
        $nombreImagenDig = $this->request->getPost('Dig_Imagen');

        $data = [
            'IR_Imagen_Inicial'   =>$nombreImagenIR,
            'DIG_Imagen_Inicial'  =>$nombreImagenDig,
        ];
 
        $update = $inspeccionesMdl->update($this->request->getPost('Id_Inspeccion'),$data);
    
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
}