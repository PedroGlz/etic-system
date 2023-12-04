<?php namespace App\Controllers;

use App\Models\LineaBaseMdl;
use App\Controllers\BaseController;

class LineaBase extends BaseController
{
    public function index(){
    }

    public function show($id = null){
        $lineaBase = new LineaBaseMdl();
        echo (json_encode($lineaBase->get()));
    }

    public function create(){
    }

    public function update(){
    }
    
    public function delete($id = null){
    }

}