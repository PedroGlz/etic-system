<?php namespace App\Database\Seeds;

class TipoPrioridadesSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Tipo_Prioridades')->where('Id_Tipo_Prioridad >=',1)->delete();

                
                for($i=1 ; $i<=20 ; $i++){

                        $data = [
                                'Tipo_Prioridad'        => "Prioridad $i",
                                'Desc_Prioridad'        => "Descr $i",
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Tipo_Prioridades')->insert($data);
                }
                
        }
}