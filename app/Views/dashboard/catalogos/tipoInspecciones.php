  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-shapes"></i>&nbsp;&nbsp;Tipos de inspección</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoTipoInspeccion"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarTipoInspeccion">Nuevo</button>
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
                <table id="TbTipoInspecciones" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Tipo_Inspeccion</th>
                      <th>Tipo</th>
                      <th>Descripción</th>
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

  <div class="modal fade" id="modalAgregarTipoInspeccion" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos del tipo de inspección</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/tipoInspecciones/create" method="POST" id="FrmTipoInspecciones">
            <div class="box-body">
              
              <!-- Campo de id oculto -->
              <input type="hidden" name="Id_Tipo_Inspeccion" id="Id_Tipo_Inspeccion" value="0">

              <!-- Campos nombre sitio, cliente y dirección -->
              <div class="">
                <div class="form-group">
                  <label for="TipoInspeccion">Nombre del tipo de inspeccion:</label>
                  <input type="text" class="form-control" id="Tipo_Inspeccion" name="Tipo_Inspeccion" placeholder="Ingresa nombre">
                </div>
              </div>
              <div class="">
                <div class="form-group">
                  <label for="TipoInspeccion">Descripción:</label>
                  <textarea class="form-control" id="Desc_Inspeccion" name="Desc_Inspeccion" placeholder="Ingresa la descripción" rows="3"></textarea>
                </div>
              </div>

              <!-- Campo de Estatus -->                             
              <div class="">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" name="Estatus" id="Estatus" value="Activo" checked>
                  <label class="custom-control-label" for="Estatus">Activo</label>
                </div>
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