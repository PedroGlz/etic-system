<?php namespace App\Controllers;

use App\Controllers\BaseController;
//use App\Models\UsuarioModel;

class Tablero extends BaseController
{
    public function index()
    {
        $session = session();        
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }

        $dataMenu = datos_menu($session);
        $script = ['src'  => 'js/catalogos/tablero.js'];

        echo view("templetes/header");
        echo view("dashboard/modulos/menu",$dataMenu);
        echo view("dashboard/modulos/tablero");
        echo view('templetes/footer',$script);

    }
}