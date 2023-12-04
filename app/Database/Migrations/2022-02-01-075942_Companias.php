<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Companias extends Migration
{
    public function up()
    {
        // Tabla de Compañias
        $this->forge->addField([
            'Id_Compania'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Id_Giro'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Id_Pais'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Compania'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'Logotipo'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'Pagina_web'       => [
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
    
        $this->forge->addKey('Id_Compania', true);
        $this->forge->addForeignKey('Id_Giro', 'Giros', 'Id_Giro'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->addForeignKey('Id_Pais', 'Paises', 'Id_Pais'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->createTable('Companias');
    }

    public function down()
    {
        $this->forge->dropTable('Companias');
    }
}
