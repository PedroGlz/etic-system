<?php namespace App\Controllers;

use App\Models\PaisesMdl;
use App\Controllers\BaseController;

class Paises extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/paises.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/paises");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $paises = new PaisesMdl();        
        echo (json_encode($paises->findAll()));
    }

    public function create(){
        $paisesMdl = new PaisesMdl();
        $session = session();        
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Pais_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Pais_insert = crear_id();

        $save = $paisesMdl->insert([
            'Id_Pais'       =>$Id_Pais_insert,
            'Pais'          =>$this->request->getPost('Pais'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Usuario,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($paisesMdl->get($Id_Pais_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }
        else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $paisesMdl = new PaisesMdl();
        $session = session();

        $Id_Pais = $this->request->getPost('Id_Pais');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Pais'           =>$this->request->getPost('Pais'),
            'Estatus'        =>$estatus,
            'Modificado_Por' =>$session->Id_Usuario,
            'Fecha_Mod'      => date("Y-m-d H:i:s"),
    
        ];

        $update = $paisesMdl->update($Id_Pais,$data);
        
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
        $paisesMdl = new PaisesMdl();
        $delete = $paisesMdl->where('Id_Pais',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}