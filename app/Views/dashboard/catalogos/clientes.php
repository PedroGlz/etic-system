  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-handshake"></i>&nbsp;&nbsp;Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoCliente"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarCliente">Nuevo</button>
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
                <table id="TbClientes" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Cliente</th>
                      <th>Razón social</th>
                      <th>Nombre Comercial</th>
                      <th>RFC</th>
                      <th>Imagen</th>
                      <th>Estatus</th>
                      <th>Creado Por</th>
                      <th>Fecha de creación</th>
                      <th>Modificado por</th>
                      <th>Fecha modificación</th>
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

  <div class="modal fade" id="modalAgregarCliente" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos del cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/clientes/create" method="POST" id="FrmClientes">
            <div class="box-body">
              
              <!-- Campos ocultos -->
              <div hidden>
                <input type="text" name="Id_Cliente" id="Id_Cliente" value="">
                <input type="text" name="Imagen_Cliente_actual" id="Imagen_Cliente_actual" value="">
              </div>

              <!-- Campos razon social, nombre comercial y rfc -->
              <div class="">
                <div class="form-group">
                  <label>Razón social:</label>
                  <input type="text" class="form-control" id="Razon_Social" name="Razon_Social" placeholder="...">
                </div>
                <div class="form-group">
                  <label>Nombre comercial:</label>
                  <input type="text" class="form-control" id="Nombre_Comercial" name="Nombre_Comercial" placeholder="...">
                </div>
                <div class="form-group">
                  <label>RFC:</label>
                  <input type="text" class="form-control" id="RFC" name="RFC" placeholder="...">
                </div>
              </div>

              <!-- Imagen del cliente -->
              <div class="">
                <div class="form-group">
                  <label>Seleccionar foto:</label>
                  <input type="file" class="form-control" id="Imagen_Cliente" name="Imagen_Cliente">
                </div>
              </div>

              <!-- Campo de activo -->
              <div class="row">
                <div class="col-sm-4">
                  <div class="custom-control custom-switch">                    
                    <input type="checkbox" class="custom-control-input" name="Estatus" id="Estatus" value="Activo" checked>
                    <label class="custom-control-label" for="Estatus">Activo</label>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnGuardar" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->