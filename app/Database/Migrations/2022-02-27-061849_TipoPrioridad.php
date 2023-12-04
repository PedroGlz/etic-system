<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoPrioridad extends Migration
{
    public function up()
    {
        // Tabla Tipo Prioridades
        $this->forge->addField([
            'Id_Tipo_Prioridad'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Tipo_Prioridad'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => false,
            ], 
            'Desc_Prioridad'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => true,
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
    
        $this->forge->addKey('Id_Tipo_Prioridad', true);
        $this->forge->createTable('Tipo_Prioridades');
    }

    public function down()
    {
        $this->forge->dropTable('Tipo_Prioridades');
    }
}
