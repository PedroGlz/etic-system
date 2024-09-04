<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::acceso');
$routes->get('/salir', 'Login::salir');
// LOGIN CLIENTES
$routes->get('/customers', 'Clientes\Login_clientes::index');
$routes->post('/customers/acceso', 'Clientes\Login_clientes::acceso');
$routes->get('/customers/salir', 'Clientes\Login_clientes::salir');
$routes->get('/customers/home', 'Clientes\PrincipalClientes::index');
// $routes->get('/inicio', 'dashboard/PlantillaController::index');
// $routes->get('/blank', 'catalogos/TIncidenciaController::index');
// $routes->get('/tablero', 'Tablero::index');
// EXPORTAR BD DE INSPECCION
$routes->match(['get', 'post'],'/exportar_inspeccion_db', 'Inspecciones::exportar_inspeccion_db');
$routes->GET('/inspecciones/descargar_bd_exportar/(:any)', 'Inspecciones::descargar_bd_exportar/$1');
// CARPETA DE ARCHIVOS
$routes->match(['get', 'post'],'/abrir_carpeta_archivos', 'Inventarios::abrir_carpeta_archivos');
// Ubicaciones
$routes->get('/inventarios', 'Inventarios::index');
$routes->get('/inventarios/obtener/(:any)', 'Inventarios::obtener/$1');
// $routes->get('/inventarios/obtenerarbol/(:any)', 'Inventarios::obtenerArbol/$1');
$routes->get('/inventarios/listado/(:any)/(:any)', 'Inventarios::listado/$1/$2');
$routes->get('/inventarios/listadolineabase/(:any)', 'Inventarios::listadolineabase/$1');
$routes->get('/inventarios/validar_crear_baseline/(:any)', 'Inventarios::validar_crear_baseline/$1');
$routes->get('/inventarios/validar_crear_problema_ubicacion/(:any)', 'Inventarios::validar_crear_problema_ubicacion/$1');
$routes->get('/inventarios/validar_eliminacion_ubicacion/(:any)/(:any)', 'Inventarios::validar_eliminacion_ubicacion/$1/$2');
$routes->get('/inventarios/borrar/(:any)', 'Inventarios::borrar/$1');
$routes->get('/inventarios/borrarlinebase/(:any)', 'Inventarios::borrarlinebase/$1');
$routes->get('/inventarios/nuevo', 'Inventarios::nuevo');
$routes->get('/inventarios/nuevalinebase', 'Inventarios::nuevalinebase');
$routes->get('/inventarios/ObtenerArchivosImg', 'Inventarios::ObtenerArchivosImg');
$routes->get('/inventarios/obtenerMaxOrden/(:any)', 'Inventarios::obtenerMaxOrden/$1');

// // Fabricantes
// $routes->get('/fabricantes/listadodesc', 'Fabricantes::listadodesc');

// Catalogo giros
$routes->get('/giros', 'Giros::index');
$routes->get('/giros/delete/(:any)', 'Giros::delete/$1');
// Catalogo clientes
$routes->get('/clientes', 'Clientes::index');
$routes->get('/clientes/delete/(:any)', 'Clientes::delete/$1');
// Grupos de sitios
$routes->get('/GruposSitios', 'GruposSitios::index');
$routes->get('/GruposSitios/show/(:any)', 'GruposSitios::show/$1');
$routes->get('/GruposSitios/delete/(:any)', 'GruposSitios::delete/$1');
// Catalogo companias
$routes->get('/companias', 'Companias::index');
$routes->get('/companias/delete/(:any)', 'Companias::delete/$1');
// Catalogo sitios
$routes->get('/sitios', 'Sitios::index');
$routes->get('/sitios/contactos_sitios/(:any)', 'Sitios::contactos_sitios/$1');
$routes->get('/sitios/show/(:any)', 'Sitios::show/$1');
$routes->get('/sitios/delete/(:any)', 'Sitios::delete/$1');
// Catalogo termografos
$routes->get('/termografos', 'Termografos::index');
$routes->get('/termografos/delete/(:any)', 'Termografos::delete/$1');
// Catalogo tipo Inspecciones
$routes->get('/tipoInspecciones', 'TipoInspecciones::index');
$routes->get('/tipoInspecciones/delete/(:any)', 'TipoInspecciones::delete/$1');
// Catalogo paises
$routes->get('/paises', 'Paises::index');
$routes->get('/paises/delete/(:any)', 'Paises::delete/$1');
// Catalogo Grupos
$routes->get('/grupos', 'Grupos::index');
$routes->get('/grupos/delete/(:any)', 'Grupos::delete/$1');
// Catalogo usuarios
$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/delete/(:any)', 'Usuarios::delete/$1');
// Catalogo causa Principal
$routes->get('/causaPrincipal', 'CausaPrincipal::index');
$routes->get('/causaPrincipal/delete/(:any)', 'CausaPrincipal::delete/$1');
// Catalogo estatus Inspeccion
$routes->get('/estatusInspeccion', 'EstatusInspeccion::index');
$routes->get('/estatusInspeccion/delete/(:any)', 'EstatusInspeccion::delete/$1');
// Catalogo fabricantes
$routes->get('/fabricantes', 'Fabricantes::index');
$routes->get('/fabricantes/delete/(:any)', 'Fabricantes::delete/$1');
// Catalogo fallas
$routes->get('/fallas', 'Fallas::index');
$routes->get('/fallas/delete/(:any)', 'Fallas::delete/$1');
// Catalogo tipo Fallas
$routes->get('/tipoFallas', 'TipoFallas::index');
$routes->get('/tipoFallas/delete/(:any)', 'TipoFallas::delete/$1');
// Catalogo tipo Prioridades
$routes->get('/tipoPrioridades', 'TipoPrioridades::index');
$routes->get('/tipoPrioridades/delete/(:any)', 'TipoPrioridades::delete/$1');
// Inspecciones
$routes->get('/inspecciones', 'Inspecciones::index');
$routes->get('/inspecciones/listado', 'Inspecciones::listado');
$routes->get('/inspecciones/delete/(:any)', 'Inspecciones::delete/$1');
$routes->get('/inspecciones/abririnspeccion', 'Inspecciones::abririnspeccion');
$routes->post('/inspecciones/actualizar_estatus_inspeccion', 'Inspecciones::actualizar_estatus_inspeccion');
$routes->get('/inspecciones/limpiar_bd', 'Inspecciones::limpiar_bd');
$routes->post('/inspecciones/inicializar_imagenes', 'Inspecciones::inicializar_imagenes');
// Inventarios
$routes->get('/inventarios/obtenerEstatusInspecDet', 'Inventarios::obtenerEstatusInspecDet');
$routes->get('/inventarios/obtenerNodosArbol', 'Inventarios::obtenerNodosArbol');
$routes->get('/inventarios/nuevoProblema', 'Inventarios::nuevoProblema');
$routes->get('/inventarios/updateProblema', 'Inventarios::updateProblema');
$routes->get('/inventarios/guardarCronico', 'Inventarios::guardarCronico');
$routes->get('/inventarios/getProblemas_Sitio/(:any)', 'Inventarios::getProblemas_Sitio/$1');
$routes->get('/inventarios/getNumero_Problema', 'Inventarios::getNumero_Problema');
$routes->get('/inventarios/eliminarProblema/(:any)', 'Inventarios::eliminarProblema/$1');
$routes->get('/inventarios/getHistorialProblema/(:any)/(:any)', 'Inventarios::getHistorialProblema/$1/$2');
$routes->get('/inventarios/cambiarEstatusUbicacion', 'Inventarios::cambiarEstatusUbicacion');

