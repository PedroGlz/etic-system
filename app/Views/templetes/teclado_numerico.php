<style>
    .btn_calcu {
        width:30px;
        height:35px;
        margin-bottom: 3px;
    }
</style>
<!-- ========== Modal Teclado Numerico ============================================================-->
<div class="modal fade" id="modal_teclado_numerico" data-backdrop="static">
    <div class="modal-dialog" style="width:116px;">
        <div class="modal-content">

            <!-- Cuerpo del modal -->
            <div class="modal-body" style="padding:5px; background-color: #252525;">
                <div class="box-body d-flex justify-content-center">
                    <div id="contenedor_teclado_numerico">
                        <div>
                            <button class="btn_calcu boton_tn_limpiar" style="background-color: #919191;color: #ffffff;"><i class="far fa-trash-alt boton_tn_limpiar"></i></button>
                            <button style="width:64px;height:35px;background-color: #919191;color: #ffffff;" class="boton_tn_borrar"><i class="fas fa-backspace boton_tn_borrar"></i></button>
                        </div>
                        <div>
                            <button class="btn_calcu boton_tn_numero" value="7">7</button>
                            <button class="btn_calcu boton_tn_numero" value="8">8</button>
                            <button class="btn_calcu boton_tn_numero" value="9">9</button>
                        </div>
                        <div>
                            <button class="btn_calcu boton_tn_numero" value="4">4</button>
                            <button class="btn_calcu boton_tn_numero" value="5">5</button>
                            <button class="btn_calcu boton_tn_numero" value="6">6</button>
                        </div>
                        <div>
                            <button class="btn_calcu boton_tn_numero" value="1">1</button>
                            <button class="btn_calcu boton_tn_numero" value="2">2</button>
                            <button class="btn_calcu boton_tn_numero" value="3">3</button>
                        </div>
                        <div>
                            <button class="btn_calcu boton_tn_numero" value=".">.</button>
                            <button class="btn_calcu boton_tn_numero" value="0">0</button>
                            <!-- <button class="btn_calcu" style="background-color: #ffaa47;" data-dismiss="modal">OK</button> -->
                            <button class="btn_calcu" style="padding:0px; background-color: #ffaa47;" data-dismiss="modal"><span>✔</span></button>
                        </div>
                        <div id="mover_modal" class="d-flex justify-content-center">
                            <i class="fas fa-arrows-alt-h text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</div>
<!-- /.modal -->