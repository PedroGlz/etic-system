<?php namespace App\Controllers\Clientes;

require(ROOTPATH.'vendor/autoload.php');

use App\Controllers\BaseController;

class PrincipalClientes extends BaseController{

    public function index(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == '' || $session->grupo != "Clientes"){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/customers'));
        }

        $dataMenu = [
            'usuario' => $session->usuario,
            'nombre' => $session->nombre,
            'nombreCliente' => $session->nombreCliente,
            'id_usuario' => $session->Id_Usuario,
            'grupo' => $session->grupo,
        ];

        return view("clientes/principal_clientes",$dataMenu);
    }

}