<?php namespace App\Controllers;

use App\Models\CompaniasMdl;
use App\Controllers\BaseController;

class Companias extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/companias.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/companias");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $companiasMdl = new CompaniasMdl();
        echo (json_encode($companiasMdl->obtenerRegistros()));
    }

    public function create(){
        $companiasMdl = new CompaniasMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';
        
        if (!empty($this->request->getFile('Logotipo'))){
            // Obteniendo la foto subida por el companias
            $archivoFoto = $this->request->getFile('Logotipo');
            // Colcando nombre al archivo
            $nombreFoto = $archivoFoto->getName();
            // Subiendo el archivo al servidor
            $archivoFoto->move(ROOTPATH.'public/Archivos_ETIC/companias_logotipos', $nombreFoto);
        }else{
            $nombreFoto = NULL;
        }

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Compania_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Compania_insert = crear_id();
        
        $save = $companiasMdl->insert([
            'Id_Compania'   =>$Id_Compania_insert,
            'Id_Giro'       =>$this->request->getPost('Id_Giro'),
            'Id_Pais'       =>$this->request->getPost('Id_Pais'),
            'Compania'      =>$this->request->getPost('Compania'),
            'Logotipo'      =>$nombreFoto,
            'Pagina_web'    =>$this->request->getPost('Pagina_web'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Compania,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($companiasMdl->get($Id_Compania_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        
        $companiasMdl = new CompaniasMdl();
        $session = session();

        $Id_Compania = $this->request->getPost('Id_Compania');    

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Giro'       =>$this->request->getPost('Id_Giro'),
            'Id_Pais'       =>$this->request->getPost('Id_Pais'),
            'Compania'      =>$this->request->getPost('Compania'),
            // 'Logotipo'      =>$nombreFoto,
            'Pagina_web'    =>$this->request->getPost('Pagina_web'),
            'Estatus'       =>$estatus,
            'Modificado_Por'=>$session->Id_Compania,
            'Fecha_Mod'     => date("Y-m-d H:i:s"),
        ];

        // Obteniendo la foto subida por el companias
        $archivoFoto = $this->request->getFile('Logotipo');
        // Validando si se subio un foto o no
        if ($archivoFoto != ""){
            // Si se sube una foto nueva, primero se borra la actual
            eliminar_imagen("companias_logotipos/".$this->request->getPost('foto_Actual'));

            // Colcando nombre al archivo
            $nombreFoto = $archivoFoto->getRandomName();
            // Subiendo el archivo al servidor
            $archivoFoto->move(ROOTPATH.'public/Archivos_ETIC/companias_logotipos', $nombreFoto);

            // Agregando el nombre de la foto para el update
            $data['Logotipo']=$nombreFoto;
        }

        // Actualizando la BD
        $update = $companiasMdl->update($Id_Compania,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){        
        $companiasMdl = new CompaniasMdl();

        $companiasMdl->select('Logotipo');
        $companiasMdl->where('Id_Compania',$id);
        $imgBorrar = $companiasMdl->get();

        eliminar_imagen("companias_logotipos/".$imgBorrar[0]['Logotipo']);

        $delete = $companiasMdl->where('Id_Compania',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}