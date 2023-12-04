<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesMdl extends Model
{
    protected $table            = 'clientes';
    protected $primaryKey       = 'Id_Cliente';
    protected $allowedFields    = [
        'Id_Cliente',
        'Id_Compania',
        'Id_Giro',
        'Razon_Social',
        'Nombre_Comercial',
        'RFC',
        'Imagen_Cliente',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion' //flag_export
    ];

    public function get($id = null){

        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Cliente' => $id])->first();	
    }

    public function obtenerRegistros(){
        return $this->table('clientes')->select('
            Id_Cliente,
            Id_Compania,
            Id_Giro,
            Razon_Social,
            Nombre_Comercial,
            RFC,
            Imagen_Cliente,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod
        ')->where(['Estatus' => 'Activo'])->findAll();
    }
}
