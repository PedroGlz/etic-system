<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

	public function contacto($name= "Neftali H")
    {


    $dataHeader = [
        'title' => 'ETIC - Termografía integral '.$name
    ];
        //echo 'Hello World!';
        echo view('templates/header',$dataHeader);
        echo view('dashboard/modulos/menu');
        echo view('dashboard/modulos/tabs');
        echo view('templates/footer');

    }

}
