<?php namespace App\Models;

use CodeIgniter\Model;

class UsuariosMdl extends Model
{

    protected $table = 'usuarios';
    protected $primaryKey = 'Id_Usuario';
    protected $allowedFields = [
        'Id_Usuario',
        'Id_Grupo',
        'Usuario',
        'Nombre',
        'Password',
        'Foto',
        'Email',
        'Telefono',
        'nivelCertificacion',
        'Ultimo_login',
        'Titulo',
        'Id_Cliente',
        'Id_Grupo_Sitios',
        'Id_Sitio',
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

        return $this->asArray()->where(['Id_Usuario' => $id])->first();
    }

    public function obtenerUsuario($data){
        return $this->table('usuarios')->select('
            Id_Usuario,
            Id_Grupo,
            Usuario,
            Nombre,
            Password,
            Foto,
            Email,
            Telefono,
            nivelCertificacion,
            Ultimo_login,
            Titulo,
            Id_Cliente,
            Id_Grupo_Sitios,
            Id_Sitio,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Razon_Social FROM clientes WHERE clientes.Id_Cliente = usuarios.Id_Cliente) AS nombreCliente,
            (SELECT Grupo FROM grupos WHERE grupos.Id_Grupo = usuarios.Id_Grupo) AS grupo
        ')->where($data)->findAll();        
    }

    public function obtenerRegistros($id = null){
        if($id !== null){
            return $this->table('usuarios')->select('
                Id_Usuario,
                Id_Grupo,
                Usuario,
                Nombre,
                Password,
                Foto,
                Email,
                Telefono,
                nivelCertificacion,
                Ultimo_login,
                Titulo,
                Id_Cliente,
                Id_Grupo_Sitios,
                Id_Sitio,
                Estatus,
                Creado_Por,
                Fecha_Creacion,
                Modificado_Por,
                Fecha_Mod,
                (SELECT Grupo FROM grupos WHERE grupos.Id_Grupo = usuarios.Id_Grupo) AS nombreGrupo
            ')->where(['Id_Usuario' => $id])->findAll();
        }

        return $this->table('usuarios')->select('
            Id_Usuario,
            Id_Grupo,
            Usuario,
            Nombre,
            Password,
            Foto,
            Email,
            Telefono,
            nivelCertificacion,
            Ultimo_login,
            Titulo,
            Id_Cliente,
            Id_Grupo_Sitios,
            Id_Sitio,
            Estatus,
            Creado_Por,
            Fecha_Creacion,
            Modificado_Por,
            Fecha_Mod,
            (SELECT Grupo FROM grupos WHERE grupos.Id_Grupo = usuarios.Id_Grupo) AS nombreGrupo
        ')->findAll();
    }
}