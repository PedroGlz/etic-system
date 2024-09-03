  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- COntiene la clase disable por defecto para validar en inventarios.js si el estatus no es cerrado entonces se quita la calse para poder utilizar elmodulo -->
      <div class="container-fluid disable" id="contenedor_modulo_inspeccion_actual">
        <div class="row">
          <div class="col-12">

            <div class="card card-primary card-outline">
              <!-- Encabezado del card -->
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-industry"></i>
                  <span class="text-primary" id="nombreSitio">&nbsp;&nbsp;<?=$nombreSitio;?></span>
                </h3>
                <div class="card-tools d-flex align-items-end">
                  <div class="btn-group mr-1">
                    <div>
                      <div><label class="">Buscar código de barras</label></div>
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="input_buscar_codigo_barras">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary btn-sm" type="button" id="btn_buscar_codigo_barras">
                            <i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="btn-group mr-1">
                    <div>
                      <div><label class="">Estatus elementos</label></div>
                      <div class="input-group input-group-sm">
                        <select class="form-control" id="Id_Status_Inspeccion_Det" name="Id_Status_Inspeccion_Det"></select>
                      </div>
                    </div>
                  </div>
                  <div class="btn-group" style="margin-bottom:-5px">
                    <div>
                      <button type="button" class="btn btn-success btn-sm" id="btn_nueva_ubicacion">
                        <i class="fas fa-cubes"></i>&nbsp;&nbsp;Nueva ubicación
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Cuerpo del card -->
              <div class="card-body" id="contenedor_elementos_inspeccion">

                <div class="clearfix fontJsGrid" style="" id="contenedor_elementos_inventario">

                  <div id="parent">

                    <div id="LeftCol">
                      <button type="button" class="btn btn-default styleBtnInicioTree" id="btnInicio" style='display:none !important;'>
                        <i class="fas fa-industry"></i>&nbsp;&nbsp;<?=$nombreSitio;?>
                      </button>
                      <div id="treeview"></div>
                    </div>

                    <div id="RightCol">
                      <div id="jsGridInventario" class="fontJsGrid" style="padding-left: 3px;"></div>
                    </div>
                  </div>

                </div>
              
                <div class="stilo_resize_lista">

                  <fieldset class="border p-1">
                    <div class="">
                      <ul class="nav nav-tabs" id="" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="ListaProblemas-tab" data-toggle="pill" href="#ListaProblemas" role="tab" aria-controls="ListaProblemas" aria-selected="true">
                            <i class="far fa-list-alt"></i>
                            <span class="">&nbsp;Listado de Problemas</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="ListaBaseLine-tab" data-toggle="pill" href="#ListaBaseLine" role="tab" aria-controls="ListaBaseLine" aria-selected="false">
                            <i class="fas fa-tasks"></i>
                            <span>Listado Base Line</span>
                          </a>
                        </li>
                      </ul>

                      <div class="tab-content" id="contenedor_listas">
                        <!-- /. 1a Pestaña Listado de problemas -->
                        <div class="tab-pane fade show active" id="ListaProblemas" role="tabpanel" aria-labelledby="ListaProblemas-tab">

                          <!-- <div class="card-body"> -->
                            <div class="card-tools" id="contenedor_filtros_lista_problemas">
                              <div class="btn-group mr-1">
                                <div class="input-group input-group-sm align-content-center">
                                  <div class="input-group-prepend">
                                    <label class="">Tipo:&nbsp;&nbsp;</label>
                                  </div>
                                  <select class="form-control" name="" id="filtroTipoProblem">
                                    <option value="0" selected>Todos</option>
                                    <option value="0D32B331-76C3-11D3-82BF-00104BC75DC2">Eléctrico</option>
                                    <option value="0D32B333-76C3-11D3-82BF-00104BC75DC2">Visual</option>
                                    <option value="0D32B334-76C3-11D3-82BF-00104BC75DC2">Mecánico</option>
                                  </select>
                                </div>
                              </div>
                              <div class="btn-group mr-1">
                                <div class="input-group input-group-sm align-content-center">
                                  <div class="input-group-prepend">
                                    <label class="">Estatus:&nbsp;&nbsp;</label>
                                  </div>
                                  <select class="form-control" name="" id="filtroEstatus">
                                    <option value="0">Todos</option>
                                    <option value="1">Abiertos, actuales</option>
                                    <option value="2" selected="">Abiertos, pasado</option>
                                    <option value="3">Abiertos, todos</option>
                                    <option value="4">Cerrados</option>
                                  </select>
                                </div>
                              </div>
                              <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-sm" id="btnNuevoProblema" data-toggle="modal" data-target="">
                                  <i class="fas fa-wrench"></i>&nbsp;&nbsp;Nuevo Problema
                                </button>
                              </div>
                            </div>

                            <div class="">
                              <div id="jsGridProblemas" class="fontJsGrid"></div>
                            </div>
                          <!-- </div> -->
                        </div>

                        <!-- /. 2a pestaña Listado Base Line-->
                        <div class="tab-pane fade" id="ListaBaseLine" role="tabpanel" aria-labelledby="ListaBaseLine-tab">
                          <!-- <div class="card-body"> -->
                            <div class="">
                              <div id="jsGridListaBaseLine" class="fontJsGrid"></div>
                            </div>
                          <!-- </div> -->
                        </div>
                      </div>

                    </div>
                  </fieldset>

                </div>

              </div><!-- /.card-body -->
            </div><!-- /.card -->

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div>

  <!-- ========== Modal Agregar Ubicaciones ==================================================================-->
  <div class="modal fade" id="modalAgregarUbicacion" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 90%;">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h4 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;<span></span></h4>
          <div class="btn-group">
            <!-- <button type="button" class="btn btn-info" id="btnGuardarUbicacion">
              <i class="nav-icon fas fa-edit"></i>&nbsp;&nbsp;Guardar
            </button> -->
            <!-- <button type="button" class="btn btn-info" id="btnResetModal">
              <i class="fas fa-file"></i>&nbsp;&nbsp;Nuevo
            </button>
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-bars"></i>&nbsp;&nbsp;Acciones
            </button>
            <div class="dropdown-menu" role="menu">
              <a href="#" class="dropdown-item">Copiar</a>
              <a href="#" class="dropdown-item">Mover</a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">Cambiar de Sitio</a>
            </div> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="row">
            <!-- left column -->
            <div class="col-sm-4">
              <div class="box-body">
                <form action="/inventarios/nuevo" id="FormInventarios" method="POST" class="form-horizontal">
                  <!-- Campos ocultos -->
                  <div hidden>
                    <div>id_inspeccion<input type="text" id="Id_Inspeccion" name="Id_Inspeccion" value="<?=$Id_Inspeccion;?>"></div>
                    <div>Id_Inspeccion_Det<input type="text" id="Id_Inspeccion_Det" name="Id_Inspeccion_Det"></div>
                    <div>id_sitio<input type="text" id="Id_Sitio" name="Id_Sitio" value="<?=$Id_Sitio;?>"></div>
                    <div>ubicacion_padre<input type="text" id="Id_Ubicacion_padre" name="Id_Ubicacion_padre" value="0"></div>
                    <div>nivel_arbol<input type="number" id="Nivel_arbol" name="Nivel_arbol" value="1"></div>
                    <div>id_ubicacion<input type="text" id="Id_Ubicacion" name="Id_Ubicacion"></div>
                    <div>ruta<input type="text" id="ruta_nueva_ubicacion" name="ruta_nueva_ubicacion"></div>
                  </div>

                  <div class="">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class='far fa-question-circle'></i></span>
                      </div>
                      <select class="form-control form-control-sm" id="Test_Estatus" name="Test_Estatus"></select>
                    </div>
                  </div>

                  <div class="row mt-1">
                    <!-- Es Equipo -->
                    <div class="col">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="Es_Equipo" id="Es_Equipo" value="SI">
                        <label class="custom-control-label" for="Es_Equipo"></label>
                        <label class="col-form-label col-form-label-sm" id="">¿Es equipo?</label>
                      </div>
                    </div>
                  </div>

                  <hr class="mt-1 mb-2" />

                  <!-- campo de Ubicacion -->
                  <div class="form-group mb-1">
                    <label for="Ubicacion" class="col-form-label col-form-label-sm">*Nombre:</label>
                    <input type="text" class="form-control form-control-sm" id="Ubicacion" name="Ubicacion" placeholder="Ingresa el nombre" required>
                  </div>
                  <!-- campo de Descripcion -->
                  <div class="form-group mb-1">
                    <label for="Descripcion" class="col-form-label col-form-label-sm">Descripción:</label>
                    <textarea class="form-control form-control-sm" rows="3" id="Descripcion" name="Descripcion" placeholder="..."></textarea>
                  </div>
                  <!-- campo de Prioridad -->
                  <div class="form-group mb-1">
                    <label for="Id_Tipo_Prioridad" class="col-form-label col-form-label-sm">Prioridad:</label>
                    <select class="form-control form-control-sm" id="Id_Tipo_Prioridad" name="Id_Tipo_Prioridad"></select>
                  </div>

                  <hr class="mt-2 mb-2" />

                  <div class="mb-1">
                    <label for="Codigo_Barras" class="col-form-label col-form-label-sm">Código de Barras:</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text">ETIC</span>
                      </div>
                      <input type="text" class="form-control form-control-sm" name="Codigo_Barras" id="Codigo_Barras">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Id_Fabricante" class="col-form-label col-form-label-sm">Fabricante:</label>
                    <select class="form-control form-control-sm" id="Id_Fabricante" name="Id_Fabricante"></select>
                  </div>

                  <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" id="btnGuardarUbicacion">Guardar</button>
                  </div>

                </form>
              </div>
              <!-- /.box-body -->
            </div>

            <!-- TABS -->
            <div class="col-sm-8" id="CardBaseLine">
              <div class="card card-warning card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="Base-Line-tab" data-toggle="pill" href="#Base-Line" role="tab" aria-controls="Base-Line" aria-selected="true">
                        Eq. Monitoreo: Baseline
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="BL-Historial-tab" data-toggle="pill" href="#BL-Historial" role="tab" aria-controls="BL-Historial" aria-selected="false">
                        Histórico Inspecciones
                      </a>
                    </li>
                  </ul>
                </div>

                <div class="card-body" style="padding-bottom: 0.5em;padding-top: 0.5em;">
                  <div class="tab-content" id="custom-tabs-four-tabContent">
                    <!-- /. 1a Pestaña -->
                    <div class="tab-pane fade show active" id="Base-Line" role="tabpanel" aria-labelledby="Base-Line-tab">
                      <div class="row">
                        <div class="col-sm">
                          <!-- GRID BASELINE -->
                          <div class="form-group">
                            <div class="row text-center">
                              <div id="jsGridBaseLine" class="fontJsGrid"></div>
                            </div>
                          </div>
                          <div class="" style="display: flex; justify-content: flex-end">
                            <button type="button" class="btn btn-warning btn-sm" id="btnNuevoBaseLine" data-toggle="modal" data-target="#">
                              <i class="fas fa-check-double"></i>&nbsp;&nbsp;Nuevo Baseline
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- /. 2a pestaña -->
                    <div class="tab-pane fade" id="BL-Historial" role="tabpanel" aria-labelledby="BL-Historial-tab">
                      <div id="jsGridHistorialInspecciones" class="fontJsGrid"></div>
                    </div>
                    <!-- /.tab -->
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-start">
          <i class="fa fa-sitemap"></i><span class="text-success">Ruta: </span><span class="text-success" id="pathUbicacion"><?=$nombreSitio;?> / </span>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- ========== Modal Seleccionar tipo problema ============================================================-->
  <div class="modal fade" id="modalSeleccionarProblema" data-backdrop="static">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h4 class="modal-title">Tipo de problema</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body">
            <form id="frmSeleccionarProblema">
              <label for="">Seleccionar problemas:</label>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio1" name="seleccionProblema" value="0D32B331-76C3-11D3-82BF-00104BC75DC2" class="custom-control-input" checked>
                <label class="custom-control-label" for="customRadio1"></label>Eléctrico
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" name="seleccionProblema" value="0D32B333-76C3-11D3-82BF-00104BC75DC2" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2"></label>Visual
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio3" name="seleccionProblema" value="0D32B334-76C3-11D3-82BF-00104BC75DC2" class="custom-control-input">
                <label class="custom-control-label" for="customRadio3"></label>Mecánico
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm col" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm col-8" id="btnProblemaContinuar">Continuar</button>
        </div>
      </div>
    </div>

  </div>
  <!-- /.modal -->

  <!-- ========== Modal Base Line ============================================================-->
  <div class="modal fade" id="modalBaseLine" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h4 class="modal-title">Baseline</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body">
            <?php include('formularioBaseLine.php'); ?>
          </div>
          <!-- /.box-body -->
        </div>

        <div class="modal-footer">
          <div class="btn-group btn-group-sm mr-auto" role="group" aria-label="Basic example" id="contenedorBtnNavegacionBL" style="display:none">
            <button type="button" class="btn btn-secondary" id="btnAtras" style="margin-right:7px; width:35px">
              <i class="fas fa-caret-left"></i>
            </button>
            <button type="button" class="btn btn-secondary" id="btnSiguiente" style="margin-left:7px; width:35px">
              <i class="fas fa-caret-right"></i>
            </button>
          </div>

          <button type="button" class="btn btn-default btn-sm col-sm-3" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm col-sm-4" id="btnGuardarBaseLine">Guardar</button>
        </div>
      </div>
    </div>

  </div>
  <!-- /.modal -->

  <!-- ========== Modal Agregar Problema ==================================================================-->
  <div class="modal fade" id="modalProblemas" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h4 class="modal-title" id="tituloModalProblemas">Detalles del problema</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/inventarios/nuevoProblema" id="FrmProblemas" method="POST" class="form-horizontal">
            <div hidden>
              <div>Id_Problema<input type="text" id="Id_Problema" name="Id_Problema"></div>
              <div>Id_Tipo_Inspeccion<input type="text" id="Id_Tipo_Inspeccion" name="Id_Tipo_Inspeccion"></div>
              <div>id_ubicacion_original_referencia<input type="text" id="id_ubicacion_original_referencia" name="id_ubicacion_original_referencia"></div>
              <div>Id_Inspeccion_Det_Cronico<input type="text" id="Id_Inspeccion_Det_Cronico" name="Id_Inspeccion_Det_Cronico"></div>
            </div>

            <div class="mb-2" id="rowCronicoEstatus" style="display: none;">
              <div class="row" style="display: flex; justify-content: flex-end">

                <div class="btn-group btn-group-sm mr-auto" role="group" aria-label="Basic example" id="contenedorBtnNavegacionProblemas" style="display:none">
                  <button type="button" class="btn btn-secondary" id="btnAtrasProblemas" style="margin-right:7px; width:35px">
                    <i class="fas fa-caret-left"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" id="btnSiguienteProblemas" style="margin-left:7px; width:35px">
                    <i class="fas fa-caret-right"></i>
                  </button>
                </div>

                <div class="col-sm-2">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <label class="col-form-label col-form-label-sm" id="labelCronico">Crónico:&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" name="Es_Cronico" id="Es_Cronico" disabled>
                      <label class="custom-control-label" for="Es_Cronico"></label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2" id="divCerrado">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <label class="col-form-label col-form-label-sm">Cerrado:&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" name="Estatus_Problema" id="Estatus_Problema">
                      <label class="custom-control-label" for="Estatus_Problema"></label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-1" id="divCronico" style="display:none;">
                  <button type="button" id="btnCronico" class="btn btn-warning btn-sm">
                    <span class="icon expand-icon fas fa-plus"></span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Menu de tabs de imagenes y datos solo para problema electricos y mecanicos -->
            <ul class="nav nav-tabs" id="menuTabsProblemaElectricoMecanico" role="tablist" style="display:">
              <li class="nav-item">
                <a class="nav-link active" id="tabDatosProblema-tab" data-toggle="pill" href="#tabDatosProblema" role="tab" aria-controls="tabDatosProblema" aria-selected="true">
                  <span class="">&nbsp;Datos</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tabImgProblema-tab" data-toggle="pill" href="#tabImgProblema" role="tab" aria-controls="tabImgProblema" aria-selected="false">
                  <span>Imágenes</span>
                </a>
              </li>
            </ul>

            <!-- Contenedor con los datos generales de los problemas NUEVO-->
            <div id="rowNew">
              <div class="row">
                <div class="col-sm-2">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group">
                      <label class="">Inspección No:</label>
                    </div>
                    <input type="text" class="form-control" name="strNumInspeccion" id="strNumInspeccion" value="<?=$inspeccion;?>" readonly>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group">
                      <label class="">Problema No:</label>
                    </div>
                    <input type="text" class="form-control" name="Numero_Problema" id="Numero_Problema" readonly>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group">
                      <label class="">Tipo problema:</label>
                    </div>
                    <input type="text" class="form-control" name="StrTipoInspeccion" id="StrTipoInspeccion" readonly>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group">
                      <label class="">Equipo:</label>
                    </div>
                    <input type="text" class="form-control" name="StrEquipo" id="StrEquipo" readonly>
                  </div>
                </div>
              </div>
            </div>

            <!-- Contenedor con los datos generales de los problemas EDITAR-->
            <div>
              <div id="encabezado_datos_electrico" style="display: none;">
                <div class="" id="rowEditElectrico" style="display: none;">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Inspección No:</label>
                        </div>
                        <input type="text" class="form-control" name="strNumInspeccionEdit" id="strNumInspeccionEdit" value="<?=$inspeccion;?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Problema No:</label>
                        </div>
                        <input type="text" class="form-control" name="Numero_ProblemaEdit" id="Numero_ProblemaEdit" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Tipo problema:</label>
                        </div>
                        <input type="text" class="form-control" name="StrTipoInspeccionEdit" id="StrTipoInspeccionEdit" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Delta Temp:</label>
                        </div>
                        <input type="text" name="aumentoTemp" id="aumentoTemp" class="form-control" readonly>
                        <div class="input-group-append">
                          <span class="input-group-text">°C</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Severidad:</label>
                        </div>
                        <input type="text" class="form-control" name="StrSeveridad" id="StrSeveridad" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                      <div class="input-group">
                        <label class="col-form-label col-form-label-sm">Falla:</label>
                      </div>
                      <select class="form-control crearComentAuto" name="Id_Falla" id="Id_Falla"></select>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="input-group input-group-sm">
                      <div class="input-group">
                        <label class="col-form-label col-form-label-sm">Ruta:</label>
                      </div>
                      <input type="text" class="form-control fontSizeInputRuta" name="StrRuta" id="StrRuta" readonly>
                    </div>
                  </div>
                </div>

                <hr class="mt-1" />
              </div>
              
              <div id="encabezado_datos_visual" style="display: none;">
                <div id="rowEditVisual" style="display: none;">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Inspección No:</label>
                        </div>
                        <input type="text" class="form-control" name="strNumInspeccionEditVisual" id="strNumInspeccionEditVisual" value="<?=$inspeccion;?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Problema No:</label>
                        </div>
                        <input type="text" class="form-control" name="Numero_ProblemaEditVisual" id="Numero_ProblemaEditVisual" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Tipo problema:</label>
                        </div>
                        <input type="text" class="form-control" name="StrTipoInspeccionEditVisual" id="StrTipoInspeccionEditVisual" readonly>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                          <label class="col-form-label col-form-label-sm">Equipo:</label>
                        </div>
                        <input type="text" class="form-control" name="StrEquipoEditVisual" id="StrEquipoEditVisual" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm">
                    <div class="input-group input-group-sm">
                      <div class="input-group">
                        <label class="col-form-label col-form-label-sm">Ruta:</label>
                      </div>
                      <input type="text" class="form-control fontSizeInputRuta" name="StrRutaVisual" id="StrRutaVisual" readonly>
                    </div>
                  </div>
                </div>
              
                <hr class="mt-1" />
              </div>
            </div>

            <div class="tab-content" id="">
              <!-- /. 1a Pestaña Datos del problema -->
              <div class="tab-pane fade show active" id="tabDatosProblema" role="tabpanel" aria-labelledby="tabDatosProblema-tab">


                <div id="divProblemaElectrico" style="display: block;">
                  <?php include('formularioProblemaElectrico.php'); ?>
                </div>

                <div id="divProblemaVisual" style="display: block;">
                  <?php include('formularioProblemaVisual.php'); ?>
                </div>

                <hr class="mt-2" />

                <div class="text-center">
                  <div class="text-center">
                    <label class="col-form-label col-form-label-sm">Historia de este problema</label>
                  </div>
                  <div id="jsGridHistorialProblemas" class="fontJsGrid"></div>
                </div>
              </div>

              <!-- /. 2a pestaña Imagenes del problema-->
              <div class="tab-pane fade" id="tabImgProblema" role="tabpanel" aria-labelledby="tabImgProblema-tab">
                <div class="row">
                  <!-- Archivo IR -->
                  <div class="col-sm-4 mt-2">
                    <label for="Archivo_IR" class="col-form-label col-form-label-sm">IR Imagen:</label>
                    <div class="input-group input-group-sm" style="" id="contenedorImgIrProblemas">
                      <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="Ir_File" id="Ir_File" placeholder="Nombre archivo" aria-invalid="false">
                      <div class="btn-group-vertical btn-group-sm">
                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnUp">
                          <i class="fas fa-chevron-up"></i>
                        </button>
                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnDown">
                          <i class="fas fa-chevron-down"></i>
                        </button>
                      </div>
                      <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                      <div class="input-group-prepend">
                        <button class="btn btn-info btn-sm btnModalArchivos" type="button" data-toggle="modal" data-target="#modalFileExplorer">
                          <i class="fas fa-folder-open fa-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Archivo ID -->
                  <div class="col-sm-4 mt-2">
                    <label for="Archivo_ID" class="col-form-label col-form-label-sm">DIG Imagen:</label>
                    <div class="input-group input-group-sm" style="" id="contenedorImgDigProblemas">
                      <input type="text" class="form-control form-control-sm inputTextImg" name="Photo_File" id="Photo_File" placeholder="Nombre archivo" aria-invalid="false">
                      <div class="btn-group-vertical btn-group-sm">
                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnUp">
                          <i class="fas fa-chevron-up"></i>
                        </button>
                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnDown">
                          <i class="fas fa-chevron-down"></i>
                        </button>
                      </div>
                      <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                      <div class="input-group-prepend">
                        <button class="btn btn-info btn-sm btnModalArchivos" type="button" data-toggle="modal" data-target="#modalFileExplorer">
                          <i class="fas fa-folder-open fa-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="card-body" style="padding-bottom: 0.5em;padding-top: 0.5em;">
                      <img src="img/sistema/imagen-no-disponible.jpeg" class="img-fluid" style="max-width: 100%; height: auto;" id="imgIR_Problema" onerror="imgError(this);" />
                      <div class="datosImg" style="font-size:12px"></div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="card-body" style="padding-bottom: 0.5em;padding-top: 0.5em;">
                      <img src="img/sistema/imagen-no-disponible.jpeg" class="img-fluid" style="max-width: 100%; height: auto;" id="imgID_Problema" onerror="imgError(this);" />
                      <div class="datosImg" style="font-size:12px"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer justify-content-between mb-1">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="btnGuardarProblema" class="btn btn-primary btn-sm col-4">Guardar</button>
        </div>
      </div>
    </div>

  </div>
  <!-- /.modal -->

  <!-- ========== Modal PDF INVENTARIOS ============================================================-->
  <div class="modal fade" id="modalSeleccionarElementosPdf" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <label class="modal-title">Seleccionar Ubicaciones</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body" style="overflow-y:auto; max-height: 450px;">
            <div class="row">
              <div class="col">
                <strong>Inventario</strong>
              </div>
              <div class="col">
                <div style="display: flex; justify-content: end">
                  <button type="button" class="btn btn-default btn-sm btnCheckAll inventario" id="" value="false">
                    <i class="fas fa-check-circle"></i> <strong>/</strong> <i class="far fa-circle"></i>
                  </button>
                </div>
              </div>
            </div>
            <!-- Reporte indivudual (ri) -->
            <div id="contenedor_lista_ri"></div>
          </div>
          <!-- /.box-body -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm col" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm col-8" id="btnGenerarPdf_inventario">
            Generar reporte
          </button>
        </div>
      </div>
    </div>

  </div>
  <!-- /.modal -->

  <!-- ========== Modal PDF PROBLEMAS ============================================================-->
  <div class="modal fade" id="modalSeleccionarProblemasPdf" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <label class="modal-title">Seleccionar Problemas</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body" style="overflow-y:auto; max-height: 450px;">

            <table style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Problema</th>
                  <th>Equipo</th>
                  <th style="text-align:right">
                    <button type="button" class="btn btn-default btn-sm btnCheckAll problemas" id="" value="false">
                      <i class="fas fa-check-circle"></i> <strong>/</strong> <i class="far fa-circle"></i>
                    </button>
                  </th>
                </tr>
              </thead>
              <tbody id="tablaProblemasPdf_ri"></tbody>
            </table>

          </div>
          <!-- /.box-body -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm col" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm col-8" id="btnGenerarPdfproblemas">
            Generar reporte
          </button>
        </div>
      </div>
    </div>

  </div>
  <!-- /.modal -->

  <!-- ========== Modal PDF RESULTADOS ANALISIS RIESGOS ============================================================-->
  <?php include('formularioReporteResultadoAnalisis.php'); ?>
  <!-- /.modal -->

  <!-- ========== Modal fechas reporte excel ============================================================-->
  <div class="modal fade" id="modal_fechas_reporte_excel_problemas" data-backdrop="static">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h4 class="modal-title">Fecha de reporte</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body">
            <form id="frm_seleccionar_fechas_excel_problemas">
              <div class="form-group">
                <label class="col-sm-12 col-form-label-sm pl-0" for="fecha_inicio_reporte_excel">
                  Fecha de inicio:
                </label>
                <input type="date" class="form-control form-control-sm" name="fecha_inicio_reporte_excel" id="fecha_inicio_reporte_excel">
              </div>
              <div class="form-group">
                <label class="col-sm-12 col-form-label-sm pl-0" for="fecha_fin_reporte_excel">
                  Fecha de finalización:
                </label>
                <input type="date" class="form-control form-control-sm" name="fecha_fin_reporte_excel" id="fecha_fin_reporte_excel">
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm col" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm col-8" id="btn_generar_reporte_excel_problemas">Continuar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal -->
