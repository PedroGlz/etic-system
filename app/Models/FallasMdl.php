<?php namespace App\Models;

use CodeIgniter\Model;

class FallasMdl extends Model
{

    protected $table = 'fallas';
    protected $primaryKey = 'Id_Falla';
    protected $allowedFields = [
        'Id_Falla',
        'Id_Tipo_Falla',
        'Falla',
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

        return $this->asArray()->where(['Id_Falla' => $id])->first();	
    }

    public function obtenerRegistros(){
        return $this->table('fallas')->select('
            Id_Falla,
            Id_Tipo_Falla,
            Falla,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Tipo_Falla FROM tipo_fallas WHERE tipo_fallas.Id_Tipo_Falla = fallas.Id_Tipo_Falla) AS nombreTipoFalla,
            (SELECT Id_Tipo_Inspeccion FROM tipo_fallas WHERE tipo_fallas.Id_Tipo_Falla = fallas.Id_Tipo_Falla) tipoProblmea
        ')->orderBy('Falla', 'ASC')->findAll();
    }
}