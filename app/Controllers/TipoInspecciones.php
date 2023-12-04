<?php namespace App\Controllers;

use App\Models\TipoInspeccionesMdl;
use App\Controllers\BaseController;

class TipoInspecciones extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/tipoInspecciones.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/tipoInspecciones");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $tipoInspeccionesMdl = new TipoInspeccionesMdl();        
        echo (json_encode($tipoInspeccionesMdl->findAll()));
    }

    public function create(){
        $tipoInspeccionesMdl = new TipoInspeccionesMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Tipo_Inspeccion_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Tipo_Inspeccion_insert = crear_id();

        $save = $tipoInspeccionesMdl->insert([
            'Id_Tipo_Inspeccion'      =>$Id_Tipo_Inspeccion_insert,
            'Tipo_Inspeccion'=>$this->request->getPost('Tipo_Inspeccion'),
            'Desc_Inspeccion'=>$this->request->getPost('Desc_Inspeccion'),
            'Estatus'        =>$estatus,
            'Creado_Por'     =>$session->Id_Usuario,
            'Fecha_Creacion' => date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($tipoInspeccionesMdl->get($Id_Tipo_Inspeccion_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }
        else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $tipoInspeccionesMdl = new TipoInspeccionesMdl();
        $session = session();

        $id_TipoInspeccion = $this->request->getPost('Id_Tipo_Inspeccion');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Tipo_Inspeccion'=>$this->request->getPost('Tipo_Inspeccion'),
            'Desc_Inspeccion'=>$this->request->getPost('Desc_Inspeccion'),
            'Estatus'        =>$estatus,
            'Modificado_Por' =>$session->Id_Usuario,
            'Fecha_Mod'      => date("Y-m-d H:i:s"),
        ];

        $update = $tipoInspeccionesMdl->update($id_TipoInspeccion,$data);
        
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
        $tipoInspeccionesMdl = new TipoInspeccionesMdl();
        $delete = $tipoInspeccionesMdl->where('Id_Tipo_Inspeccion',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}