<?php

namespace App\Controllers;

use App\Models\ClientesMdl;
use App\Models\GirosMdl;
use App\Models\CompaniasMdl;
use App\Controllers\BaseController;

class Clientes extends BaseController
{

    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        
        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/clientes.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/clientes");
        echo view('templetes/footer',$script);

    }

    public function show($id = null){
        $clientesMdl = new ClientesMdl();
        
        echo (json_encode($clientesMdl->obtenerRegistros()));
    }

    public function create(){
        $clientesMdl = new ClientesMdl();
        $session = session();

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        if (!empty($this->request->getFile('Imagen_Cliente'))){
            // Obteniendo la foto subida por el companias
            $archivoFoto = $this->request->getFile('Imagen_Cliente');
            // Colcando nombre al archivo
            $nombreFoto = $archivoFoto->getName();
            // Subiendo el archivo al servidor
            $archivoFoto->move(ROOTPATH.'public/Archivos_ETIC/clientes_img', $nombreFoto);
        }else{
            $nombreFoto = NULL;
        }

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Cliente_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Cliente_insert = crear_id();
        
        $save = $clientesMdl->insert([
            'Id_Cliente'      =>$Id_Cliente_insert,
            'Razon_Social'    =>$this->request->getPost('Razon_Social'),
            'Nombre_Comercial'=>$this->request->getPost('Nombre_Comercial'),
            'RFC'             =>$this->request->getPost('RFC'),
            'Usuario_Cliente' =>$this->request->getPost('Usuario_Cliente'),
            'Password_Cliente'=>password_hash($this->request->getPost('Password_Cliente'), PASSWORD_BCRYPT),
            'Imagen_Cliente'  =>$nombreFoto,
            'Estatus'         =>$estatus,
            'Creado_Por'      =>$session->Id_Usuario,
            'Fecha_Creacion'  => date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($clientesMdl->get($Id_Cliente_insert));
        
        // Para que entre al succes del ajax
        if($save != false){
            echo json_encode(array("status" => true));
        }
        else{
            echo json_encode(array("status" => false));
        }
    }

    public function update(){
        $clientesMdl = new ClientesMdl();
        $session = session();
        
        $Id_Cliente = $this->request->getPost('Id_Cliente');

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';
        
         $data = [
            'Id_Compania'     =>$this->request->getPost('Id_Compania'),
            'Id_Giro'         =>$this->request->getPost('Id_Giro'),
            'Razon_Social'    =>$this->request->getPost('Razon_Social'),
            'Nombre_Comercial'=>$this->request->getPost('Nombre_Comercial'),
            'RFC'             =>$this->request->getPost('RFC'),
            'Usuario_Cliente' =>$this->request->getPost('Usuario_Cliente'),
            'Estatus'         =>$estatus,
            'Modificado_Por'  =>$session->Id_Usuario,
            'Fecha_Mod'       => date("Y-m-d H:i:s"),
        ];

        // Obteniendo la foto subida por el companias
        $archivoFoto = $this->request->getFile('Imagen_Cliente');
        // Validando si se subio un foto o no
        if ($archivoFoto != ""){
            // Si se sube una foto nueva, primero se borra la actual
            eliminar_imagen("clientes_img/".$this->request->getPost('Imagen_Cliente_actual'));

            // Colcando nombre al archivo
            $nombreFoto = $archivoFoto->getName();
            // Subiendo el archivo al servidor
            $archivoFoto->move(ROOTPATH.'public/Archivos_ETIC/clientes_img', $nombreFoto);

            // Agregando el nombre de la foto para el update
            $data['Imagen_Cliente']=$nombreFoto;
        }

        // Actualizando la BD
        $update = $clientesMdl->update($Id_Cliente,$data);
        
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
        $clientesMdl = new ClientesMdl();

        $clientesMdl->select('Imagen_Cliente');
        $clientesMdl->where('Id_Cliente',$id);
        $imgBorrar = $clientesMdl->get();

        eliminar_imagen("clientes_img/".$imgBorrar[0]['Imagen_Cliente']);
        
        $delete = $clientesMdl->where('Id_Cliente',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}
