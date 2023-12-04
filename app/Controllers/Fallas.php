<?php namespace App\Controllers;

use App\Models\FallasMdl;
use App\Controllers\BaseController;

class Fallas extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/fallas.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/fallas");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $fallasMdl = new FallasMdl();

        echo (json_encode($fallasMdl->obtenerRegistros()));
    }

    public function create(){
        $fallasMdl = new FallasMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Falla_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Falla_insert = crear_id();

        $save = $fallasMdl->insert([
            'Id_Falla'      =>$Id_Falla_insert,
            'Id_Tipo_Falla' =>$this->request->getPost('Id_Tipo_Falla'),
            'Falla'         =>$this->request->getPost('Falla'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Usuario,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($fallasMdl->get($Id_Falla_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $fallasMdl = new FallasMdl();
        $session = session();

        $Id_Falla = $this->request->getPost('Id_Falla');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Tipo_Falla' =>$this->request->getPost('Id_Tipo_Falla'),
            'Falla'         =>$this->request->getPost('Falla'),
            'Estatus'       =>$estatus,
            'Modificado_Por'=>$session->Id_Usuario,
            'Fecha_Mod'     => date("Y-m-d H:i:s"),
        ];

        $update = $fallasMdl->update($Id_Falla,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){
        $fallasMdl = new FallasMdl();
        $delete = $fallasMdl->where('Id_Falla',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}