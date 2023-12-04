<?php namespace App\Models;

use CodeIgniter\Model;

class FabricantesMdl extends Model
{

    protected $table = 'fabricantes';
    protected $primaryKey = 'Id_Fabricante';
    protected $allowedFields = [
        'Id_Fabricante',
        'Id_Tipo_Inspeccion',
        'Fabricante',
        'Desc_Fabricante',
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

        return $this->asArray()->where(['Id_Fabricante' => $id])->first();	
    }

    public function obtenerDescripciones(){
        return $this->asArray()->orderBy('Fabricante', 'asc')->findColumn('Fabricante');
    }

    public function obtenerRegistros(){
        return $this->table('fabricantes')->select('
            Id_Fabricante,
            Id_Tipo_Inspeccion,
            Fabricante,
            Desc_Fabricante,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = fabricantes.Id_Tipo_Inspeccion) AS nombreTipoInspeccion
        ')->orderBy('Fabricante', 'ASC')->findAll();
    }
}