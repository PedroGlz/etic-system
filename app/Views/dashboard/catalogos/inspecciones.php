  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1><i class="fas fa-glasses"></i>&nbsp;&nbsp;Inspecciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoInspecciones"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarInspecciones">Nuevo</button>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="TbInspecciones" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Inspeccion</th>
                      <th># Inspección</th>
                      <th>Cliente</th>
                      <th>Grupo sitio</th>
                      <th>Sitio</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Estatus inspección</th>
                      <th>Ruta</th>
                      <th>No_Dias</th>
                      <th>Unidad_Temp</th>
                      <th>No_Inspeccion_Ant</th>
                      <th>Estatus</th>
                      <th>Creado_Por</th>
                      <th>Fecha_Creacion</th>
                      <th>Modificado_Por</th>
                      <th>Fecha_Mod</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- ========================================================================================
  Ventana Modal
  ==========================================================================================-->

  <div class="modal fade" id="modalAgregarInspecciones" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos de la inspección</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/inspecciones/create" method="POST" id="FrmInspecciones">
            <div class="box-body">
              
              <!-- Campo de id oculto -->
              <div hidden>
                <input type="text" name="Id_Inspeccion" id="Id_Inspeccion" value="0">
                <input type="text" name="No_Inspeccion" id="No_Inspeccion" readonly>
                <input type="text" name="No_Inspeccion_Ant" id="No_Inspeccion_Ant" readonly>
              </div>

              <!-- campo de cliente -->
              <div class="form-group row">
                <label for="Id_Cliente" class="col-sm-2 col-form-label">Cliente:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="Id_Cliente" name="Id_Cliente"></select>
                </div>  
              </div>
              <!-- campo de Grupos sitios -->
              <div class="form-group row">
                <label for="Id_Grupo_Sitios" class="col-sm-3 col-form-label">Grupos sitios:</label>
                <div class="col-sm-9">
                  <select class="form-control" id="Id_Grupo_Sitios" name="Id_Grupo_Sitios">
                    <option value="">Seleccionar...</option>
                  </select>
                </div>
              </div>
              <!-- campo de Sitio -->
              <div class="form-group row">
                <label for="Id_Sitio" class="col-sm-2 col-form-label">Sitio:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="Id_Sitio" name="Id_Sitio">
                    <option value="">Seleccionar...</option>
                  </select>
                </div>
              </div>
              <!-- Estatus de la inspeccion -->
              <div class="form-group row">
                <label for="Id_Status_Inspeccion" class="col-sm-2 col-form-label">Estatus:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="Id_Status_Inspeccion" name="Id_Status_Inspeccion">
                    <option value="73F27003-76B3-11D3-82BF-00104BC75DC2" selected>En progreso</option>
                    <option value="73F27007-76B3-11D3-82BF-00104BC75DC2">Cerrada</option>
                  </select>
                </div>
              </div>
              <!-- Campo unidad temoeratura -->
              <div class="form-group row" hidden>
                <label for="Unidad_Temp" class="col-sm-5 col-form-label">Unidad de temperatura:</label>
                <div class="col-sm-7">
                  <select class="form-control" id="Unidad_Temp" name="Unidad_Temp">
                    <option value="C" selected>°C</option>
                    <option value="F">°F</option>
                  </select>
                </div>
              </div>
              <hr/>
              <!-- campos de fecha -->
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="Fecha_Inicio">Fecha Inicio:</label>
                  <input type="datetime-local" class="form-control" id="Fecha_Inicio" name="Fecha_Inicio" placeholder="Ingresa la contraseña">
                </div>
                <div class="col-sm-6">
                  <label for="Fecha_Fin">Fecha Final:</label>
                  <input type="datetime-local" class="form-control" id="Fecha_Fin" name="Fecha_Fin" placeholder="Repite la contraseña" readonly>
                </div>
              </div>
              <!-- Campo de Estatus -->
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="Estatus" id="Estatus" value="Activo" checked>
                <label class="custom-control-label" for="Estatus">Activo</label>
              </div>

            </div>
            <!-- /.box-body -->
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->