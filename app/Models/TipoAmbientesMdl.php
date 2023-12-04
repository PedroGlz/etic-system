<?php namespace App\Models;

use CodeIgniter\Model;

class TipoAmbientesMdl extends Model{
    
    protected $table = 'tipo_ambientes';
    protected $primaryKey = 'Id_Tipo_Ambiente';
    protected $allowedFields = [
        'Id_Tipo_Ambiente',
        'Nombre',
        'Descripcion',
        'Adjust',
        'Estatus',
        'Id_Inspeccion' //flag_export
    ];
    
    public function get($id = null){
        
        if($id === null){
            return $this->where(['Estatus' => 'Activo'])->findAll();
        }

        return $this->asArray()->where(['Estatus' => 'Activo','Id_Tipo_Ambiente' => $id])->findAll();	
    }
}