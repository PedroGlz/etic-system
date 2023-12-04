<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ubicaciones extends Migration
{
    public function up()
    {
        // Tabla de Ubicaciones
        $this->forge->addField([
            'Id_Ubicacion'        => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'Id_Sitio'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
            ],
            'Id_Ubicacion_padre'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
            ],
            'Id_Tipo_Prioridad'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
            ],
            'Id_Tipo_Inspeccion'            => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
            ],
            'Ubicacion'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],   
            'Descripcion'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],                        
            'Es_Equipo'      => [
                'type'           => 'ENUM',
                'constraint'     => ['SI', 'NO'],
                'default'        => 'NO',
            ],       
            'Codigo_Barras'            => [
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
                'type'  => 'DATETIME',                           
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

        $this->forge->addKey('Id_Ubicacion', true);
        $this->forge->addForeignKey('Id_Sitio', 'Sitios', 'Id_Sitio'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->addForeignKey('Id_Tipo_Prioridad', 'Tipo_Prioridades', 'Id_Tipo_Prioridad'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->addForeignKey('Id_Tipo_Inspeccion', 'Tipo_Inspecciones', 'Id_Tipo_Inspeccion'); //FOREIGN KEY (id) REFERENCES table(id)
        $this->forge->createTable('Ubicaciones');
    }

    public function down()
    {
        $this->forge->dropTable('Ubicaciones');
    }
}
