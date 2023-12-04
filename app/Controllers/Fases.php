<?php namespace App\Controllers;

use App\Models\FasesMdl;
use App\Controllers\BaseController;

class Fases extends BaseController{

    public function show($id = null){
        $fases = new FasesMdl();
        echo (json_encode($fases->orderBy('Nombre_Fase', 'ASC')->findAll()));
    }

}