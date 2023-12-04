<div class="modal fade" id="modalInfoReporteResultadoAnalisis" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Cabecero del modal -->
            <div class="modal-header bg-info color-palette">
                <h4 class="modal-title" id="">Resultados Análisis de Riesgo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form action="/inventarios/generarResultadoDeAnalisis" id="FrmInfoReporteResultadoAnalisis" method="POST" class="form-horizontal">
                    
                    <!-- TABS PARA LAS PARTES DEL DOCUMENTO WORD -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- PORTADA -->
                        <li class="nav-item">
                            <a class="nav-link active" id="portada-tab" data-toggle="tab" href="#portada" role="tab"
                                aria-controls="portada" aria-selected="true">Portada</a>
                        </li>
                        <!-- DESCRIPCION DEL REPORTE -->
                        <li class="nav-item">
                            <a class="nav-link" id="descripciones-tab" data-toggle="tab" href="#descripciones" role="tab"
                                aria-controls="descripciones" aria-selected="false">Descripciones</a>
                        </li>
                        <!-- RECOMENDACIONES -->
                        <li class="nav-item">
                            <a class="nav-link" id="recomendaciones-tab" data-toggle="tab" href="#recomendaciones" role="tab"
                                aria-controls="recomendaciones" aria-selected="false">Recomendaciones</a>
                        </li>
                        <!-- REFERENCIAS -->
                        <li class="nav-item">
                            <a class="nav-link" id="referencias-tab" data-toggle="tab" href="#referencias" role="tab"
                                aria-controls="referencias" aria-selected="false">Referencias</a>
                        </li>
                        <!-- INVENTARIO -->
                        <li class="nav-item">
                            <a class="nav-link" id="inventario-tab" data-toggle="tab" href="#inventario" role="tab"
                                aria-controls="inventario" aria-selected="true">Inventario</a>
                        </li>
                        <!-- PROBLENAS -->
                        <li class="nav-item">
                            <a class="nav-link" id="problemas-tab" data-toggle="tab" href="#problemas" role="tab"
                                aria-controls="problemas" aria-selected="false">Problemas</a>
                        </li>
                    </ul>

                    <!-- CONTENIDO DE LOS TABS -->
                    <div class="tab-content mt-2" id="myTabContent">
                        <!-- PORTADA -->
                        <div class="tab-pane fade show active" id="portada" role="tabpanel" aria-labelledby="portada-tab">
                           
                            <!-- Detalles de las ubicaciones inspeccionadas -->
                            <!-- <div class="form-group">
                                <label class="col-sm-12 col-form-label-sm pl-0" for="detalle_ubicacion">
                                    Detalles ubicación Inspeccionada:
                                </label>
                                <textarea class="form-control form-control-sm" id="detalle_ubicacion"
                                    name="detalle_ubicacion"
                                    placeholder="Ejemplo: GRANJAS SAN PEDRO 4, SAN RAFAEL 1, 2 Y 3, SAN SIMÓN 1, 2 Y 3"
                                    rows="2"></textarea>
                            </div> -->

                            <!-- CONTACTOS -->
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label-sm pl-0" for="detalle_ubicacion">
                                    Contactos:
                                </label>
                                <div id="">
                                    <div class="row">
                                        <!-- Campo para el nombe de contacto -->
                                        <div class="col-sm-6">
                                            <label class="col-form-label col-form-label-sm"
                                                for="">Nombre</label>
                                        </div>
                                        <!-- campo para el puesto del contacto -->
                                        <div class="col-sm-6">
                                            <label class="col-form-label col-form-label-sm"
                                                for="">Puesto</label>
                                        </div>
                                    </div>

                                    <div id="contenedorContactos">
                                        <div class="row mb-1">
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">1</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nombre_contacto_1"
                                                        name="nombre_contacto[]" placeholder="Nombre" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm" id="puesto_contacto_1"
                                                        name="puesto_contacto[]" placeholder="Gerente de Planta"
                                                        value="">
                                                    <div class="d-flex align-items-center p-1">
                                                        <i class="fas fa-undo-alt btnLimpiarContacto" style="color:red; cursor: pointer;" id="1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">2</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nombre_contacto_2"
                                                        name="nombre_contacto[]" placeholder="Nombre" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm" id="puesto_contacto_2"
                                                        name="puesto_contacto[]" placeholder="Gerente de Planta"
                                                        value="">
                                                    <div class="d-flex align-items-center p-1">
                                                        <i class="fas fa-undo-alt btnLimpiarContacto" style="color:red; cursor: pointer;" id="2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">3</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nombre_contacto_3"
                                                        name="nombre_contacto[]" placeholder="Nombre" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm" id="puesto_contacto_3"
                                                        name="puesto_contacto[]" placeholder="Gerente de Planta"
                                                        value="">
                                                    <div class="d-flex align-items-center p-1">
                                                        <i class="fas fa-undo-alt btnLimpiarContacto" style="color:red; cursor: pointer;" id="3"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">4</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nombre_contacto_4"
                                                        name="nombre_contacto[]" placeholder="Nombre" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm" id="puesto_contacto_4"
                                                        name="puesto_contacto[]" placeholder="Gerente de Planta"
                                                        value="">
                                                    <div class="d-flex align-items-center p-1">
                                                        <i class="fas fa-undo-alt btnLimpiarContacto" style="color:red; cursor: pointer;" id="4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="p-1" style="display: flex; justify-content: flex-end;">
                                        <button type="button" class="btn btn-success btn-sm btnAgregarCampo">
                                            Agregar
                                        </button>
                                    </div> -->
                                </div>
                            </div>

                            <!-- FECHAS DEL REPORTE -->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-sm-12 col-form-label-sm pl-0" for="fecha_inicio_ra">
                                        Fecha de inicio:
                                    </label>
                                    <input type="date" class="form-control form-control-sm" name="fecha_inicio_ra" id="fecha_inicio_ra">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-sm-12 col-form-label-sm pl-0" for="fecha_fin_ra">
                                        Fecha de finalización:
                                    </label>
                                    <input type="date" class="form-control form-control-sm" name="fecha_fin_ra" id="fecha_fin_ra">
                                </div>
                            </div>

                            <!-- IMAGEN PORTADA -->
                            <div class="form-group">
                                <div class="row">
                                    <!-- IMAGEN PORTADA -->
                                    <div class="col-sm-6 mt-2">
                                        <label for="nombre_img_portada" class="col-form-label col-form-label-sm">Portada:</label>
                                        <div class="input-group input-group-sm" style="" id="contenedorImg_portada_word">
                                            <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="nombre_img_portada" id="nombre_img_portada" placeholder="Nombre archivo">
                                            <div class="btn-group-vertical btn-group-sm">
                                                <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                    class="btn btn-default btn-sm rounded-0 btnUp">
                                                    <i class="fas fa-chevron-up"></i>
                                                </button>
                                                <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                    class="btn btn-default btn-sm rounded-0 btnDown">
                                                    <i class="fas fa-chevron-down"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-info btn-sm btnModalArchivos" type="button" data-toggle="modal"
                                                    data-target="#modalFileExplorer">
                                                    <i class="fas fa-folder-open fa-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card-body" style="padding-bottom: 0.5em;padding-top: 0.5em;">
                                            <img src="img/sistema/imagen-no-disponible.jpeg" class="img-fluid"
                                                style="max-width: 100%; height: auto;" id="img_portada" onerror="imgError(this);" />
                                            <div class="datosImg" style="font-size:12px" hidden></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- DESCRIPCION DEL REPORTE -->
                        <div class="tab-pane fade" id="descripciones" role="tabpanel" aria-labelledby="descripciones-tab">
                            <!-- Apartado 1 descripcion del reporte -->
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label-sm pl-0" for="exampleInputEmail1">Apartado 1.
                                    Descripción del reporte:</label>
                                <p class="text-sm">
                                    e. El total de problemas y mejoras documentados se enlistan en la última sección
                                    <br>agrupándolos de acuerdo al siguiente criterio:
                                </p>

                                <div class="input-group input-group-sm">
                                    <textarea class="form-control form-control-sm" id="descripcion_reporte"
                                        name="descripcion_reporte[]" placeholder="Ingresa la descripción" rows="2"></textarea>
                                    <div class="d-flex align-items-center p-1">
                                        <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                    </div>
                                </div>
                                
                                <div id="contenedorDescripciones"></div>
                                
                                <div class="p-1" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn btn-success btn-sm btnCamposReporte agregar_descripcion">
                                        Agregar
                                    </button>
                                </div>
                            </div>

                            <!-- Areas y equipos INspeccionados -->
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label-sm pl-0" for="exampleInputEmail1">
                                    Las áreas/equipos inspeccionados durante el estudio de termografía infrarroja son las
                                    siguientes:
                                </label>
                                <div class="input-group input-group-sm">
                                    <textarea class="form-control form-control-sm" id="areas_inspeccionadas"
                                        name="areas_inspeccionadas[]" placeholder="Ingresa la descripción" rows="2"></textarea>
                                        <div class="d-flex align-items-center p-1">
                                        <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                    </div>
                                </div>
                                <div id="contenedorAreas"></div>

                                <div class="p-1" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn btn-success btn-sm btnCamposReporte agregar_area">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- RECOMENDACIONES -->
                        <div class="tab-pane fade" id="recomendaciones" role="tabpanel" aria-labelledby="recomendaciones-tab">
                            <!-- Apartado 2 Recomenadicones -->
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label-sm pl-0" for="exampleInputEmail1">
                                    Apartado 2. Recomendaciones:
                                </label>

                                <div id="contenedorTabrecomendaciones">
                                    <div>
                                        <!-- RECOMENDACION -->
                                        <div class="input-group input-group-sm mt-1">
                                            <textarea class="form-control form-control-sm" id="recomendacion_reporte"
                                                name="recomendacion_reporte[]" placeholder="Ingresa la recomendación" rows="2">Realizar un plan inmediato para ejecutar las reparaciones de acuerdo a la clasificación de diferencial de temperatura reportado.</textarea>
                                            <div class="d-flex align-items-center p-1">
                                                <i class="fas fa-undo-alt btnCamposReporte limpiar recomendacion" style="color:red; cursor: pointer;"></i>
                                            </div>
                                        </div>
                                        <!-- IMAGEN RECOMENDACION-->
                                        <div class="row mt-1">
                                            <div class="col-sm-5">
                                                <div class="input-group input-group-sm" style="" id="">
                                                    <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="imagen_recomendacion[]" id="" placeholder="Nombre archivo">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnUp">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnDown">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-info btn-sm btnModalArchivos_recomendacion" type="button" data-toggle="modal"
                                                            data-target="#modalFileExplorer">
                                                            <i class="fas fa-folder-open fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="input-group input-group-sm" style="" id="">
                                                    <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="imagen_recomendacion_2[]" id="" placeholder="Nombre archivo">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnUp">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnDown">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-info btn-sm btnModalArchivos_recomendacion" type="button" data-toggle="modal"
                                                            data-target="#modalFileExplorer">
                                                            <i class="fas fa-folder-open fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <!-- RECOMENDACION -->
                                        <div class="input-group input-group-sm mt-1">
                                            <textarea class="form-control form-control-sm" id=""
                                                name="recomendacion_reporte[]" placeholder="Ingresa la recomendación" rows="2">Continuar con su programa de inspecciones por termografía infrarroja con un período no mayor a 6 meses.</textarea>
                                            <div class="d-flex align-items-center p-1">
                                                <i class="fas fa-undo-alt btnCamposReporte limpiar recomendacion" style="color:red; cursor: pointer;"></i>
                                                <i class="fas fa-trash-alt btnCamposReporte eliminar recomendacion pl-1" style="color:red; cursor: pointer;"></i>
                                            </div>
                                        </div>
                                        <!-- IMAGEN RECOMENDACION -->
                                        <div class="row mt-1">
                                            <div class="col-sm-5">
                                                <div class="input-group input-group-sm" style="" id="">
                                                    <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="imagen_recomendacion[]" id="" placeholder="Nombre archivo">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnUp">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnDown">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-info btn-sm btnModalArchivos_recomendacion" type="button" data-toggle="modal"
                                                            data-target="#modalFileExplorer">
                                                            <i class="fas fa-folder-open fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="input-group input-group-sm" style="" id="">
                                                    <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="imagen_recomendacion_2[]" id="" placeholder="Nombre archivo">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnUp">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnDown">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-info btn-sm btnModalArchivos_recomendacion" type="button" data-toggle="modal"
                                                            data-target="#modalFileExplorer">
                                                            <i class="fas fa-folder-open fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <!-- RECOMENDACION -->
                                        <div class="input-group input-group-sm mt-1">
                                            <textarea class="form-control form-control-sm" id=""
                                                name="recomendacion_reporte[]" placeholder="Ingresa la recomendación" rows="2">Revisar su sistema general de puesta a tierra para dar cumplimiento a la NOM-001-SEDE- 2012 y NOM-022-STPS-2015.</textarea>
                                            <div class="d-flex align-items-center p-1">
                                                <i class="fas fa-undo-alt btnCamposReporte limpiar recomendacion" style="color:red; cursor: pointer;"></i>
                                                <i class="fas fa-trash-alt btnCamposReporte eliminar recomendacion pl-1" style="color:red; cursor: pointer;"></i>
                                            </div>
                                        </div>
                                        <!-- IMAGEN RECOMENDACION-->
                                        <div class="row mt-1">
                                            <div class="col-sm-5">
                                                <div class="input-group input-group-sm" style="" id="">
                                                    <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="imagen_recomendacion[]" id="" placeholder="Nombre archivo">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnUp">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnDown">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-info btn-sm btnModalArchivos_recomendacion" type="button" data-toggle="modal"
                                                            data-target="#modalFileExplorer">
                                                            <i class="fas fa-folder-open fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="input-group input-group-sm" style="" id="">
                                                    <input type="text" class="form-control form-control-sm inputIR inputTextImg" name="imagen_recomendacion_2[]" id="" placeholder="Nombre archivo">
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnUp">
                                                            <i class="fas fa-chevron-up"></i>
                                                        </button>
                                                        <button type="button" style="font-size:7px;margin:0;padding:0;width:20px;"
                                                            class="btn btn-default btn-sm rounded-0 btnDown">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-default btn-sm rounded-0 btnGetLastImg" style="margin:0;padding:0;width:20px;">...</button>
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-info btn-sm btnModalArchivos_recomendacion" type="button" data-toggle="modal"
                                                            data-target="#modalFileExplorer">
                                                            <i class="fas fa-folder-open fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="contenedorRecomendaciones"></div>

                                <div class="p-1" style="display: flex; justify-content: flex-end;">
                                    <button type="button"
                                        class="btn btn-success btn-sm btnCamposReporte agregar_recomendacion">
                                        Agregar
                                    </button>
                                </div>

                            </div>
                        </div>
                        <!-- REFERENCIAS -->
                        <div class="tab-pane fade" id="referencias" role="tabpanel" aria-labelledby="referencias-tab">

                            <div class="form-group">
                                <label class="col-sm-12 col-form-label-sm pl-0" for="exampleInputEmail1">
                                    Apartado 3. Referencias:
                                </label>

                                <div id="contenedorTabreferencias">
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">iNETA, Standard for maintenance testing specifications for electrical power equipment and  systems.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">ISO 18434-1, Condition monitoring and diagnostics of machines. Thermography.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">ISO 1843.6-7, Condition monitoring and diagnostics of machines. Requirements for qualification and assessment of personnel - Thermography.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NFPA 70B, Prácticas recomendadas para el mantenimiento de equipos eléctricos.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-001-SEDE-2012, Instalaciones eléctricas (utilización).</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-001-STPS-2012, Condiciones de seguridad en centros de trabajo</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-002-STPS-2010, Condiciones de seguridad-prevención y protección contra incendios.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-005-STPS-1998, Manejo de sustancias químicas peligrosas.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-009-ENER-2014, Eficiencia energética en sistemas de aislamientos térmicos industriales.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-022-STPS-2015, Electricidad estática en centros de trabajo.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NOM-029-STPS-2011, Mantenimiento de las instalaciones eléctricas.</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <!-- referencia -->
                                    <div class="input-group input-group-sm mt-1">
                                        <textarea class="form-control form-control-sm" id="" name="referencia_reporte[]" placeholder="Ingresa la recomendación" rows="1">NMX-J-549, Pararrayos y Sistemas de Puesta a Tierra</textarea>
                                        <div class="d-flex align-items-center p-1">
                                            <i class="fas fa-undo-alt btnCamposReporte limpiar" style="color:red; cursor: pointer;"></i>
                                            <i class="fas fa-trash-alt btnCamposReporte eliminar pl-1" style="color:red; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                </div>

                                <div id="contenedorReferencias"></div>

                                <div class="p-1" style="display: flex; justify-content: flex-end;">
                                    <button type="button"
                                        class="btn btn-success btn-sm btnCamposReporte agregar_referencia">
                                        Agregar
                                    </button>
                                </div>

                            </div>
                        </div>
                        <!-- INVENTARIO -->
                        <div class="tab-pane fade" id="inventario" role="tabpanel" aria-labelledby="inventario-tab">
                           <div class="row">
                               <div class="col">
                                   <strong>Inventario</strong>
                               </div>
                               <div class="col">
                                   <div style="display: flex; justify-content: end">
                                       <button type="button" class="btn btn-default btn-sm btnCheckAll inventario" id="" value="false">
                                           <i class="fas fa-check-circle"></i> <strong>/</strong> <i class="far fa-circle"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                           <!-- Reporte analisis (ra) -->
                           <div id="contenedor_lista_ra"></div>
                       </div>
                        <!-- PROBLEMAS -->
                       <div class="tab-pane fade" id="problemas" role="tabpanel" aria-labelledby="problemas-tab">
                           <table style="width:100%">
                               <thead>
                                   <tr>
                                       <th></th>
                                       <th>Problema</th>
                                       <th>Equipo</th>
                                       <th style="text-align:right">
                                           <button type="button" class="btn btn-default btn-sm btnCheckAll problemas"
                                               id="" value="false">
                                               <i class="fas fa-check-circle"></i> <strong>/</strong> <i
                                                   class="far fa-circle"></i>
                                           </button>
                                       </th>
                                   </tr>
                               </thead>
                               <!-- Reporte analisis (ra) -->
                               <tbody id="tablaProblemasPdf_ra"></tbody>
                           </table>
                       </div>
                    </div>
                
                </form>
            </div>
            <div class="modal-footer justify-content-between mb-1">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGenerarReporteAnalisis" class="btn btn-primary btn-sm col-4">Generar Reporte</button>
            </div>
        </div>
    </div>

</div>