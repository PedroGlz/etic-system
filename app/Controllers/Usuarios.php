<?php namespace App\Controllers;

use App\Models\UsuariosMdl;
use App\Controllers\BaseController;

class Usuarios extends BaseController
{
    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/usuarios.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/catalogos/usuarios");
        echo view('templetes/footer',$script);
    }

    public function show($id = null){
        $usuarios = new UsuariosMdl();
        echo (json_encode($usuarios->obtenerRegistros()));
    }

    public function create(){
        $usuariosMdl = new UsuariosMdl();
        $session = session();
        
        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';
        
        // Obteniendo la foto subida por el usuario
        $archivoFoto = $this->request->getFile('Foto');
        // Validando si se subio un foto o no
        if ($archivoFoto != ""){
            // Colcando nombre al archivo
            $nombreFoto = $archivoFoto->getRandomName();
            // Subiendo el archivo al servidor
            $archivoFoto->move(ROOTPATH.'public/Archivos_ETIC/fotos_usuarios', $nombreFoto);
        }else{
            $nombreFoto = NULL;
        }

        // CREAMOS EL ID CON LA AYUDA DEL HELPER Y LO GUARDAMOS EN LA VARIABLE $Id_Usuario_insert
        // PARA PASARLO AL INSERT Y DESPUES USARLO EN LA VALIDACION DE EXITO DE LA INSERCION
        $Id_Usuario_insert = crear_id();

        $save = $usuariosMdl->insert([
            'Id_Usuario'    =>$Id_Usuario_insert,
            'Id_Grupo'      =>$this->request->getPost('Id_Grupo'),
            'Usuario'       =>$this->request->getPost('Usuario'),
            'Nombre'        =>$this->request->getPost('Nombre'),
            'Password'      =>password_hash($this->request->getPost('Password'), PASSWORD_BCRYPT),
            'Foto'          =>$nombreFoto,
            'Email'         =>$this->request->getPost('Email'),
            'Telefono'      =>$this->request->getPost('Telefono'),
            'Id_Cliente'    =>$this->request->getPost('Id_Cliente'),
            'Id_Grupo_Sitios'=>$this->request->getPost('Id_Grupo_Sitios'),
            'Id_Sitio'      =>$this->request->getPost('Id_Sitio'),
            'Estatus'       =>$estatus,
            'Creado_Por'    =>$session->Id_Usuario,
            'Fecha_Creacion'=> date("Y-m-d H:i:s"),
        ]);

        // HACEMOS UNA CONSULTA CON EL ID GENERADO,SI SE ENCUENTRA EN LA TABLA RETORNA LOS DATOS Y 
        // PASA POR LA VALIDACION DE SI ES NULL, SE NIEGA EL RESULTADO
        // SI EXISTEN DATOS EN LA BD QUIERE DECIR QUE SE HIZO EL ALTA ASI QUE NO ES NULL Y SE NIEGA CONVIRTIENOSE EN TRUE
        // Y SI ES NULL SE NIEGA Y SE CONVIERTE A FALSE
        $save = !is_null($usuariosMdl->get($Id_Usuario_insert));

        // Para que entre al succes del ajax
        if($save != false){            
            echo json_encode(array("status" => true ));
        }else{
            echo json_encode(array("status" => false ));
        }
    }

    public function update(){
        
        $usuariosMdl = new UsuariosMdl();
        $session = session();

        $Id_Usuario = $this->request->getPost('Id_Usuario');    

        (!empty($this->request->getPost('Estatus'))) ? $estatus = 'Activo' : $estatus = 'Inactivo';

        $data = [
            'Id_Grupo'      =>$this->request->getPost('Id_Grupo'),
            'Usuario'       =>$this->request->getPost('Usuario'),
            'Nombre'        =>$this->request->getPost('Nombre'),
            // 'Password'      =>password_hash($this->request->getPost('Password'), PASSWORD_BCRYPT),
            // 'Foto'          =>$this->request->getPost('Foto'),
            'Email'         =>$this->request->getPost('Email'),
            'Telefono'      =>$this->request->getPost('Telefono'),
            'Id_Cliente'    =>$this->request->getPost('Id_Cliente'),
            'Id_Grupo_Sitios'=>$this->request->getPost('Id_Grupo_Sitios'),
            'Id_Sitio'      =>$this->request->getPost('Id_Sitio'),
            'Estatus'       =>$estatus,
            'Modificado_Por'=>$session->Id_Usuario,
            'Fecha_Mod'     => date("Y-m-d H:i:s"),
        ];

        // Obteniendo la foto subida por el usuario
        $archivoFoto = $this->request->getFile('Foto');
        // Validando si se subio un foto o no
        if ($archivoFoto != ""){
            // Si se sube una foto nueva, primero se borra la actual
            eliminar_imagen("fotos_usuarios/".$this->request->getPost('foto_Actual'));

            // Colcando nombre al archivo
            $nombreFoto = $archivoFoto->getName();
            // Subiendo el archivo al servidor
            $archivoFoto->move(ROOTPATH.'public/Archivos_ETIC/fotos_usuarios', $nombreFoto);

            // Agregando el nombre de la foto para el update
            $data['Foto']=$nombreFoto;
        }

        // Obteniendo el valor del campo password de la vista
        $password = $this->request->getPost('Password');
        // Validando si viene una contraseña o no
        if($password != ""){
            // Agregando el password para el update
            $data['Password'] = password_hash($password, PASSWORD_BCRYPT);
        }                

        // Actualizando la BD
        $update = $usuariosMdl->update($Id_Usuario,$data);
        
        // Para que entre al succes del ajax
        if($update != false){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    public function delete($id = null){        
        $usuariosMdl = new UsuariosMdl();

        $usuariosMdl->select('Foto');
        $usuariosMdl->where('Id_Usuario',$id);
        $imgBorrar = $usuariosMdl->get();
        
        eliminar_imagen("fotos_usuarios/".$imgBorrar[0]['Foto']);

        $delete = $usuariosMdl->where('Id_Usuario',$id)->delete();
        
        // Para que entre al succes del ajax
        if($delete){
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}