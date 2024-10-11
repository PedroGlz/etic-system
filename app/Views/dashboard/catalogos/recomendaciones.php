  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-wave-square"></i>&nbsp;&nbsp;Recomendaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" id="btnNuevaRecomendacion"class="btn btn-block btn-success" data-toggle="modal" data-target="#modalAgregarRecomendacion">Nuevo</button>
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
                <table id="TbRecomendacion" class="display table table-striped table-bordered text-center" style="width:100%;">
                  <thead class="bg-gray-dark color-palette">
                    <tr>
                      <th>Id_Recomendacion</th>
                      <th>Tipo Inspección</th>
                      <th>Causa principal</th>
                      <th>Recomendación</th>
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

  <div class="modal fade" id="modalAgregarRecomendacion" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h5 class="modal-title"><i class="far fa-plus-square"></i>&nbsp;&nbsp;Datos de recomendación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <form action="/recomendacion/create" method="POST" id="FrmRecomendaciones">
            <div class="box-body">
              
              <!-- Campo de id oculto -->
              <div hidden>
                <input type="text" name="Id_Recomendacion" id="Id_Recomendacion" value="0">
              </div>

              <!-- Campo de tipo de inpseccion -->
              <div class="form-group">
                <label for="Id_Tipo_Inspeccion">Tipo de inspección:</label>
                <select class="form-control select2" id="Id_Tipo_Inspeccion" name="Id_Tipo_Inspeccion"></select>
              </div>

              <div class="form-group">
                <label for="Id_Causa_Raiz">Causa principal:</label>
                <select class="form-control select2" id="Id_Causa_Raiz" name="Id_Causa_Raiz"></select>
              </div>
              
              <!-- Campo de Recomendacion -->
              <div class="form-group">
                <label for="Recomendacion">Recomendación:</label>
                <textarea class="form-control" id="Recomendacion" name="Recomendacion" rows="4" placeholder="Ingresar recomendación"></textarea>
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