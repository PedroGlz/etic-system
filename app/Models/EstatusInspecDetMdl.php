<?php

namespace App\Models;

use CodeIgniter\Model;

class EstatusInspecDetMdl extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'estatus_inspeccion_det';
    protected $primaryKey       = 'Id_Status_Inspeccion_Det';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Id_Status_Inspeccion_Det',
        'Estatus_Inspeccion_Det',
        'Desc_Estatus_Det',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion' //flag_export
    ];

    public function obtenerLista(){
        return $this->asArray()->where(['Estatus' => 'Activo'])->findAll();
    }

    public function obtenerRegistro($id)
    {
        return $this->asArray()
        ->where([$primaryKey => $id])
        ->findAll();
    }
}
