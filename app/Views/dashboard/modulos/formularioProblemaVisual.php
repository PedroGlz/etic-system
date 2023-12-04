<!-- <div id="rowEditVisual" style="display: none;">
    <div class="row">
        <div class="col-sm-2">
            <div class="input-group input-group-sm mb-1">
                <div class="input-group">
                    <label class="col-form-label col-form-label-sm">Inspección No:</label>
                </div>
                <input type="text" class="form-control" name="strNumInspeccionEditVisual" id="strNumInspeccionEditVisual"
                    value="<?=$inspeccion;?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="input-group input-group-sm mb-1">
                <div class="input-group">
                    <label class="col-form-label col-form-label-sm">Problema No:</label>
                </div>
                <input type="text" class="form-control" name="Numero_ProblemaEditVisual" id="Numero_ProblemaEditVisual" readonly>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group input-group-sm mb-1">
                <div class="input-group">
                    <label class="col-form-label col-form-label-sm">Tipo problema:</label>
                </div>
                <input type="text" class="form-control" name="StrTipoInspeccionEditVisual" id="StrTipoInspeccionEditVisual" readonly>
            </div>
        </div>
        <div class="col-sm">
            <div class="input-group input-group-sm mb-1">
                <div class="input-group">
                    <label class="col-form-label col-form-label-sm">Equipo:</label>
                </div>
                <input type="text" class="form-control" name="StrEquipoEditVisual" id="StrEquipoEditVisual" readonly>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm">
        <div class="input-group input-group-sm">
            <div class="input-group">
                <label class="col-form-label col-form-label-sm">Ruta:</label>
            </div>
            <input type="text" class="form-control fontSizeInputRuta" name="StrRutaVisual" id="StrRutaVisual" readonly>
        </div>
    </div>
</div> -->

<!-- <hr class="mt-1" /> -->

<div class="row">
    <div class="col-sm">
        <!-- <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <label class="col-form-label col-form-label-sm" for="hazard_Type">Tipo:&nbsp;&nbsp;&nbsp;</label>
            </div>
            <select class="form-control form-control-sm" name="hazard_Type" id="hazard_Type"></select>
        </div>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <label class="col-form-label col-form-label-sm" for="hazard_Classification">Clasificación:&nbsp;&nbsp;&nbsp;</label>
            </div>
            <select class="form-control form-control-sm" name="hazard_Classification" id="hazard_Classification"></select>
        </div>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <label class="col-form-label col-form-label-sm" for="hazard_Group">Grupo:&nbsp;&nbsp;&nbsp;</label>
            </div>
            <select class="form-control form-control-sm crearComentAuto visual" name="hazard_Group" id="hazard_Group"></select>
        </div> -->
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <label class="col-form-label col-form-label-sm" for="hazard_Issue">Problema:&nbsp;&nbsp;&nbsp;</label>
            </div>
            <select class="form-control form-control-sm crearComentAuto visual" name="hazard_Issue" id="hazard_Issue"></select>
        </div>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <label class="col-form-label col-form-label-sm" for="Id_Severidad">Severidad:&nbsp;&nbsp;&nbsp;</label>
            </div>
            <select class="form-control form-control-sm" name="Id_Severidad" id="Id_Severidad">
                <option value="">Seleccionar...</option>
                <option value="1D56EDB0-8D6E-11D3-9270-006008A19766">Crítico</option>
                <option value="1D56EDB1-8D6E-11D3-9270-006008A19766">Serio</option>
                <option value="1D56EDB2-8D6E-11D3-9270-006008A19766">Importante</option>
                <option value="1D56EDB3-8D6E-11D3-9270-006008A19766">Menor</option>
                <option value="1D56EDB4-8D6E-11D3-9270-006008A19766">Normal</option>
            </select>
        </div>

        <div class="input-group input-group-sm">
            <div class="input-group">
                <label class="col-form-label col-form-label-sm">Observaciones:</label>
            </div>
            <textarea class="form-control" name="observaciones_Visual" id="observaciones_Visual" cols="3"></textarea>
        </div>
    </div>
</div>