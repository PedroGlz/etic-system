<?php namespace App\Database\Seeds;

class TipoInspeccionesSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Tipo_Inspecciones')->where('Id_Tipo_Inspeccion >=',1)->delete();

                
                for($i=1 ; $i<=10 ; $i++){

                        $data = [
                                'Tipo_Inspeccion'        => "Prioridad $i",
                                'Desc_Inspeccion'        => "Descr $i",
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Tipo_Inspecciones')->insert($data);
                }
                
        }
}