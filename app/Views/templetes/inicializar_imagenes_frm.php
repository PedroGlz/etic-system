<!-- ========== Modal Seleccionar tipo problema ============================================================-->
<div class="modal fade" id="modal_inicializar_imagenes" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Cabecero del modal -->
            <div class="modal-header bg-info color-palette">
                <h4 class="modal-title">Inicializar Imágenes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <div class="box-body">
                    <form id="form_inicializar_imagenes" method="POST">
                        <div class="form-group">
                            <label for="Ir_Imagen">Imagen Térmica:</label>
                            <div class="input-group input-group-sm" style="" id="contenedorImgIrProblemas">
                                <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="Ir_Imagen" id="Ir_Imagen" placeholder="Nombre archivo" aria-invalid="false">
                                <div class="btn-group-vertical btn-group-sm">
                                    <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnUp">
                                    <i class="fas fa-chevron-up"></i>
                                    </button>
                                    <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnDown">
                                    <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                <div class="input-group-prepend">
                                    <button class="btn btn-info btn-sm btnModalArchivos" type="button" data-toggle="modal" data-target="#modalFileExplorer">
                                    <i class="fas fa-folder-open fa-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Dig_Imagen">Imagen Digital:</label>
                            <div class="input-group input-group-sm" style="" id="contenedorImgIrProblemas">
                                <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="Dig_Imagen" id="Dig_Imagen" placeholder="Nombre archivo" aria-invalid="false">
                                <div class="btn-group-vertical btn-group-sm">
                                    <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnUp">
                                    <i class="fas fa-chevron-up"></i>
                                    </button>
                                    <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;" class="btn btn-default btn-sm rounded-0 btnDown">
                                    <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                <div class="input-group-prepend">
                                    <button class="btn btn-info btn-sm btnModalArchivos" type="button" data-toggle="modal" data-target="#modalFileExplorer">
                                    <i class="fas fa-folder-open fa-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm col" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm col-8" id="btn_guardar_inicializar_imagenes">Continuar</button>
            </div>
        </div>
    </div>

</div>
<!-- /.modal -->