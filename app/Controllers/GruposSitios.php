<?php namespace App\Controllers;

use App\Models\GruposSitiosMdl;
use App\Controllers\BaseController;

class GruposSitios extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/gruposSitios.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/gruposSitios");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $grupos = new GruposSitiosMdl();        
        echo (json_encode($grupos->show()));
    }

    public function create(){
        $gruposSitiosMdl = new GruposSitiosMdl();
        $session = session();        
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Grupo_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Grupo_insert = crear_id();

        $save = $gruposSitiosMdl->insert([
            'Id_Grupo_Sitios'=>$Id_Grupo_insert,
            'Id_Cliente'    =>$this->request->getPost('Id_Cliente'),
            'Grupo'         =>$this->request->getPost('Grupo'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Usuario,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($gruposSitiosMdl->get($Id_Grupo_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }
        else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $gruposSitiosMdl = new GruposSitiosMdl();
        $session = session();

        $Id_Grupo_Sitios = $this->request->getPost('Id_Grupo_Sitios');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Cliente'    =>$this->request->getPost('Id_Cliente'),
            'Grupo'         =>$this->request->getPost('Grupo'),
            'Estatus'        =>$estatus,
            'Modificado_Por' =>$session->Id_Usuario,
            'Fecha_Mod'      => date("Y-m-d H:i:s"),
    
        ];

        $update = $gruposSitiosMdl->update($Id_Grupo_Sitios,$data);
        
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
        $gruposSitiosMdl = new GruposSitiosMdl();
        $delete = $gruposSitiosMdl->where('Id_Grupo_Sitios',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}