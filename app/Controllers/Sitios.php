<?php namespace App\Controllers;

use App\Models\SitiosMdl;
use App\Controllers\BaseController;

class Sitios extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/sitios.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/sitios");
        echo view('templetes/footer',$script);
    }

    public function contactos_sitios($id = null){
        $sitiosMdl = new SitiosMdl();
        // echo (json_encode($sitiosMdl->get($id)));
        echo (json_encode($sitiosMdl->obtenerRegistros($id)));
    }

    public function show($id = null){
        $sitiosMdl = new SitiosMdl();
        echo (json_encode($sitiosMdl->show($id)));
    }

    public function create(){
        $sitiosMdl = new SitiosMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Sitio_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Sitio_insert = crear_id();

        $save = $sitiosMdl->insert([
            'Id_Sitio'         =>$Id_Sitio_insert,
            'Id_Cliente'       =>$this->request->getPost('Id_Cliente'),
            'Id_Grupo_Sitios'  =>$this->request->getPost('Id_Grupo_Sitios'),
            'Sitio'            =>$this->request->getPost('Sitio'),
            'Desc_Sitio'       =>$this->request->getPost('Desc_Sitio'),
            'Folder'           =>$this->request->getPost('Folder'),
            'Direccion'        =>$this->request->getPost('Direccion'),
            'Colonia'          =>$this->request->getPost('Colonia'),
            'Estado'           =>$this->request->getPost('Estado'),
            'Municipio'        =>$this->request->getPost('Municipio'),
            'Contacto_1'       =>$this->request->getPost('Contacto_1'),
            'Puesto_Contacto_1'=>$this->request->getPost('Puesto_Contacto_1'),
            'Contacto_2'       =>$this->request->getPost('Contacto_2'),
            'Puesto_Contacto_2'=>$this->request->getPost('Puesto_Contacto_2'),
            'Contacto_3'       =>$this->request->getPost('Contacto_3'),
            'Puesto_Contacto_3'=>$this->request->getPost('Puesto_Contacto_3'),
            'Estatus'          =>$estatus,
            'Creado_Por'       =>$session->Id_Usuario,
            'Fecha_Creacion'   =>date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($sitiosMdl->get($Id_Sitio_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }
        else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $sitiosMdl = new SitiosMdl();
        $session = session();

        $id_Sitio = $this->request->getPost('Id_Sitio');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Sitio'         =>$this->request->getPost('Id_Sitio'),
            'Id_Cliente'       =>$this->request->getPost('Id_Cliente'),
            'Id_Grupo_Sitios'  =>$this->request->getPost('Id_Grupo_Sitios'),
            'Sitio'            =>$this->request->getPost('Sitio'),
            'Desc_Sitio'       =>$this->request->getPost('Desc_Sitio'),
            'Folder'           =>$this->request->getPost('Folder'),
            'Direccion'        =>$this->request->getPost('Direccion'),
            'Colonia'          =>$this->request->getPost('Colonia'),
            'Estado'           =>$this->request->getPost('Estado'),
            'Municipio'        =>$this->request->getPost('Municipio'),
            'Contacto_1'       =>$this->request->getPost('Contacto_1'),
            'Puesto_Contacto_1'=>$this->request->getPost('Puesto_Contacto_1'),
            'Contacto_2'       =>$this->request->getPost('Contacto_2'),
            'Puesto_Contacto_2'=>$this->request->getPost('Puesto_Contacto_2'),
            'Contacto_3'       =>$this->request->getPost('Contacto_3'),
            'Puesto_Contacto_3'=>$this->request->getPost('Puesto_Contacto_3'),
            'Estatus'          =>$estatus,
            'Modificado_Por'   =>$session->Id_Usuario,
            'Fecha_Mod'        => date("Y-m-d H:i:s"),
    
        ];

        $update = $sitiosMdl->update($id_Sitio,$data);
        
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
        $sitiosMdl = new SitiosMdl();
        $delete = $sitiosMdl->where('Id_Sitio',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
    
    private function _loadDefaultView($title,$data,$view){

        $dataMenu =[
            'titulo' =>  $title,
            'usuario' => 'Neftali H'
        ];
        
        $script = ['src'  => 'js/catalogos/sitios.js'];
        
        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/$view",$data);        
        echo view('templetes/footer',$script);        

    }

}