<?php namespace App\Models;

use CodeIgniter\Model;

class TipoFallasMdl extends Model
{

    protected $table = 'tipo_fallas';
    protected $primaryKey = 'Id_Tipo_Falla';
    protected $allowedFields = [
        'Id_Tipo_Falla',
        'Id_Tipo_Inspeccion',
        'Tipo_Falla',
        'Desc_Tipo_Falla',
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

        return $this->asArray()->where(['Id_Tipo_Falla' => $id])->first();	
    }

    public function obtenerRegistros(){
        return $this->table('tipo_fallas')->select('
            Id_Tipo_Falla,
            Id_Tipo_Inspeccion,
            Tipo_Falla,
            Desc_Tipo_Falla,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = tipo_fallas.Id_Tipo_Inspeccion) AS nombreTipoInspeccion
        ')->findAll();
    }
}