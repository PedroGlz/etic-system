<?php namespace App\Models;

use CodeIgniter\Model;

class GruposSitiosMdl extends Model
{

    protected $table = 'grupos_sitios';
    protected $primaryKey = 'Id_Grupo_Sitios';
    protected $allowedFields = [
        'Id_Grupo_Sitios',
        'Id_Cliente',
        'Grupo',
        'Estatus',
        'Creado_Por',
        'Fecha_Creacion',
        'Modificado_Por',
        'Fecha_Mod',
        'Id_Inspeccion' //flag_export
    ];

    public function get($id = null){
        
        $condicion = ["Id_Grupo_Sitios" => $id];

        if($id === null){
            $condicion = ["Estatus" => "Activo"];
        }

        return $this->table('grupos_sitios')->select('
            Id_Grupo_Sitios,
            Id_Cliente,
            Grupo,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = grupos_sitios.Id_Cliente) AS nombreCliente
        ')->where($condicion)->findAll();
    }

    public function show($id = null){
        $condicion = ['Id_Cliente' => $id];

        if($id === null){
            $condicion = "Id_Grupo_Sitios != ''";
        }

        return $this->table('grupos_sitios')->select('
            Id_Grupo_Sitios,
            Id_Cliente,
            Grupo,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = grupos_sitios.Id_Cliente) AS nombreCliente'
        )->where($condicion)->findAll();	
    }



}