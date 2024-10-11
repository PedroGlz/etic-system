<?php namespace App\Models;

use CodeIgniter\Model;

class FallasMdl extends Model
{

    protected $table = 'fallas';
    protected $primaryKey = 'Id_Falla';
    protected $allowedFields = [
        'Id_Falla',
        'Id_Tipo_Falla',
        'Id_Tipo_Inspeccion',
        'Falla',
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
            return $this->table('fallas')->select('
                fallas.Id_Falla,
                fallas.Id_Tipo_Falla,
                fallas.Id_Tipo_Inspeccion,
                fallas.Falla,
                fallas.Estatus,
                fallas.Creado_Por,
                fallas.Fecha_Creacion,
                fallas.Modificado_Por,
                fallas.Fecha_Mod,
                tinsp.Tipo_Inspeccion AS tipoInspeccion
            ')
            ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = fallas.Id_Tipo_Inspeccion', 'left')
            ->where(['fallas.Estatus' => 'Activo'])
            ->orderBy('fallas.Fecha_Creacion', 'ASC')->findAll();
        }

        return $this->table('fallas')->select('
            fallas.Id_Falla,
            fallas.Id_Tipo_Falla,
            fallas.Id_Tipo_Inspeccion,
            fallas.Falla,
            fallas.Estatus,
            fallas.Creado_Por,
            fallas.Fecha_Creacion,
            fallas.Modificado_Por,
            fallas.Fecha_Mod,
            tinsp.Tipo_Inspeccion AS tipoInspeccion
        ')
        ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = fallas.Id_Tipo_Inspeccion', 'left')
        ->where(['fallas.Id_Falla' => $id, 'fallas.Estatus' => 'Activo'])
        ->orderBy('fallas.Fecha_Creacion', 'ASC')->findAll();
    }

    public function obtenerRegistros($idTipoInspeccion){

        if($idTipoInspeccion === null){
            return $this->where(['Estatus' => 'Activo'])->findAll();
        }

        return $this->table('fallas')->select('
            fallas.Id_Falla,
            fallas.Id_Tipo_Falla,
            fallas.Id_Tipo_Inspeccion,
            fallas.Falla,
            fallas.Estatus,
            fallas.Creado_Por,
            fallas.Fecha_Creacion,
            fallas.Modificado_Por,
            fallas.Fecha_Mod,
            tinsp.Tipo_Inspeccion AS tipoInspeccion
        ')
        ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = fallas.Id_Tipo_Inspeccion', 'left')
        ->where(['fallas.Estatus' => 'Activo', 'fallas.Id_Tipo_Inspeccion' => $idTipoInspeccion])
        ->orderBy('fallas.Fecha_Creacion', 'ASC')->findAll();
    }
}