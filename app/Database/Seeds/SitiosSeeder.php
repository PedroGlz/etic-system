<?php namespace App\Database\Seeds;

class SitiosSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Sitios')->where('Id_Sitio >=',1)->delete();

                
                for($i=1 ; $i<=10 ; $i++){

                        $data = [
                                'Id_Cliente'            => 3,
                                'Id_Direccion'          => 1,
                                'Sitio'                 => "Sitio $i",                                      
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Sitios')->insert($data);
                }
                
        }
}