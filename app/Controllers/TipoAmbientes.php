<?php namespace App\Controllers;

use App\Models\TipoAmbientesMdl;
use App\Controllers\BaseController;

class TipoAmbientes extends BaseController{

    public function show($id = null){
        $tipoAmbientes = new TipoAmbientesMdl();
        echo (json_encode($tipoAmbientes->get()));
    }

}