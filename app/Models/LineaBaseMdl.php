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

    public function getHistorialBaseLine($Id_Ubicacion, $Id_Inspeccion){
        // return $Id_Ubicacion;
        $condicion = ['Id_Inspeccion' => $Id_Inspeccion,'Estatus' => 'Activo'];
        // $orden = 'MTA ASC';
        $orden = 'numInspeccion ASC';

        if($Id_Ubicacion != ""){
            $condicion = ['Id_Ubicacion' => $Id_Ubicacion,'Estatus' => 'Activo'];
            $orden = 'numInspeccion ASC';
        }

        return $this->table('linea_base')->select('
            Id_Linea_Base,
            Id_Ubicacion,
            Id_Inspeccion,
            Estatus,
            DATE_FORMAT(Fecha_Creacion,"%d/%m/%Y") as Fecha_Creacion,
            MTA,
            Temp_max,
            Temp_amb,
            Archivo_IR,
            Archivo_ID,
            Notas,
            Ruta,
            Fecha_Creacion AS Fecha_Creacion_sinFormato,
            (SELECT DATE_FORMAT(ins.Fecha_Inicio,"%d/%m/%Y") FROM inspecciones AS ins WHERE ins.Id_Inspeccion = linea_base.Id_Inspeccion) AS fechaInspeccion,
            (SELECT Estatus_Inspeccion_Det FROM estatus_inspeccion_det WHERE estatus_inspeccion_det.Id_Status_Inspeccion_Det = 
                (SELECT Id_Status_Inspeccion_Det FROM inspecciones_det
                WHERE inspecciones_det.Id_Ubicacion = linea_base.Id_Ubicacion AND inspecciones_det.Id_Inspeccion = linea_base.Id_Inspeccion)
            ) AS estatusInspeccion,
            (SELECT Codigo_Barras FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = linea_base.Id_Ubicacion) AS codigoBarras,
            (SELECT Fabricante FROM fabricantes WHERE fabricantes.Id_Fabricante = 
                (SELECT Id_Fabricante FROM v_ubicaciones_tree WHERE v_ubicaciones_tree.id = linea_base.Id_Ubicacion GROUP BY id)
            ) AS fabricante,
	        (SELECT Tipo_Prioridad FROM tipo_prioridades WHERE tipo_prioridades.Id_Tipo_Prioridad = (
		        SELECT Id_Tipo_Prioridad FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = linea_base.Id_Ubicacion)
            ) AS tipoPrioridad,
            (SELECT path FROM v_ubicaciones_tree WHERE v_ubicaciones_tree.id = linea_base.Id_Ubicacion GROUP BY id) AS path,
            (SELECT No_Inspeccion FROM inspecciones WHERE inspecciones.Id_Inspeccion = linea_base.Id_Inspeccion) AS numInspeccion,
            (SELECT Ubicacion FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = linea_base.Id_Ubicacion) AS equipo
        ')->where($condicion)
        ->orderBy($orden)->findAll();
    }
}