$routes->post('/inventarios/setSelectedNode', 'Inventarios::setSelectedNode');
$routes->post('/inventarios/setUnselectedNode', 'Inventarios::setUnselectedNode');
$routes->post('/inventarios/setExpandNode', 'Inventarios::setExpandNode');

// Base LIne
$routes->get('/inventarios/guardarBaseLine', 'Inventarios::guardarBaseLine');
$routes->get('/inventarios/getHistorialBaseLine', 'Inventarios::getHistorialBaseLine');
$routes->get('/inventarios/eliminarBaseLine/(:any)', 'Inventarios::eliminarBaseLine/$1');
$routes->get('/inventarios/getHistorialInspecciones/(:any)', 'Inventarios::getHistorialInspecciones/$1');
// Obtener las img actuales
$routes->post('/inventarios/lastImg', 'Inventarios::lastImg');
$routes->match(['get', 'post'], 'inventarios/subirImagenes', 'Inventarios::subirImagenes');
$routes->match(['get', 'post'], '/inventarios/eliminarImagenes', 'Inventarios::eliminarImagenes');
$routes->get('/inventarios/explorarArchivos', 'Inventarios::explorarArchivos');
$routes->get('/inventarios/guardarDatosImg', 'Inventarios::guardarDatosImg');
$routes->get('/inventarios/obtenerDatosImg', 'Inventarios::obtenerDatosImg');
// REPORTES PDF
$routes->match(['get', 'post'],'/inventarios/generarReporteInventarios', 'Inventarios::generarReporteInventarios');
$routes->match(['get', 'post'],'/inventarios/generarReporteProblemas', 'Inventarios::generarReporteProblemas');
$routes->match(['get', 'post'],'/inventarios/ordenar_ubicaciones_baseline', 'Inventarios::ordenar_ubicaciones_baseline');
$routes->match(['get', 'post'],'/inventarios/generarReporteBaseLine', 'Inventarios::generarReporteBaseLine');
$routes->match(['get', 'post'],'/inventarios/unir_reportes_baseline_problemas', 'Inventarios::unir_reportes_baseline_problemas');
$routes->match(['get', 'post'],'/inventarios/generarReporteListaProblemas/(:any)', 'Inventarios::generarReporteListaProblemas/$1');
$routes->match(['get', 'post'],'/inventarios/generarGraficaConcentradoProblemas', 'Inventarios::generarGraficaConcentradoProblemas');
$routes->match(['get', 'post'],'/inventarios/generarResultadoDeAnalisis', 'Inventarios::generarResultadoDeAnalisis');
$routes->match(['get', 'post'],'/inventarios/generarReporteListaProblemasExcel/(:any)/(:any)', 'Inventarios::generarReporteListaProblemasExcel/$1/$2');

$routes->post('/inventarios/guardar_datos_reporte', 'Inventarios::guardar_datos_reporte');
$routes->get('/inventarios/obtener_datos_reporte', 'Inventarios::obtener_datos_reporte');
// PROCESO DB
$routes->POST('/procesobd', 'ProcesoBD::procesobd');
//DESCARGRA EL ARCHIVO SQL PROCESADO
$routes->GET('/descargar_bd_procesada/(:any)', 'ProcesoBD::descargar_bd_procesada/$1');
// PROCESO DB
$routes->POST('/cargar_bd_inspeccion', 'Inspecciones::cargar_bd_inspeccion');
// Imgs
$routes->get('/inventarios/optimizar_imagenes', 'Inventarios::optimizar_imagenes');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
