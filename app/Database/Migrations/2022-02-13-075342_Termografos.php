<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Termografos extends Migration
{
    public function up()
    {
        // Tabla de Termografos
        $this->forge->addField([
            'Id_Termografo'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Termografo'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => false,
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
    
        $this->forge->addKey('Id_Termografo', true);
        $this->forge->createTable('Termografos');
    }

    public function down()
    {
        $this->forge->dropTable('Termografos');
    }
}
