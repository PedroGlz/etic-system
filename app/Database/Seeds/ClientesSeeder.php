<?php namespace App\Database\Seeds;

class ClientesSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Clientes')->where('Id_Cliente >=',1)->delete();

                
                for($i=1 ; $i<=10 ; $i++){

                        $data = [
                                'Id_Compania'           => 3,
                                'Id_Giro'               => 1,
                                'Razon_Social'          => "R.S. $i",
                                'Nombre_Comercial'      => "Nombre $i",
                                'RFC'                   => "RFC $i",                  
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Clientes')->insert($data);
                }
                
        }
}