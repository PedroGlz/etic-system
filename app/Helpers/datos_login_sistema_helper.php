<?php
/**
  * Este archivo es para uso de la aplicacion etic.
*/

if (! function_exists('datos_menu')) {
    /**
     * Funcion global para eliminar imagenes
     */
    function datos_menu(object $session){
      $dataMenu = [
        'usuario' => $session->nombre,
        'grupo' => $session->grupo,
        'inspeccion' => $session->inspeccion,
        'nombreSitio'=> is_null($session->nombreSitio) ? 'N/A' : $session->nombreSitio,
        'Id_Sitio'   => $session->Id_Sitio,
        'Id_Inspeccion' => $session->Id_Inspeccion,
        'Id_Status_Inspeccion' => $session->Id_Status_Inspeccion
      ];

      return $dataMenu;
    }
}