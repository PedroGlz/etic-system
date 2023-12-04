<?php namespace App\Database\Seeds;

class PaisesSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Paises')->where('Id_Pais >=',1)->delete();

                
                for($i=1 ; $i<=20 ; $i++){

                        $data = [
                                'Pais'                 => "Pais $i",
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Paises')->insert($data);
                }
                
        }
}