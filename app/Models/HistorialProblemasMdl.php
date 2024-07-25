<?php namespace App\Models;

use CodeIgniter\Model;

class HistorialProblemasMdl extends Model{
    protected $table = 'historial_problemas';
    protected $primaryKey = 'Id_Historial_Problema';
    protected $allowedFields = [
        'Id_Historial_Problema',
        'Id_Problema',
        'Id_Problema_Anterior',
        'Id_Problema_Original',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion', //flag_export
        'Id_Sitio' //flag_export
    ];

    public function getproblemaOrigian($idProblemaAnterior){
        return $this->table('problemas')->select('
            Id_Problema_Original,
        ')->where(['Id_Problema' => $idProblemaAnterior,'Estatus' => 'Activo'])->findAll();
    }

    // public function getHistorialProblema($id){
    //     $idProblemaOriginal = $this->table('historial_problemas')->select('
    //         Id_Problema_Original
    //     ')->where(['Id_Problema' => $id])->findAll();

    //     $idProblemaOriginal = count($idProblemaOriginal) > 0 ? $idProblemaOriginal[0]['Id_Problema_Original'] : "";
        
    //     return $this->table('historial_problemas')->select('
    //         Id_Problema_Anterior,
    //         Id_Problema_Original,
    //         Estatus,
    //         Creado_Por,
    //         Fecha_Creacion,
    //         Modificado_Por,
    //         Fecha_Mod,
    //         (SELECT DATE_FORMAT(Fecha_Creacion,"%d/%m/%Y") FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior) AS fecha_problema_historico,
    //         (SELECT DATE_FORMAT(Fecha_Inicio,"%d/%m/%Y") FROM inspecciones WHERE Id_Inspeccion = (SELECT Id_Inspeccion FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior)) AS fechaInspeccion,
    //         (SELECT Problem_Temperature FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior) AS Problem_Temperature,
    //         (SELECT Reference_Temperature FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior) AS Reference_Temperature,
    //         (SELECT Numero_Problema FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior) AS Numero_Problema,
    //         (SELECT No_Inspeccion FROM inspecciones WHERE Id_Inspeccion = (SELECT Id_Inspeccion FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior)) AS numInspeccion,
    //         (SELECT Fecha_Creacion FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior) AS Fecha_Creacion,
    //         (SELECT Severidad FROM severidades WHERE Id_Severidad = (SELECT Id_Severidad FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior)) AS StrSeveridad,
    //         (SELECT Component_Comment FROM problemas WHERE problemas.Id_Problema = historial_problemas.Id_Problema_Anterior) AS notas
    //     ')->where(['Id_Problema_Original' => $idProblemaOriginal,'Estatus' => 'Activo'])->findAll();
    // }

}