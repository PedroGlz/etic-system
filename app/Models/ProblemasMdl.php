<?php namespace App\Models;

use CodeIgniter\Model;

class ProblemasMdl extends Model{
    protected $table = 'problemas';
    protected $primaryKey = 'Id_Problema';
    protected $allowedFields = [
        'Id_Problema',
        'Id_Tipo_Inspeccion',
        'Numero_Problema',
        'Id_Sitio',
        'Id_Inspeccion',
        'Id_Inspeccion_Det',
        'Id_Ubicacion',
        'Problem_Temperature',
        'Reference_Temperature',
        'Problem_Phase',
        'Reference_Phase',
        'Problem_Rms',
        'Reference_Rms',
        'Additional_Info',
        'Additional_Rms',
        'Emissivity_Check',
        'Emissivity',
        'Indirect_Temp_Check',
        'Temp_Ambient_Check',
        'Temp_Ambient',
        'Environment_Check',
        'Environment',
        'Ir_File',
        'Photo_File',
        'Wind_Speed_Check',
        'Wind_Speed',
        'Id_Fabricante',
        'Rated_Load_Check',
        'Rated_Load',
        'Circuit_Voltage_Check',
        'Circuit_Voltage',
        'Id_Falla',
        'Component_Comment',
        'Estatus_Problema',
        'Aumento_Temperatura',
        'Id_Severidad',
        'Estatus',
        'Ruta',
        'hazard_Type',
        'hazard_Classification',
        'hazard_Group',
        'hazard_Issue',
        'Rpm',
        'Bearing_Type',
        'Es_Cronico',
        'Cerrado_En_Inspeccion',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod'
    ];

