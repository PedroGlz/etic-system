<?php namespace App\Models;

use CodeIgniter\Model;

class TipoInspeccionesMdl extends Model
{

    protected $table = 'tipo_inspecciones';
    protected $primaryKey = 'Id_Tipo_Inspeccion';
    protected $allowedFields = [
        'Id_Tipo_Inspeccion',
        'Tipo_Inspeccion',
        'Desc_Inspeccion',
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
            return $this->where(['Estatus' => 'Activo'])->findAll();
        }

        return $this->asArray()->where(['Id_Tipo_Inspeccion' => $id, 'Estatus' => 'Activo'])->first();	
    }

}