<?php namespace App\Models;

use CodeIgniter\Model;

class GirosMdl extends Model
{

    protected $table = 'giros';
    protected $primaryKey = 'Id_Giro';
    protected $allowedFields = [
        'Id_Giro',
        'Giro',
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

        return $this->asArray()->where(['Id_Giro' => $id])->first();	
    }

}