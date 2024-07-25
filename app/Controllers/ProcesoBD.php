<?php

namespace App\Controllers;

use App\Models\ClientesMdl;
use App\Models\GirosMdl;
use App\Models\CompaniasMdl;
use App\Controllers\BaseController;
helper('filesystem');

class ProcesoBD extends BaseController{

    public function cargar_script_bd(){
        $session = session();
        // Si no se ha iniciado session redirecciona al login
        if(is_null($session->usuario) || $session->usuario == ''){
            $session->setFlashdata('msg', 'Es necesario iniciar sesión');
            return redirect()->to(base_url('/'));
        }
    }

    public function procesobd(){

        $script_insert = $this->request->getPost('script_transformado');
        $nombre_db = $this->request->getPost('nombre_db');

        $ruta_guardar_script = ROOTPATH.'public/Archivos_ETIC/bd_procesadas/'.$nombre_db.'.sql';

        $contenido_nuevo_script = '
            SET NAMES utf8;
            /* CREACION DE LA BASE DE DATOS QUE USA EL SISTEMA */
            DROP DATABASE IF EXISTS `u695808356_etic_system_db`;
            CREATE DATABASE `u695808356_etic_system_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

            USE `u695808356_etic_system_db`;

            /* Estructura de la tabla `causa_principal` */

            DROP TABLE IF EXISTS `causa_principal`;
            CREATE TABLE `causa_principal` (
            `Id_Causa_Raiz` char(38) NOT NULL,
            `Id_Tipo_Inspeccion` char(38) DEFAULT NULL,
            `Id_Falla` char(38) DEFAULT NULL,
            `Causa_Raiz` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Causa_Raiz`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `clientes` */

            DROP TABLE IF EXISTS `clientes`;
            CREATE TABLE `clientes` (
            `Id_Cliente` char(38) NOT NULL,
            `Id_Compania` char(38) DEFAULT NULL,
            `Id_Giro` char(38) DEFAULT NULL,
            `Razon_Social` text DEFAULT NULL,
            `Nombre_Comercial` text DEFAULT NULL,
            `RFC` varchar(50) DEFAULT NULL,
            `Imagen_Cliente` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Cliente`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            DROP TABLE IF EXISTS `estatus_color_text`;
            CREATE TABLE `estatus_color_text` (
                `Id_Estatus_Color_Text` int(20) NOT NULL AUTO_INCREMENT,
                `Color_Text` varchar(15) DEFAULT NULL,
                `Descripcion` text NOT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Estatus_Color_Text`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /*Data for the table `estatus_color_text` */

            insert  into `estatus_color_text`(`Id_Estatus_Color_Text`,`Color_Text`,`Descripcion`) values (1,"#000000","sin inspeccionar","flag_export","flag_export"),(2,"#DD3B3B","inspeccionado con hallazgos","flag_export","flag_export"),(3,"#21B040","inspeccionado sin hallazgos","flag_export","flag_export"),(4,"#0082ff","verificado sin inspección","flag_export","flag_export");
            
            /* Estructura de la tabla `datos_reporte` */
            CREATE TABLE `datos_reporte` (
                `Id_Datos_Reporte` int(15) NOT NULL AUTO_INCREMENT,
                `Id_Inspeccion` char(38) DEFAULT NULL,
                `detalle_ubicacion` text DEFAULT NULL,
                `nombre_contacto` text DEFAULT NULL,
                `puesto_contacto` text DEFAULT NULL,
                `fecha_inicio_ra` date DEFAULT NULL,
                `fecha_fin_ra` date DEFAULT NULL,
                `nombre_img_portada` text DEFAULT NULL,
                `descripcion_reporte` text DEFAULT NULL,
                `areas_inspeccionadas` text DEFAULT NULL,
                `recomendacion_reporte` text DEFAULT NULL,
                `imagen_recomendacion` text DEFAULT NULL,
                `imagen_recomendacion_2` text DEFAULT NULL,
                `referencia_reporte` text DEFAULT NULL,
                `arrayElementosSeleccionados` text DEFAULT NULL,
                `arrayProblemasSeleccionados` text DEFAULT NULL,
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Datos_Reporte`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `equipos` */

            DROP TABLE IF EXISTS `equipos`;
            CREATE TABLE `equipos` (
            `Id_Equipo` char(38) NOT NULL,
            `Equipo` text DEFAULT NULL,
            `Descr_equipo` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Equipo`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `estatus_inspeccion` */

            DROP TABLE IF EXISTS `estatus_inspeccion`;
            CREATE TABLE `estatus_inspeccion` (
            `Id_Status_Inspeccion` char(38) NOT NULL,
            `Status_Inspeccion` varchar(30) DEFAULT NULL,
            `Desc_Status` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Status_Inspeccion`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            insert  into `estatus_inspeccion`(`Id_Status_Inspeccion`,`Status_Inspeccion`,`Desc_Status`,`Estatus`,`Creado_Por`,`Fecha_Creacion`,`Modificado_Por`,`Fecha_Mod`) values ("73F27003-76B3-11D3-82BF-00104BC75DC2","En progreso","The inspection is currently being performed","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("73F27004-76B3-11D3-82BF-00104BC75DC2","Completed","The inspection is completed as scheduled","Inactivo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("73F27006-76B3-11D3-82BF-00104BC75DC2","Postponed","The inspection is currently postponed. To be resheduled at a later date.","Inactivo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("73F27007-76B3-11D3-82BF-00104BC75DC2","Cerrada","The inspection has been closed","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00");

            /* Estructura de la tabla `estatus_inspeccion_det` */

            DROP TABLE IF EXISTS `estatus_inspeccion_det`;
            CREATE TABLE `estatus_inspeccion_det` (
            `Id_Status_Inspeccion_Det` char(38) NOT NULL,
            `Estatus_Inspeccion_Det` varchar(10) DEFAULT NULL,
            `Desc_Estatus_Det` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Status_Inspeccion_Det`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            insert  into `estatus_inspeccion_det`(`Id_Status_Inspeccion_Det`,`Estatus_Inspeccion_Det`,`Desc_Estatus_Det`,`Estatus`,`Creado_Por`,`Fecha_Creacion`,`Modificado_Por`,`Fecha_Mod`) values ("5454DDD8-5031-11D3-9270-006008A19766","NOACC","No Accesible","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("5454DDD9-5031-11D3-9270-006008A19766","BLOQ","Bloqueado","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("5454DDE0-5031-11D3-9270-006008A19766","NSFI","Not Sheduled For Inspection","Inactivo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("568798D1-76BB-11D3-82BF-00104BC75DC2","PVERIF","Para Verificar","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("568798D2-76BB-11D3-82BF-00104BC75DC2","VERIFICADO","Verificado","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("568798D3-76BB-11D3-82BF-00104BC75DC2","NOCARGA","Sin Carga","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("568798D4-76BB-11D3-82BF-00104BC75DC2","NTTC","Not Tested - Time Constraint","Inactivo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("568798D5-76BB-11D3-82BF-00104BC75DC2","MTTO","En Mantenimiento","Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00"),("568798D6-76BB-11D3-82BF-00104BC75DC2","NTNS","Not Tested - Not Specified","Inactivo","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00","2C025003-2F04-11D3-A26C-DFF115A1D844","1999-09-09 12:00:00");

            /* Estructura de la tabla `fabricantes` */

            DROP TABLE IF EXISTS `fabricantes`;
            CREATE TABLE `fabricantes` (
            `Id_Fabricante` char(38) NOT NULL,
            `Id_Tipo_Inspeccion` char(38) DEFAULT NULL,
            `Fabricante` text DEFAULT NULL,
            `Desc_Fabricante` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Fabricante`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `fallas` */

            DROP TABLE IF EXISTS `fallas`;
            CREATE TABLE `fallas` (
            `Id_Falla` char(38) NOT NULL,
            `Id_Tipo_Falla` char(38) DEFAULT NULL,
            `Falla` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Falla`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `fases` */

            DROP TABLE IF EXISTS `fases`;
            CREATE TABLE `fases` (
            `Id_Fase` char(38) NOT NULL,
            `Nombre_Fase` text DEFAULT NULL,
            `Descripcion` text DEFAULT NULL,
            `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
            `Creado_Por` char(38) DEFAULT NULL,
            `Fecha_Creacion` datetime DEFAULT NULL,
            `Modificado_Por` char(38) DEFAULT NULL,
            `Fecha_Mod` datetime DEFAULT NULL,
            `Id_Inspeccion` char(38) DEFAULT "flag_export",
            `Id_Sitio` char(38) DEFAULT "flag_export",
            PRIMARY KEY (`Id_Fase`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


            /* Estructura de la tabla `grupos` */

            DROP TABLE IF EXISTS `grupos`;
            CREATE TABLE `grupos` (
                `Id_Grupo` char(38) NOT NULL,
                `Grupo` varchar(150) DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Grupo`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;
            insert  into `grupos`(`Id_Grupo`,`Grupo`,`Estatus`,`Creado_Por`,`Fecha_Creacion`,`Modificado_Por`,`Fecha_Mod`) values ("3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","Termografos","Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-01 22:52:44",NULL,NULL),("5I78A4EH-ZR3Q-K6PS-XJMW-T91OGYL2UBNV","Clientes","Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-01 22:52:32",NULL,NULL),("ISOU90CJ-DRGN-ME4V-FBQH-2T7W5Y8K1AX3","Usuarios","Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-01 22:52:12",NULL,NULL),("K8GJNQPD-4A13-FUZE-RVLI-H5BW6CM29TOY","Administradores","Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-01 22:52:04",NULL,NULL);

            DROP TABLE IF EXISTS `grupos_sitios`;

            CREATE TABLE `grupos_sitios` (
                `Id_Grupo_Sitios` char(38) NOT NULL,
                `Id_Cliente` char(38) DEFAULT NULL,
                `Grupo` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Grupo_Sitios`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            /* Estructura de la tabla `historial_problemas` */

            DROP TABLE IF EXISTS `historial_problemas`;
            CREATE TABLE `historial_problemas` (
                `Id_Historial_Problema` char(38) NOT NULL,
                `Id_Problema` char(38) DEFAULT NULL,
                `Id_Problema_Anterior` char(38) DEFAULT NULL,
                `Id_Problema_Original` char(38) DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Historial_Problema`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;        
            
            /* Estructura de la tabla `inspecciones` */

            DROP TABLE IF EXISTS `inspecciones`;
            CREATE TABLE `inspecciones` (
                `Id_Inspeccion` char(38) NOT NULL,
                `Id_Sitio` char(38) DEFAULT NULL,
                `Id_Grupo_Sitios` char(38) DEFAULT NULL,
                `Id_Cliente` char(38) DEFAULT NULL,
                `Id_Status_Inspeccion` char(38) DEFAULT NULL,
                `Fecha_Inicio` datetime DEFAULT NULL,
                `Fecha_Fin` datetime DEFAULT NULL,
                `Fotos_Ruta` text DEFAULT NULL,
                `IR_Imagen_Inicial` text DEFAULT NULL,
                `DIG_Imagen_Inicial` text DEFAULT NULL,
                `No_Dias` int(4) DEFAULT NULL,
                `Unidad_Temp` varchar(10) DEFAULT NULL,
                `No_Inspeccion` int(20) DEFAULT NULL,
                `No_Inspeccion_Ant` int(20) DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                PRIMARY KEY (`Id_Inspeccion`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `inspecciones_det` */

            DROP TABLE IF EXISTS `inspecciones_det`;
            CREATE TABLE `inspecciones_det` (
                `Id_Inspeccion_Det` char(38) NOT NULL,
                `Id_Inspeccion` char(38) DEFAULT NULL,
                `Id_Ubicacion` char(38) DEFAULT NULL,
                `Id_Status_Inspeccion_Det` char(38) DEFAULT NULL,
                `Notas_Inspeccion` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT "Activo",
                `Id_Estatus_Color_Text` int(20) DEFAULT 1,
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Inspeccion_Det`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `linea_base` */

            DROP TABLE IF EXISTS `linea_base`;
            CREATE TABLE `linea_base` (
                `Id_Linea_Base` char(38) NOT NULL,
                `Id_Sitio` char(38) DEFAULT "flag_export",
                `Id_Ubicacion` char(38) DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT NULL,
                `Id_Inspeccion_Det` char(38) DEFAULT NULL,
                `MTA` double DEFAULT NULL,
                `Temp_max` double DEFAULT NULL,
                `Temp_amb` double DEFAULT NULL,
                `Notas` text DEFAULT NULL,
                `Archivo_IR` text DEFAULT NULL,
                `Archivo_ID` text DEFAULT NULL,
                `Ruta` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                PRIMARY KEY (`Id_Linea_Base`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `problemas` */

            DROP TABLE IF EXISTS `problemas`;
            CREATE TABLE `problemas` (
                `Id_Problema` char(38) NOT NULL,
                `Id_Tipo_Inspeccion` char(38) DEFAULT NULL,
                `Numero_Problema` int(11) DEFAULT NULL,
                `Id_Sitio` char(38) DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT NULL,
                `Id_Inspeccion_Det` char(38) DEFAULT NULL,
                `Id_Ubicacion` char(38) DEFAULT NULL,
                `Problem_Phase` char(38) DEFAULT NULL,
                `Reference_Phase` char(38) DEFAULT NULL,
                `Problem_Temperature` double DEFAULT NULL,
                `Reference_Temperature` double DEFAULT NULL,
                `Problem_Rms` double DEFAULT NULL,
                `Reference_Rms` double DEFAULT NULL,
                `Additional_Info` char(38) DEFAULT NULL,
                `Additional_Rms` double DEFAULT NULL,
                `Emissivity_Check` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Emissivity` double(10,2) DEFAULT NULL,
                `Indirect_Temp_Check` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Temp_Ambient_Check` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Temp_Ambient` double DEFAULT NULL,
                `Environment_Check` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Environment` char(38) DEFAULT NULL,
                `Ir_File` text DEFAULT NULL,
                `Ir_File_Date` date DEFAULT NULL,
                `Ir_File_Time` time DEFAULT NULL,
                `Photo_File` text DEFAULT NULL,
                `Photo_File_Date` date DEFAULT NULL,
                `Photo_File_Time` time DEFAULT NULL,
                `Wind_Speed_Check` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Wind_Speed` double DEFAULT NULL,
                `Id_Fabricante` char(38) DEFAULT NULL,
                `Rated_Load_Check` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Rated_Load` varchar(25) DEFAULT NULL,
                `Circuit_Voltage_Check` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Circuit_Voltage` varchar(25) DEFAULT NULL,
                `Id_Falla` char(38) DEFAULT NULL,
                `Id_Equipo` char(38) DEFAULT NULL,
                `Component_Comment` text DEFAULT NULL,
                `Estatus_Problema` enum("Abierto","Cerrado") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Aumento_Temperatura` double DEFAULT NULL,
                `Id_Severidad` char(38) DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Ruta` text DEFAULT NULL,
                `hazard_Type` char(38) DEFAULT NULL,
                `hazard_Classification` char(38) DEFAULT NULL,
                `hazard_Group` char(38) DEFAULT NULL,
                `hazard_Issue` char(38) DEFAULT NULL,
                `Rpm` double DEFAULT NULL,
                `Bearing_Type` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Es_Cronico` enum("SI","NO") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Cerrado_En_Inspeccion` char(38) DEFAULT NULL,
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                PRIMARY KEY (`Id_Problema`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `severidades` */

            DROP TABLE IF EXISTS `severidades`;
            CREATE TABLE `severidades` (
                `Id_Severidad` char(38) NOT NULL,
                `Severidad` varchar(30) DEFAULT NULL,
                `Descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Severidad`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `sitios` */

            DROP TABLE IF EXISTS `sitios`;
            CREATE TABLE `sitios` (
                `Id_Sitio` char(38) NOT NULL,
                `Id_Cliente` char(38) DEFAULT NULL,
                `Id_Grupo_Sitios` char(38) DEFAULT NULL,
                `Sitio` text DEFAULT NULL,
                `Desc_Sitio` text DEFAULT NULL,
                `Direccion` text DEFAULT NULL,
                `Colonia` text DEFAULT NULL,
                `Estado` text DEFAULT NULL,
                `Municipio` text DEFAULT NULL,
                `Folder` text DEFAULT NULL,
                `Contacto_1` text DEFAULT NULL,
                `Puesto_Contacto_1` text DEFAULT NULL,
                `Contacto_2` text DEFAULT NULL,
                `Puesto_Contacto_2` text DEFAULT NULL,
                `Contacto_3` text DEFAULT NULL,
                `Puesto_Contacto_3` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Sitio`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `tipo_ambientes` */

            DROP TABLE IF EXISTS `tipo_ambientes`;
            CREATE TABLE `tipo_ambientes` (
                `Id_Tipo_Ambiente` char(38) NOT NULL,
                `Nombre` text DEFAULT NULL,
                `Descripcion` text DEFAULT NULL,
                `Adjust` decimal(10,2) DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Tipo_Ambiente`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            insert  into `tipo_ambientes`(`Id_Tipo_Ambiente`,`Nombre`,`Descripcion`,`Adjust`,`Estatus`) values ("F21FBD60-782F-11D3-82BF-00104BC75DC2","Interior","Indoor inspection",0.00,"Activo"),("F21FBD61-782F-11D3-82BF-00104BC75DC2","Sunny","Sunny",0.00,"Inactivo"),("F21FBD62-782F-11D3-82BF-00104BC75DC2","Foggy","Foggy",0.05,"Inactivo"),("F21FBD63-782F-11D3-82BF-00104BC75DC2","Rain - Light","Light rain",0.10,"Inactivo"),("F21FBD64-782F-11D3-82BF-00104BC75DC2","Overcast","Overcast",0.05,"Inactivo"),("F21FBD65-782F-11D3-82BF-00104BC75DC2","Rain - Medium","Medium rain",0.20,"Inactivo"),("F21FBD66-782F-11D3-82BF-00104BC75DC2","Rain - Heavy","Heavy rain",0.30,"Inactivo"),("F21FBD67-782F-11D3-82BF-00104BC75DC2","Snow - Light","Light snow",0.10,"Inactivo"),("F21FBD68-782F-11D3-82BF-00104BC75DC2","Snow - Medium","Medium snow",0.20,"Inactivo"),("F21FBD69-782F-11D3-82BF-00104BC75DC2","Snow - Heavy","Heavy snow",0.30,"Inactivo"),("F21FBD70-782F-11D3-82BF-00104BC75DC2","Exterior",NULL,0.00,"Activo");

            /* Estructura de la tabla `tipo_fallas` */

            DROP TABLE IF EXISTS `tipo_fallas`;
            CREATE TABLE `tipo_fallas` (
                `Id_Tipo_Falla` char(38) NOT NULL,
                `Id_Tipo_Inspeccion` char(38) DEFAULT NULL,
                `Tipo_Falla` text DEFAULT NULL,
                `Desc_Tipo_Falla` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Tipo_Falla`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `tipo_inspecciones` */

            DROP TABLE IF EXISTS `tipo_inspecciones`;
            CREATE TABLE `tipo_inspecciones` (
                `Id_Tipo_Inspeccion` char(38) NOT NULL,
                `Tipo_Inspeccion` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Desc_Inspeccion` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Tipo_Inspeccion`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `tipo_prioridades` */

            DROP TABLE IF EXISTS `tipo_prioridades`;
            CREATE TABLE `tipo_prioridades` (
                `Id_Tipo_Prioridad` char(38) NOT NULL,
                `Tipo_Prioridad` varchar(5) DEFAULT NULL,
                `Desc_Prioridad` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                `Id_Sitio` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Tipo_Prioridad`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `ubicaciones` */

            DROP TABLE IF EXISTS `ubicaciones_temp`;
            CREATE TABLE `ubicaciones_temp` (
                `Id_Ubicacion` char(38) NOT NULL,
                `Id_Sitio` char(38) DEFAULT NULL,
                `Id_Ubicacion_padre` char(38) DEFAULT NULL,
                `Id_Tipo_Prioridad` char(38) DEFAULT NULL,
                `Id_Tipo_Inspeccion` char(38) DEFAULT NULL,
                `Ubicacion` text DEFAULT NULL,
                `Descripcion` text DEFAULT NULL,
                `Es_Equipo` enum("SI","NO") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Codigo_Barras` text DEFAULT NULL,
                `Nivel_arbol` int(20) DEFAULT NULL,
                `LIMITE` double DEFAULT NULL,
                `Fabricante` char(38) DEFAULT NULL,
                `Nombre_Foto` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Ubicacion`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;
            
            /* Estructura de la tabla `ubicaciones` */

            DROP TABLE IF EXISTS `ubicaciones`;
            CREATE TABLE `ubicaciones` (
                `Id_Ubicacion` char(38) NOT NULL,
                `Id_Sitio` char(38) DEFAULT NULL,
                `Id_Ubicacion_padre` char(38) DEFAULT NULL,
                `Id_Tipo_Prioridad` char(38) DEFAULT NULL,
                `Id_Tipo_Inspeccion` char(38) DEFAULT NULL,
                `Ubicacion` text DEFAULT NULL,
                `Descripcion` text DEFAULT NULL,
                `Es_Equipo` enum("SI","NO") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                `Codigo_Barras` text DEFAULT NULL,
                `Nivel_arbol` int(20) DEFAULT NULL,
                `LIMITE` double DEFAULT NULL,
                `Fabricante` char(38) DEFAULT NULL,
                `Nombre_Foto` text DEFAULT NULL,
                `Ruta` text DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Ubicacion`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

            /* Estructura de la tabla `usuarios` */

            CREATE TABLE `usuarios` (
                `Id_Usuario` char(38) NOT NULL,
                `Id_Grupo` char(38) DEFAULT NULL,
                `Usuario` varchar(50) DEFAULT NULL,
                `Nombre` varchar(100) DEFAULT NULL,
                `Password` text DEFAULT NULL,
                `Foto` text DEFAULT NULL,
                `Email` text DEFAULT NULL,
                `Telefono` varchar(15) DEFAULT NULL,
                `nivelCertificacion` varchar(50) DEFAULT NULL,
                `Ultimo_login` datetime DEFAULT NULL,
                `Titulo` varchar(20) DEFAULT NULL,
                `Id_Cliente` char(38) DEFAULT NULL,
                `Id_Grupo_Sitios` char(38) DEFAULT NULL,
                `Id_Sitio` char(38) DEFAULT NULL,
                `Estatus` enum("Activo","Inactivo") CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT "Activo",
                `Creado_Por` char(38) DEFAULT NULL,
                `Fecha_Creacion` datetime DEFAULT NULL,
                `Modificado_Por` char(38) DEFAULT NULL,
                `Fecha_Mod` datetime DEFAULT NULL,
                `Id_Inspeccion` char(38) DEFAULT "flag_export",
                PRIMARY KEY (`Id_Usuario`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

            insert  into `usuarios`(`Id_Usuario`,`Id_Grupo`,`Usuario`,`Nombre`,`Password`,`Foto`,`Email`,`Telefono`,`nivelCertificacion`,`Ultimo_login`,`Titulo`,`Id_Cliente`,`Id_Grupo_Sitios`,`Id_Sitio`,`Estatus`,`Creado_Por`,`Fecha_Creacion`,`Modificado_Por`,`Fecha_Mod`,`Id_Inspeccion`) values 
            ("07530590-D137-4B00-AA26-0C10519F2171","3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","aflores","José Alfredo Flores Bernal","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"alfredo.flores@etic-infrared.mx","5551439424","Nivel II",NULL,"Thermographer",NULL,NULL,NULL,"Activo","AFFE6C99-118C-41C1-A961-5BA8F1935D5F","2018-07-24 18:54:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-11 12:04:23","flag_export")
            ,("34F2D940-47D8-42FD-BED9-E692C0694D90","3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","eflores","Erandy Flores Guevara","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"erandy.flores@etic-infrared.mx","9211549178","Nivel III",NULL,"Thermographer",NULL,NULL,NULL,"Activo","6AE8C7D5-E2B7-4A97-8EF1-0BB02EE1CC52","2020-12-03 02:20:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-11 12:02:49","flag_export")
            ,("3C070622-3211-49F6-B12A-755F2AE47042","K8GJNQPD-4A13-FUZE-RVLI-H5BW6CM29TOY","ahernandez","Abraham Hernández Carreón","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"abraham.hernandez@etic-infrared.mx","5528980071",NULL,NULL,NULL,NULL,NULL,NULL,"Activo","BD705F1E-EA39-4682-A6D6-50F9CF6FDE23","2022-01-07 21:32:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-11 12:01:58","flag_export")
            ,("6AE8C7D5-E2B7-4A97-8EF1-0BB02EE1CC52","K8GJNQPD-4A13-FUZE-RVLI-H5BW6CM29TOY","acarreon","Alejandra Carreón Luna","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"alejandra.carreon@etic-infrared.mx","5580325401","Nivel II",NULL,"The Boss",NULL,NULL,NULL,"Activo","AFFE6C99-118C-41C1-A961-5BA8F1935D5F","2015-11-05 20:08:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-11 12:01:07","flag_export")
            ,("AFE66B1B-3357-456B-A190-6086B62DAD8D","K8GJNQPD-4A13-FUZE-RVLI-H5BW6CM29TOY","rgarcia","Rafael García Arenas","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"rafael.garcia@etic-infrared.mx","5537409232","Nivel II","2023-11-02 16:13:41","Thermographer",NULL,NULL,NULL,"Activo","6AE8C7D5-E2B7-4A97-8EF1-0BB02EE1CC52","2021-10-11 20:06:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-11 11:59:45","flag_export")
            ,("AFFE6C99-118C-41C1-A961-5BA8F1935D5F","K8GJNQPD-4A13-FUZE-RVLI-H5BW6CM29TOY","Admin","Admin","$2y$10$JS8Mhtef4AdFXYuBj0b7o.PqHr3tgepAx3l7xzW8WKBBm2R9taYie",NULL,"admin@gmail.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,"Activo","2C025003-2F04-11D3-A26C-DFF115A1D844","2004-12-30 21:39:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-04 12:57:54","flag_export")
            ,("CD2A731D-9F97-4AC7-AFA6-DD6147DC432A","3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","avargas","Anel Mariela Vargas Baños","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"anel.vargas@etic-infrared.mx","5540311945",NULL,"2023-10-21 11:39:35","Thermographer",NULL,NULL,NULL,"Activo","6AE8C7D5-E2B7-4A97-8EF1-0BB02EE1CC52","2022-02-27 13:46:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-10-03 13:00:23","flag_export")
            ,("D34DF029-7E1E-4A6E-B0EB-D4F320A8A4CE","3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","vgarcia","Vianet Elizabeth García Cova","$2y$10$nG5R7gV8A7beYZ9vxIoay.oQ3n8ch2i2iwdq0oQW8o7XT.r9vt7S.",NULL,"vianet.garcia@etic-infrared.mx","5537214292","Nivel II","2023-06-05 10:19:55","Thermographer",NULL,NULL,NULL,"Activo","6AE8C7D5-E2B7-4A97-8EF1-0BB02EE1CC52","2021-02-19 18:25:00","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-05-11 11:54:01","flag_export")
            ,("IW1EXBQ7-4VJM-5PND-Y32A-06SHLZ8FKCOR","3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","rgarcia_t","Rafael García Arenas","$2y$10$AMo8uWFK9Etmf4TlChPzXewWRWpSgMYdo1H2OF64ZuBQqNGyOHpRi",NULL,"rafael.garcia@etic-infrared.mx","5537409232","Nivel II",NULL,NULL,NULL,NULL,NULL,"Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-06-06 11:04:15","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-10-02 13:47:06","flag_export")
            ,("UTJI6WV5-1MCX-Q3FP-4YAG-LBDS9N7EORHZ","5I78A4EH-ZR3Q-K6PS-XJMW-T91OGYL2UBNV","bachoco_10","Pedro Gonzalez","$2y$10$VA/sKsx3QnK00JPJuZDZCeTTcp4RtzC.89pYY6E.QEs4mVaBKxoa6",NULL,"a@a.com","123456",NULL,"2023-10-09 22:40:55",NULL,"FDF4C4E6-0B90-441C-A4AB-A7A6A0F324F9","9ELM6CN3-57TV-IYWS-KUAH-ZFBQ4D82G1OJ","5B8829AA-4111-48B0-9D06-C559673D34E6","Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-10-02 13:18:28","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-10-02 23:36:58","flag_export")
            ,("CMRW7U2T-4GBL-H1ZI-X58P-SKFEVNDQA93J","3ZSCOHA1-UR29-PDVL-EFGQ-4NIW65MB8J7K","dgonzalez","Daniel González López","$2y$10$svJcjJlpl9JsoS6WCA06pO/tWgU6TpJz2ZyoWI1gMR8JypE5GgDbG",NULL,"daniel.gonzalez@etic-infrared.mx","7712413274","Nivel II",NULL,NULL,NULL,NULL,NULL,"Activo","AFE66B1B-3357-456B-A190-6086B62DAD8D","2023-11-04 12:19:00",NULL,NULL,"flag_export")
            ;

            /* CREACION DE LA BASE DE DATOS DEL SISTEMA ANTERIOR DE DONDE SE EXTRAERA LA INFORMACION */
            DROP DATABASE IF EXISTS '.$nombre_db.';
            CREATE DATABASE '.$nombre_db.';
            /* USAMOS LA BASE */
            USE '.$nombre_db.';
            
            /* CREACION DE LAS TABLAS DEL SITEMA ANTERIOR */

            DROP TABLE IF EXISTS `Attachments`;
            CREATE TABLE `Attachments`(
                `AttachmentID` CHAR(38) DEFAULT NULL,
                `CustomerSiteID` CHAR(38) DEFAULT NULL,
                `TableName` VARCHAR(100) DEFAULT NULL,
                `GUIDPK` CHAR(38) DEFAULT NULL,
                `FileName` VARCHAR(50) DEFAULT NULL,
                `PathName` VARCHAR(250) DEFAULT NULL,
                `AttachmentTypeID` CHAR(38) NULL,
                `AttachmentNotes` VARCHAR(500) NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `SYSIconID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `AttachmentType`;
            CREATE TABLE `AttachmentType`(
                `AttachmentTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `Cameras`;
            CREATE TABLE `Cameras`(
                `CameraID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `CurrentCertificationNo` VARCHAR(35) NULL,
                `CurrentCertificationDate` DATETIME NULL,
                `CameraType` TINYINT DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ccCountries`;
            CREATE TABLE `ccCountries`(
                `SYSCountryID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(45) DEFAULT NULL,
                `PostalCodeMask` VARCHAR(20) NULL,
                `PhoneMask` VARCHAR(35) NULL,
                `SYSCurrencyID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `ccDefaults`;
            CREATE TABLE `ccDefaults`(
                `SetupDefaultsID` CHAR(38) DEFAULT NULL,
                `DefaultSYSCountryID` CHAR(38) NULL,
                `PrintDefaultCountryName` TINYINT NULL,
                `ConfirmAddresses` TINYINT NULL,
                `DefaultListSYSIconID` CHAR(38) NULL,
                `DefaultTreeSYSIconID` CHAR(38) NULL,
                `DefaultRootSYSIconID` CHAR(38) NULL,
                `TechSupportEMail` VARCHAR(200) NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ccIconDefaults`;
            CREATE TABLE `ccIconDefaults`(
                `SYSDefaultIconID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `SYSIconID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ccIcons`;
            CREATE TABLE `ccIcons`(
                `SYSIconID` CHAR(38) DEFAULT NULL,
                `SYSIconTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `Description` VARCHAR(50) NULL,
                `Icon32` BINARY DEFAULT NULL,
                `Icon16` BINARY DEFAULT NULL,
                `Icon16s` BINARY DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ccIconType`;
            CREATE TABLE `ccIconType`(
                `SYSIconTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `Description` VARCHAR(50) NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ccUserConfirmation`;
            CREATE TABLE `ccUserConfirmation`(
                `SYSUserConfirmationID` CHAR(38) DEFAULT NULL,
                `SYSUserID` CHAR(38) DEFAULT NULL,
                `Description` VARCHAR(50) DEFAULT NULL,
                `SYSConfirmationID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ccUsers`;
            CREATE TABLE `ccUsers`(
                `SYSUserID` CHAR(38) DEFAULT NULL,
                `LogonName` VARCHAR(50) DEFAULT NULL,
                `FileAs` VARCHAR(50) DEFAULT NULL,
                `Title` VARCHAR(20) NULL,
                `FirstName` VARCHAR(20) DEFAULT NULL,
                `MiddleName` VARCHAR(20) NULL,
                `LastName` VARCHAR(35) DEFAULT NULL,
                `Pedigree` VARCHAR(5) NULL,
                `Degree` VARCHAR(5) NULL,
                `Certification` VARCHAR(50) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `UserType` TINYINT DEFAULT NULL,
                `PermissionLevel` TINYINT NULL,
                `Password` VARCHAR(10) NULL
            );
            
            
            DROP TABLE IF EXISTS `ccVersions`;
            CREATE TABLE `ccVersions`(
                `SYSVersionID` CHAR(38) DEFAULT NULL,
                `ProjectName` VARCHAR(20) DEFAULT NULL,
                `CurrentVersion` VARCHAR(50) DEFAULT NULL,
                `Description` VARCHAR(35) DEFAULT NULL,
                `UpdatePath` VARCHAR(50) NULL,
                `Filename` VARCHAR(50) DEFAULT NULL,
                `UnlockGUID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `LogVersion` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `Customers`;
            CREATE TABLE `Customers`(
                `CustomerID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `CustSIC_Code` VARCHAR(10) NULL,
                `Description` VARCHAR(50) NULL,
                `ProviderID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `CustomerTypeID` CHAR(38) NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL,
                `Custom1` VARCHAR(100) NULL,
                `Custom2` VARCHAR(100) NULL,
                `Custom3` VARCHAR(100) NULL,
                `SysIconID` CHAR(38) NULL,
                `AttachmentID` CHAR(38) NULL,
                `Address` VARCHAR(250) NULL,
                `City` VARCHAR(50) NULL,
                `State` VARCHAR(50) NULL,
                `PostalCode` VARCHAR(15) NULL,
                `Country` CHAR(38) NULL,
                `ContactName` VARCHAR(50) NULL,
                `ContactTitle` VARCHAR(30) NULL,
                `PhoneNumber1` VARCHAR(30) NULL,
                `PhoneNumber2` VARCHAR(30) NULL,
                `FaxNumber1` VARCHAR(30) NULL,
                `CustomerNotes` VARCHAR(500) NULL
            );
            
            
            DROP TABLE IF EXISTS `CustomerSites`;
            CREATE TABLE `CustomerSites`(
                `CustomerSiteID` CHAR(38) DEFAULT NULL,
                `CustomerID` CHAR(38) DEFAULT NULL,
                `SiteName` VARCHAR(100) DEFAULT NULL,
                `SiteSIC_Code` VARCHAR(10) NULL,
                `Description` VARCHAR(50) NULL,
                `Address` VARCHAR(255) NULL,
                `City` VARCHAR(50) NULL,
                `State` VARCHAR(50) NULL,
                `Zip` VARCHAR(15) NULL,
                `SYSCountryID` CHAR(38) NULL,
                `InHouseNotes` VARCHAR(500) NULL,
                `DefaultInspectionTypeID` CHAR(38) DEFAULT NULL,
                `DefaultManufacturerID` CHAR(38) NULL,
                `DaysPerInspection` INT DEFAULT NULL,
                `DefaultLaborRate` DECIMAL(12,2) NULL,
                `DefaultProductionPerHour` DECIMAL(12,2) NULL,
                `DefaultInspectionCycle` INT DEFAULT NULL,
                `BeginningCycleDate` DATETIME NULL,
                `NextDateRange` INT NULL,
                `InsuranceCoName` VARCHAR(50) NULL,
                `PreviousProviderName` VARCHAR(50) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL,
                `Custom1` VARCHAR(100) NULL,
                `Custom2` VARCHAR(100) NULL,
                `DefaultPathname` VARCHAR(300) NULL,
                `SiteTypeID` CHAR(38) NULL,
                `SiteNote` VARCHAR(500) NULL,
                `SysIconID` CHAR(38) DEFAULT NULL,
                `AttachmentID` CHAR(38) NULL,
                `ReportingTempUnit` VARCHAR(100) DEFAULT NULL,
                `defLaborCostPerHour` DOUBLE NULL,
                `defEstimatedRevHoursBF` DOUBLE NULL,
                `defEstimatedRevHoursAF` DOUBLE NULL,
                `defEstimatedRevCostAF` DOUBLE NULL,
                `defEstimatedRevCostBF` DOUBLE NULL,
                `defPriorityStatusID` CHAR(38) NULL,
                `defInspectionDetailStatusID` CHAR(38) NULL,
                `DefaultSiteFolder` VARCHAR(200) NULL,
                `PRIOR_CTO` INT NULL,
                `PRIOR_ETO` INT NULL,
                `PRIOR_NON` INT NULL,
                `PRIOR_UNC` INT NULL,
                `Custom3` VARCHAR(100) NULL,
                `ContactName` VARCHAR(50) NULL,
                `ContactTitle` VARCHAR(30) NULL,
                `PhoneNumber1` VARCHAR(30) NULL,
                `PhoneNumber2` VARCHAR(30) NULL,
                `FaxNumber1` VARCHAR(30) NULL
            );
            
            
            DROP TABLE IF EXISTS `CustomerTypes`;
            CREATE TABLE `CustomerTypes`(
                `CustomerTypeID` CHAR(38) DEFAULT NULL,
                `TypeName` VARCHAR(100) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `CustomTable`;
            CREATE TABLE `CustomTable`(
                `CustomTableID` CHAR(38) DEFAULT NULL,
                `TableName` VARCHAR(60) DEFAULT NULL,
                `ColumnName` VARCHAR(50) DEFAULT NULL,
                `GUICaption` VARCHAR(50) NULL,
                `GUIEnabled` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `Defaults`;
            CREATE TABLE `Defaults`(
                `DefaultID` CHAR(38) DEFAULT NULL,
                `AmbientBaseline` DOUBLE NULL,
                `TemperatureUnit` VARCHAR(100) NULL,
                `NewProblemStatusID` CHAR(38) NULL,
                `DefaultPriorityStatusID` CHAR(38) NULL,
                `DefaultLabor` DECIMAL(12,2) NULL,
                `InProcessInspectionStatusID` CHAR(38) NULL,
                `ReportingInspectionStatusID` CHAR(38) NULL,
                `SpecialNoteEquipmentID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `Equipment`;
            CREATE TABLE `Equipment`(
                `EquipmentID` CHAR(38) DEFAULT NULL,
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(55) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `EquipmentGroupID` CHAR(38) DEFAULT NULL,
                `ManufacturerID` CHAR(38) NULL,
                `ReplaceCost` DECIMAL(12,2) NULL,
                `ReplaceHours` DOUBLE NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `Custom1` VARCHAR(50) NULL,
                `Custom2` VARCHAR(50) NULL,
                `Custom3` VARCHAR(50) NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `EquipmentFaultLinks`;
            CREATE TABLE `EquipmentFaultLinks`(
                `FaultLinkID` CHAR(38) DEFAULT NULL,
                `EquipmentID` CHAR(38) DEFAULT NULL,
                `FaultID` CHAR(38) DEFAULT NULL,
                `EvaluationCriteriaID` CHAR(38) NULL,
                `RepairCost` DECIMAL(12,2) NULL,
                `RepairHours` DOUBLE NULL,
                `ProblemCount` INT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `EquipmentGroups`;
            CREATE TABLE `EquipmentGroups`(
                `EquipmentGroupID` CHAR(38) DEFAULT NULL,
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(50) NULL,
                `SYSIconID` CHAR(38) NULL,
                `ParentID` CHAR(38) NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `EvaluationCriteria`;
            CREATE TABLE `EvaluationCriteria`(
                `EvaluationCriteriaID` CHAR(38) DEFAULT NULL,
                `EvaluationCriteriaTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(100) DEFAULT NULL,
                `Tier2` INT NULL,
                `Tier3` INT NULL,
                `Tier4` INT NULL,
                `ReverseTiers` TINYINT NULL,
                `Standard` TINYINT NULL,
                `Ambient` INT NULL,
                `Allowable` INT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `EvaluationCriteriaType`;
            CREATE TABLE `EvaluationCriteriaType`(
                `EvaluationCriteriaTypeID` CHAR(38) DEFAULT NULL,
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `FaultRepairs`;
            CREATE TABLE `FaultRepairs`(
                `RepairID` CHAR(38) DEFAULT NULL,
                `RootCauseID` CHAR(38) NULL,
                `Summary` VARCHAR(35) NULL,
                `RepairProcedure` VARCHAR(255) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `InspectionTypeID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `FaultRootCauseLinks`;
            CREATE TABLE `FaultRootCauseLinks`(
                `FaultRootCauseLinkID` CHAR(38) NULL,
                `FaultID` CHAR(38) NULL,
                `RootCauseID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `Faults`;
            CREATE TABLE `Faults`(
                `FaultID` CHAR(38) DEFAULT NULL,
                `FaultTypeID` CHAR(38) NULL,
                `Summary` VARCHAR(35) NULL,
                `Fault` VARCHAR(200) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `SysIconID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `FaultTypes`;
            CREATE TABLE `FaultTypes`(
                `FaultTypeID` CHAR(38) DEFAULT NULL,
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionCameras`;
            CREATE TABLE `InspectionCameras`(
                `CameraInspectionID` CHAR(38) DEFAULT NULL,
                `InspectionID` CHAR(38) DEFAULT NULL,
                `CameraID` CHAR(38) DEFAULT NULL,
                `CertificationNo` VARCHAR(35) NULL,
                `CertificationDate` DATETIME NULL,
                `DefaultPath` VARCHAR(35) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionDetails`;
            CREATE TABLE `InspectionDetails`(
                `InspectionDetailID` CHAR(38) DEFAULT NULL,
                `InspectionID` CHAR(38) DEFAULT NULL,
                `LocationID` CHAR(38) DEFAULT NULL,
                `InspectionDetailStatusID` CHAR(38) DEFAULT NULL,
                `TechSYSUserID` CHAR(38) DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `TestStatusNote` VARCHAR(500) NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionDetailStati`;
            CREATE TABLE `InspectionDetailStati`(
                `InspectionDetailStatusID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) DEFAULT NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `Inspections`;
            CREATE TABLE `Inspections`(
                `InspectionID` CHAR(38) DEFAULT NULL,
                `CustomerSiteID` CHAR(38) DEFAULT NULL,
                `CustomerID` CHAR(38) NULL,
                `InspectionStatusID` CHAR(38) DEFAULT NULL,
                `ScheduledStart` DATETIME DEFAULT NULL,
                `ScheduledEnd` DATETIME DEFAULT NULL,
                `SupervisorSYSUserID` CHAR(38) NULL,
                `PhotoPath` VARCHAR(100) NULL,
                `CustomerNotes` VARCHAR(500) NULL,
                `InHouseNotes` VARCHAR(500) NULL,
                `PerDiem` DECIMAL(12,2) NULL,
                `EstLabor` DECIMAL(12,2) NULL,
                `EstOther` DECIMAL(12,2) NULL,
                `PONumber` VARCHAR(35) NULL,
                `ReportsDue` DATETIME NULL,
                `NoOfDays` TINYINT NULL,
                `TotalBid` DECIMAL(12,2) NULL,
                `InvoiceDate` DATETIME NULL,
                `InvoiceNo` INT NULL,
                `InvoiceTotal` DECIMAL(12,2) NULL,
                `ReportsShipped` DATETIME NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `Custom1` VARCHAR(100) NULL,
                `Custom2` VARCHAR(100) NULL,
                `Custom3` VARCHAR(100) NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL,
                `SysIconID` CHAR(38) NULL,
                `TemperatureUnit` VARCHAR(100) DEFAULT NULL,
                `TechID` CHAR(38) DEFAULT NULL,
                `LastInspectionNo` INT NULL,
                `AttachmentID` CHAR(38) NULL,
                `InspectionNo` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionStati`;
            CREATE TABLE `InspectionStati`(
                `InspectionStatusID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `Closed` TINYINT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionTypeGroups`;
            CREATE TABLE `InspectionTypeGroups`(
                `InspectionTypeGroupID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `SYSIconID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionTypes`;
            CREATE TABLE `InspectionTypes`(
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `DefaultEvaluationCriteriaID` CHAR(38) NULL,
                `InspectionTypeGroupID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `InspectionUseTypes`;
            CREATE TABLE `InspectionUseTypes`(
                `ID` INT NULL,
                `UseTypeName` VARCHAR(100) NULL,
                `Description` VARCHAR(250) NULL
            );
            
            
            DROP TABLE IF EXISTS `ITLog`;
            CREATE TABLE `ITLog`(
                `LogDate` DATETIME DEFAULT NULL,
                `TableID` INT DEFAULT NULL,
                `ROWGUID` CHAR(38) DEFAULT NULL,
                `Action` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ittable`;
            CREATE TABLE `ittable`(
                `tableid` INT DEFAULT NULL,
                `name` VARCHAR(128) DEFAULT NULL,
                `platform` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `LocationBaselinePhotos`;
            CREATE TABLE `LocationBaselinePhotos`(
                `BaselinePhotoID` CHAR(38) DEFAULT NULL,
                `BaselineID` CHAR(38) DEFAULT NULL,
                `CameraInspectionID` CHAR(38) NULL,
                `Caption` VARCHAR(35) NULL,
                `FileName` VARCHAR(150) DEFAULT NULL,
                `Promotional` TINYINT NULL,
                `TechSYSUserID` CHAR(38) DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `LocationBaselines`;
            CREATE TABLE `LocationBaselines`(
                `BaselineID` CHAR(38) DEFAULT NULL,
                `LocationID` CHAR(38) DEFAULT NULL,
                `InspectionID` CHAR(38) DEFAULT NULL,
                `MeasuredBaseline` DOUBLE DEFAULT NULL,
                `AmbientBaseline` DOUBLE DEFAULT NULL,
                `CurrentThreshold` DOUBLE DEFAULT NULL,
                `CustomerNotes` VARCHAR(500) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `Locations`;
            CREATE TABLE `Locations`(
                `LocationID` CHAR(38) DEFAULT NULL,
                `CustomerSiteID` CHAR(38) DEFAULT NULL,
                `ParentID` CHAR(38) NULL,
                `Name` VARCHAR(100) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `BarCode` VARCHAR(35) NULL,
                `PriorityStatusID` CHAR(38) DEFAULT NULL,
                `InspectionCycle` INT NULL,
                `ManufacturerID` CHAR(38) NULL,
                `Threshold` DOUBLE NULL,
                `Benchmark` DOUBLE NULL,
                `RequireBaselinePhoto` TINYINT NULL,
                `RepairShutdownCost` DECIMAL(12,2) NULL,
                `ReplaceShutdownCost` DECIMAL(12,2) NULL,
                `InspectionTypeID` CHAR(38) NULL,
                `InspectionOrder` INT NULL,
                `InHouseNotes` VARCHAR(500) NULL,
                `PhotoFilename` VARCHAR(100) NULL,
                `SysIconID` CHAR(38) NULL,
                `Omit` TINYINT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` INT DEFAULT NULL,
                `InspectionProcedure` VARCHAR(500) NULL,
                `GPS` VARCHAR(50) NULL,
                `GPSType` VARCHAR(50) NULL,
                `Custom1` VARCHAR(50) NULL,
                `Custom2` VARCHAR(50) NULL,
                `Custom3` VARCHAR(50) NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL,
                `InspectionID` CHAR(38) NULL,
                `IsEquipment` TINYINT NULL,
                `AttachmentID` CHAR(38) NULL,
                `NextScheduledInspDate` DATETIME NULL,
                `LocationPath` VARCHAR(500) NULL,
                `EquipmentID` VARCHAR(50) NULL
            );
            
            
            DROP TABLE IF EXISTS `locationstemptable`;
            CREATE TABLE `locationstemptable`(
                `LocationID` CHAR(38) NULL,
                `ParentID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `LocationsWorkTable`;
            CREATE TABLE `LocationsWorkTable`(
                `LocationID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `Manufacturers`;
            CREATE TABLE `Manufacturers`(
                `ManufacturerID` CHAR(38) DEFAULT NULL,
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `Contact` VARCHAR(35) NULL,
                `Phone` VARCHAR(15) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `PIEConductors`;
            CREATE TABLE `PIEConductors`(
                `PIEConductorID` CHAR(38) DEFAULT NULL,
                `ShortName` VARCHAR(10) NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(50) NULL,
                `MeltTemperature` DOUBLE DEFAULT NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `PIEEnvironment`;
            CREATE TABLE `PIEEnvironment`(
                `PIEEnvironmentID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `Adjust` DOUBLE NULL,
                `SYSIconID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `PIEEquipment`;
            CREATE TABLE `PIEEquipment`(
                `PIEElectricalAddendumID` CHAR(38) DEFAULT NULL,
                `EquipmentID` CHAR(38) DEFAULT NULL,
                `CatalogNo` VARCHAR(35) NULL,
                `ModelNo` VARCHAR(35) NULL,
                `Size` VARCHAR(35) NULL,
                `RatedLoad` DOUBLE NULL,
                `CircuitVoltage` DOUBLE NULL,
                `LineSideConductorID` CHAR(38) NULL,
                `LoadSideConductorID` CHAR(38) NULL,
                `WireGauge` TINYINT NULL,
                `XfmrKVARating` DOUBLE NULL,
                `LineSideRating` DOUBLE NULL,
                `LoadSideRating` DOUBLE NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `PIEPhases`;
            CREATE TABLE `PIEPhases`(
                `PIEPhaseID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `PIEProblemInspections`;
            CREATE TABLE `PIEProblemInspections`(
                `PIEProblemInspectionID` CHAR(38) DEFAULT NULL,
                `ProblemInspectionID` CHAR(38) DEFAULT NULL,
                `RMSSamples` TINYINT NULL,
                `ReferencePhaseID` CHAR(38) NULL,
                `ReferenceTemperature` DOUBLE NULL,
                `ReferenceLoad` DOUBLE NULL,
                `ProblemPhaseID` CHAR(38) NULL,
                `ProblemTemperature` DOUBLE NULL,
                `ProblemLoad` DOUBLE NULL,
                `Voltage` DOUBLE NULL,
                `AmbientTemperature` DOUBLE NULL,
                `Windspeed` DOUBLE NULL,
                `PIEEnvironmentID` CHAR(38) NULL,
                `RatedLoad` DOUBLE NULL,
                `ProblemSeverityID` CHAR(38) NULL,
                `TrueRMSLoad_A` DOUBLE NULL,
                `TrueRMSLoad_B` DOUBLE NULL,
                `TrueRMSLoad_C` DOUBLE NULL,
                `TrueRMSLoad_N` DOUBLE NULL,
                `FreqOnNuetral` DOUBLE NULL,
                `NuetralToGroundVoltage` DOUBLE NULL,
                `IndirectTempMeas` TINYINT NULL,
                `SecondReferencePhaseID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `ProblemAssessment` VARCHAR(100) NULL
            );
            
            
            DROP TABLE IF EXISTS `PriorityStati`;
            CREATE TABLE `PriorityStati`(
                `PriorityStatusID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(35) DEFAULT NULL,
                `Description` VARCHAR(100) DEFAULT NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ProblemInspections`;
            CREATE TABLE `ProblemInspections`(
                `ProblemInspectionID` CHAR(38) DEFAULT NULL,
                `ProblemID` CHAR(38) DEFAULT NULL,
                `InspectionID` CHAR(38) DEFAULT NULL,
                `ProblemNo` INT DEFAULT NULL,
                `CustomerNotes` VARCHAR(500) NULL,
                `Evaluation` DOUBLE NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `InspectionDetailID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ProblemPhotos`;
            CREATE TABLE `ProblemPhotos`(
                `ProblemPhotoID` CHAR(38) DEFAULT NULL,
                `ProblemInspectionID` CHAR(38) DEFAULT NULL,
                `CameraInspectionID` CHAR(38) NULL,
                `Caption` VARCHAR(35) NULL,
                `PhotoFileName` VARCHAR(100) NULL,
                `Promotional` TINYINT DEFAULT NULL,
                `TechSYSUserID` CHAR(38) NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `PhotoDate` DATETIME NULL,
                `PhotoTime` VARCHAR(10) NULL,
                `IRFilename` VARCHAR(100) NULL,
                `IRDate` DATETIME NULL,
                `IRTime` VARCHAR(10) NULL,
                `IRCaption` VARCHAR(35) NULL
            );
            
            
            DROP TABLE IF EXISTS `ProblemRepairAttempt`;
            CREATE TABLE `ProblemRepairAttempt`(
                `RepairAttemptID` CHAR(38) DEFAULT NULL,
                `RootCauseActual` VARCHAR(255) NULL,
                `RepairProcedure` VARCHAR(255) NULL,
                `ConfirmedSYSUserID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `RepairStatusID` CHAR(38) DEFAULT NULL,
                `RepairStatusDate` DATETIME DEFAULT NULL,
                `RepairCostActual` DECIMAL(12,2) NULL,
                `RepairTimeActual` DOUBLE NULL,
                `ReplacementCostActual` DECIMAL(12,2) NULL,
                `ReplacementTimeActual` DOUBLE NULL,
                `Notes` VARCHAR(200) NULL,
                `IsRootCauseValidated` TINYINT DEFAULT NULL,
                `ValidationDate` DATETIME NULL,
                `ProblemID` CHAR(38) DEFAULT NULL,
                `Technician` VARCHAR(35) NULL,
                `RepairedDateActual` DATETIME NULL,
                `SysIconID` CHAR(38) NULL,
                `InspectionNo` INT NULL,
                `RepairNo` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `Problems`;
            CREATE TABLE `Problems`(
                `ProblemID` CHAR(38) DEFAULT NULL,
                `LocationID` CHAR(38) DEFAULT NULL,
                `EquipmentID` CHAR(38) DEFAULT NULL,
                `ComponentComment` VARCHAR(300) NULL,
                `FaultID` CHAR(38) DEFAULT NULL,
                `FaultType` VARCHAR(35) DEFAULT NULL,
                `RepairID` CHAR(38) NULL,
                `RepairProcedure` VARCHAR(255) NULL,
                `InspectionTypeID` CHAR(38) DEFAULT NULL,
                `EvaluationCriteriaID` CHAR(38) NULL,
                `Consequences` VARCHAR(255) NULL,
                `ProductionLossOnFailure` TINYINT DEFAULT NULL,
                `InHouseNotes` VARCHAR(255) NULL,
                `ManufacturerID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL,
                `IsChronic` TINYINT DEFAULT NULL,
                `PriorProblemID` CHAR(38) NULL,
                `RootCauseEstimate` VARCHAR(255) NULL,
                `ProblemStatus` TINYINT DEFAULT NULL,
                `ProblemStatusClosedDate` DATETIME NULL,
                `RepairedDateEstimate` DATETIME NULL,
                `ReinspectionScheduleDate` DATETIME NULL,
                `Custom1` VARCHAR(100) NULL,
                `Custom2` VARCHAR(100) NULL,
                `Custom3` VARCHAR(100) NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL,
                `SysIconID` CHAR(38) NULL,
                `AttachmentID` CHAR(38) NULL,
                `LaborCostPerHour` DOUBLE NULL,
                `EstimatedPartsCostAF` DOUBLE NULL,
                `EstimatedPartsCostBF` DOUBLE NULL,
                `EstimatedLaborHoursAF` DOUBLE NULL,
                `EstimatedLaborHoursBF` DOUBLE NULL,
                `EstimatedRevHoursBF` DOUBLE NULL,
                `EstimatedRevHoursAF` DOUBLE NULL,
                `EstimatedRevCostAF` DOUBLE NULL,
                `EstimatedRevCostBF` DOUBLE NULL,
                `PartListBF` VARCHAR(200) NULL,
                `PartListAF` VARCHAR(200) NULL,
                `PI1` VARCHAR(25) NULL,
                `PI2` VARCHAR(25) NULL,
                `PI3` VARCHAR(25) NULL,
                `PI4` VARCHAR(25) NULL,
                `PI5` VARCHAR(25) NULL,
                `PI6` VARCHAR(50) NULL,
                `PI7` VARCHAR(50) NULL,
                `PI8` VARCHAR(50) NULL,
                `PI9` VARCHAR(50) NULL,
                `PI10` VARCHAR(50) NULL,
                `PI11` VARCHAR(50) NULL,
                `PI12` VARCHAR(50) NULL,
                `PI13` VARCHAR(100) NULL,
                `PI14` VARCHAR(100) NULL,
                `ClosedOnInspectionNo` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `ProblemSeverity`;
            CREATE TABLE `ProblemSeverity`(
                `ProblemSeverityID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(20) DEFAULT NULL,
                `BaseFarenheit` INT DEFAULT NULL,
                `BaseFRange` VARCHAR(10) DEFAULT NULL,
                `BaseCentigrade` INT DEFAULT NULL,
                `BaseCRange` VARCHAR(10) DEFAULT NULL,
                `InspectionTypeID` CHAR(38) NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `AssessmentName` VARCHAR(100) NULL,
                `BaseAssessment` INT NULL,
                `BaseAssessmentRange` VARCHAR(100) NULL
            );
            
            
            DROP TABLE IF EXISTS `Providers`;
            CREATE TABLE `Providers`(
                `ProviderID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(100) DEFAULT NULL,
                `Logo` BLOB NULL,
                `Address` VARCHAR(200) NULL,
                `logo2` VARCHAR(50) NULL
            );
            
            
            DROP TABLE IF EXISTS `RepairStati`;
            CREATE TABLE `RepairStati`(
                `RepairStatusID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(50) DEFAULT NULL,
                `Description` VARCHAR(100) DEFAULT NULL,
                `SYSIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` TINYINT DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `ReplicationHistory`;
            CREATE TABLE `ReplicationHistory`(
                `ReplicationHistoryID` CHAR(38) DEFAULT NULL,
                `DateCheckOut` DATETIME NULL,
                `DateCheckIn` DATETIME NULL,
                `CustomerID` CHAR(38) NULL,
                `CustomerSiteID` CHAR(38) NULL,
                `InspectionID` CHAR(38) NULL,
                `UserID` CHAR(38) NULL,
                `Custom1` VARCHAR(100) NULL,
                `Custom2` VARCHAR(100) NULL,
                `Custom3` VARCHAR(100) NULL,
                `CustomGUID1` CHAR(38) NULL,
                `CustomGUID2` CHAR(38) NULL,
                `ScheduledCheckIn` DATETIME NULL
            );
            
            
            DROP TABLE IF EXISTS `Reports`;
            CREATE TABLE `Reports`(
                `ReportID` CHAR(38) DEFAULT NULL,
                `ReportName` VARCHAR(200) DEFAULT NULL,
                `ReportDesc` VARCHAR(100) NULL,
                `SysIconID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `Grouping` TINYINT NULL,
                `SortOrder` TINYINT NULL
            );
            
            
            DROP TABLE IF EXISTS `ReportVersion`;
            CREATE TABLE `ReportVersion`(
                `VersionNumber` INT NULL,
                `VersionDescription` VARCHAR(2000) NULL
            );
            
            
            DROP TABLE IF EXISTS `RootCause`;
            CREATE TABLE `RootCause`(
                `RootCauseID` CHAR(38) DEFAULT NULL,
                `RootCause` VARCHAR(255) DEFAULT NULL,
                `FaultID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `SysIconID` CHAR(38) NULL,
                `InspectionTypeID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `RootCauseRepairLinks`;
            CREATE TABLE `RootCauseRepairLinks`(
                `RootCauseRepairLinkID` CHAR(38) DEFAULT NULL,
                `RootCauseID` CHAR(38) NULL,
                `RepairID` CHAR(38) NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `RouteEquipment`;
            CREATE TABLE `RouteEquipment`(
                `RouteEquipmentID` CHAR(38) DEFAULT NULL,
                `RouteID` CHAR(38) DEFAULT NULL,
                `LocationID` CHAR(38) DEFAULT NULL,
                `RouteOrder` INT DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `Routes`;
            CREATE TABLE `Routes`(
                `RouteID` CHAR(38) DEFAULT NULL,
                `CustomerSiteID` CHAR(38) DEFAULT NULL,
                `Name` VARCHAR(100) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `DeleteFlag` INT DEFAULT NULL,
                `NextScheduled` DATETIME NULL,
                `Frequency` INT NULL,
                `Custom1` VARCHAR(50) NULL,
                `SysIconID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `SiteTypes`;
            CREATE TABLE `SiteTypes`(
                `SiteTypeID` CHAR(38) DEFAULT NULL,
                `TypeName` VARCHAR(100) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL,
                `LastModified` DATETIME DEFAULT NULL,
                `LastUserID` CHAR(38) DEFAULT NULL,
                `SysIconID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `tblExport`;
            CREATE TABLE `tblExport`(
                `ExportDate` DATETIME NULL,
                `ExportUserID` CHAR(38) NULL,
                `InspectionID` CHAR(38) NULL,
                `InspectionNo` INT NULL,
                `CustomerSiteID` CHAR(38) NULL,
                `LogVersion` INT NULL,
                `ImportedDate` DATETIME NULL,
                `OutFileName` VARCHAR(250) NULL,
                `UseType` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `tblTransaction`;
            CREATE TABLE `tblTransaction`(
                `TransactionID` VARCHAR(100) DEFAULT NULL,
                `TableName` VARCHAR(100) DEFAULT NULL,
                `ColumnName` VARCHAR(100) NULL,
                `SourceGUID` CHAR(38) DEFAULT NULL,
                `DestGUID` CHAR(38) NULL,
                `Action` VARCHAR(1) DEFAULT NULL,
                `CreateDate` DATETIME DEFAULT NULL,
                `CreateUserID` CHAR(38) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `TTOutfileConfig`;
            CREATE TABLE `TTOutfileConfig`(
                `TTUID` VARCHAR(4) NULL,
                `LocalBackUpFolder` VARCHAR(100) NULL,
                `LocalTDFPath` VARCHAR(100) NULL,
                `LocalTDEPath` VARCHAR(100) NULL,
                `LocalTDEBackupPath` VARCHAR(100) NULL,
                `TemplateFileNamePath` VARCHAR(100) NULL,
                `CatalogKeyFileName` VARCHAR(100) NULL,
                `FTPSite` VARCHAR(100) NULL,
                `FTPUserName` VARCHAR(100) NULL,
                `FTPPassword` VARCHAR(100) NULL,
                `FTPPath` VARCHAR(100) NULL,
                `SystemAdminEmail` VARCHAR(100) NULL,
                `SAEmailDEFAULTification` TINYINT NULL,
                `AdditionalEmail` VARCHAR(250) NULL,
                `KeyFolder` VARCHAR(250) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_AllClosedProblems`;
            CREATE TABLE `zrpt_AllClosedProblems`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteHeaderName` VARCHAR(500) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `CurrentInspectionNo` INT NULL,
                `Inspections_ScheduledStart` DATETIME NULL,
                `LastInspectionNo` INT NULL,
                `LastInspectionScheduledStart` DATETIME NULL,
                `InspectionID` CHAR(38) NULL,
                `InspectionNo` INT NULL,
                `LocationID` CHAR(38) NULL,
                `ProblemID` CHAR(38) NULL,
                `ProblemNo` INT NULL,
                `ProblemType` VARCHAR(5) NULL,
                `TempUnit` VARCHAR(1) NULL,
                `ProblemTempRise` DOUBLE NULL,
                `LocationPath` VARCHAR(500) NULL,
                `ComponentComment` VARCHAR(300) NULL,
                `ProblemSeverityName` VARCHAR(20) NULL,
                `PriorityStatusName` VARCHAR(35) NULL,
                `TestStatusName` VARCHAR(35) NULL,
                `PercentLoad` DOUBLE NULL,
                `AdjTempRise` DOUBLE NULL,
                `AdjTempUnit` VARCHAR(1) NULL,
                `RepairStatus` VARCHAR(20) NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `RequestID` CHAR(38) NULL,
                `Expiration` DATETIME NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_AllOpenProblems`;
            CREATE TABLE `zrpt_AllOpenProblems`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteHeaderName` VARCHAR(500) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `CurrentInspectionNo` INT NULL,
                `Inspections_ScheduledStart` DATETIME NULL,
                `LastInspectionNo` INT NULL,
                `LastInspectionScheduledStart` DATETIME NULL,
                `InspectionID` CHAR(38) NULL,
                `InspectionNo` INT NULL,
                `LocationID` CHAR(38) NULL,
                `ProblemID` CHAR(38) NULL,
                `ProblemNo` INT NULL,
                `ProblemType` VARCHAR(5) NULL,
                `TempUnit` VARCHAR(1) NULL,
                `ProblemTempRise` DOUBLE NULL,
                `LocationPath` VARCHAR(500) NULL,
                `ComponentComment` VARCHAR(300) NULL,
                `ProblemSeverityName` VARCHAR(20) NULL,
                `PriorityStatusName` VARCHAR(35) NULL,
                `TestStatusName` VARCHAR(35) NULL,
                `PercentLoad` DOUBLE NULL,
                `AdjTempRise` DOUBLE NULL,
                `AdjTempUnit` VARCHAR(1) NULL,
                `RepairStatus` VARCHAR(20) NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `RequestID` CHAR(38) NULL,
                `Expiration` DATETIME NULL,
                `Chronic` VARCHAR(5) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_BaselineTrending`;
            CREATE TABLE `zrpt_BaselineTrending`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteHeaderName` VARCHAR(500) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `Inspections_InspectionID` CHAR(38) NULL,
                `Inspections_InspectionNo` INT NULL,
                `Inspections_LastInspectionNo` INT NULL,
                `Inspections_ScheduledStart` DATETIME NULL,
                `LastInspectionScheduledStart` DATETIME NULL,
                `Locations_LocationID` CHAR(38) NULL,
                `InspectionDetails_TestStatus` VARCHAR(35) NULL,
                `InspectionDetails_TestStatusNote` VARCHAR(500) NULL,
                `LocationBaselines_ThresholdTemp` DOUBLE NULL,
                `LocationBaselines_MeasuredTemp` DOUBLE NULL,
                `LocationBaselines_AmbientTemp` DOUBLE NULL,
                `Locations_PhotoFileName` VARCHAR(100) NULL,
                `Locations_PhotoDate` DATETIME NULL,
                `Locations_PhotoTime` VARCHAR(10) NULL,
                `Locations_Barcode` VARCHAR(50) NULL,
                `Locations_ParentPath` VARCHAR(1000) NULL,
                `Locations_LocationPath` VARCHAR(1000) NULL,
                `Locations_LocationName` VARCHAR(100) NULL,
                `LocationBaselines_BaselineID` CHAR(38) NULL,
                `LocationBaselines_CustomerNotes` VARCHAR(500) NULL,
                `LocationBaselinePhotos_PhotoFilename` VARCHAR(150) NULL,
                `LocationBaselinePhotos_PhotosDate` DATETIME NULL,
                `LocationBaselinePhotos_PhotosTime` VARCHAR(10) NULL,
                `Locations_PhotoPathFileName` VARCHAR(150) NULL,
                `LocationBaselinePhotos_PhotosPathFileName` VARCHAR(150) NULL,
                `Detail_InspectionID` CHAR(38) NULL,
                `Detail_InspectionNo` INT NULL,
                `Detail_ScheduledStart` DATETIME NULL,
                `TempUnit` VARCHAR(1) NULL,
                `PriorityStatus` VARCHAR(35) NULL,
                `Manufacturer` VARCHAR(50) NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `RequestID` CHAR(38) NULL,
                `Expiration` DATETIME NULL,
                `Locations_OrderLevel` INT NULL,
                `PageNumber` INT NULL,
                `LatestBaselineInspectionNo` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_BaselineTrending_CurrentLocationID`;
            CREATE TABLE `zrpt_BaselineTrending_CurrentLocationID`(
                `CurrentLocationID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_BaselineTrending_Graph_Source`;
            CREATE TABLE `zrpt_BaselineTrending_Graph_Source`(
                `Label` VARCHAR(25) NULL,
                `Ambient` NUMERIC(28, 2) NULL,
                `Measured` NUMERIC(28, 2) NULL,
                `Threshold` NUMERIC(28, 2) NULL,
                `LocationID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_CostBenefit`;
            CREATE TABLE `zrpt_CostBenefit`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteHeaderName` VARCHAR(500) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `Inspections_InspectionID` CHAR(38) NULL,
                `Inspections_InspectionNo` INT NULL,
                `Inspections_LastInspectionNo` INT NULL,
                `Inspections_ScheduledStart` DATETIME NULL,
                `LastInspectionScheduledStart` DATETIME NULL,
                `Locations_LocationID` CHAR(38) NULL,
                `CurrentProblemInspectionID` CHAR(38) NULL,
                `CurrentProblemID` CHAR(38) NULL,
                `CurrentProblemNo` INT NULL,
                `CurrentProblemType` VARCHAR(5) NULL,
                `CurrentTempUnit` VARCHAR(1) NULL,
                `CurrentProblemTempRise` DOUBLE NULL,
                `PrevProblemNo` INT NULL,
                `PrevProblemType` VARCHAR(5) NULL,
                `PrevTempUnit` VARCHAR(1) NULL,
                `PrevProblemTempRise` DOUBLE NULL,
                `LocationPath` VARCHAR(1000) NULL,
                `LocationName` VARCHAR(100) NULL,
                `Problems_ComponentComment` VARCHAR(300) NULL,
                `ProblemSeverityName` VARCHAR(20) NULL,
                `PriorityStatusName` VARCHAR(35) NULL,
                `PercentLoad` DOUBLE NULL,
                `AdjTempRise` DOUBLE NULL,
                `PrevAdjTempRise` DOUBLE NULL,
                `AdjTempUnit` VARCHAR(1) NULL,
                `RepairStatus` VARCHAR(20) NULL,
                `PercentOfChange` DOUBLE NULL,
                `ProductionLossOnFailure` DOUBLE NULL,
                `Consequences` VARCHAR(250) NULL,
                `LaborCostPerHour` DOUBLE NULL,
                `EstimatedPartsCostBF` DOUBLE NULL,
                `EstimatedPartsCostAF` DOUBLE NULL,
                `EstimatedLaborHoursBF` DOUBLE NULL,
                `EstimatedLaborHoursAF` DOUBLE NULL,
                `EstimatedRevHoursBF` DOUBLE NULL,
                `EstimatedRevHoursAF` DOUBLE NULL,
                `EstimatedRevCostBF` DOUBLE NULL,
                `EstimatedRevCostAF` DOUBLE NULL,
                `SubLaborBF` DOUBLE NULL,
                `SubLaborAF` DOUBLE NULL,
                `LaborSaving` DOUBLE NULL,
                `SubLostRevBF` DOUBLE NULL,
                `SubLostRevAF` DOUBLE NULL,
                `LostRevSaving` DOUBLE NULL,
                `TotalCostBF` DOUBLE NULL,
                `TotalCostAF` DOUBLE NULL,
                `TotalSaving` DOUBLE NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `RequestID` CHAR(38) NULL,
                `Expiration` DATETIME NULL,
                `DetailInspectionNo` INT NULL,
                `Problems_LaborCostPerHourAF` DOUBLE NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_CoverPage`;
            CREATE TABLE `zrpt_CoverPage`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteName` VARCHAR(100) NULL,
                `CustomerSitesHeader` VARCHAR(500) NULL,
                `ccUsers_FileAs` VARCHAR(100) NULL,
                `ccUsers_Certification` VARCHAR(100) NULL,
                `Inspections_InspectionID` CHAR(38) NULL,
                `Inspections_InspectionNo` VARCHAR(10) NULL,
                `Inspections_ScheduledStart` DATETIME NULL,
                `LastInspectionID` VARCHAR(100) NULL,
                `LastInspectionNo` VARCHAR(100) NULL,
                `LastInspectionScheduledStart` DATETIME NULL,
                `ProblemSeverity_ProblemSeverityID` CHAR(38) NULL,
                `ProblemSeverity_Name` VARCHAR(50) NULL,
                `TempRiseRange` VARCHAR(50) NULL,
                `PCNT` INT NULL,
                `LPCNT` INT NULL,
                `INEW` INT NULL,
                `LINEW` INT NULL,
                `IREOCCUR` INT NULL,
                `LIREOCCUR` INT NULL,
                `LTN` INT NULL,
                `LNT` INT NULL,
                `IPCNT` VARCHAR(10) NULL,
                `LIPCNT` VARCHAR(10) NULL,
                `TotalOP` INT NULL,
                `PCNT_Percent` VARCHAR(50) NULL,
                `LPCNT_Percent` VARCHAR(50) NULL,
                `PCNT_PercentChange` VARCHAR(50) NULL,
                `INEW_Percent` VARCHAR(50) NULL,
                `LINEW_Percent` VARCHAR(50) NULL,
                `INEW_PercentChange` VARCHAR(50) NULL,
                `IREOCCUR_Percent` VARCHAR(50) NULL,
                `LIREOCCUR_Percent` VARCHAR(50) NULL,
                `IREOCCUR_PercentChange` VARCHAR(50) NULL,
                `IPCNT_Percent` VARCHAR(50) NULL,
                `LIPCNT_Percent` VARCHAR(50) NULL,
                `IPCNT_PercentChange` VARCHAR(50) NULL,
                `LNT_Text` VARCHAR(50) NULL,
                `TotalOP_Text` VARCHAR(50) NULL,
                `LTN_Text` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `TotalEQ` INT NULL,
                `TotalEQTested` INT NULL,
                `RequestID` CHAR(38) NULL,
                `Expiration` DATETIME NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage`;
            CREATE TABLE `zrpt_DocumentationPage` (
            `pkid` VARCHAR(100) DEFAULT NULL,
            `ProviderName` VARCHAR(100) DEFAULT NULL,
            `Customers_Name` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_SiteHeaderName` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Address` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_City` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_State` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Zip` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_CityStateZip` VARCHAR(100) DEFAULT NULL,
            `Manufacturers_Name` VARCHAR(100) DEFAULT NULL,
            `CCUsers_FileAs` VARCHAR(100) DEFAULT NULL,
            `CCUsers_Certification` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_PIEEnvironmentID` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_Name` VARCHAR(100) DEFAULT NULL,
            `EquipmentGroups_Name` VARCHAR(100) DEFAULT NULL,
            `LineSideConductor` VARCHAR(100) DEFAULT NULL,
            `LoadSideConductor` VARCHAR(100) DEFAULT NULL,
            `ProblemSeverity_Name` VARCHAR(100) DEFAULT NULL,
            `PriorityStati_Name` VARCHAR(100) DEFAULT NULL,
            `EvaluationCriteria_Tier2` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionID` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionNo` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledStart` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledEnd` VARCHAR(100) DEFAULT NULL,
            `Inspections_PhotoPath` VARCHAR(100) DEFAULT NULL,
            `Inspections_TemperatureUnit` VARCHAR(100) DEFAULT NULL,
            `InspectionTypes_Name` VARCHAR(100) DEFAULT NULL,
            `InspectionTypesProblemNo` VARCHAR(100) DEFAULT NULL,
            `InspectionNoProblemNo` VARCHAR(100) DEFAULT NULL,
            `Locations_Name` VARCHAR(100) DEFAULT NULL,
            `Locations_LocationPath` VARCHAR(100) DEFAULT NULL,
            `Problems_ProblemID` VARCHAR(100) DEFAULT NULL,
            `Problems_LocationID` VARCHAR(100) DEFAULT NULL,
            `Problems_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Problems_ComponentComment` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultID` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultType` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairID` VARCHAR(100) DEFAULT NULL,
            `Problems_PI1` VARCHAR(100) DEFAULT NULL,
            `Problems_PI2` VARCHAR(100) DEFAULT NULL,
            `Problems_PI3` VARCHAR(100) DEFAULT NULL,
            `Problems_PI4` VARCHAR(100) DEFAULT NULL,
            `Problems_PI5` VARCHAR(100) DEFAULT NULL,
            `Problems_PI6` VARCHAR(100) DEFAULT NULL,
            `Problems_PI7` VARCHAR(100) DEFAULT NULL,
            `Problems_PI8` VARCHAR(100) DEFAULT NULL,
            `Problems_PI9` VARCHAR(100) DEFAULT NULL,
            `Problems_PI10` VARCHAR(100) DEFAULT NULL,
            `Problems_PI11` VARCHAR(100) DEFAULT NULL,
            `Problems_PI12` VARCHAR(100) DEFAULT NULL,
            `Problems_PI13` VARCHAR(100) DEFAULT NULL,
            `Problems_PI14` VARCHAR(100) DEFAULT NULL,
            `Problems_Consequences` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListBF` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListAF` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHour` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_ProductionLossOnFailure` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemInspectionID` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemNo` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoFileName` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoTime` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRFilename` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRTime` VARCHAR(100) DEFAULT NULL,
            `PhotoPathFileName` VARCHAR(100) DEFAULT NULL,
            `IRPathFileName` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ReferenceTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ProblemTemperature` VARCHAR(100) DEFAULT NULL,
            `AdjTempRise` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt50` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt100` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_AmbientTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_Windspeed` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_A` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_B` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_C` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_N` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_FreqOnNuetral` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_NuetralToGroundVoltage` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_IndirectTempMeas` VARCHAR(100) DEFAULT NULL,
            `ProblemPhase` VARCHAR(100) DEFAULT NULL,
            `ReferencePhase` VARCHAR(100) DEFAULT NULL,
            `Harmonic` VARCHAR(100) DEFAULT NULL,
            `Chronic` VARCHAR(100) DEFAULT NULL,
            `MeltingTemp` VARCHAR(100) DEFAULT NULL,
            `TempRiseHistory` VARCHAR(100) DEFAULT NULL,
            `Equipment_EquipmentName` VARCHAR(100) DEFAULT NULL,
            `Problems_RootcauseEstimate` VARCHAR(100) DEFAULT NULL,
            `Faults_Fault` VARCHAR(100) DEFAULT NULL,
            `Locations_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Logo` VARCHAR(100) DEFAULT NULL,
            `RequestID` VARCHAR(100) DEFAULT NULL,
            `Expiration` VARCHAR(100) DEFAULT NULL,
            `ProblemPhaseName` VARCHAR(100) DEFAULT NULL,
            `ReferencePhaseName` VARCHAR(100) DEFAULT NULL,
            `PercentofRatedLoad` VARCHAR(100) DEFAULT NULL,
            `SupervisorFileAs` VARCHAR(100) DEFAULT NULL,
            `SupervisorCertification` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_CreateDate` VARCHAR(100) DEFAULT NULL,
            `TPMNumber` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHourAF` VARCHAR(100) DEFAULT NULL,
            `SecondReferencePhaseName` VARCHAR(100) DEFAULT NULL,
            `WorkOrderNumber` VARCHAR(100) DEFAULT NULL,
            `RepairDate` VARCHAR(100) DEFAULT NULL,
            `RepairedBy` VARCHAR(100) DEFAULT NULL,
            `Rootcause` VARCHAR(100) DEFAULT NULL,
            `RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `RepairNotes` VARCHAR(100) DEFAULT NULL,
            `Barcode` VARCHAR(100) DEFAULT NULL,
            `ProblemAssessment` VARCHAR(100) DEFAULT NULL,
            `TestStatus` VARCHAR(100) DEFAULT NULL,
            `TestStatusNotes` VARCHAR(100) DEFAULT NULL,
            `AssessmentNotes` VARCHAR(100) DEFAULT NULL
            ) 
            ;
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_CurrentProblemID`;
            CREATE TABLE `zrpt_DocumentationPage_CurrentProblemID`(
                `pkid` CHAR(38) DEFAULT NULL,
                `CurrentProblemID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_Graph_Source`;
            CREATE TABLE `zrpt_DocumentationPage_Graph_Source`(
                `pkid` CHAR(38) DEFAULT NULL,
                `Label` VARCHAR(25) NULL,
                `Problem` NUMERIC(28, 2) NULL,
                `Reference` NUMERIC(28, 2) NULL,
                `iORDER` INT NULL,
                `ProblemID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_Graph_Source_MC`;
            CREATE TABLE `zrpt_DocumentationPage_Graph_Source_MC`(
                `pkid` CHAR(38) DEFAULT NULL,
                `Label` VARCHAR(25) NULL,
                `Problem` NUMERIC(28, 2) NULL,
                `Reference` NUMERIC(28, 2) NULL,
                `iORDER` INT NULL,
                `ProblemID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_Graph_Source_TD`;
            CREATE TABLE `zrpt_DocumentationPage_Graph_Source_TD`(
                `pkid` CHAR(38) DEFAULT NULL,
                `Label` VARCHAR(25) NULL,
                `Problem` NUMERIC(28, 2) NULL,
                `Reference` NUMERIC(28, 2) NULL,
                `iORDER` INT NULL,
                `ProblemID` CHAR(38) NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_MC`;
            CREATE TABLE `zrpt_DocumentationPage_MC` (
            `pkid` VARCHAR(100) DEFAULT NULL,
            `ProviderName` VARCHAR(100) DEFAULT NULL,
            `Customers_Name` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_SiteHeaderName` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Address` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_City` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_State` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Zip` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_CityStateZip` VARCHAR(100) DEFAULT NULL,
            `Manufacturers_Name` VARCHAR(100) DEFAULT NULL,
            `CCUsers_FileAs` VARCHAR(100) DEFAULT NULL,
            `CCUsers_Certification` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_PIEEnvironmentID` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_Name` VARCHAR(100) DEFAULT NULL,
            `EquipmentGroups_Name` VARCHAR(100) DEFAULT NULL,
            `LineSideConductor` VARCHAR(100) DEFAULT NULL,
            `LoadSideConductor` VARCHAR(100) DEFAULT NULL,
            `ProblemSeverity_Name` VARCHAR(100) DEFAULT NULL,
            `PriorityStati_Name` VARCHAR(100) DEFAULT NULL,
            `EvaluationCriteria_Tier2` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionID` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionNo` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledStart` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledEnd` VARCHAR(100) DEFAULT NULL,
            `Inspections_PhotoPath` VARCHAR(100) DEFAULT NULL,
            `Inspections_TemperatureUnit` VARCHAR(100) DEFAULT NULL,
            `InspectionTypes_Name` VARCHAR(100) DEFAULT NULL,
            `InspectionTypesProblemNo` VARCHAR(100) DEFAULT NULL,
            `InspectionNoProblemNo` VARCHAR(100) DEFAULT NULL,
            `Locations_Name` VARCHAR(100) DEFAULT NULL,
            `Locations_LocationPath` VARCHAR(100) DEFAULT NULL,
            `Problems_ProblemID` VARCHAR(100) DEFAULT NULL,
            `Problems_LocationID` VARCHAR(100) DEFAULT NULL,
            `Problems_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Problems_ComponentComment` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultID` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultType` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairID` VARCHAR(100) DEFAULT NULL,
            `Problems_PI1` VARCHAR(100) DEFAULT NULL,
            `Problems_PI2` VARCHAR(100) DEFAULT NULL,
            `Problems_PI3` VARCHAR(100) DEFAULT NULL,
            `Problems_PI4` VARCHAR(100) DEFAULT NULL,
            `Problems_PI5` VARCHAR(100) DEFAULT NULL,
            `Problems_PI6` VARCHAR(100) DEFAULT NULL,
            `Problems_PI7` VARCHAR(100) DEFAULT NULL,
            `Problems_PI8` VARCHAR(100) DEFAULT NULL,
            `Problems_PI9` VARCHAR(100) DEFAULT NULL,
            `Problems_PI10` VARCHAR(100) DEFAULT NULL,
            `Problems_PI11` VARCHAR(100) DEFAULT NULL,
            `Problems_PI12` VARCHAR(100) DEFAULT NULL,
            `Problems_PI13` VARCHAR(100) DEFAULT NULL,
            `Problems_PI14` VARCHAR(100) DEFAULT NULL,
            `Problems_Consequences` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListBF` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListAF` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHour` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_ProductionLossOnFailure` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemInspectionID` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemNo` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoFileName` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoTime` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRFilename` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRTime` VARCHAR(100) DEFAULT NULL,
            `PhotoPathFileName` VARCHAR(100) DEFAULT NULL,
            `IRPathFileName` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ReferenceTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ProblemTemperature` VARCHAR(100) DEFAULT NULL,
            `AdjTempRise` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt50` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt100` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_AmbientTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_Windspeed` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_A` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_B` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_C` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_N` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_FreqOnNuetral` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_NuetralToGroundVoltage` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_IndirectTempMeas` VARCHAR(100) DEFAULT NULL,
            `ProblemPhase` VARCHAR(100) DEFAULT NULL,
            `ReferencePhase` VARCHAR(100) DEFAULT NULL,
            `Harmonic` VARCHAR(100) DEFAULT NULL,
            `Chronic` VARCHAR(100) DEFAULT NULL,
            `MeltingTemp` VARCHAR(100) DEFAULT NULL,
            `TempRiseHistory` VARCHAR(100) DEFAULT NULL,
            `Equipment_EquipmentName` VARCHAR(100) DEFAULT NULL,
            `Problems_RootcauseEstimate` VARCHAR(100) DEFAULT NULL,
            `Faults_Fault` VARCHAR(100) DEFAULT NULL,
            `Locations_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Logo` VARCHAR(100) DEFAULT NULL,
            `RequestID` VARCHAR(100) DEFAULT NULL,
            `Expiration` VARCHAR(100) DEFAULT NULL,
            `PercentofRatedLoad` VARCHAR(100) DEFAULT NULL,
            `SupervisorFileAs` VARCHAR(100) DEFAULT NULL,
            `SupervisorCertification` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_CreateDate` VARCHAR(100) DEFAULT NULL,
            `TPMNumber` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHourAF` VARCHAR(100) DEFAULT NULL,
            `WorkOrderNumber` VARCHAR(100) DEFAULT NULL,
            `RepairDate` VARCHAR(100) DEFAULT NULL,
            `RepairedBy` VARCHAR(100) DEFAULT NULL,
            `Rootcause` VARCHAR(100) DEFAULT NULL,
            `RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `RepairNotes` VARCHAR(100) DEFAULT NULL,
            `Barcode` VARCHAR(100) DEFAULT NULL,
            `ProblemAssessment` VARCHAR(100) DEFAULT NULL,
            `TestStatus` VARCHAR(100) DEFAULT NULL,
            `TestStatusNotes` VARCHAR(100) DEFAULT NULL,
            `AssessmentNotes` VARCHAR(100) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_TD`;
            CREATE TABLE `zrpt_DocumentationPage_TD` (
            `pkid` VARCHAR(100) DEFAULT NULL,
            `ProviderName` VARCHAR(100) DEFAULT NULL,
            `Customers_Name` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_SiteHeaderName` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Address` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_City` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_State` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Zip` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_CityStateZip` VARCHAR(100) DEFAULT NULL,
            `Manufacturers_Name` VARCHAR(100) DEFAULT NULL,
            `CCUsers_FileAs` VARCHAR(100) DEFAULT NULL,
            `CCUsers_Certification` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_PIEEnvironmentID` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_Name` VARCHAR(100) DEFAULT NULL,
            `EquipmentGroups_Name` VARCHAR(100) DEFAULT NULL,
            `LineSideConductor` VARCHAR(100) DEFAULT NULL,
            `LoadSideConductor` VARCHAR(100) DEFAULT NULL,
            `ProblemSeverity_Name` VARCHAR(100) DEFAULT NULL,
            `PriorityStati_Name` VARCHAR(100) DEFAULT NULL,
            `EvaluationCriteria_Tier2` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionID` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionNo` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledStart` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledEnd` VARCHAR(100) DEFAULT NULL,
            `Inspections_PhotoPath` VARCHAR(100) DEFAULT NULL,
            `Inspections_TemperatureUnit` VARCHAR(100) DEFAULT NULL,
            `InspectionTypes_Name` VARCHAR(100) DEFAULT NULL,
            `InspectionTypesProblemNo` VARCHAR(100) DEFAULT NULL,
            `InspectionNoProblemNo` VARCHAR(100) DEFAULT NULL,
            `Locations_Name` VARCHAR(100) DEFAULT NULL,
            `Locations_LocationPath` VARCHAR(100) DEFAULT NULL,
            `Problems_ProblemID` VARCHAR(100) DEFAULT NULL,
            `Problems_LocationID` VARCHAR(100) DEFAULT NULL,
            `Problems_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Problems_ComponentComment` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultID` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultType` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairID` VARCHAR(100) DEFAULT NULL,
            `Problems_PI1` VARCHAR(100) DEFAULT NULL,
            `Problems_PI2` VARCHAR(100) DEFAULT NULL,
            `Problems_PI3` VARCHAR(100) DEFAULT NULL,
            `Problems_PI4` VARCHAR(100) DEFAULT NULL,
            `Problems_PI5` VARCHAR(100) DEFAULT NULL,
            `Problems_PI6` VARCHAR(100) DEFAULT NULL,
            `Problems_PI7` VARCHAR(100) DEFAULT NULL,
            `Problems_PI8` VARCHAR(100) DEFAULT NULL,
            `Problems_PI9` VARCHAR(100) DEFAULT NULL,
            `Problems_PI10` VARCHAR(100) DEFAULT NULL,
            `Problems_PI11` VARCHAR(100) DEFAULT NULL,
            `Problems_PI12` VARCHAR(100) DEFAULT NULL,
            `Problems_PI13` VARCHAR(100) DEFAULT NULL,
            `Problems_PI14` VARCHAR(100) DEFAULT NULL,
            `Problems_Consequences` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListBF` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListAF` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHour` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_ProductionLossOnFailure` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemInspectionID` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemNo` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoFileName` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoTime` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRFilename` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRTime` VARCHAR(100) DEFAULT NULL,
            `PhotoPathFileName` VARCHAR(100) DEFAULT NULL,
            `IRPathFileName` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ReferenceTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ProblemTemperature` VARCHAR(100) DEFAULT NULL,
            `AdjTempRise` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt50` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt100` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_AmbientTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_Windspeed` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_A` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_B` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_C` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_N` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_FreqOnNuetral` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_NuetralToGroundVoltage` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_IndirectTempMeas` VARCHAR(100) DEFAULT NULL,
            `ProblemPhase` VARCHAR(100) DEFAULT NULL,
            `ReferencePhase` VARCHAR(100) DEFAULT NULL,
            `Harmonic` VARCHAR(100) DEFAULT NULL,
            `Chronic` VARCHAR(100) DEFAULT NULL,
            `MeltingTemp` VARCHAR(100) DEFAULT NULL,
            `TempRiseHistory` VARCHAR(100) DEFAULT NULL,
            `Equipment_EquipmentName` VARCHAR(100) DEFAULT NULL,
            `Problems_RootcauseEstimate` VARCHAR(100) DEFAULT NULL,
            `Faults_Fault` VARCHAR(100) DEFAULT NULL,
            `Locations_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Logo` VARCHAR(100) DEFAULT NULL,
            `RequestID` VARCHAR(100) DEFAULT NULL,
            `Expiration` VARCHAR(100) DEFAULT NULL,
            `ProblemPhaseName` VARCHAR(100) DEFAULT NULL,
            `ReferencePhaseName` VARCHAR(100) DEFAULT NULL,
            `PercentofRatedLoad` VARCHAR(100) DEFAULT NULL,
            `SupervisorFileAs` VARCHAR(100) DEFAULT NULL,
            `SupervisorCertification` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_CreateDate` VARCHAR(100) DEFAULT NULL,
            `TPMNumber` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHourAF` VARCHAR(100) DEFAULT NULL,
            `SecondReferencePhaseName` VARCHAR(100) DEFAULT NULL,
            `WorkOrderNumber` VARCHAR(100) DEFAULT NULL,
            `RepairDate` VARCHAR(100) DEFAULT NULL,
            `RepairedBy` VARCHAR(100) DEFAULT NULL,
            `Rootcause` VARCHAR(100) DEFAULT NULL,
            `RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `RepairNotes` VARCHAR(100) DEFAULT NULL,
            `Barcode` VARCHAR(100) DEFAULT NULL,
            `ProblemAssessment` VARCHAR(100) DEFAULT NULL,
            `TestStatus` VARCHAR(100) DEFAULT NULL,
            `TestStatusNotes` VARCHAR(100) DEFAULT NULL,
            `AssessmentNotes` VARCHAR(100) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_DocumentationPage_VS`;
            CREATE TABLE `zrpt_DocumentationPage_VS` (
            `pkid` VARCHAR(100) DEFAULT NULL,
            `ProviderName` VARCHAR(100) DEFAULT NULL,
            `Customers_Name` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_SiteHeaderName` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Address` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_City` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_State` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_Zip` VARCHAR(100) DEFAULT NULL,
            `CustomerSites_CityStateZip` VARCHAR(100) DEFAULT NULL,
            `Manufacturers_Name` VARCHAR(100) DEFAULT NULL,
            `CCUsers_FileAs` VARCHAR(100) DEFAULT NULL,
            `CCUsers_Certification` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_PIEEnvironmentID` VARCHAR(100) DEFAULT NULL,
            `PIEEnvironment_Name` VARCHAR(100) DEFAULT NULL,
            `EquipmentGroups_Name` VARCHAR(100) DEFAULT NULL,
            `LineSideConductor` VARCHAR(100) DEFAULT NULL,
            `LoadSideConductor` VARCHAR(100) DEFAULT NULL,
            `ProblemSeverity_Name` VARCHAR(100) DEFAULT NULL,
            `PriorityStati_Name` VARCHAR(100) DEFAULT NULL,
            `EvaluationCriteria_Tier2` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionID` VARCHAR(100) DEFAULT NULL,
            `Inspections_InspectionNo` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledStart` VARCHAR(100) DEFAULT NULL,
            `Inspections_ScheduledEnd` VARCHAR(100) DEFAULT NULL,
            `Inspections_PhotoPath` VARCHAR(100) DEFAULT NULL,
            `Inspections_TemperatureUnit` VARCHAR(100) DEFAULT NULL,
            `InspectionTypes_Name` VARCHAR(100) DEFAULT NULL,
            `InspectionTypesProblemNo` VARCHAR(100) DEFAULT NULL,
            `InspectionNoProblemNo` VARCHAR(100) DEFAULT NULL,
            `Locations_Name` VARCHAR(100) DEFAULT NULL,
            `Locations_LocationPath` VARCHAR(100) DEFAULT NULL,
            `Problems_ProblemID` VARCHAR(100) DEFAULT NULL,
            `Problems_LocationID` VARCHAR(100) DEFAULT NULL,
            `Problems_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Problems_ComponentComment` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultID` VARCHAR(100) DEFAULT NULL,
            `Problems_FaultType` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairID` VARCHAR(100) DEFAULT NULL,
            `Problems_PI1` VARCHAR(100) DEFAULT NULL,
            `Problems_PI2` VARCHAR(100) DEFAULT NULL,
            `Problems_PI3` VARCHAR(100) DEFAULT NULL,
            `Problems_PI4` VARCHAR(100) DEFAULT NULL,
            `Problems_PI5` VARCHAR(100) DEFAULT NULL,
            `Problems_PI6` VARCHAR(100) DEFAULT NULL,
            `Problems_PI7` VARCHAR(100) DEFAULT NULL,
            `Problems_PI8` VARCHAR(100) DEFAULT NULL,
            `Problems_PI9` VARCHAR(100) DEFAULT NULL,
            `Problems_PI10` VARCHAR(100) DEFAULT NULL,
            `Problems_PI11` VARCHAR(100) DEFAULT NULL,
            `Problems_PI12` VARCHAR(100) DEFAULT NULL,
            `Problems_PI13` VARCHAR(100) DEFAULT NULL,
            `Problems_PI14` VARCHAR(100) DEFAULT NULL,
            `Problems_Consequences` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListBF` VARCHAR(100) DEFAULT NULL,
            `Problems_PartListAF` VARCHAR(100) DEFAULT NULL,
            `Problems_RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedPartsCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedLaborHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHour` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevCostAF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursBF` VARCHAR(100) DEFAULT NULL,
            `Problems_EstimatedRevHoursAF` VARCHAR(100) DEFAULT NULL,
            `Problems_ProductionLossOnFailure` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemInspectionID` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_ProblemNo` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoFileName` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_PhotoTime` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRFilename` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRDate` VARCHAR(100) DEFAULT NULL,
            `ProblemPhotos_IRTime` VARCHAR(100) DEFAULT NULL,
            `PhotoPathFileName` VARCHAR(100) DEFAULT NULL,
            `IRPathFileName` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ReferenceTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_ProblemTemperature` VARCHAR(100) DEFAULT NULL,
            `AdjTempRise` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt50` VARCHAR(100) DEFAULT NULL,
            `TempRiseAt100` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_AmbientTemperature` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_Windspeed` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_A` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_B` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_C` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_TrueRMSLoad_N` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_FreqOnNuetral` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_NuetralToGroundVoltage` VARCHAR(100) DEFAULT NULL,
            `PIEProblemInspections_IndirectTempMeas` VARCHAR(100) DEFAULT NULL,
            `ProblemPhase` VARCHAR(100) DEFAULT NULL,
            `ReferencePhase` VARCHAR(100) DEFAULT NULL,
            `Harmonic` VARCHAR(100) DEFAULT NULL,
            `Chronic` VARCHAR(100) DEFAULT NULL,
            `MeltingTemp` VARCHAR(100) DEFAULT NULL,
            `TempRiseHistory` VARCHAR(100) DEFAULT NULL,
            `Equipment_EquipmentName` VARCHAR(100) DEFAULT NULL,
            `Problems_RootcauseEstimate` VARCHAR(100) DEFAULT NULL,
            `Faults_Fault` VARCHAR(100) DEFAULT NULL,
            `Locations_EquipmentID` VARCHAR(100) DEFAULT NULL,
            `Logo` VARCHAR(100) DEFAULT NULL,
            `RequestID` VARCHAR(100) DEFAULT NULL,
            `Expiration` VARCHAR(100) DEFAULT NULL,
            `PercentofRatedLoad` VARCHAR(100) DEFAULT NULL,
            `SupervisorFileAs` VARCHAR(100) DEFAULT NULL,
            `SupervisorCertification` VARCHAR(100) DEFAULT NULL,
            `ProblemInspections_CreateDate` VARCHAR(100) DEFAULT NULL,
            `Problems_LaborCostPerHourAF` VARCHAR(100) DEFAULT NULL,
            `WorkOrderNumber` VARCHAR(100) DEFAULT NULL,
            `RepairDate` VARCHAR(100) DEFAULT NULL,
            `RepairedBy` VARCHAR(100) DEFAULT NULL,
            `Rootcause` VARCHAR(100) DEFAULT NULL,
            `RepairProcedure` VARCHAR(100) DEFAULT NULL,
            `RepairNotes` VARCHAR(100) DEFAULT NULL,
            `Barcode` VARCHAR(100) DEFAULT NULL,
            `ProblemAssessment` VARCHAR(100) DEFAULT NULL,
            `TestStatus` VARCHAR(100) DEFAULT NULL,
            `TestStatusNotes` VARCHAR(100) DEFAULT NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_InspectionInventory`;
            CREATE TABLE `zrpt_InspectionInventory`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteName` VARCHAR(100) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `RegisterOwner` VARCHAR(100) NULL,
                `InspectionID` CHAR(38) NULL,
                `InspectionNo` INT NULL,
                `TestStatus` VARCHAR(50) NULL,
                `NextInspectionDate` DATETIME NULL,
                `PriorityStatus` VARCHAR(50) NULL,
                `ProblemNo` VARCHAR(500) NULL,
                `Barcode` VARCHAR(50) NULL,
                `LocationID` CHAR(38) NULL,
                `ParentPath` VARCHAR(1000) NULL,
                `LocationPath` VARCHAR(1000) NULL,
                `LocationName` VARCHAR(100) NULL,
                `StatusNotes` VARCHAR(250) NULL,
                `InspectionSchduledStart` DATETIME NULL,
                `LastInspectionNo` INT NULL,
                `InspectionOrder` INT NULL,
                `IsEquipment` TINYINT NULL,
                `RequestID` CHAR(38) NULL,
                `ExpirationDate` DATETIME NULL,
                `GroupLevel` VARCHAR(10) NULL,
                `OrderLevel` INT NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `InspectedBy` VARCHAR(100) NULL,
                `TotalEQ` INT NULL,
                `TotalEQTested` INT NULL
            );
            
            
            DROP TABLE IF EXISTS `zrpt_InspectionInventoryWithHistory`;
            CREATE TABLE `zrpt_InspectionInventoryWithHistory`(
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteName` VARCHAR(100) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `RegisterOwner` VARCHAR(100) NULL,
                `InspectionID` CHAR(38) NULL,
                `InspectionNo` INT NULL,
                `LocationID` CHAR(38) NULL,
                `ParentPath` VARCHAR(1000) NULL,
                `LocationPath` VARCHAR(1000) NULL,
                `LocationName` VARCHAR(100) NULL,
                `InspectionSchduledStart` DATETIME NULL,
                `LastInspectionNo` INT NULL,
                `InspectionOrder` INT NULL,
                `IsEquipment` TINYINT NULL,
                `GroupLevel` VARCHAR(10) NULL,
                `OrderLevel` INT NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `InspectedBy` VARCHAR(100) NULL,
                `Inspection1` DATETIME NULL,
                `Inspection2` DATETIME NULL,
                `Inspection3` DATETIME NULL,
                `Inspection4` DATETIME NULL,
                `Inspection5` DATETIME NULL,
                `InspectionData1` VARCHAR(50) NULL,
                `InspectionData2` VARCHAR(50) NULL,
                `InspectionData3` VARCHAR(50) NULL,
                `InspectionData4` VARCHAR(50) NULL,
                `InspectionData5` VARCHAR(50) NULL,
                `TextColor1` VARCHAR(50) NULL,
                `TextColor2` VARCHAR(50) NULL,
                `TextColor3` VARCHAR(50) NULL,
                `TextColor4` VARCHAR(50) NULL,
                `TextColor5` VARCHAR(50) NULL,
                `InspectionNo1` INT NULL,
                `InspectionNo2` INT NULL,
                `InspectionNo3` INT NULL,
                `InspectionNo4` INT NULL,
                `InspectionNo5` INT NULL,
                `Barcode` VARCHAR(50) NULL
            );

            
            DROP TABLE IF EXISTS `zrpt_ListOfProblemsByInspID`;
            CREATE TABLE `zrpt_ListOfProblemsByInspID`(
                `pkid` CHAR(38) DEFAULT NULL,
                `ProviderName` VARCHAR(100) NULL,
                `Customers_Name` VARCHAR(100) NULL,
                `CustomerSites_SiteHeaderName` VARCHAR(500) NULL,
                `CustomerSites_Address` VARCHAR(250) NULL,
                `CustomerSites_City` VARCHAR(50) NULL,
                `CustomerSites_State` VARCHAR(50) NULL,
                `CustomerSites_Zip` VARCHAR(15) NULL,
                `CustomerSites_CityStateZip` VARCHAR(100) NULL,
                `Inspections_InspectionID` CHAR(38) NULL,
                `Inspections_InspectionNo` INT NULL,
                `Inspections_LastInspectionNo` INT NULL,
                `Inspections_ScheduledStart` DATETIME NULL,
                `LastInspectionScheduledStart` DATETIME NULL,
                `Locations_LocationID` CHAR(38) NULL,
                `CurrentProblemInspectionID` CHAR(38) NULL,
                `CurrentProblemID` CHAR(38) NULL,
                `CurrentProblemNo` INT NULL,
                `CurrentProblemType` VARCHAR(5) NULL,
                `CurrentTempUnit` VARCHAR(1) NULL,
                `CurrentProblemTempRise` DOUBLE NULL,
                `PrevProblemNo` INT NULL,
                `PrevProblemType` VARCHAR(5) NULL,
                `PrevTempUnit` VARCHAR(1) NULL,
                `PrevProblemTempRise` DOUBLE NULL,
                `LocationPath` VARCHAR(500) NULL,
                `Problems_ComponentComment` VARCHAR(300) NULL,
                `ProblemSeverityName` VARCHAR(20) NULL,
                `PriorityStatusName` VARCHAR(35) NULL,
                `PercentLoad` DOUBLE NULL,
                `AdjTempRise` DOUBLE NULL,
                `AdjTempUnit` VARCHAR(1) NULL,
                `RepairStatus` VARCHAR(20) NULL,
                `Locations_EquipmentID` VARCHAR(50) NULL,
                `Logo` VARCHAR(50) NULL,
                `RequestID` CHAR(38) NULL,
                `Expiration` DATETIME NULL,
                `Chronic` VARCHAR(5) NULL,
                `DetailInspectionNo` INT NULL
            );

            /*View structure for view cronicos_actual */
            DROP VIEW IF EXISTS `cronicos_actual`;
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cronicos_actual` AS (select `ppi`.`PIEProblemInspectionID` AS `Id_Problema`,`ppi`.`ProblemInspectionID` AS `ProblemInspectionID`,`proins`.`ProblemID` AS `ProblemID`,`proins`.`InspectionID` AS `Id_Inspeccion`, (SELECT `CustomerSiteID` FROM `inspections` AS `ins` WHERE `ins`.`InspectionID` = `proins`.`InspectionID`) AS `Id_Sitio` from (`pieprobleminspections` `ppi` join `probleminspections` `proins` on(`proins`.`ProblemInspectionID` = `ppi`.`ProblemInspectionID`)) where `ppi`.`ProblemInspectionID` in (select `pins`.`ProblemInspectionID` from `probleminspections` `pins` where `pins`.`ProblemID` in (select `p`.`ProblemID` from `problems` `p` where `p`.`IsChronic` = 1)) and `proins`.`InspectionID` = (select `inspections`.`InspectionID` from `inspections` where `inspections`.`InspectionNo` = (select max(`inspections`.`InspectionNo`) from `inspections`)));
            
            /*View structure for view cronicos_anteriores */
            DROP VIEW IF EXISTS `cronicos_anteriores`;
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cronicos_anteriores` AS (select `ppi`.`PIEProblemInspectionID` AS `Id_Problema`,`ppi`.`ProblemInspectionID` AS `ProblemInspectionID`,`proins`.`ProblemID` AS `ProblemID`,`proins`.`InspectionID` AS `Id_Inspeccion` from (`pieprobleminspections` `ppi` join `probleminspections` `proins` on(`proins`.`ProblemInspectionID` = `ppi`.`ProblemInspectionID`)) where `ppi`.`ProblemInspectionID` in (select `pins`.`ProblemInspectionID` from `probleminspections` `pins` where `pins`.`ProblemID` in (select `p`.`ProblemID` from `problems` `p` where `p`.`IsChronic` = 1)) and `proins`.`InspectionID` = (select `inspections`.`InspectionID` from `inspections` where `inspections`.`InspectionNo` = (select `inspections`.`LastInspectionNo` from `inspections` where `inspections`.`InspectionNo` = (select max(`inspections`.`InspectionNo`) from `inspections`))));

            /* SENTENCIAS DE INSERT PARA AGREGAR TODOS LOS DATOS ASUS RESPECTIVAS TABLAS */
            '.$script_insert.';
            
            /* USAMOS LA BASE QUE USARA EL SISTEMA ACTUAL QUE SE CREO EN UN INICIO*/
            USE `u695808356_etic_system_db`;
            
            /* CREAMOS LAS TABLAS A PARTIR DEL RESULTADO DE CONSULTAR LA INFORMACION DE CADA TABLA DE LA BASE DEL SISTEMA ANTERIOR */
            INSERT INTO causa_principal 
            SELECT
                UPPER(RootCauseID) AS Id_Causa_Raiz
                ,UPPER(InspectionTypeID) AS Id_Tipo_Inspeccion
                ,UPPER(FaultID) AS Id_Falla
                ,RootCause AS Causa_Raiz
                ,"Activo" AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion 
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.rootcause AS causa_principal;

            INSERT INTO clientes 
            SELECT
                UPPER(CustomerID) AS Id_Cliente
                ,UPPER(NULL) AS Id_Compania
                ,UPPER(NULL) AS Id_Giro
                ,NAME AS Razon_Social
                ,NAME AS Nombre_Comercial
                ,NULL AS RFC
                ,NULL AS Imagen_Cliente
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion 
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.customers AS Clientes;

            INSERT INTO equipos 
            SELECT
                UPPER(Equipos.EquipmentID) AS Id_Equipo
                ,Equipos.Name AS Equipo
                ,Equipos.Description AS Descr_equipo
                ,IF(Equipos.DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(Equipos.CreateUserID) AS Creado_Por
                ,Equipos.CreateDate AS Fecha_Creacion
                ,UPPER(Equipos.LastUserID) AS Modificado_Por
                ,Equipos.LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion 
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.equipment AS Equipos;

            INSERT INTO fabricantes 
            SELECT
                UPPER(ManufacturerID) AS Id_Fabricante
                ,UPPER(InspectionTypeID) AS Id_Tipo_Inspeccion
                ,fabricantes.Name AS Fabricante
                ,Description AS Desc_Fabricante
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion 
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.manufacturers AS fabricantes;

            INSERT INTO fallas 
            SELECT
                UPPER(FaultID) AS Id_Falla
                ,UPPER(FaultTypeID) AS Id_Tipo_Falla
                ,fault AS Falla
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion 
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.faults AS fallas;

            INSERT INTO fases 
            SELECT
                UPPER(Fases.PIEPhaseID) AS Id_Fase
                ,Fases.Name AS Nombre_Fase
                ,Fases.Description AS Descripcion
                ,IF(Fases.DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(Fases.CreateUserID) AS Creado_Por
                ,Fases.CreateDate AS Fecha_Creacion
                ,UPPER(Fases.LastUserID) AS Modificado_Por
                ,Fases.LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion 
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.piephases AS Fases;

            /*AQUI VA LA TABLA DE HISTORIAL_PROBLEMAS cuando este lista*/
            INSERT INTO historial_problemas
            SELECT
                (SELECT UPPER(CONCAT(SUBSTR(MD5(RAND()), 1, 8),"-",SUBSTR(MD5(RAND()), 1, 4),"-",SUBSTR(MD5(RAND()), 1, 4),"-",SUBSTR(MD5(RAND()), 1, 4),"-",SUBSTR(MD5(RAND()), 1, 12)))) AS Id_Historial_Problema
                ,c_ac.Id_Problema AS Id_Problema
                ,c_an.Id_Problema AS Id_Problema_Anterior
                ,c_an.Id_Problema AS Id_Problema_Original
                ,"Activo" AS Estatus
                ,NULL Creado_Por
                ,NULL Fecha_Creacion
                ,NULL Modificado_Por
                ,NULL Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
                ,c_ac.Id_Sitio AS Id_Sitio
            FROM '.$nombre_db.'.cronicos_actual AS c_ac
            INNER JOIN '.$nombre_db.'.cronicos_anteriores AS c_an ON c_an.ProblemID = c_ac.ProblemID;

            INSERT INTO inspecciones
            SELECT
                UPPER(InspectionID) AS Id_Inspeccion
                ,UPPER(CustomerSiteID) AS Id_Sitio
                ,"" AS Id_Grupo_Sitios
                ,UPPER(CustomerID) AS Id_Cliente
                ,UPPER(InspectionStatusID) AS Id_Status_Inspeccion
                ,ScheduledStart AS Fecha_Inicio
                ,ScheduledEnd AS Fecha_Fin
                ,CONCAT("public/Archivos_ETIC/inspecciones",PhotoPath) AS Fotos_Ruta
                ,NULL AS IR_Imagen_Inicial
                ,NULL AS DIG_Imagen_Inicial
                ,NoOfDays AS No_Dias
                ,TemperatureUnit AS Unidad_Temp
                ,InspectionNo AS No_Inspeccion
                ,LastInspectionNo AS No_Inspeccion_Ant
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
            FROM '.$nombre_db.'.inspections AS inspecciones;

            INSERT INTO inspecciones_det
            SELECT
                UPPER(InspectionDetailID) AS Id_Inspeccion_Det
                ,UPPER(InspectionID) AS Id_Inspeccion
                ,UPPER(LocationID) AS Id_Ubicacion
                ,UPPER(InspectionDetailStatusID) AS Id_Status_Inspeccion_Det
                ,TestStatusNote AS Notas_Inspeccion
                ,(SELECT IF(ubi.DeleteFlag = 0,"Activo","Inactivo") FROM '.$nombre_db.'.locations AS ubi WHERE ubi.LocationID = inspecciones_det.LocationID) AS Estatus
                ,"1" AS Id_Estatus_Color_Text
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,UPPER((SELECT CustomerSiteID FROM '.$nombre_db.'.inspections AS ins WHERE ins.InspectionID = inspecciones_det.InspectionID )) AS Id_Sitio
            FROM '.$nombre_db.'.inspectiondetails AS inspecciones_det;

            INSERT INTO linea_base
            SELECT
                UPPER(BaselineID) AS Id_Linea_Base
                ,UPPER((SELECT CustomerSiteID FROM '.$nombre_db.'.inspections AS ins WHERE ins.InspectionID = b_l.InspectionID )) AS Id_Sitio
                ,UPPER(LocationID) AS Id_Ubicacion
                ,UPPER(InspectionID) AS Id_Inspeccion
                ,UPPER((SELECT insdet.InspectionDetailID FROM '.$nombre_db.'.inspectiondetails AS insdet WHERE insdet.LocationID = b_l.LocationID AND insdet.InspectionID = b_l.InspectionID)) AS Id_Inspeccion_Det
                , ROUND(IF(MeasuredBaseline != "",((MeasuredBaseline - 32) / 1.8),MeasuredBaseline)) AS MTA
                , ROUND(IF(CurrentThreshold != "",((CurrentThreshold - 32) / 1.8),CurrentThreshold)) AS Temp_max
                , ROUND(IF(AmbientBaseline != "",((AmbientBaseline - 32) / 1.8),AmbientBaseline)) AS Temp_amb
                ,CustomerNotes AS Notas
                ,(SELECT lbp.FileName FROM '.$nombre_db.'.locationbaselinephotos AS lbp WHERE lbp.BaselineID = b_l.BaselineID) AS Archivo_IR
                ,(SELECT l.PhotoFilename FROM '.$nombre_db.'.locations AS l WHERE l.LocationID = b_l.LocationID) AS Archivo_ID
                ,IFNULL(IFNULL((SELECT allpopen.LocationPath FROM '.$nombre_db.'.zrpt_AllOpenProblems AS allpopen WHERE allpopen.LocationID = b_l.LocationID GROUP BY allpopen.LocationPath),
                (SELECT allpclose.LocationPath FROM '.$nombre_db.'.zrpt_AllClosedProblems AS allpclose WHERE allpclose.LocationID = b_l.LocationID GROUP BY allpclose.LocationPath)),
                    (SELECT bt.Locations_LocationPath FROM '.$nombre_db.'.zrpt_baselinetrending AS bt WHERE bt.LocationBaselines_BaselineID = b_l.BaselineID GROUP BY bt.Locations_LocationPath)
                )AS Ruta
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
            FROM '.$nombre_db.'.locationbaselines AS b_l;

            INSERT INTO problemas
            SELECT
                UPPER(PIEProblemInspectionID) AS Id_Problema
                ,UPPER((SELECT p.InspectionTypeID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID))) AS Id_Tipo_Inspeccion
                ,(SELECT ip.ProblemNo FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID) AS Numero_Problema
                ,UPPER((SELECT CustomerSiteID FROM '.$nombre_db.'.inspections AS ins WHERE ins.InspectionID = (SELECT ip.InspectionID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID))) AS Id_Sitio
                ,UPPER((SELECT ip.InspectionID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Id_Inspeccion
                ,UPPER((SELECT ip.InspectionDetailID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Id_Inspeccion_Det
                ,UPPER((SELECT p.LocationID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID))) AS Id_Ubicacion
                ,UPPER(ProblemPhaseID) AS Problem_Phase
                ,UPPER(ReferencePhaseID) AS Reference_Phase
                , ROUND(IF(ProblemTemperature != "",((ProblemTemperature - 32) / 1.8),ProblemTemperature)) AS Problem_Temperature
                , ROUND(IF(ReferenceTemperature != "",((ReferenceTemperature - 32) / 1.8),ReferenceTemperature)) AS Reference_Temperature
                ,TrueRMSLoad_A AS Problem_Rms
                ,TrueRMSLoad_B AS Reference_Rms
                ,UPPER(SecondReferencePhaseID) AS Additional_Info
                ,TrueRMSLoad_C AS Additional_Rms
                ,"off" AS Emissivity_Check
                ,FreqOnNuetral AS Emissivity
                ,"off" AS Indirect_Temp_Check
                ,"off" AS Temp_Ambient_Check
                , ROUND(IF(AmbientTemperature != "",((AmbientTemperature - 32) / 1.8),AmbientTemperature)) AS Temp_Ambient
                ,"off" AS Environment_Check
                ,UPPER(PIEEnvironmentID) AS Environment
                ,(SELECT pf.IRFilename FROM '.$nombre_db.'.problemphotos AS pf WHERE pf.ProblemInspectionID = ppi.ProblemInspectionID) AS Ir_File
                ,(SELECT DATE_FORMAT(pf.IRDate,"%d/%m/%Y") FROM '.$nombre_db.'.problemphotos AS pf WHERE pf.ProblemInspectionID = ppi.ProblemInspectionID) AS Ir_File_Date
                ,(SELECT pf.IRTime FROM '.$nombre_db.'.problemphotos AS pf WHERE pf.ProblemInspectionID = ppi.ProblemInspectionID) AS Ir_File_Time
                ,(SELECT pf.PhotoFIleName FROM '.$nombre_db.'.problemphotos AS pf WHERE pf.ProblemInspectionID = ppi.ProblemInspectionID) AS Photo_File
                ,(SELECT DATE_FORMAT(pf.PhotoDate,"%d/%m/%Y") FROM '.$nombre_db.'.problemphotos AS pf WHERE pf.ProblemInspectionID = ppi.ProblemInspectionID) AS Photo_File_Date
                ,(SELECT pf.PhotoTime FROM '.$nombre_db.'.problemphotos AS pf WHERE pf.ProblemInspectionID = ppi.ProblemInspectionID) AS Photo_File_Time
                ,"off" AS Wind_Speed_Check
                ,Windspeed AS Wind_Speed
                ,UPPER((SELECT p.ManufacturerID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID))) AS Id_Fabricante
                ,"off" AS Rated_Load_Check
                ,(SELECT p.PI4 FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Rated_Load
                ,"off" AS Circuit_Voltage_Check
                ,(SELECT p.PI5 FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Circuit_Voltage
                ,UPPER((SELECT p.FaultID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID))) AS Id_Falla
                ,UPPER((SELECT p.EquipmentID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID))) AS Id_Equipo
                ,(SELECT p.ComponentComment FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Component_Comment
                ,(SELECT IF(p.ProblemStatus = 1,"Abierto","Cerrado") FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Estatus_Problema
                ,ROUND((IF(ProblemTemperature != "",((ProblemTemperature - 32) / 1.8),ProblemTemperature)) - (IF(ReferenceTemperature != "",((ReferenceTemperature - 32) / 1.8),ReferenceTemperature))) AS Aumento_Temperatura
                ,UPPER((SELECT ProblemSeverityID FROM '.$nombre_db.'.problemseverity AS ps WHERE ps.ProblemSeverityID = ppi.ProblemSeverityID)) AS Id_Severidad
                ,(SELECT IF(ip.DeleteFlag = 0,"Activo","Inactivo") FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID) AS Estatus
                ,IFNULL((SELECT allpopen.LocationPath FROM '.$nombre_db.'.zrpt_AllOpenProblems AS allpopen WHERE allpopen.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)),
                (SELECT allpclose.LocationPath FROM '.$nombre_db.'.zrpt_AllClosedProblems AS allpclose WHERE allpclose.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)))AS Ruta
                #para sacar hazard type se enlaza a problems con el ProblemID al campo FaultType
                ,UPPER((#SELECT p.FaultType FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (
                SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID
                    #)
                )) AS hazard_Type
                #para sacar Hazard Classification se enlaza a equipmentgroups con el ProblemID despues a equipment con el EquipmentID y despues a equipmentgroups con el EquipmentGroupID al campo Name
                ,UPPER((#select eg.Name from '.$nombre_db.'.equipmentgroups as eg where eg.EquipmentGroupID = (
                SELECT e.EquipmentGroupID FROM '.$nombre_db.'.equipment AS e WHERE e.EquipmentID = (
                    SELECT p.EquipmentID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (
                        SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID
                        )
                    )
                #)
                )) AS hazard_Classification
                #para sacar Hazard Group se enlaza a equipment, primero con el ProblemID despues a equipment con el EquipmentID al campo Name
                ,UPPER((#SELECT e.Name FROM '.$nombre_db.'.equipment AS e WHERE e.EquipmentID = (
                    SELECT p.EquipmentID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (
                        SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID
                        )
                    #)
                )) AS hazard_Group
                #para sacar Hazard Issue se enlaza a faults, primero con el ProblemID despues a faults con el FaultID al campo Fault
                ,UPPER((#select f.Fault from '.$nombre_db.'.faults as f where f.FaultID = (
                    SELECT p.FaultID FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (
                        SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID
                        )
                    #)
                )) AS hazard_Issue
                ,"0" AS Rpm
                ,"0" AS Bearing_Type
                ,(SELECT IF(p.IsChronic = 1,"SI","NO") FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID)) AS Es_Cronico
                ,UPPER((SELECT i.InspectionID FROM '.$nombre_db.'.inspections AS i WHERE i.InspectionNo = (
                    SELECT p.ClosedOnInspectionNo FROM '.$nombre_db.'.problems AS p WHERE p.ProblemID = (
                        SELECT ip.ProblemID FROM '.$nombre_db.'.probleminspections AS ip WHERE ip.ProblemInspectionID = ppi.ProblemInspectionID
                        )
                    )
                )) AS Cerrado_En_Inspeccion
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
            FROM '.$nombre_db.'.pieprobleminspections AS ppi;

            INSERT INTO severidades
            SELECT
                UPPER(ProblemSeverityID) AS Id_Severidad
                ,(CASE
                    WHEN severidades.Name = "1-Critical" THEN "Crítico"
                    WHEN severidades.Name = "2-Serious" THEN "Serio"
                    WHEN severidades.Name = "3-Important" THEN "Importante"
                    WHEN severidades.Name = "4-Minor" THEN "Menor"
                    WHEN severidades.Name = "5-Normal" THEN "Normal"
                END )AS Severidad
                ,(CASE
                    WHEN severidades.Name = "1-Critical" THEN "Mayores a 16°C"
                    WHEN severidades.Name = "2-Serious" THEN "De 9°C a 15°C"
                    WHEN severidades.Name = "3-Important" THEN "De 4°C a 8°C"
                    WHEN severidades.Name = "4-Minor" THEN "De 1°C a 3°C"
                    WHEN severidades.Name = "5-Normal" THEN "Sin diferencia, 0°C"
                END )AS Descripcion
                ,"flag_export" AS Id_Inspeccion
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.problemseverity AS severidades;

            INSERT INTO sitios
            SELECT
                UPPER(CustomerSiteID) AS Id_Sitio
                ,UPPER(CustomerID) AS Id_Cliente
                ,"" AS Id_Grupo
                ,SiteName AS Sitio
                ,Description AS Desc_Sitio
                ,NULL AS Direccion
                ,NULL AS Colonia
                ,NULL AS Estado
                ,NULL AS Municipio
                ,DefaultSiteFolder AS Folder
                ,NULL AS Contacto_1
                ,NULL AS Puesto_Contacto_1
                ,NULL AS Contacto_2
                ,NULL AS Puesto_Contacto_2
                ,NULL AS Contacto_3
                ,NULL AS Puesto_Contacto_3
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
            FROM '.$nombre_db.'.customersites AS Sitios;

            INSERT INTO tipo_fallas
            SELECT
                UPPER(FaultTypeID) AS Id_Tipo_Falla
                ,UPPER(InspectionTypeID) AS Id_Tipo_Inspeccion
                ,tipo_fallas.Name AS Tipo_Falla
                ,Description AS Desc_Tipo_Falla
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.faulttypes AS tipo_fallas;

            INSERT INTO tipo_inspecciones
            SELECT
                UPPER(InspectionTypeID) AS Id_Tipo_Inspeccion
                ,CASE
                    WHEN tipo_inspecciones.Name = "I/C Electrical" THEN "Eléctrico"
                    WHEN tipo_inspecciones.Name = "T/D Electrical" THEN "Eléctrico"	
                    WHEN tipo_inspecciones.Name = "Visual" THEN "Visual"
                    WHEN tipo_inspecciones.Name = "Mechanical" THEN "Mecánico"
                END AS Tipo_Inspeccion
                ,Description AS Desc_Inspeccion
                ,"Activo" AS Estatus
                ,NULL AS Creado_Por
                ,NULL AS Fecha_Creacion
                ,NULL AS Modificado_Por
                ,NULL AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.inspectiontypes AS tipo_inspecciones;

            INSERT INTO tipo_prioridades
            SELECT
                UPPER(PriorityStatusID) AS Id_Tipo_Prioridad
                ,tipo_prioridades.Name AS Tipo_Prioridad
                ,(CASE
                    WHEN tipo_prioridades.Name = "CTO" THEN "Crítica para la operación"
                    WHEN tipo_prioridades.Name = "ETO" THEN "Esencial para la operación"
                    WHEN tipo_prioridades.Name = "NON" THEN "No esencial para la operación"
                    WHEN tipo_prioridades.Name = "UNC" THEN "No clasificado"
                END )AS Desc_Prioridad
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
                ,"flag_export" AS Id_Sitio
            FROM '.$nombre_db.'.prioritystati AS tipo_prioridades;

            INSERT INTO ubicaciones_temp
            SELECT
                UPPER(LocationID) AS Id_Ubicacion
                ,UPPER(CustomerSiteID) AS Id_Sitio
                ,UPPER(ParentID) AS Id_Ubicacion_padre
                ,UPPER(PriorityStatusID) AS Id_Tipo_Prioridad
                ,UPPER(InspectionTypeID) AS Id_Tipo_Inspeccion
                ,ubicaciones_temp.Name AS Ubicacion
                ,Description AS Descripcion
                #,IsEquipment as Es_Equipo
                ,IF(IsEquipment = 0,"NO","SI") AS Es_Equipo
                ,BarCode AS Codigo_Barras
                ,0 AS Nivel_arbol
                ,Threshold AS LIMITE
                ,UPPER(ManufacturerID) AS Fabricante
                ,PhotoFilename AS Nombre_Foto
                ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
                ,UPPER(CreateUserID) AS Creado_Por
                ,CreateDate AS Fecha_Creacion
                ,UPPER(LastUserID) AS Modificado_Por
                ,LastModified AS Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
                #,LocationPath
                #,EquipmentID
            FROM '.$nombre_db.'.locations AS ubicaciones_temp;

            #INSERT INTO Usuarios
            #SELECT
            #    UPPER(SYSUserID) AS Id_Usuario
            #    ,UPPER(NULL) AS Id_Grupo
            #    ,LogonName AS Usuario
            #    ,CONCAT(FirstName," ",LastName) AS Nombre
            #    ,Usuarios.Password
            #    ,NULL AS Foto
            #    ,NULL AS Email
            #    ,NULL AS Telefono
            #    ,Certification AS nivelCertificacion
            #    ,NULL AS Ultimo_login
            #    ,Title AS Titulo
            #    ,IF(DeleteFlag = 0,"Activo","Inactivo") AS Estatus
            #    ,UPPER(CreateUserID) AS Creado_Por
            #    ,CreateDate AS Fecha_Creacion
            #    ,UPPER(LastUserID) AS Modificado_Por
            #    ,LastModified AS Fecha_Mod
            #FROM '.$nombre_db.'.ccusers AS Usuarios;
            
            /* CREACION DE LA VISTA v_ubicaciones */

            DROP TABLE IF EXISTS `v_ubicaciones`;
            DROP VIEW IF EXISTS `v_ubicaciones`;        
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ubicaciones` AS select `t1`.`Ubicacion` AS `lev1`,`t2`.`Ubicacion` AS `lev2` from (`ubicaciones` `t1` left join `ubicaciones` `t2` on(`t2`.`Id_Ubicacion_padre` = `t1`.`Id_Ubicacion`)) where `t1`.`Id_Ubicacion_padre` is null order by `t1`.`Id_Ubicacion`,`t2`.`Id_Ubicacion`;
            
            /* CREACION DE LA VISTA v_ubicaciones_path_temp */
            
            DROP TABLE IF EXISTS `v_ubicaciones_path_temp`;
            DROP VIEW IF EXISTS `v_ubicaciones_path_temp`;        
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ubicaciones_path_temp` AS with recursive ubicacion_path(id_ubicacion,ubicacion,path) as (select `u695808356_etic_system_db`.`ubicaciones_temp`.`Id_Ubicacion` AS `id_ubicacion`,`u695808356_etic_system_db`.`ubicaciones_temp`.`Ubicacion` AS `ubicacion`,cast(`u695808356_etic_system_db`.`ubicaciones_temp`.`Ubicacion` as char(1000) charset utf8 COLLATE utf8_general_ci) AS `path` from `u695808356_etic_system_db`.`ubicaciones_temp` where `u695808356_etic_system_db`.`ubicaciones_temp`.`Id_Ubicacion_padre` IS NULL union all select `e`.`Id_Ubicacion` AS `Id_Ubicacion`,`e`.`Ubicacion` AS `Ubicacion`,concat(`ep`.`path`," / ",convert(`e`.`Ubicacion` using utf8)) AS `CONCAT(ep.path, " / ", e.ubicacion)` from (`ubicacion_path` `ep` join `u695808356_etic_system_db`.`ubicaciones_temp` `e` on(`ep`.`id_ubicacion` = `e`.`Id_Ubicacion_padre`)))select `ubicacion_path`.`id_ubicacion` AS `id_ubicacion`,`ubicacion_path`.`ubicacion` AS `ubicacion`,`ubicacion_path`.`path` AS `path` from `ubicacion_path` order by `ubicacion_path`.`path`;
            
            /* CREACION DE LA VISTA v_ubicaciones_path */
            
            DROP TABLE IF EXISTS `v_ubicaciones_path`;
            DROP VIEW IF EXISTS `v_ubicaciones_path`;        
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ubicaciones_path` AS with recursive ubicacion_path(id_ubicacion,ubicacion,path) as (select `u695808356_etic_system_db`.`ubicaciones`.`Id_Ubicacion` AS `id_ubicacion`,`u695808356_etic_system_db`.`ubicaciones`.`Ubicacion` AS `ubicacion`,cast(`u695808356_etic_system_db`.`ubicaciones`.`Ubicacion` as char(1000) charset utf8 COLLATE utf8_general_ci) AS `path` from `u695808356_etic_system_db`.`ubicaciones` where `u695808356_etic_system_db`.`ubicaciones`.`Id_Ubicacion_padre` = 0 union all select `e`.`Id_Ubicacion` AS `Id_Ubicacion`,`e`.`Ubicacion` AS `Ubicacion`,concat(`ep`.`path`," / ",convert(`e`.`Ubicacion` using utf8)) AS `CONCAT(ep.path, " / ", e.ubicacion)` from (`ubicacion_path` `ep` join `u695808356_etic_system_db`.`ubicaciones` `e` on(`ep`.`id_ubicacion` = `e`.`Id_Ubicacion_padre`)))select `ubicacion_path`.`id_ubicacion` AS `id_ubicacion`,`ubicacion_path`.`ubicacion` AS `ubicacion`,`ubicacion_path`.`path` AS `path` from `ubicacion_path` order by `ubicacion_path`.`path`;
            
            /* CREACION DE LA VISTA v_ubicaciones_tree */
            
            DROP TABLE IF EXISTS `v_ubicaciones_tree`;
            DROP VIEW IF EXISTS `v_ubicaciones_tree`;        
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ubicaciones_tree` AS select `a`.`Id_Ubicacion` AS `id`,`a`.`Id_Sitio` AS `Id_Sitio`,`a`.`Ubicacion` AS `name`,ifnull(`a`.`Id_Ubicacion_padre`,0) AS `parent_id`,`a`.`Nivel_arbol` AS `level`,`a`.`Codigo_Barras` AS `Codigo_Barras`,`a`.`Es_Equipo` AS `Es_Equipo`,`a`.`Estatus` AS `Estatus`,`a`.`Id_Tipo_Prioridad` AS `Id_Tipo_Prioridad`,`a`.`Descripcion` AS `Descripcion`,`a`.`Fabricante` AS `Id_Fabricante`,`a`.`Id_Ubicacion_padre` AS `Id_Ubicacion_padre`,`b`.`Id_Inspeccion_Det` AS `Id_Inspeccion_Det`,`b`.`Id_Status_Inspeccion_Det` AS `Id_Status_Inspeccion_Det`,`c`.`Id_Inspeccion` AS `Id_Inspeccion`,`c`.`No_Inspeccion` AS `No_Inspeccion`,`c`.`Fecha_Inicio` AS `Fecha_inspeccion`,`d`.`Estatus_Inspeccion_Det` AS `Estatus_Inspeccion_Det`,`b`.`Notas_Inspeccion` AS `Notas_Inspeccion`,`a`.`Ruta` AS `path` from (((`ubicaciones` `a` join `inspecciones_det` `b` on(`a`.`Id_Ubicacion` = `b`.`Id_Ubicacion`)) join `inspecciones` `c` on(`b`.`Id_Inspeccion` = `c`.`Id_Inspeccion`)) join `estatus_inspeccion_det` `d` on(`d`.`Id_Status_Inspeccion_Det` = `b`.`Id_Status_Inspeccion_Det`)) where `a`.`Estatus` = "Activo" group by `a`.`Ruta` order by `a`.`Fecha_Creacion` ASC;

            /*Creacion de la vista v_ubicaciones_arbol*/

            DROP TABLE IF EXISTS `v_ubicaciones_arbol`;
            DROP VIEW IF EXISTS `v_ubicaciones_arbol`;
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ubicaciones_arbol` AS (SELECT `insdet`.`Id_Inspeccion_Det` AS `Id_Inspeccion_Det`,`insdet`.`Id_Ubicacion` AS `id`,(SELECT `ubi`.`Id_Sitio` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Id_Sitio`,(SELECT `ubi`.`Ubicacion` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `name`,(SELECT IFNULL(`ubi`.`Id_Ubicacion_padre`,0) FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `parent_id`,(SELECT `ubi`.`Nivel_arbol` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `level`,(SELECT `ubi`.`Codigo_Barras` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Codigo_Barras`,(SELECT `ect`.`Color_Text` FROM `estatus_color_text` `ect` WHERE `ect`.`Id_Estatus_Color_Text` = `insdet`.`Id_Estatus_Color_Text`) AS `color_text`,(SELECT `ubi`.`Es_Equipo` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Es_Equipo`,(SELECT `ubi`.`Estatus` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Estatus`,(SELECT `ubi`.`Id_Tipo_Prioridad` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Id_Tipo_Prioridad`,(SELECT `ubi`.`Descripcion` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Descripcion`,(SELECT `ubi`.`Fabricante` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Id_Fabricante`,(SELECT `ubi`.`Id_Ubicacion_padre` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Id_Ubicacion_padre`, `insdet`.`Id_Status_Inspeccion_Det` AS `Id_Status_Inspeccion_Det`, `insdet`.`Id_Inspeccion` AS `Id_Inspeccion`,(SELECT `insp`.`No_Inspeccion` FROM `inspecciones` `insp` WHERE `insp`.`Id_Inspeccion` = `insdet`.`Id_Inspeccion`) AS `No_Inspeccion`,(SELECT `insp`.`Fecha_Inicio` FROM `inspecciones` `insp` WHERE `insp`.`Id_Inspeccion` = `insdet`.`Id_Inspeccion`) AS `Fecha_inspeccion`,(SELECT `eid`.`Estatus_Inspeccion_Det` FROM `estatus_inspeccion_det` `eid` WHERE `eid`.`Id_Status_Inspeccion_Det` = `insdet`.`Id_Status_Inspeccion_Det`) AS `Estatus_Inspeccion_Det`, `insdet`.`Notas_Inspeccion` AS `Notas_Inspeccion`,(SELECT `ubi`.`Ruta` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `path`,(SELECT `ubi`.`Fecha_Creacion` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`) AS `Fecha_Creacion` FROM `inspecciones_det` `insdet` WHERE `insdet`.`Estatus` = "Activo" ORDER BY (SELECT `ubi`.`Fecha_Creacion` FROM `ubicaciones` `ubi` WHERE `ubi`.`Id_Ubicacion` = `insdet`.`Id_Ubicacion`));

            /* CREACION DE LA VISTA hisotrial del baseline */

            DROP TABLE IF EXISTS `v_historial_baseline`;
            DROP VIEW IF EXISTS `v_historial_baseline`;
            CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_historial_baseline` AS (select `linea_base`.`Id_Linea_Base` AS `Id_Linea_Base`,`linea_base`.`Id_Ubicacion` AS `Id_Ubicacion`,`linea_base`.`Id_Inspeccion` AS `Id_Inspeccion`,`linea_base`.`Estatus` AS `Estatus`,date_format(`linea_base`.`Fecha_Creacion`,"%d/%m/%Y") AS `Fecha_Creacion`,`linea_base`.`MTA` AS `MTA`,`linea_base`.`Temp_max` AS `Temp_max`,`linea_base`.`Temp_amb` AS `Temp_amb`,`linea_base`.`Archivo_IR` AS `Archivo_IR`,`linea_base`.`Archivo_ID` AS `Archivo_ID`,`linea_base`.`Notas` AS `Notas`,`linea_base`.`Ruta` AS `Ruta`,`linea_base`.`Fecha_Creacion` AS `Fecha_Creacion_sinFormato`,(select date_format(`ins`.`Fecha_Inicio`,"%d/%m/%Y") from `inspecciones` `ins` where `ins`.`Id_Inspeccion` = `linea_base`.`Id_Inspeccion`) AS `fechaInspeccion`,(select `estatus_inspeccion_det`.`Estatus_Inspeccion_Det` from `estatus_inspeccion_det` where `estatus_inspeccion_det`.`Id_Status_Inspeccion_Det` = (select `inspecciones_det`.`Id_Status_Inspeccion_Det` from `inspecciones_det` where `inspecciones_det`.`Id_Ubicacion` = `linea_base`.`Id_Ubicacion` and `inspecciones_det`.`Id_Inspeccion` = `linea_base`.`Id_Inspeccion`)) AS `estatusInspeccion`,(select `ubicaciones`.`Codigo_Barras` from `ubicaciones` where `ubicaciones`.`Id_Ubicacion` = `linea_base`.`Id_Ubicacion`) AS `codigoBarras`,(select `fabricantes`.`Fabricante` from `fabricantes` where `fabricantes`.`Id_Fabricante` = (select `v_ubicaciones_tree`.`Id_Fabricante` from `v_ubicaciones_tree` where `v_ubicaciones_tree`.`id` = `linea_base`.`Id_Ubicacion` group by `v_ubicaciones_tree`.`id`)) AS `fabricante`,(select `tipo_prioridades`.`Tipo_Prioridad` from `tipo_prioridades` where `tipo_prioridades`.`Id_Tipo_Prioridad` = (select `ubicaciones`.`Id_Tipo_Prioridad` from `ubicaciones` where `ubicaciones`.`Id_Ubicacion` = `linea_base`.`Id_Ubicacion`)) AS `tipoPrioridad`,(select `v_ubicaciones_tree`.`path` from `v_ubicaciones_tree` where `v_ubicaciones_tree`.`id` = `linea_base`.`Id_Ubicacion` group by `v_ubicaciones_tree`.`id`) AS `path`,(select `inspecciones`.`No_Inspeccion` from `inspecciones` where `inspecciones`.`Id_Inspeccion` = `linea_base`.`Id_Inspeccion`) AS `numInspeccion`,(select `ubicaciones`.`Ubicacion` from `ubicaciones` where `ubicaciones`.`Id_Ubicacion` = `linea_base`.`Id_Ubicacion`) AS `equipo` from `linea_base` where `linea_base`.`Estatus` = "Activo" order by (select `inspecciones`.`No_Inspeccion` from `inspecciones` where `inspecciones`.`Id_Inspeccion` = `linea_base`.`Id_Inspeccion`));

            INSERT INTO ubicaciones
            SELECT
                ut.Id_Ubicacion
                ,Id_Sitio
                ,IFNULL(Id_Ubicacion_padre,0) AS Id_Ubicacion_padre
                ,Id_Tipo_Prioridad
                ,Id_Tipo_Inspeccion
                ,Ubicacion
                ,Descripcion
                ,Es_Equipo
                ,Codigo_Barras
                ,ROUND (
                    (LENGTH((SELECT v_up.path FROM v_ubicaciones_path_temp AS v_up WHERE v_up.id_ubicacion = ut.Id_Ubicacion)) - LENGTH( REPLACE ((SELECT v_up.path FROM v_ubicaciones_path_temp AS v_up WHERE v_up.id_ubicacion = ut.Id_Ubicacion), "/", "") )) / LENGTH("/")
                ) + 1 AS Nivel_arbol
                ,LIMITE
                ,Fabricante
                ,Nombre_Foto
                ,(SELECT v_up.path FROM v_ubicaciones_path_temp AS v_up WHERE v_up.id_ubicacion = ut.Id_Ubicacion) AS Ruta
                ,Estatus
                ,Creado_Por
                ,Fecha_Creacion
                ,Modificado_Por
                ,Fecha_Mod
                ,"flag_export" AS Id_Inspeccion
            FROM ubicaciones_temp AS ut;
            
            DROP TABLE IF EXISTS `ubicaciones_temp`;
            DROP VIEW IF EXISTS `v_ubicaciones_path_temp`;

            /* Asigando color de letra */
            UPDATE inspecciones_det SET Id_Estatus_Color_Text = 2 WHERE Id_Inspeccion_Det IN (SELECT p.Id_Inspeccion_Det FROM problemas AS p GROUP BY p.Id_Inspeccion_Det); 
            UPDATE inspecciones_det SET Id_Estatus_Color_Text = 3 WHERE Id_Inspeccion_Det IN (SELECT p.Id_Inspeccion_Det FROM linea_base AS p GROUP BY p.Id_Inspeccion_Det);
            
            DROP DATABASE IF EXISTS '.$nombre_db.';'
        ;
        
        $disp = write_file($ruta_guardar_script, $contenido_nuevo_script);

        
        if (!($disp)){
            echo "File could not be updated";
        }else{

            // // Creamos la ruta para hacer la restauracion en linea de comandos
            // $ruta_bd_inspeccion = "C:/xampp/htdocs/etic-system/public/Archivos_ETIC/bd_procesadas/".$nombre_db.".sql";
            // // Ejecutmos el comando
            // shell_exec("C:/xampp/mysql/bin/mysql -u root u695808356_etic_system_db < ".$ruta_bd_inspeccion);

            return json_encode(200);
        }
    }

    public function descargar_bd_procesada($nombre_bd_procesada){
        $filePath = ROOTPATH.'public/Archivos_ETIC/bd_procesadas/'.$nombre_bd_procesada;

        return $this->response->download($filePath, null);
    }

}