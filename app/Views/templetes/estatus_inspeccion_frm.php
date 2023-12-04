<!-- ========== Modal Seleccionar ACTUALIZAR ESTATUS INSPECCION ============================================================-->
  <div class="modal fade" id="modal_estatus_inspeccion" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Cabecero del modal -->
        <div class="modal-header bg-info color-palette">
          <h4 class="modal-title">Actualizar estatus de inspección</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">Estatus Inspección</span>
              </div>
              <select class="form-control custom-select" name="select_actualizar_estatus_inspeccion" id="select_actualizar_estatus_inspeccion" aria-invalid="false">
                <option value="73F27003-76B3-11D3-82BF-00104BC75DC2">En progreso</option>
                <option value="73F27007-76B3-11D3-82BF-00104BC75DC2" selected>Cerrada</option>
                <!-- <option value="73F27006-76B3-11D3-82BF-00104BC75DC2">Pospuesta</option>
                <option value="73F27004-76B3-11D3-82BF-00104BC75DC2">Terminada</option> -->
              </select>
              <!-- <div class="input-group-prepend">
                <button type="button" class="btn btn-secondary" title="Guardar estatus">
                  <i class="fas fa-lock"></i>
                </button>
              </div> -->
              <div class="input-group-prepend">
                <!-- <button type="button" class="btn btn-warning" id="btn_exportar_inspeccion_finalizada" title="Exportar inspección" style="display:none">
                  <i class="fas fa-download"></i>
                </button> -->
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm col" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm col-8" id="btn_guardar_estatus_inspeccion">Guardar</button>
        </div>
      </div>
    </div>

  </div>
<!-- /.modal -->





