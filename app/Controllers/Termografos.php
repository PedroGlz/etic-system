<?php namespace App\Controllers;

use App\Models\TermografosMdl;
use App\Controllers\BaseController;

class Termografos extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/termografos.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/termografos");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $termografosMdl = new TermografosMdl();        
        echo (json_encode($termografosMdl->findAll()));
    }

    public function create(){
        $termografosMdl = new TermografosMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Termografo_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Termografo_insert = crear_id();

        $save = $termografosMdl->insert([
            'Id_Termografo' =>$Id_Termografo_insert,
            'Termografo'    =>$this->request->getPost('Termografo'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Usuario,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($termografosMdl->get($Id_Termografo_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }
        else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $termografosMdl = new TermografosMdl();
        $session = session();

        $id_Termografos = $this->request->getPost('IdTermografo');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [            
            'Termografo'     =>$this->request->getPost('Termografo'),
            'Estatus'        =>$estatus,
            'Modificado_Por' =>$session->Id_Usuario,
            'Fecha_Mod'      => date("Y-m-d H:i:s"),
    
        ];

        $update = $termografosMdl->update($id_Termografos,$data);
        
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
        $termografosMdl = new TermografosMdl();
        $delete = $termografosMdl->where('Id_Termografo',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}