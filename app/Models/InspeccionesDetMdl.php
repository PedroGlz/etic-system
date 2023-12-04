<?php

namespace App\Models;

use CodeIgniter\Model;

class InspeccionesDetMdl extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'inspecciones_det';
    protected $primaryKey       = 'Id_Inspeccion_Det';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Id_Inspeccion_Det',
        'Id_Inspeccion',
        'Id_Ubicacion',
        'Id_Status_Inspeccion_Det',
        'Notas_Inspeccion',
        'Estatus',
        'Id_Estatus_Color_Text',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
    ];

    public function get($id = null){

        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Inspeccion_Det' => $id])->first();	
    }

    public function obtenerLista(){
        return $this->asArray()
        ->where(['Estatus'   => 'Activo'])  
        ->findAll();
    }

    public function getHistorialInspecciones($id){
        return $this->table('Inspecciones_det')->select('
            Id_Inspeccion_Det,
            Id_Inspeccion,
            Id_Ubicacion, 
            Id_Status_Inspeccion_Det,
            Notas_Inspeccion,
            Estatus,
            (SELECT No_Inspeccion FROM inspecciones WHERE inspecciones.Id_Inspeccion = Inspecciones_det.Id_Inspeccion) AS numInspeccion,
            (SELECT Fecha_Creacion FROM inspecciones WHERE inspecciones.Id_Inspeccion = Inspecciones_det.Id_Inspeccion) AS Fecha_Creacion,
            (SELECT Estatus_Inspeccion_Det FROM estatus_inspeccion_det WHERE estatus_inspeccion_det.Id_Status_Inspeccion_Det = Inspecciones_det.Id_Status_Inspeccion_Det) AS estatusUbicacion
        ')
        ->where(['Id_Ubicacion' => $id,'Estatus'=> 'Activo'])
        ->orderBy('Id_Inspeccion', 'DESC')
        ->findAll();
    }

    public function obtener_idInspeccionDet_actual($id_inspeccion, $id_ubicacion){
        return $this->table('Inspecciones_det')->select('
            Id_Inspeccion_Det
        ')
        ->where(['Id_Inspeccion' => $id_inspeccion, 'Id_Ubicacion'=> $id_ubicacion,'Estatus'=> 'Activo'])->first();
    }

}
