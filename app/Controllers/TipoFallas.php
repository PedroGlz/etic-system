<?php namespace App\Controllers;

use App\Models\TipoFallasMdl;
use App\Controllers\BaseController;

class TipoFallas extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/tipoFallas.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/tipoFallas");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $tipoFallasMdl = new TipoFallasMdl();
        echo (json_encode($tipoFallasMdl->obtenerRegistros()));
    }

    public function create(){
        $tipoFallasMdl = new TipoFallasMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Tipo_Falla_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Tipo_Falla_insert = crear_id();

        $save = $tipoFallasMdl->insert([
            'Id_Tipo_Falla'     =>$Id_Tipo_Falla_insert,
            'Id_Tipo_Inspeccion'=>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Tipo_Falla'        =>$this->request->getPost('Tipo_Falla'),
            'Desc_Tipo_Falla'   =>$this->request->getPost('Desc_Tipo_Falla'),
            'Estatus'           =>$estatus,
            'Creado_por'        =>$session->Id_Usuario,
            'Fecha_creacion'    => date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($tipoFallasMdl->get($Id_Tipo_Falla_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $tipoFallasMdl = new TipoFallasMdl();
        $session = session();

        $Id_Tipo_Falla = $this->request->getPost('Id_Tipo_Falla');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Tipo_Inspeccion'=>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Tipo_Falla'        =>$this->request->getPost('Tipo_Falla'),
            'Desc_Tipo_Falla'   =>$this->request->getPost('Desc_Tipo_Falla'),
            'Estatus'           =>$estatus,
            'Modificado_por'    =>$session->Id_Usuario,
            'Fecha_mod'         => date("Y-m-d H:i:s"),
        ];

        $update = $tipoFallasMdl->update($Id_Tipo_Falla,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){
        $tipoFallasMdl = new TipoFallasMdl();
        $delete = $tipoFallasMdl->where('Id_Tipo_Falla',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}