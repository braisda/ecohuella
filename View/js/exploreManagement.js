var categories;
var moderators;
var actualFather;
var fathersCategories;
var processes;
var processes2;
var showProcesses = false;
var originalCategories;
var originalProcesses;
var lastCategory;

function checkPermissions() {
    if (getCookie("userRole") != "basico") {
        window.location.href = './menu.html';
    }
}

async function loadCategoryData() {
    var lang = getCookie("lang");
    actualFather = "1";

    createHideForm("formCategoryManagement");

    await ajaxPromise(document.formCategoryManagement, "search", "category", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            categories = res;
            updateFathers(res, true);

            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", fathersCategories.total);
                pager("categoryExplore");
            }
            setCookie("totalElements", fathersCategories.total);
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

function getList(start, end) {
    $("#exploreCards").html("");

    finalBucle = parseInt(start) + parseInt(end);

    if (!showProcesses && fathersCategories.resource.length < finalBucle) {
        finalBucle = fathersCategories.resource.length;
    } else if (showProcesses && processes2.resource.length < finalBucle) {
        finalBucle = processes2.resource.length;
    }

    for (var i = start; i < finalBucle; i++) {
        if (showProcesses) {
            makeProcessCard(processes2.resource[i]);
        } else {
            var card = makeCategoryCard(fathersCategories.resource[i]);
            $("#exploreCards").append(card);
        }
        setLang(getCookie('lang'));
    }
}

function makeCategoryCard(row) {
    var card =
        '<div class="row d-flex justify-content-center">' +
        '<div id="prueba" onclick="retrieveChildren(' + row.id_categoria + ', \'' + row.nombre + '\');" class="card cardExplore text-white bg-secondary m-3">' +
        '<div class="card-header bg-dark text-uppercase font-weight-bold ">' + row.nombre + '</div>' +
        '<div class="card-body bg-card" style="min-height: 8rem !important;">' +
        '<p class="card-text mb-0">' + row.descripcion + '</p>' +
        '</div>' +
        '</div>' +
        '</div>';

    return card;
}

function makeProcessCard(row) {
    idProcess = Object.keys(row)[0];

    var card =
        '<div class="row d-flex justify-content-center">' +
        '<div id="card_' + idProcess + '" class="card cardExploreProcess text-white bg-secondary m-3">' +
        '<div class="card-header bg-dark text-uppercase font-weight-bold "><span id="icon_' + idProcess + '" class=""></span><span id="card_title_' + idProcess + '"> ' + row[idProcess][0].nombre + '</span></div>' +
        '<ul class="nav nav-pills pl-2" id="pills-tab' + idProcess + '" role="tablist">' +
        '</ul>' +
        '<div class="tab-content" id="pills-tabContent' + idProcess + '">' +

        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
    $("#exploreCards").append(card);

    openedProcess = false;
    openedLastProcess = false;
    row[idProcess].forEach(function (p, idx, array) {
        ul = document.getElementById("pills-tab" + idProcess);
        liText = '<li id="li_' + p.id_proceso + "_" + p.version + '" class="nav-item">' +
            (p.abierto == 0 ?
                '<a onclick="checkColorDot(' + p.id_proceso + ', ' + p.abierto + ')" class="nav-link mr-1" id="pills_' + p.id_proceso + "_" + p.version + '_tab" data-toggle="pill" href="#pills_' + p.id_proceso + "_" + p.version + '" role="tab" aria-controls="pills_' + p.id_proceso + "_" + p.version + '" aria-selected="false">V.' + p.version + '</a>'
                : '<a onclick="checkColorDot(' + p.id_proceso + ', ' + p.abierto + ')" class="nav-link mr-1" id="pills_' + p.id_proceso + "_" + p.version + '_tab" data-toggle="pill" href="#pills_' + p.id_proceso + "_" + p.version + '" role="tab" aria-controls="pills_' + p.id_proceso + "_" + p.version + '" aria-selected="false"><u>V.' + p.version + '</u></a>')
        '</li>';
        ul.innerHTML += liText;

        pills = document.getElementById("pills-tabContent" + idProcess);
        newCardContentText = '<div class="tab-pane fade" id="pills_' + p.id_proceso + "_" + p.version + '" role="tabpanel" aria-labelledby="pills_' + p.id_proceso + "_" + p.version + '_tab">' +
            '<div class="card-body bg-card">' +
            '<p class="card-text mb-0">' + p.descripcion + '</p>' +
            '<p class="card-text mb-0"><span class="VERSION"></span>: ' + p.version + '</p>' +
            (p.abierto == 0 ?
                '<button class="btn btn-dark ABRIR_PROCESO mt-1" onclick="openProcess(' + p.id_proceso + ', ' + p.version + ', ' + p.id_categoria.id_categoria + ');" ></button>'
                : '<button class="btn btn-dark CERRAR_PROCESO mt-1" onclick="closeProcess(' + p.id_proceso + ', ' + p.version + ', ' + p.id_categoria.id_categoria + ');" ></button>')
        '</div>' +
            '</div>';
        pills.innerHTML += newCardContentText;

        //actualizamos el color del icono abierto/cerrrado
        checkColorDot(idProcess, p.abierto);

        //comprobamos si alguno de los procesos está abierto
        if (p.abierto == true) {
            openedProcess = true;
        }

        //ponemos como visible siempre la última version
        if (idx === array.length - 1) {
            document.getElementById("pills_" + p.id_proceso + "_" + p.version + "_tab").classList.add("active");
            document.getElementById("pills_" + p.id_proceso + "_" + p.version).classList.add("show");
            document.getElementById("pills_" + p.id_proceso + "_" + p.version).classList.add("active");

            //comprobamos si el último de los procesos está abierto
            if (p.abierto == true) {
                openedLastProcess = true;
            }
        }


    });

    //establecemos icono de alerta si el proceso está abierto en una versión que no es la última
    if (openedProcess && !openedLastProcess) {
        alerta = '<div class="tooltip6"><img class="alertaVersion ICONO_ALERTA_VERSION" src="Resources/alert.png" alt="Detalle"/><span class="tooltiptext ICONO_ALERTA_VERSION"></span></div>';
        document.getElementById("card_title_" + idProcess).innerHTML += alerta;
    }
}

function checkColorDot(idProceso, abierto) {
    if (abierto == 1) {
        document.getElementById("icon_" + idProceso).classList.remove("red-dot");
        document.getElementById("icon_" + idProceso).classList.add("green-dot");
    } else {
        document.getElementById("icon_" + idProceso).classList.remove("green-dot");
        document.getElementById("icon_" + idProceso).classList.add("red-dot");
    }
}

async function retrieveChildren(father_id, father_name) {
    lastCategory = { "father_id": father_id, "father_name": father_name };
    if ($("#btnFilterClose").css('display') != "none") {
        closeFilters();
    }
    showProcesses = false;
    if (document.getElementById("idVacio") != null) {
        document.getElementById("idVacio").remove();
    }
    await loadChildrenCategoryData(father_id, father_name);
}

async function loadChildrenCategoryData(father_id, father_name) {
    var lang = getCookie("lang");

    insertField(
        document.formCategoryManagement,
        "id_categoria_padre",
        father_id
    );

    await ajaxPromise(document.formCategoryManagement, "search", "category", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            updateFathers(res, false);

            if (fathersCategories.resource.length > 0) {
                setCookie("paintPager", "si");
                adjustPager();
                if (getCookie("paintPager") == "si") {
                    setCookie("totalElements", fathersCategories.total);
                    pager("categoryExplore");
                }
                setCookie("totalElements", fathersCategories.total);
                fileTableMessage();
                updateBreadcrumbCategory(father_id, father_name);
                document.getElementById("pageTitle").classList.remove('EXPLORAR_PROCESOS_CATEGORIA');
                document.getElementById("pageTitle").classList.add('EXPLORAR_CATEGORIAS');
                searchEntities(getCookie('actualPage'));
            } else {
                updateBreadcrumbCategory(father_id, father_name);
                searchProcess(father_id);
            }

        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

function updateFathers(res, isInitial) {
    fathersCategories = {
        code: res.code,
        criteriosbusqueda: res.criteriosbusqueda,
        empieza: res.empieza,
        filas: res.filas,
        ok: res.ok,
        resource: res.resource,
        total: res.total
    };

    if (isInitial) {
        fathersCategories.resource = fathersCategories.resource.filter(function (categorie) {
            return categorie.id_categoria_padre.id_categoria == "1";
        });
        fathersCategories.total = fathersCategories.resource.length;
        fathersCategories.filas = fathersCategories.resource.length;
    } else {
        fathersCategories.resource = fathersCategories.resource.filter(function (categorie) {
            return categorie.id_categoria != "1";
        });
        fathersCategories.total = fathersCategories.resource.length;
        fathersCategories.filas = fathersCategories.resource.length;
    }

    return fathersCategories;
}

async function searchProcess(father_id) {
    await loadProcessData(father_id);
}

async function loadProcessData(father_id) {
    var lang = getCookie("lang");

    createHideForm("formProcessManagement");

    insertField(
        document.formProcessManagement,
        "id_categoria",
        father_id
    );
    insertField(
        document.formProcessManagement,
        "activo",
        1
    );
    showProcesses = true;
    await ajaxPromise(document.formProcessManagement, "explore", "process", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            processes = res;

            processes2 = groupProcesses(res);

            empty = document.createElement("p");
            empty.id = "idVacio";
            empty.classList.add("VACIO");
            if (processes.code == "RECORDSET_VACIO") {
                document.getElementById("contenidoPrincipalInicio").appendChild(empty);
            }
            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", processes2.total);
                pager("processExplore");
            }
            setCookie("totalElements", processes2.total);
            fileTableMessage();
            document.getElementById("pageTitle").classList.remove('EXPLORAR_CATEGORIAS');
            document.getElementById("pageTitle").classList.add('EXPLORAR_PROCESOS_CATEGORIA');
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
    res.resource.forEach(function (process) {
        if (process.version == 1) {
            groupedProcess[process.id_proceso] = [];
            groupedProcesses.push(groupedProcess);
            groupedProcess = {};
        }
    });

    groupedProcesses.forEach(function (gp) {
        idProcess = Object.keys(gp)[0];

        res.resource.forEach(function (process) {
            if (idProcess == process.id_proceso) {
                gp[idProcess].push(process);
            }
        });
    });


    //Eliminamos las versiones no activas anteriores a la última que esté activa
    groupedProcesses = deleteOldNoActive(groupedProcesses);

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

function deleteOldNoActive(groupedProcesses) {
    groupedProcesses.forEach(function (gp) {
        lastOpened = null;
        idProcess = Object.keys(gp)[0];

        gp[idProcess].forEach(function (process) {
            if (process.abierto == 1) {
                lastOpened = process.version;
            }
        });

        gp[idProcess] = gp[idProcess].filter(function (p) {
            return (p.version < lastOpened && p.abierto) || (p.version >= lastOpened);
        });
    });

    return groupedProcesses;
}

function openProcess(idProcess, version, categoria) {
    $("#myModalConfirmOpenProcess").modal("show");

    if (document.getElementById("btnConfirmOpenProcess")) {
        document.getElementById("btnConfirmOpenProcess").remove();
    }

    var btn =
        '<button type="button" id="btnConfirmOpenProcess" class="btn btn-primary ABRIR_PROCESO" onclick="confirmProcess(' + idProcess + ', ' + version + ', ' + categoria + ')"></button >';

    $('#divConfirmOpenProcess').append(btn);
    setLang(getCookie("lang"));
}

function closeProcess(idProcess, version, categoria) {
    $("#myModalConfirmDeleteProcess").modal("show");

    if (document.getElementById("btnConfirmDeleteProcess")) {
        document.getElementById("btnConfirmDeleteProcess").remove();
    }

    var btn =
        '<button type="button" id="btnConfirmDeleteProcess" class="btn btn-primary CERRAR_PROCESO" onclick="deleteProcess(' + idProcess + ', ' + version + ', ' + categoria + ')"></button >';

    $('#divConfirmDeleteProcess').append(btn);
    setLang(getCookie("lang"));
}

async function confirmProcess(idProcess, version, categoria) {
    await addProcessUserExecution(idProcess, version, categoria);
}

async function addProcessUserExecution(idProcess, version, categoria) {
    var lang = getCookie("lang");

    createHideForm("formProcessUserExecutionAdd");
    removeField("id_proceso");
    removeField("version");
    removeField("dni_usuario_ejecucion");
    removeField("controller");
    removeField("action");
    insertField(
        document.formProcessUserExecutionAdd,
        "id_proceso",
        idProcess
    );
    insertField(
        document.formProcessUserExecutionAdd,
        "version",
        version
    );
    insertField(
        document.formProcessUserExecutionAdd,
        "dni_usuario_ejecucion",
        getCookie('userSystem')
    );

    await ajaxPromise(document.formProcessUserExecutionAdd, "add", "processUserExecution", ["ANADIR_PROCESS_USER_EXECUTION_OK"], true)
        .then((res) => {
            $("#myModalConfirmOpenProcess").modal("hide");
            ajaxResponseOK("ANADIR_PROCESS_USER_EXECUTION_OK", res.code);
            document.getElementById("modal").style.display = "block";
            searchProcess(categoria);
        })
        .catch((res) => {
            $("#myModalConfirmOpenProcess").modal("hide");
            ajaxResponseKO(res.code);
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

async function deleteProcess(idProcess, version, categoria) {
    await deleteProcessUserExecution(idProcess, version, categoria);
}

async function deleteProcessUserExecution(idProcess, version, categoria) {
    var lang = getCookie("lang");

    createHideForm("formProcessUserExecutionDelete");
    removeField("id_proceso");
    removeField("version");
    removeField("dni_usuario_ejecucion");
    removeField("controller");
    removeField("action");
    insertField(
        document.formProcessUserExecutionDelete,
        "id_proceso",
        idProcess
    );
    insertField(
        document.formProcessUserExecutionDelete,
        "version",
        version
    );
    insertField(
        document.formProcessUserExecutionDelete,
        "dni_usuario_ejecucion",
        getCookie('userSystem')
    );

    await ajaxPromise(document.formProcessUserExecutionDelete, "finalDelete", "processUserExecution", ["ELIMINAR_PROCESS_USER_EXECUTION_OK"], true)
        .then((res) => {

            $("#myModalConfirmDeleteProcess").modal("hide");
            ajaxResponseOK("ELIMINAR_PROCESS_USER_EXECUTION_OK", res.code);
            document.getElementById("modal").style.display = "block";
            searchProcess(categoria);
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
            $("#myModalConfirmDeleteProcess").modal("hide");
            document.getElementById("modal").style.display = "block";
        });
    setLang(lang);
    deleteActionController();
}

function filterButton() {
    var showBtn = getCookie('userRole') == 'basico' ? ' <button id="btnFilterShow" type="button" class="btn btn-dark FILTRAR my-3" onclick="showFilters()" class="tooltip"></button>' +
        ' <button id="btnFilterClose" type="button" class="btn btn-dark CERRAR_FILTRADO my-3" onclick="closeFilters()" class="tooltip" style="display:none"></button>' : '';

    document.getElementById("btnFilter").innerHTML += showBtn;

}

function showFilters() {
    if (showProcesses) {
        originalProcesses = processes2.resource;
    } else {
        originalCategories = fathersCategories.resource;
    }
    document.getElementById("buscador").style.display = "block";
    document.getElementById("bnombre").style.display = "block";
    document.getElementById("bdescripcion").style.display = "block";

    $('#btnFilterShow').css('display', 'none');
    $('#btnFilterClose').css('display', 'inline-block');
}

function closeFilters() {
    if (showProcesses) {
        originalProcesses = null;
    } else {
        originalCategories = null;
    }
    document.getElementById("bnombre").value = "";
    document.getElementById("bnombre").style.display = "none";
    document.getElementById("bdescripcion").value = "";
    document.getElementById("bdescripcion").style.display = "none";

    $('#btnFilterShow').css('display', 'inline-block');
    $('#btnFilterClose').css('display', 'none');

    if (showProcesses) {
        loadProcessData(lastCategory.father_id, lastCategory.father_name);
    } else {
        if (lastCategory != null) {
            retrieveChildren(lastCategory.father_id, lastCategory.father_name);
        } else {
            loadCategoryData();
        }
    }
}

function filtrar() {
    if (showProcesses) {
        processes2.resource = originalProcesses;
    } else {
        fathersCategories.resource = originalCategories;
    }

    nombre = document.getElementById("bnombre").value;
    descripcion = document.getElementById("bdescripcion").value;

    if (showProcesses) {
        if (nombre != null && nombre != "") {
            processes2.resource = processes2.resource.filter(function (process) {
                return process[Object.keys(process)[0]][0].nombre.toString().toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
            });
        }

        if (descripcion != null && descripcion != "") {
            processes2.resource = processes2.resource.filter(function (process) {
                return process[Object.keys(process)[0]][0].descripcion.toString().toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(descripcion.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
            });
        }

        processes2.total = processes2.resource.length;
    } else {
        if (nombre != null && nombre != "") {
            fathersCategories.resource = fathersCategories.resource.filter(function (category) {
                return category.nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
            });
        }

        if (descripcion != null && descripcion != "") {
            fathersCategories.resource = fathersCategories.resource.filter(function (category) {
                return category.descripcion.toString().toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(descripcion.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
            });
        }

        fathersCategories.total = fathersCategories.resource.length;
    }



    setCookie("paintPager", "si");
    adjustPager();
    if (getCookie("paintPager") == "si") {
        if (showProcesses) {
            setCookie("totalElements", processes2.total);
            pager("process");
            setCookie("totalElements", processes2.total);
        } else {
            setCookie("totalElements", fathersCategories.total);
            pager("category");
            setCookie("totalElements", fathersCategories.total);
        }
    }
    fileTableMessage();
    searchEntities(getCookie('actualPage'));
}
