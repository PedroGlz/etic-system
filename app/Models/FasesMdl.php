<?php namespace App\Models;

use CodeIgniter\Model;

class FasesMdl extends Model{
    
    protected $table = 'fases';
    protected $primaryKey = 'Id_Fase';
    protected $allowedFields = [
        'Id_Fase',
        'Nombre_Fase',
        'Descripcion',
        'Fecha_Creacion',
        'Creado_Por',
        'Fecha_Mod',
        'Modificado_Por',
        'Id_Inspeccion' //flag_export
    ];
}