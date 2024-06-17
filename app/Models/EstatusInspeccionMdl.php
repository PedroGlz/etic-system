<?php namespace App\Models;

use CodeIgniter\Model;

class EstatusInspeccionMdl extends Model
{

    protected $table = 'estatus_inspeccion';
    protected $primaryKey = 'Id_Status_Inspeccion';
    protected $allowedFields = [
        'Id_Status_Inspeccion',
        'Status_Inspeccion',
        'Desc_Status',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion', //flag_export
        'Id_Sitio' //flag_export
    ];

    public function get($id = null){

        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Status_Inspeccion' => $id])->first();	
    }

}