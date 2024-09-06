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
    
    public function getProblemas_Sitio($condicion, $orden = 'problemas.Id_Problema ASC', $array = null){
        $condicion['problemas.Estatus'] = 'Activo';

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
            problemas.Id_Problema,    
            problemas.Id_Tipo_Inspeccion,
            problemas.Numero_Problema,
            problemas.Id_Sitio,
            problemas.Id_Inspeccion,
            problemas.Id_Inspeccion_Det,
            problemas.Id_Ubicacion,
            problemas.Problem_Temperature,
            problemas.Reference_Temperature,
            problemas.Problem_Phase,
            problemas.Reference_Phase,
            problemas.Problem_Rms,
            problemas.Reference_Rms,
            problemas.Additional_Info,
            problemas.Additional_Rms,
            problemas.Emissivity_Check,
            problemas.Emissivity,
            problemas.Indirect_Temp_Check,
            problemas.Temp_Ambient_Check,
            problemas.Temp_Ambient,
            problemas.Environment_Check,
            problemas.Environment,
            problemas.Ir_File,
            problemas.Photo_File,
            problemas.Wind_Speed_Check,
            problemas.Wind_Speed,
            problemas.Id_Fabricante,
            problemas.Rated_Load_Check,
            problemas.Rated_Load,
            problemas.Circuit_Voltage_Check,
            problemas.Circuit_Voltage,
            problemas.Id_Falla,
            problemas.Component_Comment,
            problemas.Estatus_Problema,
            problemas.Aumento_Temperatura,
            problemas.Id_Severidad,
            problemas.Estatus,
            problemas.Ruta,
            problemas.hazard_Type,
            problemas.hazard_Classification,
            problemas.hazard_Group,
            problemas.hazard_Issue,
            problemas.Rpm,
            problemas.Bearing_Type,
            problemas.Es_Cronico,
            problemas.Cerrado_En_Inspeccion,
            problemas.Creado_Por,
            problemas.Fecha_Creacion,
            problemas.Modificado_Por,
            problemas.Fecha_Mod,
            DATE_FORMAT(problemas.Fecha_Creacion,"%d/%m/%Y") AS fecha_key_grafica,
            DATE_FORMAT(problemas.Fecha_Creacion,"%d/%m/%Y") AS Fecha_Creacion_formateada,
            
            sitios.Sitio AS nombre_sitio,
            fht.Falla AS hazardType,
            fhc.Falla AS hazardClassification,
            fhg.Falla AS hazardGroup,
            fhi.Falla AS hazardIssue,
            ubi.Codigo_Barras AS codigoBarras,
            ubi.Ubicacion AS nombreEquipo,
            tp.Desc_Prioridad AS tipoPrioridad,
            sev.Severidad AS severidad,
            sev.Severidad AS StrSeveridad,
            fab.Fabricante AS fabricante,
            fpp.Nombre_Fase AS faseProblema,
            fprf.Nombre_Fase AS faseReferencia,
            fai.Nombre_Fase AS faseAdicional,
            ta.Nombre AS tipoAmbiente,
            insp.No_Inspeccion AS numInspeccion,
            tinsp.Tipo_Inspeccion AS tipoInspeccion
        ')
        ->join('sitios', 'problemas.Id_Sitio = sitios.Id_Sitio', 'left')
        ->join('FALLAS fht', 'fht.Id_Falla = problemas.hazard_Type', 'left')
        ->join('FALLAS fhc', 'fhc.Id_Falla = problemas.hazard_Classification', 'left')
        ->join('FALLAS fhg', 'fhg.Id_Falla = problemas.hazard_Group', 'left')
        ->join('FALLAS fhi', 'fhi.Id_Falla = problemas.hazard_Issue', 'left')
        ->join('ubicaciones ubi', 'ubi.Id_Ubicacion = problemas.Id_Ubicacion', 'left')
        ->join('tipo_prioridades tp', 'ubi.Id_Tipo_Prioridad = tp.Id_Tipo_Prioridad', 'left')
        ->join('severidades sev', 'sev.Id_Severidad = problemas.Id_Severidad', 'left')
        ->join('fabricantes fab', 'fab.Id_Fabricante = problemas.Id_Fabricante', 'left')
        ->join('fases fpp', 'fpp.Id_Fase = problemas.Problem_Phase', 'left')
        ->join('fases fprf', 'fprf.Id_Fase = problemas.Reference_Phase', 'left')
        ->join('fases fai', 'fai.Id_Fase = problemas.Additional_Info', 'left')        
        ->join('tipo_ambientes ta', 'ta.Id_Tipo_Ambiente = problemas.Environment', 'left')
        ->join('inspecciones insp', 'insp.Id_Inspeccion = problemas.Id_Inspeccion', 'left')
        ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion', 'left')
        ->where($condicion)
        ->whereIn('problemas.Id_Problema', $array)
        ->whereNotIn('problemas.Id_Problema', $arridds)
        ->orderBy($orden)
        ->get();
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
        $condicion = ['problemas.Id_Sitio' => $Id_Sitio, "problemas.Estatus_Problema"=> $estatus,'problemas.Estatus' => 'Activo'];

        if($estatus == "Cerrado"){
            $condicion['problemas.Cerrado_En_Inspeccion'] = $Id_Inspeccion;
        }

        return $this->table('problemas')->select('
            problemas.Id_Problema,    
            problemas.Id_Tipo_Inspeccion,
            problemas.Numero_Problema,
            problemas.Id_Sitio,
            problemas.Id_Inspeccion,
            problemas.Id_Inspeccion_Det,
            problemas.Id_Ubicacion,
            problemas.Problem_Temperature,
            problemas.Reference_Temperature,
            problemas.Problem_Phase,
            problemas.Reference_Phase,
            problemas.Problem_Rms,
            problemas.Reference_Rms,
            problemas.Additional_Info,
            problemas.Additional_Rms,
            problemas.Emissivity_Check,
            problemas.Emissivity,
            problemas.Indirect_Temp_Check,
            problemas.Temp_Ambient_Check,
            problemas.Temp_Ambient,
            problemas.Environment_Check,
            problemas.Environment,
            problemas.Ir_File,
            problemas.Photo_File,
            problemas.Wind_Speed_Check,
            problemas.Wind_Speed,
            problemas.Id_Fabricante,
            problemas.Rated_Load_Check,
            problemas.Rated_Load,
            problemas.Circuit_Voltage_Check,
            problemas.Circuit_Voltage,
            problemas.Id_Falla,
            problemas.Component_Comment,
            problemas.Estatus_Problema,
            problemas.Aumento_Temperatura,
            problemas.Id_Severidad,
            problemas.Estatus,
            problemas.Ruta,
            problemas.hazard_Type,
            problemas.hazard_Classification,
            problemas.hazard_Group,
            problemas.hazard_Issue,
            problemas.Rpm,
            problemas.Bearing_Type,
            problemas.Es_Cronico,
            problemas.Cerrado_En_Inspeccion,
            problemas.Creado_Por,
            problemas.Fecha_Creacion,
            problemas.Modificado_Por,
            problemas.Fecha_Mod,
            tinsp.Tipo_Inspeccion AS tipoInspeccion,
            insp.No_Inspeccion AS numInspeccion,
            sev.Severidad AS StrSeveridad
        ')
        ->join('severidades sev', 'sev.Id_Severidad = problemas.Id_Severidad', 'left')
        ->join('inspecciones insp', 'insp.Id_Inspeccion = problemas.Id_Inspeccion', 'left')
        ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion', 'left')
        ->where($condicion)
        // ->groupBy('Id_Inspeccion')
        ->orderBy("problemas.Id_Inspeccion DESC , problemas.Id_Tipo_Inspeccion ASC, problemas.Numero_Problema ASC")->findAll();
    }

    public function getProblemas_SitioGrafica($condicion){
        return $this->table('problemas')->select('
            problemas.Id_Problema,    
            problemas.Id_Tipo_Inspeccion,
            problemas.Numero_Problema,
            problemas.Id_Sitio,
            problemas.Id_Inspeccion,
            problemas.Id_Inspeccion_Det,
            problemas.Id_Ubicacion,
            problemas.Problem_Temperature,
            problemas.Reference_Temperature,
            problemas.Problem_Phase,
            problemas.Reference_Phase,
            problemas.Problem_Rms,
            problemas.Reference_Rms,
            problemas.Additional_Info,
            problemas.Additional_Rms,
            problemas.Emissivity_Check,
            problemas.Emissivity,
            problemas.Indirect_Temp_Check,
            problemas.Temp_Ambient_Check,
            problemas.Temp_Ambient,
            problemas.Environment_Check,
            problemas.Environment,
            problemas.Ir_File,
            problemas.Photo_File,
            problemas.Wind_Speed_Check,
            problemas.Wind_Speed,
            problemas.Id_Fabricante,
            problemas.Rated_Load_Check,
            problemas.Rated_Load,
            problemas.Circuit_Voltage_Check,
            problemas.Circuit_Voltage,
            problemas.Id_Falla,
            problemas.Component_Comment,
            problemas.Estatus_Problema,
            problemas.Aumento_Temperatura,
            problemas.Id_Severidad,
            problemas.Estatus,
            problemas.Ruta,
            problemas.hazard_Type,
            problemas.hazard_Classification,
            problemas.hazard_Group,
            problemas.hazard_Issue,
            problemas.Rpm,
            problemas.Bearing_Type,
            problemas.Es_Cronico,
            problemas.Cerrado_En_Inspeccion,
            problemas.Creado_Por,
            problemas.Fecha_Creacion,
            problemas.Modificado_Por,
            problemas.Fecha_Mod,
            fht.Falla AS hazardType,
            fhc.Falla AS hazardClassification,
            fhg.Falla AS hazardGroup,
            fhi.Falla AS hazardIssue,
            ubi.Codigo_Barras AS codigoBarras,
            sev.Severidad AS severidad,
            sev.Severidad AS StrSeveridad,
            fab.Fabricante AS fabricante,
            fpp.Nombre_Fase AS faseProblema,
            fprf.Nombre_Fase AS faseReferencia,
            fai.Nombre_Fase AS faseAdicional,
            ta.Nombre AS tipoAmbiente,
            insp.No_Inspeccion AS numInspeccion,
            tinsp.Tipo_Inspeccion AS tipoInspeccion,
            tp.Desc_Prioridad AS tipoPrioridad,
            ubi.Ubicacion AS nombreEquipo
        ')
        ->join('FALLAS fht', 'fht.Id_Falla = problemas.hazard_Type', 'left')
        ->join('FALLAS fhc', 'fhc.Id_Falla = problemas.hazard_Classification', 'left')
        ->join('FALLAS fhg', 'fhg.Id_Falla = problemas.hazard_Group', 'left')
        ->join('FALLAS fhi', 'fhi.Id_Falla = problemas.hazard_Issue', 'left')
        ->join('ubicaciones ubi', 'ubi.Id_Ubicacion = problemas.Id_Ubicacion', 'left')
        ->join('tipo_prioridades tp', 'ubi.Id_Tipo_Prioridad = tp.Id_Tipo_Prioridad', 'left')
        ->join('severidades sev', 'sev.Id_Severidad = problemas.Id_Severidad', 'left')
        ->join('fabricantes fab', 'fab.Id_Fabricante = problemas.Id_Fabricante', 'left')
        ->join('fases fpp', 'fpp.Id_Fase = problemas.Problem_Phase', 'left')
        ->join('fases fprf', 'fprf.Id_Fase = problemas.Reference_Phase', 'left')
        ->join('fases fai', 'fai.Id_Fase = problemas.Additional_Info', 'left')        
        ->join('tipo_ambientes ta', 'ta.Id_Tipo_Ambiente = problemas.Environment', 'left')
        ->join('inspecciones insp', 'insp.Id_Inspeccion = problemas.Id_Inspeccion', 'left')
        ->join('tipo_inspecciones tinsp', 'tinsp.Id_Tipo_Inspeccion = problemas.Id_Tipo_Inspeccion', 'left')
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