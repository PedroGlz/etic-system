<?php namespace App\Models;

use CodeIgniter\Model;

class TipoPrioridadesMdl extends Model
{

    protected $table = 'tipo_prioridades';
    protected $primaryKey = 'Id_Tipo_Prioridad';
    protected $allowedFields = [
        'Id_Tipo_Prioridad',
        'Tipo_Prioridad',
        'Desc_Prioridad',
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

        return $this->asArray()->where(['Id_Tipo_Prioridad' => $id])->first();	
    }

}