    public function getNumero_Problema($Id_Inspeccion,$Id_Tipo_Inspeccion){
        return $this->table('problemas')->select('
            Id_Problema,
            Id_Tipo_Inspeccion,
            Numero_Problema,
            Id_Sitio,
            Id_Inspeccion,
            Id_Inspeccion_Det,
            Id_Ubicacion,
            Emissivity,
            Temp_Ambient,
            Environment,
            Wind_Speed,
            Rated_Load,
            Circuit_Voltage,
            Indirect_Temp_Check,
            Emissivity_Check,
            Temp_Ambient_Check,
            Environment_Check,
            Wind_Speed_Check,
            Rated_Load_Check,
            Circuit_Voltage_Check,
        ')->where(['Id_Inspeccion' => $Id_Inspeccion,'Id_Tipo_Inspeccion' => $Id_Tipo_Inspeccion,'Estatus' => 'Activo'])->orderBy('Numero_Problema', 'DESC')->first();
    }
    
    public function validarProblemaCronico($idUbicacion, $problem, $idProblema){
        if($idProblema == 0){
            return $this->select('Id_Problema')->where(['Id_Ubicacion' => $idUbicacion,'Problem_Phase' => $problem,'Estatus' => 'Activo'])->countAllResults();
        }
        return  $this->select('Id_Problema')->where(['Id_Ubicacion' => $idUbicacion,'Problem_Phase' => $problem,'Id_Problema !=' => $idProblema,'Estatus' => 'Activo'])->countAllResults();
    }
    
    public function getProblemas_Sitio($condicion, $orden = 'Id_Problema ASC', $array = null){
        $condicion['Estatus'] = 'Activo';

        $cronicosCerradosHistorial = $this->table('problemas')->select('Id_Problema')
        ->where([
            'Es_Cronico' => 'SI',
            'Estatus_Problema' => 'Cerrado',
            'Estatus' => 'Activo',
        ]);

        $arridds = [];
        foreach ($cronicosCerradosHistorial->findAll() as $row) {
            array_push($arridds,$row['Id_Problema']);
        }

        return $this->table('problemas')->select('
            Id_Problema,    
            Id_Tipo_Inspeccion,
            Numero_Problema,
            Id_Sitio,
            Id_Inspeccion,
            Id_Inspeccion_Det,
            Id_Ubicacion,
            Problem_Temperature,
            Reference_Temperature,
            Problem_Phase,
            Reference_Phase,
            Problem_Rms,
            Reference_Rms,
            Additional_Info,
            Additional_Rms,
            Emissivity_Check,
            Emissivity,
            Indirect_Temp_Check,
            Temp_Ambient_Check,
            Temp_Ambient,
            Environment_Check,
            Environment,
            Ir_File,
            Photo_File,
            Wind_Speed_Check,
            Wind_Speed,
            Id_Fabricante,
            Rated_Load_Check,
            Rated_Load,
            Circuit_Voltage_Check,
            Circuit_Voltage,
            Id_Falla,
            Component_Comment,
            Estatus_Problema,
            Aumento_Temperatura,
            Id_Severidad,
            Estatus,
            Ruta,
            hazard_Type,
            hazard_Classification,
            hazard_Group,
            hazard_Issue,
            Rpm,
            Bearing_Type,
            Es_Cronico,
            Cerrado_En_Inspeccion,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            DATE_FORMAT(Fecha_Creacion,"%d/%m/%Y") AS fecha_key_grafica,
            DATE_FORMAT(Fecha_Creacion,"%d/%m/%Y") AS Fecha_Creacion_formateada,
            (SELECT Sitio FROM sitios WHERE sitios.Id_Sitio = problemas.Id_Sitio) AS nombre_sitio,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Type) AS hazardType,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Classification) AS hazardClassification,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Group) AS hazardGroup,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Issue) AS hazardIssue,
            (SELECT Codigo_Barras FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = problemas.ID_Ubicacion) AS codigoBarras,
            (SELECT Ubicacion FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = problemas.Id_Ubicacion) AS nombreEquipo,            
            (SELECT Desc_Prioridad FROM tipo_prioridades WHERE tipo_prioridades.Id_Tipo_Prioridad = (SELECT Id_Tipo_Prioridad FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = problemas.ID_Ubicacion)) AS tipoPrioridad,
            (SELECT Severidad FROM severidades WHERE severidades.Id_Severidad = problemas.Id_Severidad) AS severidad,
            (SELECT Severidad FROM severidades WHERE severidades.Id_Severidad = problemas.Id_Severidad) AS StrSeveridad,
            (SELECt Fabricante FROM fabricantes WHERE fabricantes.Id_Fabricante = problemas.Id_Fabricante) AS fabricante,            
            (SELECt Nombre_Fase FROM fases WHERE fases.Id_Fase = problemas.Problem_Phase) AS faseProblema,
            (SELECt Nombre_Fase FROM fases WHERE fases.Id_Fase = problemas.Reference_Phase) AS faseReferencia,
            (SELECt Nombre_Fase FROM fases WHERE fases.Id_Fase = problemas.Additional_Info) AS faseAdicional,
            (SELECT Nombre FROM tipo_ambientes WHERE tipo_ambientes.Id_Tipo_Ambiente = problemas.Environment) AS tipoAmbiente,
            (SELECT No_Inspeccion FROM inspecciones WHERE inspecciones.Id_Inspeccion = problemas.Id_Inspeccion) AS numInspeccion,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion) AS tipoInspeccion
        ')
        // ->join('sitios', 'sitios.Id_Sitio = problemas.Id_Sitio', 'left')
        // ->join('FALLAS fht', 'fht.Id_Falla = problemas.hazard_Type', 'left')
        // ->join('FALLAS fhc', 'fhc.Id_Falla = problemas.hazard_Classification', 'left')
        // ->join('FALLAS fhg', 'fhg.Id_Falla = problemas.hazard_Group', 'left')
        // ->join('FALLAS fhi', 'fhi.Id_Falla = problemas.hazard_Issue', 'left')
        // ->join('ubicaciones ubi', 'ubi.Id_Ubicacion = problemas.Id_Ubicacion', 'left')
        // ->join('tipo_prioridades tp', 'ubi.Id_Tipo_Prioridad = tp.Id_Tipo_Prioridad', 'left')
        // ->join('severidades sev', 'sev.Id_Severidad = problemas.Id_Severidad', 'left')
        // ->join('fabricantes fab', 'fab.Id_Fabricante = problemas.Id_Fabricante', 'left')
        // ->join('fases fpp', 'fpp.Id_Fase = problemas.Problem_Phase', 'left')
        // ->join('fases fprf', 'fprf.Id_Fase = problemas.Reference_Phase', 'left')
        // ->join('fases fai', 'fai.Id_Fase = problemas.Additional_Info', 'left')        
        // ->join('tipo_ambientes ta', 'ta.Id_Tipo_Ambiente = problemas.Environment', 'left')
        // ->join('inspecciones insp', 'insp.Id_Inspeccion = problemas.Id_Inspeccion', 'left')
        // ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion', 'left')
        ->where($condicion)
        ->whereIn('Id_Problema', $array)
        ->whereNotIn('Id_Problema', $arridds)
        ->orderBy($orden)->findAll();
    }

    public function getProblemas_Sitio_Reporte($Id_Sitio,$Id_Inspeccion){
        return $this->table('problemas')->select('
            Id_Ubicacion,
            GROUP_CONCAT(
                CASE
                    WHEN Id_Tipo_Inspeccion = "0D32B331-76C3-11D3-82BF-00104BC75DC2" THEN CONCAT("E ",Numero_Problema)
                    WHEN Id_Tipo_Inspeccion = "0D32B332-76C3-11D3-82BF-00104BC75DC2" THEN CONCAT("E ",Numero_Problema)
                    WHEN Id_Tipo_Inspeccion = "0D32B333-76C3-11D3-82BF-00104BC75DC2" THEN CONCAT("V ",Numero_Problema)
                    ELSE CONCAT("M ",Numero_Problema)
                END
            ) AS Problemas
        ')->where(['Id_Sitio' => $Id_Sitio,'Id_Inspeccion' => $Id_Inspeccion,'Estatus' => 'Activo'])
        ->groupBy('Id_Ubicacion')->findAll();
    }

    public function getReporteListaProblemas($Id_Sitio,$estatus,$Id_Inspeccion){
        $condicion = ['Id_Sitio' => $Id_Sitio, "Estatus_Problema"=> $estatus,'Estatus' => 'Activo'];

        if($estatus == "Cerrado"){
            $condicion['Cerrado_En_Inspeccion'] = $Id_Inspeccion;
        }

        return $this->table('problemas')->select('
            Id_Problema,    
            Id_Tipo_Inspeccion,
            Numero_Problema,
            Id_Sitio,
            Id_Inspeccion,
            Id_Inspeccion_Det,
            Id_Ubicacion,
            Problem_Temperature,
            Reference_Temperature,
            Problem_Phase,
            Reference_Phase,
            Problem_Rms,
            Reference_Rms,
            Additional_Info,
            Additional_Rms,
            Emissivity_Check,
            Emissivity,
            Indirect_Temp_Check,
            Temp_Ambient_Check,
            Temp_Ambient,
            Environment_Check,
            Environment,
            Ir_File,
            Photo_File,
            Wind_Speed_Check,
            Wind_Speed,
            Id_Fabricante,
            Rated_Load_Check,
            Rated_Load,
            Circuit_Voltage_Check,
            Circuit_Voltage,
            Id_Falla,
            Component_Comment,
            Estatus_Problema,
            Aumento_Temperatura,
            Id_Severidad,
            Estatus,
            Ruta,
            hazard_Type,
            hazard_Classification,
            hazard_Group,
            hazard_Issue,
            Rpm,
            Bearing_Type,
            Es_Cronico,
            Cerrado_En_Inspeccion,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion) AS tipoInspeccion,
            (SELECT No_Inspeccion FROM inspecciones WHERE inspecciones.Id_Inspeccion = problemas.Id_Inspeccion) AS numInspeccion,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion) AS tipoInspeccion,
            (SELECT Severidad FROM severidades WHERE severidades.Id_Severidad = problemas.Id_Severidad) AS StrSeveridad
        ')
        ->where($condicion)
        // ->groupBy('Id_Inspeccion')
        ->orderBy("Id_Inspeccion DESC , Id_Tipo_Inspeccion ASC, Numero_Problema ASC")->findAll();
    }

    public function getProblemas_SitioGrafica($condicion){
        return $this->table('problemas')->select('
            Id_Problema,    
            Id_Tipo_Inspeccion,
            Numero_Problema,
            Id_Sitio,
            Id_Inspeccion,
            Id_Inspeccion_Det,
            Id_Ubicacion,
            Problem_Temperature,
            Reference_Temperature,
            Problem_Phase,
            Reference_Phase,
            Problem_Rms,
            Reference_Rms,
            Additional_Info,
            Additional_Rms,
            Emissivity_Check,
            Emissivity,
            Indirect_Temp_Check,
            Temp_Ambient_Check,
            Temp_Ambient,
            Environment_Check,
            Environment,
            Ir_File,
            Photo_File,
            Wind_Speed_Check,
            Wind_Speed,
            Id_Fabricante,
            Rated_Load_Check,
            Rated_Load,
            Circuit_Voltage_Check,
            Circuit_Voltage,
            Id_Falla,
            Component_Comment,
            Estatus_Problema,
            Aumento_Temperatura,
            Id_Severidad,
            Estatus,
            Ruta,
            hazard_Type,
            hazard_Classification,
            hazard_Group,
            hazard_Issue,
            Rpm,
            Bearing_Type,
            Es_Cronico,
            Cerrado_En_Inspeccion,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Type) AS hazardType,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Classification) AS hazardClassification,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Group) AS hazardGroup,
            (SELECT Falla FROM FALLAS WHERE FALLAS.Id_Falla = problemas.hazard_Issue) AS hazardIssue,
            (SELECT Codigo_Barras FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = problemas.ID_Ubicacion) AS codigoBarras,
            (SELECT Desc_Prioridad FROM tipo_prioridades WHERE tipo_prioridades.Id_Tipo_Prioridad = (SELECT Id_Tipo_Prioridad FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = problemas.ID_Ubicacion)) AS tipoPrioridad,
            (SELECT Severidad FROM severidades WHERE severidades.Id_Severidad = problemas.Id_Severidad) AS severidad,
            (SELECt Fabricante FROM fabricantes WHERE fabricantes.Id_Fabricante = problemas.Id_Fabricante) AS fabricante,
            (SELECt Nombre_Fase FROM fases WHERE fases.Id_Fase = problemas.Problem_Phase) AS faseProblema,
            (SELECt Nombre_Fase FROM fases WHERE fases.Id_Fase = problemas.Reference_Phase) AS faseReferencia,
            (SELECt Nombre_Fase FROM fases WHERE fases.Id_Fase = problemas.Additional_Info) AS faseAdicional,
            (SELECT Nombre FROM tipo_ambientes WHERE tipo_ambientes.Id_Tipo_Ambiente = problemas.Environment) AS tipoAmbiente,
            (SELECT No_Inspeccion FROM inspecciones WHERE inspecciones.Id_Inspeccion = problemas.Id_Inspeccion) AS numInspeccion,
            (SELECT Tipo_Inspeccion FROM tipo_inspecciones WHERE tipo_inspecciones.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion) AS tipoInspeccion,
            (SELECT Ubicacion FROM ubicaciones WHERE ubicaciones.Id_Ubicacion = problemas.Id_Ubicacion) AS nombreEquipo,
            (SELECT Severidad FROM severidades WHERE severidades.Id_Severidad = problemas.Id_Severidad) AS StrSeveridad
        ')
        ->where('Estatus','Activo')
        ->where($condicion)->findAll();
    }

    public function get($id = null){
        if($id === null){
            return $this->findAll();
        }

        return $this->asArray()->where(['Id_Problema' => $id])->first();
    }

    public function obtenerUbicacionesCronicos(){
        return $this->table('problemas')->select('Id_Ubicacion')
        ->where([
            'Es_Cronico' => 'SI',
            'Estatus_Problema' => 'Abierto',
            'Estatus' => 'Activo',
        ])
        ->groupBy("Id_Ubicacion")
        ->findAll();
    }

    public function obtenerProblemasCronicos($Id_Ubicacion, $id_tipo_problema){
        return $this->table('problemas')->select('
            problemas.id_problema, 
            problemas.Numero_Problema,
            (SELECT i.no_inspeccion FROM inspecciones AS i WHERE i.id_inspeccion = problemas.id_inspeccion) AS numeroInspeccion
        ')
        ->where([
            'problemas.Id_Ubicacion' => $Id_Ubicacion,
            'Id_Tipo_Inspeccion' => $id_tipo_problema,
            'problemas.Es_Cronico' => 'SI',
            'problemas.Estatus_Problema' => 'Abierto',
            'problemas.Estatus' => 'Activo',
        ])
        ->orderBy('numeroInspeccion DESC')->findAll();
    }

    public function getHistorialProblema($Id_Ubicacion, $id_tipo_problema){
        return $this->table('problemas')->select('
            Problem_Temperature,
            Reference_Temperature,
            DATE_FORMAT(Fecha_Creacion,"%d/%m/%Y") AS fecha_problema_historico,
            Numero_Problema,
            (SELECT i.no_inspeccion FROM inspecciones AS i WHERE i.id_inspeccion = problemas.id_inspeccion) AS numInspeccion,
            Fecha_Creacion,
            (SELECT s.Severidad FROM severidades AS s WHERE s.Id_Severidad = problemas.Id_Severidad) AS StrSeveridad,
            Component_Comment AS notas
        ')
        ->where([
            'problemas.Id_Ubicacion' => $Id_Ubicacion,
            'Id_Tipo_Inspeccion' => $id_tipo_problema,
            'problemas.Es_Cronico' => 'SI',
            'problemas.Estatus' => 'Activo',
        ])
        ->orderBy('numInspeccion DESC')->findAll();
    }
}