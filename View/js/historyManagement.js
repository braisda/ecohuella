var processUserExecutions;
var executedProcesses;
var processUserExecutionParameters;
var totalHuellaCarbono;
var totalArray = [];
var originalProcesses;
var calculatedProcesses;

function checkPermissions() {
    if (getCookie("userRole") != "basico") {
        window.location.href = './menu.html';
    }
}

async function loadProcessUserExecutionData() {
    var lang = getCookie("lang");

    createHideForm("formprocessUserExecutions");

    insertField(
        document.formprocessUserExecutions,
        "dni_usuario_ejecucion",
        getCookie("userSystem")
    );

    await ajaxPromise(document.formprocessUserExecutions, "search", "processUserExecution", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            processUserExecutions = res;
            //loadCalculatedProcessData();
            searchExecutedProcesses();
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

async function loadCalculatedProcessData() {
    var lang = getCookie("lang");

    totalHuellaCarbono = 0;

    createHideForm("formCalculatedProcess");

    insertField(
        document.formCalculatedProcess,
        "dni_usuario_ejecucion",
        getCookie("userSystem")
    );

    await ajaxPromise(document.formCalculatedProcess, "search", "processUserExecutionParameter", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            calculatedProcesses = res;

            calculatedProcesses = groupCalculatedProcesses(res);
            //TODO CALCULAR HUELLA DE CARBONO TOTAL
            calculateTotalFootPrint();
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

function calculateTotalFootPrint() {
    calculatedProcesses.resource.forEach(function (cp) {
        idProcess = Object.keys(cp)[0];
        cp[idProcess].forEach(function (version, idx, array) {
            if (idx === array.length - 1) {
                executedProcesses.resource.forEach(function (elems) {
                    id = Object.keys(elems)[0];
                    elems[id].forEach(function (elem) {
                        if (elem.id_proceso == idProcess && elem.version == Object.keys(version)[0]) {
                            formula = elem.formula;
                        }
                    });
                });

                params = version[Object.keys(version)[0]];
                params.forEach(function (p) {
                    formula = formula.replaceAll("#_" + p.id_parametro.id_parametro + "_#", p.valor_parametro);
                });
                footPrint = eval(formula);
                totalHuellaCarbono += footPrint;
                document.getElementById("calculoHuellaTotal").textContent = totalHuellaCarbono;
            }
        });
    });
}

function groupCalculatedProcesses(res) {
    groupedProcesses = [];
    groupedProcess = {};
    ids = [];
    versionProcess = {};

    calculatedProcesses.resource.forEach(function (p) {
        if (!ids.includes(p.id_proceso.id_proceso)) {
            ids.push(p.id_proceso.id_proceso);
        }
    });

    ids.forEach(function (id) {
        groupedProcess[id] = [];
        groupedProcesses.push(groupedProcess);
        groupedProcess = {};
    });



    groupedProcesses.forEach(function (gp) {
        idProcess = Object.keys(gp)[0];
        versions = [];
        calculatedProcesses.resource.forEach(function (p) {
            if (idProcess == p.id_proceso.id_proceso) {
                if (gp[idProcess].length == 0) {
                    if(p.version.id_proceso == null){
                        ver = p.version;
                    } else {
                        ver = p.version.id_proceso;
                    }
                    versionProcess[ver] = [];
                    gp[idProcess].push(versionProcess);
                    versionProcess = {};
                } else if (gp[idProcess].length > 0) {
                    gp[idProcess].forEach(function (g) {
                        version = Object.keys(g)[0];
                        if (version != p.version.id_proceso) {
                            versionProcess[p.version.id_proceso] = [];
                            gp[idProcess].push(versionProcess);
                            versionProcess = {};
                        }
                    });
                }
            }
        });
    });

    groupedProcesses.forEach(function (gp) {
        idProcess = Object.keys(gp)[0];
        gp[idProcess].forEach(function (g) {
            version = Object.keys(g)[0];
            calculatedProcesses.resource.forEach(function (p) {
                if(p.version.id_proceso == null){
                    ver = p.version;
                } else {
                    ver = p.version.id_proceso;
                }
                if (idProcess == p.id_proceso.id_proceso && version == ver) {
                    g[version].push(p);
                }
            });
        });
    });

    newRes = {
        code: res.code,
        criteriosbusqueda: res.criteriosbusqueda,
        empieza: res.empieza,
        filas: groupedProcesses.length,
        ok: res.ok,
        resource: groupedProcesses,
        total: groupedProcesses.length
    };

    return newRes;
}

async function searchExecutedProcesses() {
    await loadProcessData();
}

async function loadProcessData() {
    var lang = getCookie("lang");

    createHideForm("formProcessManagement");

    insertField(
        document.formProcessManagement,
        "activo",
        1
    );

    await ajaxPromise(document.formProcessManagement, "search", "process", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            aux = [];
            processUserExecutions.resource.forEach(function (p) {
                res.resource.forEach(function (r) {
                    if(p.version.id_proceso == null){
                        ver = p.version;
                    } else {
                        ver = p.version.id_proceso;
                    }
                    if (r.id_proceso == p.id_proceso.id_proceso && r.version == ver && p.dni_usuario_ejecucion.dni == getCookie("userSystem")) {
                        aux.push(r);
                    }
                });
            });

            res.resource = aux;
            res.filas = aux.length;
            res.total = aux.length;
            if (aux.length == 0 || aux.length == '0') {
                res.code = "RECORDSET_VACIO";
            }
            
            loadCalculatedProcessData();
            //TODO --> CALCULAR AQUI TODOS LOS PROCESOS Y METERLOS EN UN ARRAY
            executedProcesses = groupProcesses(res);
            empty = document.createElement("p");
            empty.id = "idVacio";
            empty.classList.add("VACIO");
            if (executedProcesses.code == "RECORDSET_VACIO") {
                document.getElementById("contenidoPrincipalInicio").appendChild(empty);
            }

            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", executedProcesses.total);
                pager("history");
            }
            setCookie("totalElements", executedProcesses.total);
            fileTableMessage();
            searchEntities(getCookie('actualPage'));
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

function groupProcesses(res) {
    groupedProcesses = [];
    groupedProcess = {};
    ids = [];

    res.resource.forEach(function (process) {
        if (!ids.includes(process.id_proceso)) {
            ids.push(process.id_proceso);
        }
    });

    ids.forEach(function (id) {
        groupedProcess[id] = [];
        groupedProcesses.push(groupedProcess);
        groupedProcess = {};
    });

    groupedProcesses.forEach(function (gp) {
        idProcess = Object.keys(gp)[0];
        res.resource.forEach(function (process) {
            if (idProcess == process.id_proceso) {
                gp[idProcess].push(process);
            }
        });
    });

    newRes = {
        code: res.code,
        criteriosbusqueda: res.criteriosbusqueda,
        empieza: res.empieza,
        filas: groupedProcesses.length,
        ok: res.ok,
        resource: groupedProcesses,
        total: groupedProcesses.length
    };

    return newRes;
}

function getList(start, end) {
    $("#executedCards").html("");

    finalBucle = parseInt(start) + parseInt(end);

    if (executedProcesses.resource.length < finalBucle) {
        finalBucle = executedProcesses.resource.length;
    }

    for (var i = start; i < finalBucle; i++) {
        makeExecutedCard(executedProcesses.resource[i]);
    }
}

function makeExecutedCard(row) {
    idProcess = Object.keys(row)[0];
    var card =
        '<div class="row d-flex justify-content-center">' +
        '<div id="card_' + idProcess + '" class="card cardHistory text-white bg-card m-3">' +
        '<div class="card-header bg-dark text-uppercase font-weight-bold "><span id="icon_' + idProcess + '" class=""></span><span id="card_title_' + idProcess + '"> ' + row[idProcess][0].nombre + '</span></div>' +
        '<ul class="nav nav-pills pl-2 bg-secondary" id="pills-tab' + idProcess + '" role="tablist">' +
        '</ul>' +
        '<div class="tab-content" id="pills-tabContent' + idProcess + '">' +

        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
    $("#executedCards").append(card);


    row[idProcess].forEach(function (p, idx, array) {
        ul = document.getElementById("pills-tab" + idProcess);

        liText =
            '<li id="li_' + p.id_proceso + "_" + p.version + '" class="nav-item">' +
            '<a class="nav-link mr-1" id="pills_' + p.id_proceso + "_" + p.version + '_tab" data-toggle="pill" href="#pills_' + p.id_proceso + "_" + p.version + '" role="tab" aria-controls="pills_' + p.id_proceso + "_" + p.version + '" aria-selected="false">V.' + p.version + '</a>' +
            '</li>';
        ul.innerHTML += liText;

        pills = document.getElementById("pills-tabContent" + idProcess);
        newCardContentText = '<div class="tab-pane fade" id="pills_' + p.id_proceso + "_" + p.version + '" role="tabpanel" aria-labelledby="pills_' + p.id_proceso + "_" + p.version + '_tab">' +
            '<div class="card-body bg-card">' +
            '<p class="card-text mb-0 description-text-card bg-card">' + p.descripcion + '</p>' +
            '<p class="card-text mb-0"><span class="VERSION"></span>: ' + p.version + '</p>' +
            '<button id="processBtn_' + p.id_proceso + '_' + p.version + '" class="btn btn-dark ACTUALIZAR my-1" onclick="openProcessParameters(' + p.id_proceso + ', ' + p.version + ', \'' + p.nombre + '\');" ></button>' +
            '<ul class="list-group list-group-flush">' +
            '<li class="list-group-item bg-card"><span class="CATEGORIA text-uppercase font-weight-bold"></span>: ' + p.id_categoria.nombre + '</li>' +
            '<li class="list-group-item bg-card"><span class="FECHA_EJECUCION text-uppercase font-weight-bold"></span>: <span id="fechaEjecucion_' + p.id_proceso + "_" + p.version + '" ></li>' +
            '<li class="list-group-item  bg-card"><span class="HUELLA_CARBONO text-uppercase font-weight-bold"></span>: <span id="huellaCarbono_' + p.id_proceso + "_" + p.version + '" class="border border-white p-1" >' +
            (idx === array.length - 1 ?
                calculateFootPrint(p, true)
                : calculateFootPrint(p), false)
        '</span> Kg (CO2)</li>' +
            '</ul>' +
            '</div>' +
            '</div>';
        pills.innerHTML += newCardContentText;
    });

    setLang(getCookie('lang'));
}

function calculateFootPrint(row, isLastVersion) {
    loadProcessUserExecutionParameterData(row, isLastVersion);
}

async function loadProcessUserExecutionParameterData(row, isLastVersion) {
    var lang = getCookie("lang");

    createHideForm("formprocessUserExecutionParameters");

    insertField(
        document.formprocessUserExecutionParameters,
        "id_proceso",
        row.id_proceso
    );
    insertField(
        document.formprocessUserExecutionParameters,
        "version",
        row.version
    );

    insertField(
        document.formprocessUserExecutionParameters,
        "dni_usuario_ejecucion",
        getCookie("userSystem")
    );

    await ajaxPromise(document.formprocessUserExecutionParameters, "search", "processUserExecutionParameter", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            id = "huellaCarbono_" + row.id_proceso + "_" + row.version;
            idFecha = "fechaEjecucion_" + row.id_proceso + "_" + row.version;

            formula = row.formula;

            if (res.resource.length > 0) {
                params = [];
                res.resource.forEach(function (r) {
                    param = {
                        "id_param": r.id_parametro.id_parametro,
                        "valor_param": r.valor_parametro,
                        "fecha_ejecucion": r.fecha_ejecucion
                    };
                    params.push(param);
                });

                params.forEach(function (p, idx, array) {
                    formula = formula.replaceAll("#_" + p.id_param + "_#", p.valor_param);
                    if (idx === array.length - 1) {

                        result = eval(formula);

                        if (isLastVersion) {
                            //ponemos como activa la última version
                            document.getElementById("pills_" + row.id_proceso + "_" + row.version + "_tab").classList.add("active");
                            document.getElementById("pills_" + row.id_proceso + "_" + row.version).classList.add("show");
                            document.getElementById("pills_" + row.id_proceso + "_" + row.version).classList.add("active");

                            //cambiamos botón de las versiones antiguas para poder eliminarlas
                            addDeleteButtonToOldVersions(row);
                        }

                        document.getElementById(id).textContent = result;
                        document.getElementById(idFecha).textContent = p.fecha_ejecucion;


                    }
                });
            } else {
                document.getElementById(id).textContent = "-";
                document.getElementById(id).classList.add("text-warning");
                document.getElementById(id).classList.add("font-weight-bold");

                if (isLastVersion) {
                    document.getElementById("pills_" + row.id_proceso + "_" + row.version + "_tab").classList.add("active");
                    document.getElementById("pills_" + row.id_proceso + "_" + row.version).classList.add("show");
                    document.getElementById("pills_" + row.id_proceso + "_" + row.version).classList.add("active");
                }

                if (document.getElementById('title_alert_' + row.id_proceso) == null) {
                    alerta = '<div id="title_alert_' + row.id_proceso + '" class="tooltip6"><img class="alertaVersion ICONO_ALERTA_VERSION_VALOR" src="Resources/alert.png" alt="Detalle"/><span class="tooltiptext ICONO_ALERTA_VERSION_VALOR"></span></div>';
                    document.getElementById("card_title_" + row.id_proceso).innerHTML += alerta;
                }
            }
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

function addDeleteButtonToOldVersions(row) {
    cards = document.getElementById("pills-tabContent" + row.id_proceso);

    for (let item of cards.getElementsByTagName("button")) {
        if (!item.id.includes(row.id_proceso + "_" + row.version)) {
            item.parentElement.innerHTML = item.parentElement.innerHTML.replace("ACTUALIZAR", "ELIMINAR");
        }
    }
    for (let item of cards.getElementsByTagName("button")) {
        if (!item.id.includes(row.id_proceso + "_" + row.version)) {
            item.parentElement.innerHTML = item.parentElement.innerHTML.replace("openProcessParameters", "deleteProcess");
        }
    }
}

function deleteProcess(idProcess, version, nombre) {
    $("#myModalConfirmDeleteProcess").modal("show");

    if (document.getElementById("btnConfirmDeleteProcess")) {
        document.getElementById("btnConfirmDeleteProcess").remove();
    }

    var btn =
        '<button type="button" id="btnConfirmDeleteProcess" class="btn btn-primary ELIMINAR_CALCULO" onclick="deleteProcessExecution(' + idProcess + ', ' + version + ')"></button >';

    $('#divConfirmDeleteProcess').append(btn);
    setLang(getCookie("lang"));
}

async function deleteProcessExecution(idProcess, version) {
    await deleteProcessUserExecutionParameter(idProcess, version);
}

async function deleteProcessUserExecutionParameter(idProcess, version) {
    var lang = getCookie("lang");

    createHideForm("formProcessUserExecutionParameterDelete");
    removeField("id_proceso");
    removeField("version");
    removeField("dni_usuario_ejecucion");
    removeField("controller");
    removeField("action");
    insertField(
        document.formProcessUserExecutionParameterDelete,
        "id_proceso",
        idProcess
    );
    insertField(
        document.formProcessUserExecutionParameterDelete,
        "version",
        version
    );
    insertField(
        document.formProcessUserExecutionParameterDelete,
        "dni_usuario_ejecucion",
        getCookie('userSystem')
    );

    await ajaxPromise(document.formProcessUserExecutionParameterDelete, "finalDelete", "processUserExecutionParameter", ["ELIMINAR_PROCESS_USER_EXECUTION_PARAMETER_OK"], true)
        .then((res) => {

            $("#myModalConfirmDeleteProcess").modal("hide");
            ajaxResponseOK("ELIMINAR_PROCESS_USER_EXECUTION_PARAMETER_OK", res.code);
            document.getElementById("modal").style.display = "block";

        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            $("#myModalConfirmDeleteProcess").modal("hide");
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

function openProcessParameters(idProcess, version, nameProcess) {
    $("#formularioAcciones").modal("show");
    $("#tituloCalculoProceso").html("");
    $("#tituloCalculoProceso").append(nameProcess);

    id = "huellaCarbono_" + idProcess + "_" + version;
    if (document.getElementById(id).textContent == "-") {
        document.getElementById("formularioGenerico").action = "javascript:calculateProcess(" + idProcess + ", " + version + ")"
    } else {
        document.getElementById("formularioGenerico").action = "javascript:updateCalculateProcess(" + idProcess + ", " + version + ")"
    }

    searchParameters(idProcess, version);
}

async function searchParameters(idProcess, version) {
    await loadParametersData(idProcess, version);
}

async function loadParametersData(idProcess, version) {
    var lang = getCookie("lang");

    createHideForm("formParametersManagement");

    insertField(
        document.formParametersManagement,
        "id_proceso",
        idProcess
    );

    insertField(
        document.formParametersManagement,
        "version",
        version
    );

    await ajaxPromise(document.formParametersManagement, "search", "parameter", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            $("#datosProcesos").html("");
            res.resource.forEach(function (param) {
                var fieldForm =
                    '<div class="row">' +
                    '<div class="form-group col-12 mb-0">' +
                    '<label>' + param.descripcion +
                    '<div class="obligatorio tooltip2" id="' + param.nombre + '">*' +
                    '<span class="tooltiptext2 campoObligatorio CAMPO_OBLIGATORIO"></span>' +
                    '</div>' +
                    '</label>' +
                    '</div>' +
                    '<div class="form-group col-12">' +
                    '<input type="number" step=".01" id="id_param_' + param.id_parametro + '" name="' + param.id_parametro + '" class="form-control" placeholder="' + param.unidad + '" onblur="return checkParameter(\'id_param_' + param.id_parametro + '\', \'errorFormato' + param.nombre + '\', \'paramExploreRegister\')" />' +
                    '<div id="errorFormato' + param.nombre + '" style="display:none"></div>' +
                    '</div>' +
                    '</div>';
                $("#datosProcesos").append(fieldForm);
            });
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

async function calculateProcess(idProcess, version) {
    insertField(
        document.formularioGenerico,
        "id_proceso",
        idProcess
    );
    insertField(
        document.formularioGenerico,
        "version",
        version
    );
    insertField(
        document.formularioGenerico,
        "dni_usuario_ejecucion",
        getCookie('userSystem')
    );
    insertField(
        document.formularioGenerico,
        "fecha_ejecucion",
        getCurrentDate()
    );

    inputs = document.forms["formularioGenerico"].getElementsByTagName("input");
    inputsFiltered = [];

    for (const input of inputs) {
        if (input.id.includes("id_param_")) {
            insertField(
                document.formularioGenerico,
                "id_parametro",
                input.name
            );

            insertField(
                document.formularioGenerico,
                "valor_parametro",
                input.value
            );


            await ajaxPromise(document.formularioGenerico, "add", "processUserExecutionParameter", "ANADIR_PROCESS_USER_EXECUTION_PARAMETER_OK", false)
                .then((res) => {
                    $("#registro-modal").modal("toggle");

                    ajaxResponseOK("ANADIR_PROCESS_USER_EXECUTION_PARAMETER_OK", res.code);

                    $("#formularioAcciones").modal("hide");
                    document.getElementById("modal").style.display = "block";
                    setLang(getCookie("lang"));
                })
                .catch((res) => {
                    $("#registro-modal").modal("toggle");
                    ajaxResponseKO(res.code);

                    $("#formularioAcciones").modal("hide");
                    document.getElementById("modal").style.display = "block";
                    setLang(getCookie("lang"));
                });
        }
    }
}

async function updateCalculateProcess(idProcess, version) {
    insertField(
        document.formularioGenerico,
        "id_proceso",
        idProcess
    );
    insertField(
        document.formularioGenerico,
        "version",
        version
    );
    insertField(
        document.formularioGenerico,
        "dni_usuario_ejecucion",
        getCookie('userSystem')
    );
    insertField(
        document.formularioGenerico,
        "fecha_ejecucion",
        getCurrentDate()
    );

    inputs = document.forms["formularioGenerico"].getElementsByTagName("input");
    inputsFiltered = [];

    for (const input of inputs) {
        if (input.id.includes("id_param_")) {
            insertField(
                document.formularioGenerico,
                "id_parametro",
                input.name
            );

            insertField(
                document.formularioGenerico,
                "valor_parametro",
                input.value
            );


            await ajaxPromise(document.formularioGenerico, "edit", "processUserExecutionParameter", "EDITAR_PROCESS_USER_EXECUTION_PARAMETER_OK", false)
                .then((res) => {
                    $("#registro-modal").modal("toggle");

                    ajaxResponseKO(res.code);
                    ajaxResponseOK("EDITAR_PROCESS_USER_EXECUTION_PARAMETER_OK", res.code);

                    $("#formularioAcciones").modal("hide");

                    document.getElementById("modal").style.display = "block";

                    setLang(getCookie("lang"));
                })
                .catch((res) => {
                    $("#registro-modal").modal("toggle");
                    ajaxResponseKO(res.code);

                    $("#formularioAcciones").modal("show");
                    document.getElementById("modal").style.display = "block";

                    setLang(getCookie("lang"));
                });
        }
    }
}

function getIndividualFootPrint(idP, v, formula) {
    footPrint = "-";
    calculatedProcesses.resource.forEach(function (cp) {
        idProcess = Object.keys(cp)[0];
        if (idProcess == idP) {
            cp[idP].forEach(function (version) {
                idVersion = Object.keys(version)[0];
                if (idVersion == v) {
                    params = version[Object.keys(version)[0]];
                    if (params) {
                        params.forEach(function (p) {
                            formula = formula.replaceAll("#_" + p.id_parametro.id_parametro + "_#", p.valor_parametro);
                        });
                        footPrint = eval(formula);
                    }
                }
            });
        }
    });
    return footPrint;
}

function exportLastVersion() {
    var descargar = true;
    var total = 0;
    var doc = new jsPDF();

    var img = new Image()
    img.src = 'Resources/indexIcon2.png'
    img.onload = () => {
        doc.addImage(img, 'png', 20, 20, 20, 20)

        doc.setFontType("bold");
        doc.text(42, 32, 'Ecohuella');
        doc.setFontSize(14);
        doc.text(20, 50, 'INFORME HISTORIAL PROCESOS');

        doc.setFontType("normal");
        doc.setFontSize(11);
        doc.text(20, 60, "+ Solicitante: " + getCookie("userSystem"));
        doc.text(20, 65, '+ Tipo Informe: Cálculo de huella de carbono para última versión de procesos calculados');
        doc.text(20, 70, "+ Fecha informe: " + getCurrentDate());

        doc.setFontSize(12);
        doc.setFontType("bold");
        doc.text(20, 80, "LISTADO DE PROCESOS:");

        doc.setFontSize(11);
        doc.setFontType("normal");
        lineHeight = 81;
        executedProcesses.resource.forEach(function (process) {
            process[Object.keys(process)[0]].forEach(function (p, idx, array) {
                if (idx === array.length - 1) {
                    if (lineHeight < 266) {
                        lineHeight = lineHeight + 5
                        doc.text(20, lineHeight, "+ Nombre proceso: " + p.nombre);
                        lineHeight = lineHeight + 5
                        doc.text(30, lineHeight, "- Versión: " + p.version);
                        lineHeight = lineHeight + 5
                        calculo = getIndividualFootPrint(p.id_proceso, p.version, p.formula);
                        if (calculo == "-") {
                            descargar = false;
                        }
                        doc.text(30, lineHeight, "- Huella de carbono: " + calculo + " Kg CO2");
                        total += parseInt(calculo);
                    } else {
                        doc.addPage();
                        doc.addImage(img, 'png', 20, 20, 20, 20)

                        doc.setFontType("bold");
                        doc.text(42, 32, 'Ecohuella');
                        doc.setFontSize(14);
                        doc.text(20, 50, 'INFORME HISTORIAL PROCESOS');

                        doc.setFontType("normal");
                        doc.setFontSize(11);
                        doc.text(20, 60, '+ Tipo Informe: Cálculo de huella de carbono para última versión de procesos calculados');
                        doc.text(20, 65, "+ Fecha informe: " + getCurrentDate());

                        doc.setFontSize(12);
                        doc.setFontType("bold");
                        doc.text(20, 75, "LISTADO DE PROCESOS:");

                        doc.setFontSize(11);
                        doc.setFontType("normal");
                        lineHeight = 81;
                    }

                }
            });
        });

        doc.setFontSize(14);
        doc.setFontType("bold");
        lineHeight = lineHeight + 10;
        doc.text(20, lineHeight, "TOTAL HUELLA DE CARBONO CALCULADA: " + total + " Kg CO2");

        if (descargar) {
            ajaxResponseOK("INFORME_EXPORTADO_CORRECTAMENTE");
            document.getElementById("modal").style.display = "block";
            doc.save('historico_ultima_version.pdf');
            window.open(doc.output('bloburl'))
        } else {
            ajaxResponseKO("ULTIMA_VERSION_NO_EJECUTADA");
            document.getElementById("modal").style.display = "block";
        }
    };
}

function openExportSelectedVersion() {
    document.getElementById("listadoProcesos").innerHTML = "";
    $("#formularioSeleccionProcesos").modal("show");
    executedProcesses.resource.forEach(function (process) {
        document.getElementById("listadoProcesos").innerHTML +=
            "<div class='form-group col-3'>" +
            "<label>" + process[Object.keys(process)[0]][0].nombre + "</label>" +
            "<select name='version' id='select_version_" + process[Object.keys(process)[0]][0].id_proceso + "' class='form-control'></select>" +
            "</div>";

        var select = $("#select_version_" + process[Object.keys(process)[0]][0].id_proceso);

        select.empty();

        var option1 = document.createElement("option");
        option1.setAttribute("value", "");
        option1.setAttribute("label", "-----");
        option1.setAttribute("class", "-----");

        select.append(option1);

        process[Object.keys(process)[0]].forEach(function (p) {
            option2 = document.createElement("option");
            option2.setAttribute("value", p.version);
            option2.setAttribute("name", p.version);
            optionTexto = document.createTextNode(p.version);
            option2.appendChild(optionTexto);
            select.append(option2);
            option2.setAttribute("selected", "true");
        });
    });
    setLang(getCookie("lang"));
}

function exportSelectedVersion() {
    customSelection = [];
    selects = document.getElementsByTagName("select");

    for (let select of selects) {
        obj = {};
        id = select.id.substring(15, select.id.length);
        value = select.value;
        obj["proceso"] = id;
        obj["version"] = value;
        customSelection.push(obj);
    }

    var descargar = true;
    var total = 0;
    var doc = new jsPDF();

    var img = new Image()
    img.src = 'Resources/indexIcon2.png'
    img.onload = () => {
        doc.addImage(img, 'png', 20, 20, 20, 20)

        doc.setFontType("bold");
        doc.text(42, 32, 'Ecohuella');
        doc.setFontSize(14);
        doc.text(20, 50, 'INFORME HISTORIAL PROCESOS');

        doc.setFontType("normal");
        doc.setFontSize(11);
        doc.text(20, 60, "+ Solicitante: " + getCookie("userSystem"));
        doc.text(20, 65, '+ Tipo Informe: Cálculo de huella de carbono para última versión de procesos calculados');
        doc.text(20, 70, "+ Fecha informe: " + getCurrentDate());

        doc.setFontSize(12);
        doc.setFontType("bold");
        doc.text(20, 80, "LISTADO DE PROCESOS:");

        doc.setFontSize(11);
        doc.setFontType("normal");
        lineHeight = 81;
        executedProcesses.resource.forEach(function (process) {
            process[Object.keys(process)[0]].forEach(function (p) {
                customSelection.forEach(function (cs) {
                    if ((cs.version != "") && (p.id_proceso == cs.proceso && p.version == cs.version)) {
                        if (lineHeight < 266) {
                            lineHeight = lineHeight + 5
                            doc.text(20, lineHeight, "+ Nombre proceso: " + p.nombre);
                            lineHeight = lineHeight + 5
                            doc.text(30, lineHeight, "- Versión: " + p.version);
                            lineHeight = lineHeight + 5
                            calculo = getIndividualFootPrint(p.id_proceso, p.version, p.formula);
                            if (calculo == "-") {
                                descargar = false;
                            }
                            doc.text(30, lineHeight, "- Huella de carbono: " + calculo + " Kg CO2");
                            total += parseInt(calculo);
                        } else {
                            doc.addPage();
                            doc.addImage(img, 'png', 20, 20, 20, 20)

                            doc.setFontType("bold");
                            doc.text(42, 32, 'Ecohuella');
                            doc.setFontSize(14);
                            doc.text(20, 50, 'INFORME HISTORIAL PROCESOS');

                            doc.setFontType("normal");
                            doc.setFontSize(11);
                            doc.text(20, 60, '+ Tipo Informe: Cálculo de huella de carbono para versiones personalizadas');
                            doc.text(20, 65, "+ Fecha informe: " + getCurrentDate());

                            doc.setFontSize(12);
                            doc.setFontType("bold");
                            doc.text(20, 75, "LISTADO DE PROCESOS:");

                            doc.setFontSize(11);
                            doc.setFontType("normal");
                            lineHeight = 81;
                        }
                    }
                });
            });
        });

        doc.setFontSize(14);
        doc.setFontType("bold");
        lineHeight = lineHeight + 10;
        doc.text(20, lineHeight, "TOTAL HUELLA DE CARBONO CALCULADA: " + total + " Kg CO2");

        if (descargar) {
            $("#formularioSeleccionProcesos").modal("hide");
            ajaxResponseOK("INFORME_EXPORTADO_CORRECTAMENTE");
            document.getElementById("modal").style.display = "block";
            doc.save('historico_versiones_personalizadas.pdf');
            window.open(doc.output('bloburl'))
        } else {
            $("#formularioSeleccionProcesos").modal("hide");
            ajaxResponseKO("VERSION_NO_EJECUTADA");
            document.getElementById("modal").style.display = "block";
        }
    };
}

function filterButton() {
    var showBtn = getCookie('userRole') == 'basico' ? ' <button id="btnFilterShow" type="button" class="btn btn-dark FILTRAR my-3" onclick="showFilters()" class="tooltip"></button>' +
        ' <button id="btnFilterClose" type="button" class="btn btn-dark CERRAR_FILTRADO my-3" onclick="closeFilters()" class="tooltip" style="display:none"></button>' : '';

    document.getElementById("btnFilter").innerHTML += showBtn;

}

function showFilters() {
    originalProcesses = executedProcesses.resource;

    document.getElementById("buscador").style.display = "block";
    document.getElementById("bnombre").style.display = "block";
    document.getElementById("bdescripcion").style.display = "block";

    $('#btnFilterShow').css('display', 'none');
    $('#btnFilterClose').css('display', 'inline-block');
}

function closeFilters() {
    originalProcesses = null;

    document.getElementById("bnombre").value = "";
    document.getElementById("bnombre").style.display = "none";
    document.getElementById("bdescripcion").value = "";
    document.getElementById("bdescripcion").style.display = "none";

    $('#btnFilterShow').css('display', 'inline-block');
    $('#btnFilterClose').css('display', 'none');

    loadProcessUserExecutionData();
}

function filtrar() {
    executedProcesses.resource = originalProcesses;

    nombre = document.getElementById("bnombre").value;
    descripcion = document.getElementById("bdescripcion").value;


    if (nombre != null && nombre != "") {
        executedProcesses.resource = executedProcesses.resource.filter(function (process) {
            return process[Object.keys(process)[0]][0].nombre.toString().toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (descripcion != null && descripcion != "") {
        executedProcesses.resource = executedProcesses.resource.filter(function (process) {
            return process[Object.keys(process)[0]][0].descripcion.toString().toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(descripcion.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    executedProcesses.total = executedProcesses.resource.length;

    setCookie("paintPager", "si");
    adjustPager();
    if (getCookie("paintPager") == "si") {
        setCookie("totalElements", executedProcesses.total);
        pager("process");
        setCookie("totalElements", executedProcesses.total);
    }
    fileTableMessage();
    searchEntities(getCookie('actualPage'));
}