<?php
  helper('url');
?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <div class="info">
        <b>No. Inspeccion:&nbsp;<?=  empty($inspeccion) ? 'N/A' :  $inspeccion;?></b>
      </div>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Cerrar sesion Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-sign-out-alt"></i>
            <!--<span class="badge badge-warning navbar-badge">15</span>-->
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Sistema</span>
            <!-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i>Logs de accesos
            </a> -->
            <div class="dropdown-divider"></div>
            <a href="/salir" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i>Salir del sistema
            </a>

          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <!--<li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="img/sistema/img_etic_menu.png" alt="ETIC Logo" class="brand-image">
        <span class="brand-text font-weight-light">ETIC - System</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="img/sistema/user_ico.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <div hidden>
              <div><input type="text" name="tipo_usuario_log" id="tipo_usuario_log" value="<?= $grupo; ?>"></div>
              <div><input type="text" name="ctrl_estatus_inspeccion" id="ctrl_estatus_inspeccion" value="<?= empty($Id_Status_Inspeccion) ? 0 :  $Id_Status_Inspeccion; ?>"></div>
              <div><input type="text" name="ctrl_id_inspeccion" id="ctrl_id_inspeccion" value="<?= empty($Id_Inspeccion) ? 0 :  $Id_Inspeccion; ?>"></div>
            </div>
            <a href="#" class="d-block"><?= $grupo; ?></a>
            <div class="text-wrap"><a href="#" class="d-block"><?= empty($usuario) ? 'N/A' :  $usuario; ?></a></div>
          </div>
        </div>
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <i class='fas fa-glasses' style='color:white'></i>
          </div>
          <div class="info">
            <a href="#" class="d-block">No. Inspeccion:&nbsp;<?=  empty($inspeccion) ? 'N/A' :  $inspeccion;    ?></a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library fa-copy-->

            <!--APARTADO DE CATALOGOS -->
            <div class="user-panel mb-3 d-flex">
              <li class="nav-item">
                <ul class="nav nav-treeview" style="display: block;">
                  <!-- <li class="nav-item">
                    <a href="/tablero" class="nav-link">
                      <i class="nav-icon fas fa-th"></i>
                      <p>
                        Tablero control
                      </p>
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        Catalogos
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/clientes" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Clientes</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/gruposSitios" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Grupos sitios</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/sitios" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Sitios</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/termografos" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Termógrafos</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/tipoInspecciones" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Tipos de Inspección</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                      <!-- <li class="nav-item">
                        <a href="/causaPrincipal" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Causa principal</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/estatusInspeccion" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Estatus inspección</p>
                        </a>
                      </li> -->
                      <?php endif;?>

                      <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                      <li class="nav-item">
                        <a href="/fabricantes" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Fabricantes</p>
                        </a>
                      </li>
                      <?php endif;?>

                      <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                      <li class="nav-item">
                        <a href="/fallas" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Fallas</p>
                        </a>
                      </li>
                      <?php endif;?>

                      <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                      <li class="nav-item">
                        <a href="/tipoFallas" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Tipo fallas</p>
                        </a>
                      </li>
                      <?php endif;?>

                      <?php if ($grupo == "Administradores"): ?>
                      <!-- <li class="nav-item">
                        <a href="/tipoPrioridades" class="nav-link">
                          <i class="nav-icon far fa-circle nav-icon"></i>
                          <p>Tipo prioridades</p>
                        </a>
                      </li> -->
                      <?php endif;?>
                    </ul>
                  </li>

                  <?php if ($grupo == "Administradores"): ?>
                    <!-- <li class="nav-item">
                      <a href="/inspecciones" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p> Inspecciones</p>
                      </a>
                    </li> -->
                  <?php endif;?>

                </ul>
              </li>
            </div>

            <!--APARTADO DE ESTATUS DE INSPECCION -->
            <div class="user-panel mb-3 d-flex">
              <li class="nav-item">
                <ul class="nav nav-treeview" style="display: block;">

                  <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                    <li class="nav-item">
                      <a href="/inventarios" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                        <p> Inspección Actual</p>
                      </a>
                    </li>
                    
                    <!-- Solo Si hay una inspeccion abierta se muestran estas opciones -->
                    <?php if (!empty($Id_Inspeccion)): ?>
                      <li class="nav-item">
                        <a href="#" id="btn_estatus_inspeccion" class="nav-link">
                          <i class="nav-icon fas fa-unlock-alt"></i>
                          <p> Estatus de inspección</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="#" id="btn_inicializar_imagenes" class="nav-link">
                          <i class="nav-icon far fa-image"></i>
                          <p> Inicializar imágenes</p>
                        </a>
                      </li>
                    <?php endif;?>

                  <?php endif;?>

                  <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                    <li class="nav-item">
                      <a href="#" id="" class="nav-link btn_abrir_carpeta_archivos imagenes">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p> Carpeta de imágenes</p>
                      </a>
                    </li>
                  <?php endif;?>

                  <?php if ($grupo == "Administradores" || $grupo == "Termografos"): ?>
                    <li class="nav-item">
                      <a href="#" id="" class="nav-link btn_abrir_carpeta_archivos reportes">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p> Carpeta de reportes</p>
                      </a>
                    </li>
                  <?php endif;?>
                </ul>
              </li>
            </div>

            <!-- APARTADO DE REPORTES -->
            <div class="user-panel mb-3 d-flex">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>REPORTES <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="#" class="nav-link" onclick="optimizar_imagenes()">
                      <i class="nav-icon fas fa-star"></i>
                      <p> Optimizar imágenes</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a id="btnGenerarResultadoAnalisis" target="_blank" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon far fa-file-alt"></i>
                      <p> Resultados de Análisis</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" id="btnReporteInventarios" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-cubes"></i>
                      <p> Reporte de Inventarios</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" id="btnReporteProblemas" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-wrench"></i>
                      <p> Reporte de Problemas</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <!-- <a href="/inventarios/generarReporteBaseLine" class="nav-link"> -->
                    <a href="#" id="btnReporteBaseLine" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-clipboard-check"></i>
                      <p> Reporte de Baseline</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" id="btnReporteProblemasAbiertos" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-exclamation-triangle"></i>
                      <p> Lista de Problemas Abiertos</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" id="btnReporteProblemasCerrados" class="nav-link" style="cursor:pointer;">
                    <i class="nav-icon far fa-thumbs-up"></i>
                      <p> Lista de Problemas Cerrados</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <!-- <a href="/inventarios/generarGraficaConcentradoProblemas" id="btnGraficaConcentradoProblemas" class="nav-link" style="cursor:pointer;"> -->
                    <a href="#" id="btnGraficaConcentradoProblemas" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-chart-bar"></i>
                      <p> Grafica de Anomalías</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" id="btnReporteListaProblemasExcel" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-table"></i>
                      <p>Excel Lista de Problemas</p>
                    </a>
                  </li>
                </ul>
              </li>
            </div>

            <!-- APARTADO DE SISTEMA -->
            <?php if ($grupo == "Administradores"): ?>
            <div class="user-panel mb-3 d-flex">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>SISTEMA <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- <li class="nav-item">
                    <a href="/usuarios" class="nav-link">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Usuarios
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/grupos" class="nav-link">
                      <i class="nav-icon fas fa-user-friends"></i>
                      <p>
                        Grupos
                      </p>
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <a href="#" id="btn_script_bd" class="nav-link" style="cursor:pointer;">
                      <i class="nav-icon fas fa-database"></i>
                      <p>
                        Procesar Base de datos
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            </div>
            <?php endif; ?>

            <!-- TAMAÑO DE LETRA -->
            <div class="user-panel mb-3 d-flex">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>FUENTE <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" id="" class="nav-link" style="cursor:pointer;" onclick="cambiar_size_fuente('0.9')">
                      <p>Pequeño</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" id="" class="nav-link" style="cursor:pointer;" onclick="cambiar_size_fuente('1')">
                      <p>Mediano</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" id="" class="nav-link" style="cursor:pointer;" onclick="cambiar_size_fuente('1.1')">
                      <p>Grande</p>
                    </a>
                  </li>
                </ul>
              </li>
            </div>
            
            <!-- APARTADO DE AYUDA -->
            <li class="nav-header">AYUDA</li>
            <li class="nav-item">
              <a href="#" id="" class="nav-link btn_abrir_carpeta_archivos documentacion">
                <i class="nav-icon far fa-folder-open"></i>
                <p>Documentación</p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>