<?php

namespace App\Models;

use CodeIgniter\Model;

class LineaBaseMdl extends Model
{
    protected $table            = 'linea_base';
    protected $primaryKey       = 'Id_Linea_Base';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'Id_Linea_Base',
        'Id_Sitio', //flag_export
        'Id_Ubicacion',
        'Id_Inspeccion',
        'Id_Inspeccion_Det',
        'MTA',
        'Temp_max',
        'Temp_amb',
        'Notas',
        'Archivo_IR',
        'Archivo_ID',
        'Ruta',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod'
    ];

    public function get($id = null){

        if($id === null){
            return $this->where(['Estatus' => 'Activo'])->findAll();
        }

        return $this->asArray()->where(['Id_Linea_Base' => $id,'Estatus' => 'Activo'])->first();	
    }

    public function getHistorialBaseLine($Id_Inspeccion){
        $condicion = ['linea_base.Id_Inspeccion' => $Id_Inspeccion,'linea_base.Estatus' => 'Activo'];
        $orden = 'numInspeccion ASC';

        return $this->table('linea_base')->select('
            linea_base.Id_Linea_Base,
            linea_base.Id_Ubicacion,
            linea_base.Id_Inspeccion,
            linea_base.Id_Inspeccion_Det,
            linea_base.Estatus,
            DATE_FORMAT(linea_base.Fecha_Creacion,"%d/%m/%Y") as Fecha_Creacion,
            linea_base.MTA,
            linea_base.Temp_max,
            linea_base.Temp_amb,
            linea_base.Archivo_IR,
            linea_base.Archivo_ID,
            linea_base.Notas,
            linea_base.Ruta,
            linea_base.Fecha_Creacion AS Fecha_Creacion_sinFormato,
            insp.No_Inspeccion AS numInspeccion,
            ubi.Ubicacion AS equipo
        ')
        ->join('inspecciones insp', 'insp.Id_Inspeccion = linea_base.Id_Inspeccion', 'left')
        ->join('ubicaciones ubi', 'ubi.Id_Ubicacion = linea_base.Id_Ubicacion', 'left')
        ->where($condicion)
        ->orderBy($orden)->findAll();
    }

    public function getBaselineUbicacion($Id_Ubicacion, $Id_Inspeccion){
        $condicion = ['linea_base.Id_Inspeccion' => $Id_Inspeccion,'linea_base.Id_Inspeccion_Det' => $Id_Ubicacion,'linea_base.Estatus' => 'Activo'];

        return $this->table('linea_base')->select('
            linea_base.Id_Linea_Base,
            linea_base.Id_Ubicacion,
            linea_base.Id_Inspeccion,
            linea_base.Id_Inspeccion_Det,
            linea_base.Estatus,
            DATE_FORMAT(linea_base.Fecha_Creacion,"%d/%m/%Y") as Fecha_Creacion,
            linea_base.MTA,
            linea_base.Temp_max,
            linea_base.Temp_amb,
            linea_base.Archivo_IR,
            linea_base.Archivo_ID,
            linea_base.Notas,
            linea_base.Ruta,
            linea_base.Fecha_Creacion AS Fecha_Creacion_sinFormato,
            insp.No_Inspeccion AS numInspeccion
        ')
        ->join('inspecciones insp', 'insp.Id_Inspeccion = linea_base.Id_Inspeccion', 'left')
        ->where($condicion)
        ->findAll();
    }
}
