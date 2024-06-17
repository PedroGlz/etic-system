<?php namespace App\Models;

use CodeIgniter\Model;

class CausaPrincipalMdl extends Model
{

    protected $table = 'causa_principal';
    protected $primaryKey = 'Id_Causa_Raiz';
    protected $allowedFields = [
        'Id_Causa_Raiz',
        'Id_Tipo_Inspeccion',
        'Id_Falla',
        'Causa_Raiz',
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
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Causa_Raiz' => $id])->first();	
    }

    public function obtenerRegistros(){
        return $this->table('causa_principal')->select('
            Id_Causa_Raiz,
            Id_Tipo_Inspeccion,
            Id_Falla,
            Causa_Raiz,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = causa_principal.Id_Tipo_Inspeccion) AS nombreTipoInspeccion,
            (SELECT Falla FROM fallas WHERE fallas.Id_Falla = causa_principal.Id_Falla) AS nombreFalla
        ')->findAll();
    }
}