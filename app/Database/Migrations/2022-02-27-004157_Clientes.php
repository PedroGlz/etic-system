<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
    public function up()
    {
        // Tabla de Clientes
        $this->forge->addField([
            'Id_Cliente'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Id_Compania'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
            ],
            'Id_Giro'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Razon_Social'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'Nombre_Comercial'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'RFC'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
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
    
        $this->forge->addKey('Id_Cliente', true);
        $this->forge->addForeignKey('Id_Compania', 'Companias', 'Id_Compania'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->addForeignKey('Id_Giro', 'Giros', 'Id_Giro'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->createTable('Clientes');
    }

    public function down()
    {
        $this->forge->dropTable('Clientes');
    }
}
