<?php

namespace App\Models;

use CodeIgniter\Model;

class InspeccionesMdl extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'inspecciones';
    protected $primaryKey       = 'Id_Inspeccion';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Id_Inspeccion',
        'Id_Sitio',
        'Id_Cliente',
        'Id_Grupo_Sitios',
        'Id_Status_Inspeccion',
        'Fecha_Inicio',
        'Fecha_Fin',
        'Fotos_Ruta',
        'IR_Imagen_Inicial',
        'DIG_Imagen_Inicial',
        'No_Dias',
        'Unidad_Temp',
        'No_Inspeccion',
        'No_Inspeccion_Ant',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod' 
    ];

    public function obtenerRegistros($Id_Inspeccion = null){
        $condicion = ['Estatus' => 'Activo'];

        if($Id_Inspeccion != null){
            $condicion = ['Id_Inspeccion' => $Id_Inspeccion,'Estatus' => 'Activo'];
        }
        
        return $this->table('inspecciones')->select('
            Id_Inspeccion,
            Id_Sitio,
            Id_Cliente,
            Id_Grupo_Sitios,
            Id_Status_Inspeccion,
            Fecha_Inicio,
            Fecha_Fin,
            Fotos_Ruta,
            IR_Imagen_Inicial,
            DIG_Imagen_Inicial,
            No_Dias,
            Unidad_Temp,
            No_Inspeccion,
            No_Inspeccion_Ant,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (DATE_FORMAT(Fecha_Inicio,"%d/%m/%Y")) AS fechaInspeccionActual,
            (SELECT DATE_FORMAT(Fecha_Inicio,"%d/%m/%Y") FROM inspecciones AS insp2 WHERE insp2.No_Inspeccion = inspecciones.No_Inspeccion_Ant) AS fechaInspeccionAnterior,
            (SELECT DATE_FORMAT(Fecha_Inicio,"%d-%m-%Y") FROM inspecciones AS insp2 WHERE insp2.No_Inspeccion = inspecciones.No_Inspeccion_Ant) AS fechaInspeccionAnterior_reporte_resultado_analisis,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = inspecciones.Id_Cliente) AS nombreCliente,
            (SELECT Imagen_Cliente FROM clientes WHERE clientes.Id_Cliente = inspecciones.Id_Cliente) AS imagen_cliente,
            (SELECT Sitio FROM sitios WHERE sitios.Id_Sitio = inspecciones.Id_Sitio) AS nombreSitio,
            (SELECT Grupo FROM grupos_sitios WHERE grupos_sitios.Id_Grupo_Sitios = inspecciones.Id_Grupo_Sitios) AS nombreGrupoSitio,
            (SELECT Status_Inspeccion FROM estatus_inspeccion WHERE estatus_inspeccion.Id_Status_Inspeccion = inspecciones.Id_Status_Inspeccion) AS nombreEstatusInspeccion
        ')->where($condicion)->findAll();
    }

    public function get($id = null){
        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Inspeccion' => $id])->first();
    }

    public function datos_inspeccion_restaurar(){
        // $condicion= "No_Inspeccion = (SELECT MAX(itemp.No_Inspeccion) FROM inspecciones AS itemp) AND Id_Status_Inspeccion ='73F27003-76B3-11D3-82BF-00104BC75DC2'";
        $condicion= "No_Inspeccion = (SELECT MAX(itemp.No_Inspeccion) FROM inspecciones AS itemp)";

        return $this->table('inspecciones')->select('
            Id_Inspeccion,
            Id_Sitio,
            Id_Cliente,
            Id_Grupo_Sitios,
            Id_Status_Inspeccion,
            No_Inspeccion,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = inspecciones.Id_Cliente) AS nombreCliente,
            (SELECT Sitio FROM sitios WHERE sitios.Id_Sitio = inspecciones.Id_Sitio) AS nombreSitio,
            (SELECT Grupo FROM grupos_sitios WHERE grupos_sitios.Id_Grupo_Sitios = inspecciones.Id_Grupo_Sitios) AS nombreGrupoSitio
        ')->where($condicion)->findAll();
    }
}
