<?php namespace App\Database\Seeds;

class CompaniasSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Companias')->where('Id_Compania >=',1)->delete();

                
                for($i=1 ; $i<=10 ; $i++){

                        $data = [
                                'Id_Giro'               => 1,
                                'Id_Pais'               => 1,
                                'Compania'              => "Compañia $i",
                                'Logotipo'              => "adminLTE-3.1.0/dist/img/default-logo.png",
                                'Pagina_web'            => "www.web$i.com",
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")
                                
                        ];

                        $this->db->table('Companias')->insert($data);
                }
                
        }
}