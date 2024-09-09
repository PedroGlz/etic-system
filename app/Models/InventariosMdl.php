<?php

namespace App\Models;

use CodeIgniter\Model;

class InventariosMdl extends Model
{
    protected $table            = 'v_ubicaciones_arbol_2';
    //protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'Id_Inspeccion_Det',
        'id',
        'Id_Sitio',
        'nombreUbicacion',
        'text',
        'level',
        'Codigo_Barras',
        'Es_Equipo',
        'Estatus',
        'Id_Tipo_Prioridad',
        'Descripcion',
        'Id_Fabricante',
        'Id_Ubicacion_padre',
        'Id_Status_Inspeccion_Det',
        'Id_Inspeccion',
        'No_Inspeccion',
        'Fecha_inspeccion',
        'Notas_Inspeccion',
        'path',
        'Fecha_Creacion',
        'icon',
        'Estatus_Inspeccion_Det',
        'color',
        'expanded',
        'selected',
        'parent_id',
    ];


    public function obtenerLista($id_inspeccion)
    {
        return $this->asArray()
        ->where(['No_Inspeccion' => $id_inspeccion])->findAll();
    }

    public function obtenerNodosArbol($Id_Sitio,$id_inspeccion,$parentId){
        return $this->table('v_ubicaciones_arbol_2')->where([
            'Id_Sitio' => $Id_Sitio,
            'Id_Inspeccion' => $id_inspeccion,
            // 'parent_id' => $parentId,
            'Estatus' => 'Activo'
        ])->findAll();
    }

    public function consultaReporte($Id_Sitio,$id_inspeccion,$array){
        return $this->table('v_ubicaciones_arbol_2')->select('
            id AS Id_Ubicacion,
            level,
            Estatus_Inspeccion_Det AS Estatus,
            nombreUbicacion AS Elemento,
            Codigo_Barras,
            Notas_Inspeccion,
            Id_Inspeccion_Det,
            (SELECT Tipo_Prioridad FROM tipo_prioridades WHERE tipo_prioridades.Id_Tipo_Prioridad = v_ubicaciones_arbol_2.Id_Tipo_Prioridad) AS Prioridad
        ')
        // ->where(['Id_Sitio' => $Id_Sitio,'Id_Inspeccion' => $id_inspeccion])
        ->where(['Id_Sitio' => $Id_Sitio])
        ->whereIn('Id_Inspeccion_Det', $array)
        // ->orderBy('path ASC, Fecha_Creacion ASC')
        // ->orderBy('Fecha_Creacion', 'ASC')
        ->findAll();
    }

    public function conteo($Id_Sitio){
        return count($this->asArray()
        ->where(['Id_Sitio' => $Id_Sitio,'Estatus' => 'Activo'])->findAll());
    }

    public function getUbicacionPadre($id_inspeccion_det, $id_inspeccion){
        return $this->table('v_ubicaciones_arbol_2')->select('parent_id')->where(['Id_Inspeccion_Det' => $id_inspeccion_det,'Id_Inspeccion' => $id_inspeccion])->findAll();
    }

    public function cuantosHijosSinInspeccionar($id_padre, $id_inspeccion){
        return count($this->asArray()->where([
            "parent_id" => $id_padre,
            "Id_Status_Inspeccion_Det" => "568798D1-76BB-11D3-82BF-00104BC75DC2",
            "Id_Inspeccion" => $id_inspeccion
        ])->findAll());
    }

    // En este punto tomamos el campo id como para identificar la copia de la original y sacar su estatus
    public function getStatusPadre($id_padre, $id_inspeccion){
        return $this->table('v_ubicaciones_arbol_2')->select('Id_Status_Inspeccion_Det')->where(['id' => $id_padre,'Id_Inspeccion' => $id_inspeccion])->findAll();
    }

    public function getIdInspeccionDetPorIdPadre($id_padre, $id_inspeccion){
        return $this->table('v_ubicaciones_arbol_2')->select('Id_Inspeccion_Det, Id_Status_Inspeccion_Det')->where(['id' => $id_padre,'Id_Inspeccion' => $id_inspeccion])->findAll();
    }
}
