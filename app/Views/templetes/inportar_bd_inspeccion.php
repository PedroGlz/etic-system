<div class="modal fade" id="modal_inportar_bd_inspeccion" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Cabecero del modal -->
            <div class="modal-header bg-info color-palette">
                <h4 class="modal-title" id="">Seleccionar Base de Datos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form id="form_restaurar_db_inspeccion" method="POST">
                    <p>Seleccionar archivo .sql de la Inspección a realizar:</p>
                    <div class="input-group input-group-sm">
                        <input type="file" name='bd_inspeccion' id="bd_inspeccion" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between mb-1">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_cargar_bd_inspeccion" class="btn btn-primary btn-sm col-4">Procesar</button>
            </div>
        </div>
    </div>
</div>