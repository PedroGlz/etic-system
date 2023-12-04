<?php

namespace App\Models;

use CodeIgniter\Model;

class UbicacionesMdl extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ubicaciones';
    protected $primaryKey       = 'Id_Ubicacion';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Id_Ubicacion',
        'Id_Sitio',
        'Id_Ubicacion_padre',
        'Id_Tipo_Prioridad',
        'Id_Tipo_Inspeccion',
        'Ubicacion',
        'Descripcion',
        'Es_Equipo',
        'Codigo_Barras',
        'Nivel_arbol',
        'LIMITE',
        'Fabricante',
        'Nombre_Foto',
        'Ruta',
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

        return $this->asArray()->where(['Id_Ubicacion' => $id])->first();	
    }

    public function ubicaciones($idSitio){
        return $this->select('Id_Sitio,Id_Ubicacion,Estatus')
        ->where(['Id_Sitio' => $idSitio,'Estatus' => 'Activo'])->findAll();
    }
}
