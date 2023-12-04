  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="far fa-building"></i>&nbsp;&nbsp;Compañías</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoCompanias"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarCompanias">Nuevo</button>
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
                <table id="TbCompanias" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Compania</th>
                      <th>Giro</th>
                      <th>País</th>
                      <th>Compañía</th>
                      <th>Logotipo</th>
                      <th>Pagina web</th>
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

  <div class="modal fade" id="modalAgregarCompanias" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos de la compañía</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/companias/create" method="POST" id="FrmCompanias">
            <div class="box-body">

              <!-- Campo de id oculto -->
              <div hidden>
                <input type="text" name="Id_Compania" id="Id_Compania" value="0">
                <input type="text" name="foto_Actual" id="foto_Actual" value="">
              </div>

              <!-- campo Compania -->
              <div class="form-group row">
                <label for="Compania" class="col-sm-2 col-form-label">Compañía:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Compania" name="Compania" placeholder="Nombre de la compañía">
                </div>
              </div>
              <!-- campo de giro -->
              <div class="form-group row">
                <label for="Id_Giro" class="col-sm-2 col-form-label">Giro:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="Id_Giro" name="Id_Giro"></select>
                </div>
              </div>
              <!-- campo de pais -->
              <div class="form-group row">
                <label for="Id_Pais" class="col-sm-2 col-form-label">País:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="Id_Pais" name="Id_Pais"></select>
                </div>
              </div>
              <!-- campo Pagina_web -->
              <div class="form-group row">
                <label for="Pagina_web" class="col-sm-3 col-form-label">Pagina web:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="Pagina_web" name="Pagina_web" placeholder="https://www.google.com/">
                </div>
              </div>
              <!-- Cargar imagen -->
              <div class="">
                <div class="form-group">
                  <label>Seleccionar foto:</label>
                  <input type="file" class="form-control" id="Logotipo" name="Logotipo">
                </div>
              </div>

              <!-- Estatus -->
              <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" name="Estatus" id="Estatus" value="A" checked>
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

