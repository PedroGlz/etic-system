<?php
/**
  * Este archivo es para uso de la aplicacion etic.
*/

if (! function_exists('crear_id')) {
    /**
     * Write File
     *
     * Writes data to the file specified in the path.
     * Creates a new file if non-existent.
     *
     * @param string $path File path
     * @param string $data Data to write
     * @param string $mode fopen() mode (default: 'wb')
     */
    function crear_id(){
      
      // EN ESTA CADENA DE TEXTO SE COLOCAN LOS CARACTERES QUE GENERARAN UNA NUEVA CADENA ALEATORIA
      $caracteres_posibles = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      // SE TOMA LOS CARACTERES POSIBLES Y SE CONVINAN ALEATOREAMENTE Y SE TOMA 32 CARACTERES APARTIR E LA POSICION 0
      $cadena_aleatoria_generada = substr(str_shuffle($caracteres_posibles), 0, 32);
      // LA CADENA SE DIVIDE EN 5 PARTES CON UN " - ", 8 CARACTERES - 4 CARACTERES - 4 CARACTERES - 4 CARACTERES - 12 CARACTERES
      // FINALMENETE LA CADENA ALEATORIA DE 32 CARACTERES SE CONVIENRTE EN UNA CADENA DE 36 CARACTERES CON LOS GUIONES AGREGADOS
      $id_generado = substr($cadena_aleatoria_generada,0,8)."-".substr($cadena_aleatoria_generada,8,4)."-".substr($cadena_aleatoria_generada,12,4)."-".substr($cadena_aleatoria_generada,16,4)."-".substr($cadena_aleatoria_generada,20,12);
      
      // DESCOMENTAR ESTAS DOS LINEAS PARA VALIDAR EL ID GENERADO
      // var_dump($cadena_aleatoria_generada);
      // var_dump($id_generado);
      
      // RETORNAMOS EL ID GENERADO
      return $id_generado;
    }
}