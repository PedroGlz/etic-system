<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Giros extends Migration
{
    public function up()
    {
        // Tabla Giros
        $this->forge->addField([
            'Id_Giro'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Giro'       => [
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
    
        $this->forge->addKey('Id_Giro', true);
        $this->forge->createTable('Giros');

    }

    public function down()
    {
        $this->forge->dropTable('Giros');
    }
}
