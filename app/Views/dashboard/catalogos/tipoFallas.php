  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-toolbox"></i>&nbsp;&nbsp;Tipos de fallas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoTipoFallas"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarTipoFallas">Nuevo</button>
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
                <table id="TbTipoFallas" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Tipo_Falla</th>
                      <th>Tipo de inspección</th>
                      <th>Tipo de falla</th>
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

  <div class="modal fade" id="modalAgregarTipoFallas" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos del tipo de falla</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/tipoFallas/create" method="POST" id="FrmTipoFallas">
            <div class="box-body">
              
              <!-- Campo de id oculto -->
              <div hidden>
                <input type="text" name="Id_Tipo_Falla" id="Id_Tipo_Falla" value="0">
              </div>

              <!-- Campo de tipo de inpseccion -->
              <div class="form-group">
                <label for="Id_Tipo_Inspeccion">Tipo de inspección:</label>
                <select class="form-control select2" id="Id_Tipo_Inspeccion" name="Id_Tipo_Inspeccion"></select>
              </div>

              <!-- Campo de tipo de falla -->
              <div class="form-group">
                <label for="Tipo_Falla">Tipo de falla:</label>
                  <input type="text" class="form-control" id="Tipo_Falla" name="Tipo_Falla" placeholder="Ingresar falla">
              </div>

              <!-- Campo de Tipo de Descripcion -->
              <div class="form-group">
                <label for="Desc_Tipo_Falla">Descripción:</label>
                <textarea class="form-control" id="Desc_Tipo_Falla" name="Desc_Tipo_Falla" rows="4" placeholder="Ingresar descripción"></textarea>
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