<?php namespace App\Controllers;

use App\Models\RecomendacionesMdl;
use App\Controllers\BaseController;

class Recomendaciones extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/recomendaciones.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/recomendaciones");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $recomendaciones = new RecomendacionesMdl();        
        echo (json_encode($recomendaciones->get($id)));
    }

    public function create(){
        $recomendacionesMdl = new RecomendacionesMdl();
        $session = session();        
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Recomendacion_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Recomendacion_insert = crear_id();

        $save = $recomendacionesMdl->insert([
            'Id_Recomendacion'   =>$Id_Recomendacion_insert,
            'Id_Tipo_Inspeccion' =>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Id_Causa_Raiz'      =>$this->request->getPost('Id_Causa_Raiz'),
            'Recomendacion'      =>$this->request->getPost('Recomendacion'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Usuario,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($recomendacionesMdl->get($Id_Recomendacion_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }
        else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $recomendacionesMdl = new RecomendacionesMdl();
        $session = session();

        $Id_Recomendacion = $this->request->getPost('Id_Recomendacion');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Tipo_Inspeccion' =>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Id_Causa_Raiz'      =>$this->request->getPost('Id_Causa_Raiz'),
            'Recomendacion'  =>$this->request->getPost('Recomendacion'),
            'Estatus'        =>$estatus,
            'Modificado_Por' =>$session->Id_Usuario,
            'Fecha_Mod'      => date("Y-m-d H:i:s"),
    
        ];

        $update = $recomendacionesMdl->update($Id_Recomendacion,$data);
        
        // Para que entre al succes del ajax
        if($update != false)
        {            
            echo json_encode(array("status" => true));
        }
        else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){
        $recomendacionesMdl = new RecomendacionesMdl();
        $delete = $recomendacionesMdl->where('Id_Recomendacion',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}