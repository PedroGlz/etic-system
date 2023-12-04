<?php namespace App\Database\Seeds;

class GirosSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Giros')->where('Id_Giro >=',1)->delete();

                
                for($i=1 ; $i<=10 ; $i++){

                        $data = [
                                'Giro'                 => "Giro $i",                                
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                
                        ];

                        $this->db->table('Giros')->insert($data);
                }
                
        }
}