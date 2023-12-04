<div class="modal fade" id="modal_cargar_script_bd" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Cabecero del modal -->
            <div class="modal-header bg-info color-palette">
                <h4 class="modal-title" id="">Cargar script</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <textarea class="form-control" name="" id="script_sql_server" rows="10"></textarea>
                <!-- <textarea class="form-control" name="" id="script_resultado" rows="10"></textarea> -->
            </div>
            <div class="modal-footer justify-content-between mb-1">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_convertir_sql" class="btn btn-primary btn-sm col-4">Procesar</button>
            </div>
        </div>
    </div>
</div>