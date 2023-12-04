<?php namespace App\Controllers;

use App\Models\FabricantesMdl;
use App\Controllers\BaseController;

class Fabricantes extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/fabricantes.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/fabricantes");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $fabricantesMdl = new FabricantesMdl();
        echo (json_encode($fabricantesMdl->obtenerRegistros()));
    }

    public function create(){
        $fabricantesMdl = new FabricantesMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Fabricante_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Fabricante_insert = crear_id();

        $save = $fabricantesMdl->insert([
            'Id_Fabricante'      =>$Id_Fabricante_insert,
            'Id_Tipo_Inspeccion'=>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Fabricante'        =>$this->request->getPost('Fabricante'),
            'Desc_Fabricante'   =>$this->request->getPost('Desc_Fabricante'),
            'Estatus'           =>$estatus,
            'Creado_Por'        =>$session->Id_Usuario,
            'Fecha_Creacion'    => date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($fabricantesMdl->get($Id_Fabricante_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $fabricantesMdl = new FabricantesMdl();
        $session = session();

        $Id_Fabricante = $this->request->getPost('Id_Fabricante');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Tipo_Inspeccion'=>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Fabricante'        =>$this->request->getPost('Fabricante'),
            'Desc_Fabricante'   =>$this->request->getPost('Desc_Fabricante'),
            'Estatus'           =>$estatus,
            'Modificado_Por'    =>$session->Id_Usuario,
            'Fecha_Mod'         => date("Y-m-d H:i:s"),
        ];

        $update = $fabricantesMdl->update($Id_Fabricante,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){
        $fabricantesMdl = new FabricantesMdl();
        $delete = $fabricantesMdl->where('Id_Fabricante',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}