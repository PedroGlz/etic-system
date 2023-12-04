<?php namespace App\Controllers;

use App\Models\GruposMdl;
use App\Controllers\BaseController;

class HistorialProblemas extends BaseController
{
    public function index(){
    }

    public function show($id = null){
        $historialProblemas = new HistorialProblemasMdl();
        echo (json_encode($historialProblemas->findAll()));
    }

    public function create(){
    }

    public function update(){
    }
    
    public function delete($id = null){
    }

}