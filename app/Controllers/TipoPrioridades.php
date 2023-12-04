<?php namespace App\Controllers;

use App\Models\TipoPrioridadesMdl;
use App\Controllers\BaseController;

class TipoPrioridades extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/tipoPrioridades.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/tipoPrioridades");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $tipoPrioridadesMdl = new TipoPrioridadesMdl();
        echo (json_encode($tipoPrioridadesMdl->findAll()));
    }

    public function create(){
        $tipoPrioridadesMdl = new TipoPrioridadesMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Tipo_Prioridad_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Tipo_Prioridad_insert = crear_id();

        $save = $tipoPrioridadesMdl->insert([
            'Id_Tipo_Prioridad'=>$Id_Tipo_Prioridad_insert,
            'Tipo_Prioridad'   =>$this->request->getPost('Tipo_Prioridad'),
            'Desc_Prioridad'   =>$this->request->getPost('Desc_Prioridad'),
            'Estatus'          =>$estatus,
            'Creado_Por'       =>$session->Id_Usuario,
            'Fecha_Creacion'   =>date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($tipoPrioridadesMdl->get($Id_Tipo_Prioridad_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $tipoPrioridadesMdl = new TipoPrioridadesMdl();
        $session = session();

        $Id_Tipo_Prioridad = $this->request->getPost('Id_Tipo_Prioridad');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Tipo_Prioridad'=>$this->request->getPost('Tipo_Prioridad'),
            'Desc_Prioridad'=>$this->request->getPost('Desc_Prioridad'),
            'Estatus'       =>$estatus,
            'Modificado_Por'=>$session->Id_Usuario,
            'Fecha_Mod'     => date("Y-m-d H:i:s"),
        ];

        $update = $tipoPrioridadesMdl->update($Id_Tipo_Prioridad,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){
        $tipoPrioridadesMdl = new TipoPrioridadesMdl();
        $delete = $tipoPrioridadesMdl->where('Id_Tipo_Prioridad',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}