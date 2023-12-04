<?php namespace App\Models;

use CodeIgniter\Model;

class SitiosMdl extends Model
{

    protected $table = 'sitios';
    protected $primaryKey = 'Id_Sitio';
    protected $allowedFields = [
        'Id_Sitio',
        'Id_Cliente',
        'Id_Grupo_Sitios',
        'Sitio',
        'Desc_Sitio',
        'Direccion',
        'Colonia',
        'Estado',
        'Municipio',
        'Folder',
        'Contacto_1',
        'Puesto_Contacto_1',
        'Contacto_2',
        'Puesto_Contacto_2',
        'Contacto_3',
        'Puesto_Contacto_3',
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

        return $this->asArray()->where(['Id_Sitio' => $id])->first();	
    }

    public function obtenerRegistros($id = null){

        if($id !== null){
            return $this->table('sitios')->select('
                Id_Sitio,
                Id_Cliente,
                Id_Grupo_Sitios,
                Sitio,
                Desc_Sitio,
                Direccion,
                Colonia,
                Estado,
                Municipio,
                Contacto_1,
                Puesto_Contacto_1,
                Contacto_2,
                Puesto_Contacto_2,
                Contacto_3,
                Puesto_Contacto_3,
                Estatus,
                Creado_Por,
                Fecha_Creacion,
                Modificado_Por,
                Fecha_Mod,
                (SELECT Grupo FROM grupos_sitios WHERE grupos_sitios.Id_Grupo_Sitios = sitios.Id_Grupo_Sitios) AS nombreGrupoSitio,
                (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = sitios.Id_Cliente) AS nombreCliente
            ')->where(['Id_Sitio' => $id])->findAll();
        }

        return $this->table('sitios')->select('
            Id_Sitio,
            Id_Cliente,
            Id_Grupo_Sitios,
            Sitio,
            Desc_Sitio,
            Direccion,
            Colonia,
            Estado,
            Municipio,
            Contacto_1,
            Puesto_Contacto_1,
            Contacto_2,
            Puesto_Contacto_2,
            Contacto_3,
            Puesto_Contacto_3,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Grupo FROM grupos_sitios WHERE grupos_sitios.Id_Grupo_Sitios = sitios.Id_Grupo_Sitios) AS nombreGrupoSitio,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = sitios.Id_Cliente) AS nombreCliente
        ')->findAll();
    }

    public function show($id = null){
        $condicion = ['Id_Grupo_Sitios' => $id];

        if($id === null){
            $condicion = "Id_Sitio != ''";
        }

        return $this->table('sitios')->select('
            Id_Sitio,
            Id_Cliente,
            Id_Grupo_Sitios,
            Sitio,
            Desc_Sitio,
            Direccion,
            Colonia,
            Estado,
            Municipio,
            Contacto_1,
            Puesto_Contacto_1,
            Contacto_2,
            Puesto_Contacto_2,
            Contacto_3,
            Puesto_Contacto_3,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Grupo FROM grupos_sitios WHERE grupos_sitios.Id_Grupo_Sitios = sitios.Id_Grupo_Sitios) AS nombreGrupoSitio,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = sitios.Id_Cliente) AS nombreCliente'
        )->where($condicion)->findAll();	
    }
}