<!-- <div class="tab-content" id=""> -->
    <!-- /. 1a Pestaña Datos del problema --> 
    <!-- <div class="tab-pane fade show active" id="tabDatosProblema" role="tabpanel" aria-labelledby="tabDatosProblema-tab"> -->
        <!-- <div class="" id="rowEditElectrico" style="display: none;">
            <div class="row">
                <div class="col-sm-2">
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                            <label class="col-form-label col-form-label-sm">Inspección No:</label>
                        </div>
                        <input type="text" class="form-control" name="strNumInspeccionEdit" id="strNumInspeccionEdit" value="<?=$inspeccion;?>" readonly>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                            <label class="col-form-label col-form-label-sm">Problema No:</label>
                        </div>
                        <input type="text" class="form-control" name="Numero_ProblemaEdit" id="Numero_ProblemaEdit" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                            <label class="col-form-label col-form-label-sm">Tipo problema:</label>
                        </div>
                        <input type="text" class="form-control" name="StrTipoInspeccionEdit" id="StrTipoInspeccionEdit" readonly>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                            <label class="col-form-label col-form-label-sm">Delta Temp:</label>
                        </div>
                        <input type="text" name="aumentoTemp" id="aumentoTemp" class="form-control" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">°C</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group">
                            <label class="col-form-label col-form-label-sm">Severidad:</label>
                        </div>
                        <input type="text" class="form-control" name="StrSeveridad" id="StrSeveridad" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="input-group input-group-sm">
                    <div class="input-group">
                        <label class="col-form-label col-form-label-sm">Falla:</label>
                    </div>
                    <select class="form-control crearComentAuto" name="Id_Falla" id="Id_Falla"></select>
                </div>
            </div>
            <div class="col-sm">
                <div class="input-group input-group-sm">
                    <div class="input-group">
                        <label class="col-form-label col-form-label-sm">Ruta:</label>
                    </div>
                    <input type="text" class="form-control fontSizeInputRuta" name="StrRuta" id="StrRuta" readonly>
                </div>
            </div>
        </div>

        <hr class="mt-1" /> -->

        <div class="row" style="justify-content: end">
            <div class="col-sm-3">
                <div class="input-group input-group-sm" style="display: flex; justify-content: center">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Temperatura</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 campoProblemaElectrico" style="display: block;">
                <div class="input-group input-group-sm" style="justify-content: center">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Elemento:</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group input-group-sm" style="justify-content: center">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">I <sub>RMS</sub>:</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" id="contenedorAux" style="display: none;"></div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">*Componente con anomalía:&nbsp;&nbsp;</label>
                    </div>
                    <input type="text" name="Problem_Temperature" id="Problem_Temperature" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">°C</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 campoProblemaElectrico" style="display: block;">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">*&nbsp;</label>
                    </div>
                    <select class="form-control crearComentAuto" name="Problem_Phase" id="Problem_Phase"></select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group input-group-sm">
                    <input type="text" name="Problem_Rms" id="Problem_Rms" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">A</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-1 mb-1" />

        <div class="row">
            <div class="col-sm-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">*Componente de referencia:&nbsp;&nbsp;</label>
                    </div>
                    <input type="text" name="Reference_Temperature" id="Reference_Temperature" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">°C</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 campoProblemaElectrico" style="display: block;">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">*&nbsp;</label>
                    </div>
                    <select class="form-control" name="Reference_Phase" id="Reference_Phase"></select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group input-group-sm">
                    <input type="text" name="Reference_Rms" id="Reference_Rms" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">A</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-1 mb-1" />

        <div class="row campoProblemaElectrico" style="display: ;">
            <div class="col-sm-6">
                <div class="mb-1" style="display: flex; justify-content: flex-end">
                    <label class="col-form-label col-form-label-sm">Información adicional:</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="input-group input-group-sm mb-1">
                    &nbsp;&nbsp;&nbsp;
                    <select class="form-control" name="Additional_Info" id="Additional_Info"></select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group input-group-sm mb-1">
                    <input type="text" name="Additional_Rms" id="Additional_Rms" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">A</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Emisividad :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Emissivity_Check" id="Emissivity_Check">
                    </div>
                    <input type="text" name="Emissivity" id="Emissivity" class="form-control" step="0.01" min="0" max="1">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-2 campoProblemaElectrico" style="display: block;">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Temp. Indirecta:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Indirect_Temp_Check" id="Indirect_Temp_Check">
                    </div>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Temp. Ambiente:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Temp_Ambient_Check" id="Temp_Ambient_Check">
                    </div>
                    <input type="text" name="Temp_Ambient" id="Temp_Ambient" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">°C</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Tipo Ambiente:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Environment_Check" id="Environment_Check">
                    </div>
                    <select class="form-control" name="Environment" id="Environment"></select>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Causa principal:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <select class="form-control" name="Id_Causa_Raiz" id="Id_Causa_Raiz"></select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-group input-group-sm mb-1" style="display: none;" id="divRpm">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">RPM:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <input type="text" class="form-control" name="Rpm" id="Rpm">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-1" style="display: none;" id="divTipoRodamiento">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Tipo de rodamiento:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <input type="text" class="form-control" name="Bearing_Type" id="Bearing_Type">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-1 campoProblemaElectrico" style="display: ;">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Velocidad del viento:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Wind_Speed_Check" id="Wind_Speed_Check">
                    </div>
                    <input type="text" name="Wind_Speed" id="Wind_Speed" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">m/s</span>
                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                    </div>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <label class="col-form-label col-form-label-sm">Fabricante:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <select class="form-control" name="Id_Fabricante" id="idFabricanteProblemas"></select>
                </div>
                <fieldset class="border p-2">
                    <legend class="float-none w-auto" style="font-size: 16px;">Especificación Eléctrica</legend>
                    <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                            <label class="col-form-label col-form-label-sm">Corriente nominal (A):&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Rated_Load_Check" id="Rated_Load_Check" disabled>
                        </div>
                        <input type="text" class="form-control" name="Rated_Load" id="Rated_Load">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                        </div>
                    </div>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label class="col-form-label col-form-label-sm">Voltaje nominal (V):&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Circuit_Voltage_Check" id="Circuit_Voltage_Check" disabled>
                        </div>
                        <input type="text" class="form-control" name="Circuit_Voltage" id="Circuit_Voltage">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <hr class="mt-1 mb-2" />

        <div class="">
            <div class="input-group input-group-sm">
                <div class="input-group">
                    <label class="col-form-label col-form-label-sm">Comentarios:</label>
                </div>
                <textarea class="form-control" name="Component_Comment" id="Component_Comment" cols="3"></textarea>
            </div>
        </div>
