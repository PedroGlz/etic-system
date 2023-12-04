<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        // Tabla de Usuarios
        $this->forge->addField([
            'Id_Usuario'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Id_Grupo'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
            ],
            'Usuario'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => false,
            ],
            'Nombre'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => false,
            ],
            'Password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'Foto'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'Email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => false,
            ],
            'Ultimo_login' => [
                'type' 			=> 'DATETIME',                    
                'null' 		    => true,                
            ], 
            'Estatus'      => [
                'type'           => 'ENUM',
                'constraint'     => ['Activo', 'Inactivo'],
                'default'        => 'Activo',
            ],
            'Creado_Por' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => false,
                'null'           => false,
            ],
            'Fecha_Creacion' => [
                'type'  => 'timestamp',                           
                'null'  => false,
            ],
            'Modificado_Por' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Fecha_Mod' => [
                    'type' 			=> 'DATETIME',                    
                    'null' 		=> true,
                    'on update' 	=> 'NOW()',
            ],            
        ]);
    
        $this->forge->addKey('Id_Usuario', true);
        $this->forge->addForeignKey('Id_Grupo', 'Grupos', 'Id_Grupo'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->createTable('Usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('Usuarios');
    }
}
