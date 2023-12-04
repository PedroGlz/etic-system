<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sitios extends Migration
{
    public function up()
    {
        // Tabla de Sitios
        $this->forge->addField([
            'Id_Sitio'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Id_Cliente'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
            ],
            'Id_Direccion'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Sitio'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
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

        $this->forge->addKey('Id_Sitio', true);
        $this->forge->addForeignKey('Id_Cliente', 'Clientes', 'Id_Cliente'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->createTable('Sitios');
    }

    public function down()
    {
        $this->forge->dropTable('Sitios');
    }
}
