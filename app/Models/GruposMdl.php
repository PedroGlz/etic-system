<?php namespace App\Models;

use CodeIgniter\Model;

class GruposMdl extends Model
{

    protected $table = 'grupos';
    protected $primaryKey = 'Id_Grupo';
    protected $allowedFields = [
        'Id_Grupo',
        'Grupo',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion' //flag_export
    ];

    public function get($id = null)
    {
        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Grupo' => $id])->first();	
    }

}