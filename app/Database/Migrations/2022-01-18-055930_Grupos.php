<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Grupos extends Migration
{
        public function up()
        {
        //Tabla de grupos
        $this->forge->addField([
                'Id_Grupo'          => [
                        'type'           => 'INT',
                        'constraint'     => 5,
                        'unsigned'       => true,
                        'auto_increment' => true,
                ],
                'Grupo'       => [
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
                        'type' => 'timestamp',                           
                        'null'           => false,
                ],
                'Modificado_Por' => [
                        'type'           => 'INT',
                        'constraint'     => 5,
                        'unsigned'       => true,
                        'null'           => true,
                ],
                'Fecha_Mod' => [
                        'type' 			=> 'datetime',                        
                        'null' 		=> true,
                        'on update' 	=> 'NOW()',
                ],
                
        ]);
        
                $this->forge->addKey('Id_Grupo', true);
                $this->forge->createTable('Grupos');
        }

        public function down()
        {
                $this->forge->dropTable('Grupos');
        }
}
