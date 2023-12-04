<?php namespace App\Database\Seeds;

class GruposSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Grupos')->where('Id_Grupo >=',1)->delete();

                
                for($i=1 ; $i<=20 ; $i++){

                        $data = [
                                'Grupo'                 => "Grupo $i",
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Grupos')->insert($data);
                }
                
        }
}