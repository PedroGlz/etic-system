<?php namespace App\Models;

use CodeIgniter\Model;

class FotosProblemasMdl extends Model
{

    protected $table = 'fotos_problemas';
    protected $primaryKey = 'Id_Foto_Problema';
    protected $allowedFields = [
        'Id_Foto_Problema',
        'Id_Inspeccion',
        'Id_Inspeccion_Det',
        'Nombre_Foto',
        'Fecha_Creacion_Foto',
        'Hora_Creacion_Foto'
    ];

    public function get($nombreImg, $Id_Inspeccion){

        return $this->asArray()->where(['Nombre_Foto' => $nombreImg, 'Id_Inspeccion' => $Id_Inspeccion])->first();	
    }

}