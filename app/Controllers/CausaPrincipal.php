<?php namespace App\Controllers;

use App\Models\CausaPrincipalMdl;
use App\Controllers\BaseController;

class CausaPrincipal extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/causaPrincipal.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/causaPrincipal");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $causaPrincipalMdl = new CausaPrincipalMdl();
        echo (json_encode($causaPrincipalMdl->obtenerRegistros()));
    }

    public function create(){
        $causaPrincipalMdl = new CausaPrincipalMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Causa_Raiz_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Causa_Raiz_insert = crear_id();

        $save = $causaPrincipalMdl->insert([
            'Id_Causa_Raiz'      =>$Id_Causa_Raiz_insert,
            'Id_Tipo_Inspeccion'=>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Id_Falla'          =>$this->request->getPost('Id_Falla'),
            'Causa_Raiz'        =>$this->request->getPost('Causa_Raiz'),
            'Estatus'           =>$estatus,
            'Creado_Por'        =>$session->Id_Usuario,
            'Fecha_Creacion'    => date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($causaPrincipalMdl->get($Id_Causa_Raiz_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        $causaPrincipalMdl = new CausaPrincipalMdl();
        $session = session();

        $Id_Causa_Raiz = $this->request->getPost('Id_Causa_Raiz');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Tipo_Inspeccion'=>$this->request->getPost('Id_Tipo_Inspeccion'),
            'Id_Falla'          =>$this->request->getPost('Id_Falla'),
            'Causa_Raiz'        =>$this->request->getPost('Causa_Raiz'),
            'Estatus'           =>$estatus,
            'Modificado_Por'    =>$session->Id_Usuario,
            'Fecha_Mod'         => date("Y-m-d H:i:s"),
        ];

        $update = $causaPrincipalMdl->update($Id_Causa_Raiz,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){
        $causaPrincipalMdl = new CausaPrincipalMdl();
        $delete = $causaPrincipalMdl->where('Id_Causa_Raiz',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }

}