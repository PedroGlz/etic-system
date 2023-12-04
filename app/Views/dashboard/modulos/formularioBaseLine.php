<form action="/inventarios/guardarBaseLine" id="FormBaseLine" method="POST">
                        
    <!-- Campos ocultos -->
    <div hidden>
        Id_Linea_Base<input type="text" id="Id_Linea_Base" name="Id_Linea_Base" value="0">
        Id_Inspeccion<input type="text" id="Id_InspeccionBL" name="Id_InspeccionBL" value="0">
        Id_Ubicacion<input type="text" id="Id_UbicacionBL" name="Id_UbicacionBL" value="0">
        Id_Inspeccion_Det_BL<input type="text" id="Id_Inspeccion_Det_BL" name="Id_Inspeccion_Det_BL" value="0">
    </div>

    <div class="row">
        <!-- campo de MTA -->
        <div class="col-sm-5">
            <label for="MTA" class="col-form-label col-form-label-sm">*MTA (Max Temp Admisible):</label>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-sm" name="MTA" id="MTA">
                <div class="input-group-prepend">
                    <span class="input-group-text">°C</span>
                </div>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                </div>
            </div>
        </div>
        <!-- campo de temperatura Max -->
        <div class="col-sm">
            <label for="Temp_max" class="col-form-label col-form-label-sm">*Temp Máx:</label>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-sm" name="Temp_max" id="Temp_max">
                <div class="input-group-prepend">
                    <span class="input-group-text">°C</span>
                </div>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                </div>
            </div>
        </div>
        <!-- campo de temperatura Ambiente -->
        <div class="col-sm">
            <label for="Temp_amb" class="col-form-label col-form-label-sm">*Temp Amb:</label>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-sm" name="Temp_amb" id="Temp_amb">
                <div class="input-group-prepend">
                    <span class="input-group-text">°C</span>
                </div>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary btn_teclado_numerico" type="button"><i class="fas fa-calculator"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="form-group mb-2">
            <label for="" class="col-form-label col-form-label-sm">Notas:</label>
            <textarea class="form-control form-control-sm" rows="2" id="NotasBL" name="NotasBL" placeholder="Notas"></textarea>
        </div>
    </div>
    <div class="row">
        <!-- Archivo IR -->
        <div class="col-sm-6 mt-2">
            <label for="Archivo_IR" class="col-form-label col-form-label-sm">IR Imagen:</label>
            <div class="input-group input-group-sm" style="" id="contenedorImgIrBl">
                <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="Archivo_IR" id="Archivo_IR" placeholder="Nombre archivo">
                <div class="btn-group-vertical btn-group-sm">
                    <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"class="btn btn-default btn-sm rounded-0 btnUp">
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
        <!-- Archivo ID -->
        <div class="col-sm-6 mt-2">
            <label for="Archivo_ID" class="col-form-label col-form-label-sm">DIG Imagen:</label>
            <div class="input-group input-group-sm" style="" id="contenedorImgDigBl">
                <input type="text" class="form-control form-control-sm inputTextImg" name="Archivo_ID" id="Archivo_ID" placeholder="Nombre archivo">
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
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card-body" style="padding-bottom: 0.5em;padding-top: 0.5em;">
                <img src="img/sistema/imagen-no-disponible.jpeg" class="img-fluid" style="max-width: 100%; height: auto;" id="imgIR_BL" onerror="imgError(this);" />
                <div class="datosImg" style="font-size:12px"></div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <div class="card-body" style="padding-bottom: 0.5em;padding-top: 0.5em;">
                <img src="img/sistema/imagen-no-disponible.jpeg" class="img-fluid" style="max-width: 100%; height: auto;" id="imgID_BL" onerror="imgError(this);" />
                <div class="datosImg" style="font-size:12px"></div>
            </div>
        </div>
    </div>
    
    <div class="">
        <div class="input-group input-group-sm">
            <div class="input-group">
                <label class="col-form-label col-form-label-sm">Ruta:</label>
            </div>
            <input type="text" class="form-control" name="rutaBaseLine" id="rutaBaseLine" readonly>
        </div>
    </div>

</form>`