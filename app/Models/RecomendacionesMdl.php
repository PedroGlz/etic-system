<?php namespace App\Models;

use CodeIgniter\Model;

class RecomendacionesMdl extends Model
{

    protected $table = 'recomendaciones';
    protected $primaryKey = 'Id_Recomendacion';
    protected $allowedFields = [
        'Id_Recomendacion',
        'Id_Tipo_Inspeccion',
        'Id_Causa_Raiz',
        'Recomendacion',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion',
        'Id_Sitio',
    ];

    public function get($id = null)
    {
        if($id === null){
            return $this->table('recomendaciones')->select('
                recomendaciones.Id_Recomendacion,
                recomendaciones.Id_Tipo_Inspeccion,
                recomendaciones.Id_Causa_Raiz,
                recomendaciones.Recomendacion,
                recomendaciones.Estatus,
                recomendaciones.Creado_Por,
                recomendaciones.Fecha_Creacion,
                recomendaciones.Modificado_Por,
                recomendaciones.Fecha_Mod,
                recomendaciones.Id_Inspeccion,
                recomendaciones.Id_Sitio,
                tinsp.Tipo_Inspeccion AS tipoInspeccion,
                cp.causa_raiz
            ')
            ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = recomendaciones.Id_Tipo_Inspeccion', 'left')
            ->join('causa_principal cp', 'cp.Id_Causa_Raiz = recomendaciones.Id_Causa_Raiz', 'left')
            ->where(['recomendaciones.Estatus' => 'Activo'])
            ->orderBY('recomendaciones.Fecha_Creacion DESC')->findAll();
        }

        return $this->table('recomendaciones')->select('
            recomendaciones.Id_Recomendacion,
            recomendaciones.Id_Tipo_Inspeccion,
            recomendaciones.Id_Causa_Raiz,
            recomendaciones.Recomendacion,
            recomendaciones.Estatus,
            recomendaciones.Creado_Por,
            recomendaciones.Fecha_Creacion,
            recomendaciones.Modificado_Por,
            recomendaciones.Fecha_Mod,
            recomendaciones.Id_Inspeccion,
            recomendaciones.Id_Sitio,
            tinsp.Tipo_Inspeccion AS tipoInspeccion,
            cp.causa_raiz
        ')
        ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = recomendaciones.Id_Tipo_Inspeccion', 'left')
        ->join('causa_principal cp', 'cp.Id_Causa_Raiz = recomendaciones.Id_Causa_Raiz', 'left')
        ->where(['recomendaciones.Id_Recomendacion' => $id, 'recomendaciones.Estatus' => 'Activo'])
        ->orderBY('recomendaciones.Fecha_Creacion DESC')->first();	
    }

}