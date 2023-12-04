<?php namespace App\Database\Seeds;

class UsuariosSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {

                $this->db->table('Usuarios')->where('Id_Usuario >=',1)->delete();

                
                for($i=1 ; $i<=10 ; $i++){

                        $data = [
                                'Id_Grupo'              => 1,
                                'Usuario'               => "Usuario $i",
                                'Nombre'                => "Nombre $i",
                                'Password'              => hash('sha256', '1234'),
                                'Foto'                  => "adminLTE-3.1.0/dist/img/default-logo.png",
                                'Ultimo_login'          => date("Y-m-d H:i:s") ,
                                'Estatus'               => 'Activo',
                                'Creado_Por'            => 1,
                                'Fecha_Creacion'        => date("Y-m-d H:i:s")                                 
                        ];

                        $this->db->table('Usuarios')->insert($data);
                }
                
        }
}