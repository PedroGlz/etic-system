<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paises extends Migration
{
    public function up()
    {
        //Tabla de paises
        $this->forge->addField([
            'Id_Pais'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'Pais'       => [
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
                'type'              => 'timestamp',                           
                'null'              => false,
            ],
            'Modificado_Por' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Fecha_Mod' => [
                    'type' 			=> 'DATETIME',                    
                    'null' 		    => true,
                    'on update' 	=> 'NOW()',
            ],            
        ]);
        
        $this->forge->addKey('Id_Pais', true);
        $this->forge->createTable('Paises');
    }

    public function down()
    {
        $this->forge->dropTable('Paises');
    }
}
