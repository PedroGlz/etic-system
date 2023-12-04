  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Sitios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevoSitio" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarSitio">Nuevo</button>
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
                <table id="TbSitios" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Sitio</th>
                      <th>Cliente</th>
                      <th>Grupo sitio</th>
                      <th>Sitio</th>
                      <th>Descripción</th>
                      <th>Dirección</th>
                      <th>Colonia</th>
                      <th>Estado</th>
                      <th>Municipio</th>
                      <th>Contacto_1</th>
                      <th>Puesto_Contacto_1</th>
                      <th>Contacto_2</th>
                      <th>Puesto_Contacto_2</th>
                      <th>Contacto_3</th>
                      <th>Puesto_Contacto_3</th>
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

  <div class="modal fade" id="modalAgregarSitio" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos del sitio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/sitios/create" method="POST" id="FrmSitios">
            <div class="box-body">

              <!-- Campo de id oculto -->
              <input type="hidden" name="Id_Sitio" id="Id_Sitio" value="0">

              <!-- Campos nombre sitio, cliente y dirección -->
              <div class="row">
                <div class="col">
                  <label class="col-form-label col-form-label-sm" for="Id_Cliente">Cliente:</label>
                  <div class="input-group input-group-sm">
                    <select class="form-control" id="Id_Cliente" name="Id_Cliente"></select>
                  </div>
                </div>
                <div class="col">
                  <label class="col-form-label col-form-label-sm" for="Id_Grupo_Sitios">Grupo sitio:</label>
                  <div class="input-group input-group-sm">
                    <select class="form-control" id="Id_Grupo_Sitios" name="Id_Grupo_Sitios">
                      <option value="">Seleccionar...</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <hr class="mt-2 mb-1" />
              
              <div class="">
                <label class="col-form-label col-form-label-sm" for="Sitio">Nombre del Sitio:</label>
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" id="Sitio" name="Sitio" placeholder="Ingresa el nombre">
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label class="col-form-label col-form-label-sm" for="Direccion">Dirección:</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="Direccion" name="Direccion" placeholder="Calle y número">
                  </div>
                </div>

                <div class="col">
                  <label class="col-form-label col-form-label-sm" for="Direccion">Colonia:</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="Colonia" name="Colonia" placeholder="Colonia">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <label class="col-form-label col-form-label-sm" for="Municipio">Municipio:</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="Municipio" name="Municipio" placeholder="Municipio">
                  </div>
                </div>

                <div class="col">
                  <label class="col-form-label col-form-label-sm" for="Estado">Estado:</label>
                  <div class="input-group input-group-sm">
                    <select class="form-control" name="Estado" id="Estado">
                      <option value="">Seleccionar...</option>
                      <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                      <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                      <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                      <option value="CAMPECHE">CAMPECHE</option>
                      <option value="CHIAPAS">CHIAPAS</option>
                      <option value="CHIHUAHUA">CHIHUAHUA</option>
                      <option value="CIUDAD DE MÉXICO">CIUDAD DE MÉXICO</option>
                      <option value="COAHUILA">COAHUILA</option>
                      <option value="COLIMA">COLIMA</option>
                      <option value="DURANGO">DURANGO</option>
                      <option value="ESTADO DE MÉXICO">ESTADO DE MÉXICO</option>
                      <option value="GUANAJUATO">GUANAJUATO</option>
                      <option value="GUERRERO">GUERRERO</option>
                      <option value="HIDALGO">HIDALGO</option>
                      <option value="JALISCO">JALISCO</option>
                      <option value="MICHOACÁN">MICHOACÁN</option>
                      <option value="MORELOS">MORELOS</option>
                      <option value="NAYARIT">NAYARIT</option>
                      <option value="NUEVO LEÓN">NUEVO LEÓN</option>
                      <option value="OAXACA">OAXACA</option>
                      <option value="PUEBLA">PUEBLA</option>
                      <option value="QUERÉTARO">QUERÉTARO</option>
                      <option value="QUINTANA ROO">QUINTANA ROO</option>
                      <option value="SAN LUIS POTOSÍ">SAN LUIS POTOSÍ</option>
                      <option value="SINALOA">SINALOA</option>
                      <option value="SONORA">SONORA</option>
                      <option value="TABASCO">TABASCO</option>
                      <option value="TAMAULIPAS">TAMAULIPAS</option>
                      <option value="TLAXCALA">TLAXCALA</option>
                      <option value="VERACRUZ">VERACRUZ</option>
                      <option value="YUCATÁN">YUCATÁN</option>
                      <option value="ZACATECAS">ZACATECAS</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="">
                <label class="col-form-label col-form-label-sm" for="Desc_Sitio">Descripción:</label>
                <div class="input-group input-group-sm">
                  <textarea class="form-control" id="Desc_Sitio" name="Desc_Sitio" placeholder="Ingresa la descripción" rows="2"></textarea>
                </div>
              </div>

              <!-- Apartado de informacion de contactos -->
              <fieldset class="border p-1 mt-2">
                <legend class="float-none w-auto mb-0" style="font-size: 16px;">Información de contactos</legend>

                <div class="row">
                  <!-- Campo para el nombe de contacto -->
                  <div class="col-sm-6">
                    <label class="col-form-label col-form-label-sm" for="">Nombre</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-append">
                        <span class="input-group-text">1</span>
                      </div>
                      <input type="text" class="form-control" id="Contacto_1" name="Contacto_1" placeholder="Nombre">
                    </div>
                  </div>
                  <!-- campo para el puesto del contacto -->
                  <div class="col-sm-6">
                    <label class="col-form-label col-form-label-sm" for="">Puesto</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="Puesto_Contacto_1" name="Puesto_Contacto_1" placeholder="Gerente de Planta">
                    </div>
                  </div>
                </div>

                <div class="row mt-1">
                  <!-- Campo para el nombe de contacto -->
                  <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                      <div class="input-group-append">
                        <span class="input-group-text">2</span>
                      </div>
                      <input type="text" class="form-control" id="Contacto_2" name="Contacto_2" placeholder="Nombre">
                    </div>
                  </div>
                  <!-- campo para el puesto del contacto -->
                  <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="Puesto_Contacto_2" name="Puesto_Contacto_2" placeholder="Gerente de Planta">
                    </div>
                  </div>
                </div>

                <div class="row mt-1">
                  <!-- Campo para el nombe de contacto -->
                  <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                      <div class="input-group-append">
                        <span class="input-group-text">3</span>
                      </div>
                      <input type="text" class="form-control" id="Contacto_3" name="Contacto_3" placeholder="Nombre">
                    </div>
                  </div>
                  <!-- campo para el puesto del contacto -->
                  <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="Puesto_Contacto_3" name="Puesto_Contacto_3" placeholder="Gerente de Planta">
                    </div>
                  </div>
                </div>

              </fieldset>

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