<?php namespace App\Controllers\Clientes;

use App\Controllers\BaseController;
use App\Models\UsuariosMdl;
use App\Models\ClientesMdl;

class Login_clientes extends BaseController
{
    public function index()
    {
        $session = session();
        // Mostrar el login solo cuando no se ha iniciado session 
        if(is_null($session->usuario) || $session->usuario == '' || $session->grupo != "Clientes"){
            $this->salir();
            return view('clientes/login_clientes');
        }
        
        return redirect()->route('/customers/home');
    }

    public function acceso(){

        // Obteniendo valores de la vista login
        $usuario = $this->request->getPost('Usuario');
        $password = $this->request->getPost('Password');
        $recordarme = $this->request->getPost('remember');

        $usuarioMdl = new UsuariosMdl();
        $session = session();

        // Obteniendo resultados de la consulta
        $datosUsuario = $usuarioMdl->obtenerUsuario(['Usuario' => $usuario,]);    

        if(count($datosUsuario) > 0 && $datosUsuario[0]['grupo'] != "Clientes"){
            $session->setFlashdata('msg', 'Solo clientes autorizados');
            return redirect()->to(base_url('/customers'));
        }

        // validando datos del usuario
        if(count($datosUsuario) > 0 && password_verify($password,$datosUsuario[0]['Password'])){
            
            // Creando variables de session
            $data = [
                "Id_Usuario" => $datosUsuario[0]['Id_Usuario'],
                "usuario" => $datosUsuario[0]['Usuario'],
                "nombre" => $datosUsuario[0]['Nombre'],
                "nombreCliente" => $datosUsuario[0]['nombreCliente'],
                "grupo" => $datosUsuario[0]['grupo'],
                "fecha_login" => date("Y-m-d H:i:s")
            ];
            $session->set($data);

            // Actualizando la fecha y hora del ultimo login en la tabla de usuarios
            $update = $usuarioMdl->update($datosUsuario[0]['Id_Usuario'],["Ultimo_login" => date("Y-m-d H:i:s")]);

            //Creando las cookies para el btn de recordarme
            if(!empty($recordarme)){
                set_cookie('usuario',$usuario,time()+3600*24*7);
                set_cookie('password',$password,time()+3600*24*7);
            }

            return redirect()->to(base_url('/customers/home'));
        
        }else{
            $session->setFlashdata('msg', 'El nombre de usuario o contraseña son incorrectos');
            return redirect()->to(base_url('/customers'));
        }  

    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/customers'));
    }
}