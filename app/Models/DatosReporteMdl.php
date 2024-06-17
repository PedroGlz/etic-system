<?php

namespace App\Models;

use CodeIgniter\Model;

class DatosReporteMdl extends Model
{
    protected $table            = 'datos_reporte';
    protected $primaryKey       = 'Id_Datos_Reporte';
    protected $allowedFields    = [
        'Id_Datos_Reporte',
        'Id_Inspeccion',
        'detalle_ubicacion',
        'nombre_contacto',
        'puesto_contacto',
        'fecha_inicio_ra',
        'fecha_fin_ra',
        'nombre_img_portada',
        'descripcion_reporte',
        'areas_inspeccionadas',
        'recomendacion_reporte',
        'imagen_recomendacion',
        'imagen_recomendacion_2',
        'referencia_reporte',
        'arrayElementosSeleccionados',
        'arrayProblemasSeleccionados',
        'Id_Sitio' //flag_export
    ];

    public function get(){

        return $this->table('datos_reporte')->select('
            MAX(Id_Datos_Reporte) AS ultimo_registro
        ')->findAll();
    }

    public function get_registros($id = null){
        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Inspeccion' => $id])->first();
    }
}
