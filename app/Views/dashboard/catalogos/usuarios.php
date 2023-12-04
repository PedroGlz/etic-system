  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-user-tie"></i>&nbsp;&nbsp;Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoUsuario"class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario">Nuevo</button>
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
                <table id="TbUsuarios" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Usuario</th>
                      <th>Grupo</th>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Password</th>
                      <th>Teléfono</th>
                      <th>Foto</th>
                      <th>Email</th>
                      <th>Ultimo_login</th>
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

  <div class="modal fade" id="modalAgregarUsuario" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos del usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/usuarios/create" method="POST" id="FrmUsuarios">
            <div class="box-body">

              <!-- Campo de id oculto -->
              <div hidden>
                <input type="text" name="Id_Usuario" id="Id_Usuario" value="0">
                <input type="text" name="foto_Actual" id="foto_Actual" value="">
              </div>

              <!-- campo de nombre -->                  
              <div class="form-group row">
                <label for="Nombre" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Ingresa el nombre">
                </div>
              </div>
              <!-- campo de usuario -->
              <div class="form-group row">
                <label for="Usuario" class="col-sm-2 col-form-label">Usuario:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Usuario" name="Usuario" placeholder="Ingresa alias del usuario">
                </div>
              </div>

              <!-- campo Telefono -->
              <div class="form-group row">
                <label for="Nombre" class="col-sm-2 col-form-label">Teléfono:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Telefono" name="Telefono">
                </div>
              </div>

              <!-- campo email -->
              <div class="form-group row">
                <label for="Nombre" class="col-sm-4 col-form-label">Correo electrónico:</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="Email" name="Email" placeholder="nombre@ejemplo.com">
                </div>
              </div>

              <!-- campo de perfil -->
              <div class="form-group row">
                <label for="Grupo" class="col-sm-2 col-form-label">Grupo:</label> 
                <div class="col-sm-10">
                  <select class="form-control" id="Id_Grupo" name="Id_Grupo">
                    <option value="">Seleccionar...</option>
                  </select>
                </div>
              </div>

              <div id="contenedor_campos_cliente" style="display:none">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="">
                      <label for="">Cliente:</label>
                      <select class="form-control" id="Id_Cliente" name="Id_Cliente"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="">
                      <label for="">Grupo sitio:</label>
                      <select class="form-control" id="Id_Grupo_Sitios" name="Id_Grupo_Sitios">
                        <option value="">Seleccionar...</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-6">
                    <div class="">
                      <label for="">Sitio:</label>
                      <select class="form-control" id="Id_Sitio" name="Id_Sitio">
                        <option value="">Seleccionar...</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row" id="contenedor_campos_termografo" style="display:none">
                <div class="col-sm-6">
                  <div class="">
                    <label for="">Nivel de certificación:</label>
                    <input type="text" class="form-control" id="nivelCertificacion" name="nivelCertificacion" placeholder="Ej: Nivel II">
                  </div>
                </div>
              </div>

              <hr/>
              <!-- campo de password -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="Password">Contraseña:</label>
                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Ingresa la contraseña">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="rPassword">Repite la contraseña:</label>
                    <input type="password" class="form-control" id="rPassword" name="rPassword" placeholder="Repite la contraseña">
                  </div>
                </div>
              </div>
              <!-- Cargar imagen -->
              <div class="" hidden>
                <div class="form-group">
                  <label>Seleccionar foto:</label>
                  <input type="file" class="form-control" id="Foto" name="Foto">
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
