  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-bezier-curve"></i>&nbsp;&nbsp;Causas principales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoCausaPrincipal"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarCausaPrincipal">Nuevo</button>
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
                <table id="TbCausaPrincipal" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Causa_Raiz</th>
                      <th>Tipo inspección</th>
                      <th>Falla</th>
                      <th>Causa raíz</th>
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

  <div class="modal fade" id="modalAgregarCausaPrincipal" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos de la causa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/causaPrincipal/create" method="POST" id="FrmCausaPrincipal">
            <div class="box-body">
              
              <!-- Campo de id oculto -->
              <div hidden>
                <input type="text" name="Id_Causa_Raiz" id="Id_Causa_Raiz" value="0">
              </div>

              <!-- Campo de Causa Raiz -->
              <div class="form-group">
                <label for="Causa_Raiz">Causa principal:</label>
                <input type="text" class="form-control" id="Causa_Raiz" name="Causa_Raiz" placeholder="Ingresar causa">
              </div>

              <!-- Campo de Tipo de inspección -->
              <div class="form-group">
                <label for="Id_Tipo_Inspeccion">Tipo de inspección:</label>
                <select class="form-control select2" style="width: 100%;" id="Id_Tipo_Inspeccion" name="Id_Tipo_Inspeccion"></select>
              </div>

              <!-- Campo de Falla -->
              <div class="form-group">
              <label for="Id_Falla">Falla:</label>
                <select class="form-control select2" style="width: 100%;" id="Id_Falla" name="Id_Falla">
                  <option value="">op1</option>
                  <option value="">op2</option>
                </select>
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