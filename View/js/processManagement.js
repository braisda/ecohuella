var processes;
var categories;
var formulators;
var parameters;
var finalFormula;
var originalProcesses;

function checkPermissions() {
    if (getCookie("userRole") != "moderador" && getCookie("userRole") != "formulador") {
        window.location.href = './menu.html';
    }
}

async function loadProcessData() {
    var lang = getCookie("lang");

    createHideForm("formProcessManagement");

    await ajaxPromise(document.formProcessManagement, "search", "process", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            processes = res;
            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", res.total);
                pager("process");
            }
            setCookie("totalElements", res.total);
            fileTableMessage();
            searchEntities(getCookie('actualPage'));
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
        });
    setLang(lang);
    deleteActionController();
}

async function loadCategoryData() {
    var lang = getCookie("lang");

    createHideForm("formCategoryManagement");

    await ajaxPromise(document.formCategoryManagement, "search", "category", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            categories = res;
            fillCategoriesInForm();
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
        });
    setLang(lang);
    deleteActionController();
}

async function loadUserData() {
    var lang = getCookie("lang");

    createHideForm("formUserManagement");

    insertField(
        document.formUserManagement,
        "id_rol",
        3
    );

    await ajaxPromise(document.formUserManagement, "search", "user", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            formulators = res.resource;
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
        });
    setLang(lang);
    deleteActionController();
}

async function loadParameterData(processId, version, formula) {
    var lang = getCookie("lang");

    createHideForm("formParameterManagement");

    insertField(
        document.formParameterManagement,
        "id_proceso",
        processId
    );

    insertField(
        document.formParameterManagement,
        "version",
        version
    );

    await ajaxPromise(document.formParameterManagement, "search", "parameter", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            parameters = res;
            fillParametersInForm();
            $("#input_formula_proceso").val(translateFormula(formula));
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
        });
    setLang(lang);
    deleteActionController();
}

function getList(start, end) {
    $("#datosEntidades").html("");

    finalBucle = parseInt(start) + parseInt(end);

    if (processes.resource.length < finalBucle) {
        finalBucle = processes.resource.length;
    }

    for (var i = start; i < finalBucle; i++) {
        var tr = makeRow(processes.resource[i]);
        $("#datosEntidades").append(tr);
        setLang(getCookie('lang'));
    }
}

function makeRow(row) {
    atributosFunciones = [
        "'" + row.id_proceso + "'",
        "'" + row.version + "'",
        "'" + row.nombre + "'",
        "'" + row.descripcion + "'",
        "'" + row.formula + "'",
        "'" + row.fecha_creacion + "'",
        "'" + row.fecha_modificacion + "'",
        "'" + row.activo + "'",
        "'" + row.id_categoria.id_categoria + "'",
        "'" + row.dni_usuario_creacion.dni + "'",
        "'" + row.dni_usuario_modificacion.dni + "'"
    ];

    celdaAccionesDetalle =
        '<div class="tooltip6"><img class="detalle ICONO_DETALLE" src="Resources/detail3.png" onclick="showDetail(' +
        atributosFunciones +
        ')" alt="Detalle"/><span class="tooltiptext ICONO_DETALLE"></span></div>';
    celdaAccionesEditar =
        '<div class="tooltip6"><img class="editar ICONO_EDIT" src="Resources/edit3.png" onclick="showEdit(' +
        atributosFunciones +
        ')" alt="Editar"/><span class="tooltiptext ICONO_EDIT"></span></div>';
    celdaAccionesEliminar =
        '<div class="tooltip6"><img class="eliminar ICONO_ELIMINAR" src="Resources/delete3.png" id=' + atributosFunciones[0] + ' onclick="showDelete(' +
        atributosFunciones[0] + ', ' + atributosFunciones[1] +
        ')" alt="Eliminar"/><span class="tooltiptext ICONO_ELIMINAR"></span></div>';
    if (getCookie('userRole') == 'formulador' && getCookie("userSystem") == row.dni_usuario_modificacion.dni) {
        celdaAcciones = celdaAccionesDetalle + celdaAccionesEditar + celdaAccionesEliminar;
    } else if (getCookie('userRole') == 'moderador') {
        celdaAccionesActivar =
            '<div class="tooltip6"><img class="editar ICONO_EDIT" src="Resources/activar.png" onclick="showEdit(' +
            atributosFunciones + ", 'activate'" +
            ')" alt="Editar"/><span class="tooltiptext ACTIVAR"></span></div>';
        celdaAccionesReasignar =
            '<div class="tooltip6"><img class="editar ICONO_EDIT" src="Resources/reasignar.png" onclick="showEdit(' +
            atributosFunciones + ", 'reasign'" +
            ')" alt="Editar"/><span class="tooltiptext REASIGNAR"></span></div>';
        celdaAcciones = celdaAccionesDetalle + celdaAccionesActivar + celdaAccionesReasignar;
    } else if (getCookie('userRole') == 'formulador' && getCookie("userSystem") != row.dni_usuario_modificacion.dni) {
        celdaAcciones = celdaAccionesDetalle;
    } else {
        celdaAcciones = '';
    }
    var rowTable =
        '<tr class="impar" id="datoEntidad">' +
        "</td> <td>" +
        row.id_proceso +
        "</td> <td>" +
        row.version +
        "</td> <td>" +
        row.nombre +
        "</td> <td>" +
        row.fecha_creacion +
        "</td> <td>" +
        row.id_categoria.id_categoria + " - " + row.id_categoria.nombre +
        "</td> <td>" +
        row.dni_usuario_modificacion.dni +
        "</td>" +
        (row.activo == 1 ?
            "<td class='text-nowrap SI'>"
            : "<td class='text-nowrap NO'>") +
        "</td> <td>" +
        celdaAcciones
    "</td> </tr>";

    return rowTable;
}

function showDetail(
    id,
    version,
    nombre,
    descripcion,
    formula,
    fecha_creacion,
    fecha_modificacion,
    activo,
    id_categoria,
    creador,
    modificador
) {
    var idioma = getCookie("lang");
    var fields = [
        "input_id_proceso_visible",
        "input_version_proceso",
        "input_nombre_proceso",
        "input_descripcion_proceso",
        "input_formula_proceso",
        "input_fecha_creacion_proceso",
        "input_fecha_modificacion_proceso",
        "input_creador_proceso",
        "input_creador_proceso_visible",
        "idParametroE",
        "idValorE"
    ];
    var fieldsSelect = [
        "input_activo_proceso",
        "input_categoria",
        "input_categoria_proceso",
        "input_modificador_proceso",
        "idOperadorE"
    ];
    seeInDetailStructure();
    changeForm("detailForm", "javascript:closeEntityModal();", "");
    changeIcon("Resources/close2.png", "CERRARMODAL", "iconoCerrar", "Ok");
    fillForm(
        id,
        version,
        nombre,
        descripcion,
        formula,
        fecha_creacion,
        fecha_modificacion,
        activo,
        id_categoria,
        creador,
        modificador
    );
    disableFields(fields);
    disableFieldsSelect(fieldsSelect);
    $("#botoneraBoxEdit").attr("style", "display: none !important");
    $("#input_formula_proceso").attr("onclick", "");
    $("#formularioAcciones").modal("show");
    setLang(idioma);
}

/**Función para dar una estructura a la ventana modal de ver en detalle.*/
function seeInDetailStructure() {
    clearModalErrors();
    activateFieldsBlock();
    hideRequired();
    showLabels();
}

function clearModalErrors() {
    let errores = [
        "errorFormatoId",
        "errorFormatoVersion",
        "errorFormatoNombre",
        "errorFormatoDescripcion",
        "errorFormatoFormula",
        "errorFormatoFechaCreacion",
        "errorFormatoFechaModificacion",
        "errorFormatoActivo",
        "errorFormatoCategoria",
        "errorFormatoCreador",
        "errorFormatoModificador"
    ];
    errores.forEach((element) => {
        deleteFieldId(element);
    });
}

function activateFieldsBlock() {
    $("#input_id_proceso_visible").attr("style", "display: block");
    $("#input_version_proceso").attr("style", "display: block");
    $("#input_nombre_proceso").attr("style", "display: block");
    $("#input_descripcion_proceso").attr("style", "display: block");
    $("#input_formula_proceso").attr("style", "display: block");
    $("#input_fecha_creacion_proceso").attr("style", "display: block");
    $("#input_fecha_modificacion_proceso").attr("style", "display: block");
    $("#input_activo_proceso").attr("style", "display: block");
    $("#input_categoria_proceso").attr("style", "display: block");
    $("#input_creador_proceso").attr("style", "display: block");
    $("#input_creador_proceso_visible").attr("style", "display: block");
    $("#input_modificador_proceso").attr("style", "display: block");

    enableFields([
        "input_id_proceso",
        "input_id_proceso_visible",
        "input_version_proceso",
        "input_nombre_proceso",
        "input_descripcion_proceso",
        "input_formula_proceso",
        "input_fecha_creacion_proceso",
        "input_fecha_modificacion_proceso",
        "input_creador_proceso",
        "input_creador_proceso_visible",
        "idParametroE",
        "idValorE"
    ]);
    enableFieldsSelect([
        "input_activo_proceso",
        "input_categoria_proceso",
        "input_categoria_proceso",
        "input_modificador_proceso",
        "idOperadorE"
    ]);
}

function hideRequired() {
    $("#obligatorio_proceso_id").attr("style", "display: none");
    $("#obligatorio_proceso_version").attr("style", "display: none");
    $("#obligatorio_proceso_nombre").attr("style", "display: none");
    $("#obligatorio_proceso_descripcion").attr("style", "display: none");
    $("#obligatorio_proceso_formula").attr("style", "display: none");
    $("#obligatorio_proceso_fecha_creacion").attr("style", "display: none");
    $("#obligatorio_proceso_fecha_modificacion").attr("style", "display: none");
    $("#obligatorio_proceso_activo").attr("style", "display: none");
    $("#obligatorio_proceso_categoria").attr("style", "display: none");
    $("#obligatorio_proceso_creador").attr("style", "display: none");
    $("#obligatorio_proceso_modificador").attr("style", "display: none");
}

function showLabels() {
    $("#label_proceso_id").attr("style", "display: block");
    $("#label_proceso_version").attr("style", "display: block");
    $("#label_proceso_nombre").attr("style", "display: block");
    $("#label_proceso_descripcion").attr("style", "display: block");
    $("#label_proceso_formula").attr("style", "display: block");
    $("#label_proceso_fecha_creacion").attr("style", "display: block");
    $("#label_proceso_fecha_modificacion").attr("style", "display: block");
    $("#label_proceso_activo").attr("style", "display: block");
    $("#label_proceso_categoria").attr("style", "display: block");
    $("#label_proceso_creador").attr("style", "display: block");
    $("#label_proceso_modificador").attr("style", "display: block");
}

/**Función que rellenado los datos del formulario para realizar la petición.*/
function fillForm(
    id,
    version,
    nombre,
    descripcion,
    formula,
    fecha_creacion,
    fecha_modificacion,
    activo,
    id_categoria,
    creador,
    modificador
) {
    loadParameterData(id, version, formula);
    $("#input_id_proceso").val(id);
    $("#input_id_proceso_visible").val(id);
    $("#input_version_proceso").val(version);
    $("#input_nombre_proceso").val(nombre);
    $("#input_descripcion_proceso").val(descripcion);
    $("#input_formula_proceso").val(formula);
    $("#input_fecha_creacion_proceso").val(fecha_creacion);
    $("#input_fecha_modificacion_proceso").val(fecha_modificacion);
    $("#input_activo_proceso").val(activo);
    var selectCategory = $("#input_categoria_proceso");

    selectCategory.empty();

    categories.resource.forEach(function (category) {
        option = document.createElement("option");
        option.setAttribute("value", category.id_categoria);
        option.setAttribute("name", category.id_categoria);
        optionTexto = document.createTextNode(category.id_categoria + " - " + category.nombre);
        if (id_categoria == category.id_categoria) {
            option.setAttribute("selected", "true");
        }
        option.appendChild(optionTexto);
        selectCategory.append(option);
    });

    formulators.forEach(function (user) {
        if (creador == user.dni) {
            $("#input_creador_proceso").val(creador);
            $("#input_creador_proceso_visible").val(creador + " / " + user.nombre + " " + user.apellidos_usuario);
        }
    });

    var selectModificator = $("#input_modificador_proceso");

    selectModificator.empty();

    formulators.forEach(function (user) {
        option = document.createElement("option");
        option.setAttribute("value", user.dni);
        option.setAttribute("name", user.dni);
        optionTexto = document.createTextNode(user.dni + " / " + user.nombre + " " + user.apellidos_usuario);
        if (modificador == user.dni) {
            option.setAttribute("selected", "true");
        }
        option.appendChild(optionTexto);
        selectModificator.append(option);
    });
}

/**Función para cerrar la ventana de detalle de usuario*/
function closeEntityModal() {
    $("#formularioAcciones").modal("hide");
    closeModal("formularioAcciones", "", "");
}

function addButton() {
    var showBtn = getCookie('userRole') == 'formulador' ? '<button type="button" class="btn btn-dark ANADIR_PROCESO my-3" data-toggle="modal" data-target="#registro-modal" class="tooltip"></button>' : '';

    showBtn += getCookie('userRole') == 'moderador' || getCookie('userRole') == 'formulador' ? ' <button id="btnFilterShow" type="button" class="btn btn-dark FILTRAR my-3" onclick="showFilters()" class="tooltip"></button>' +
        ' <button id="btnFilterClose" type="button" class="btn btn-dark CERRAR_FILTRADO my-3" onclick="closeFilters()" class="tooltip" style="display:none"></button>' : '';


    document.getElementById("btnAdd").innerHTML += showBtn;
}

async function addProcess() {
    insertField(
        document.formularioProceso,
        "activo",
        0
    );
    insertField(
        document.formularioProceso,
        "version",
        1
    );
    insertField(
        document.formularioProceso,
        "dni_usuario_creacion",
        getCookie("userSystem")
    );
    insertField(
        document.formularioProceso,
        "dni_usuario_modificacion",
        getCookie("userSystem")
    );
    insertField(
        document.formularioProceso,
        "fecha_creacion",
        getCurrentDate()
    );
    insertField(
        document.formularioProceso,
        "fecha_modificacion",
        getCurrentDate()
    );
    insertField(
        document.formularioProceso,
        "formula",
        ""
    );

    await ajaxPromise(document.formularioProceso, "add", "process", "ANADIR_PROCESO_OK", false)
        .then((res) => {
            $("#registro-modal").modal("toggle");

            ajaxResponseOK("ANADIR_PROCESO_OK", res.code);

            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
            let idElementoList = [
                "nombreP",
                "descripcionP",
                "categoriaP"
            ];
            resetForm("formularioProceso", idElementoList);
        })
        .catch((res) => {
            $("#registro-modal").modal("toggle");
            ajaxResponseKO(res.code);
            let idElementoList = [
                "nombreP",
                "descripcionP",
                "categoriaP"
            ];
            resetForm("formularioProceso", idElementoList);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function fillCategoriesInForm() {
    var select = $("#categoriaP");

    select.empty();

    var option1 = document.createElement("option");
    option1.setAttribute("value", "");
    option1.setAttribute("label", "-----");
    option1.setAttribute("class", "-----");
    option1.setAttribute("selected", "true");
    select.append(option1);

    categories.resource.forEach(function (category) {
        option2 = document.createElement("option");
        option2.setAttribute("value", category.id_categoria);
        option2.setAttribute("name", category.nombre);
        optionTexto = document.createTextNode(category.id_categoria + " - " + category.nombre);
        option2.appendChild(optionTexto);
        select.append(option2);
    });
}

function checkAddProcess() {
    if (checkName('nombreP', 'errorFormatNameProcess', 'nameProcessRegister') &&
        checkDescription('descripcionP', 'errorFormatDescripcionP', 'descriptionProcessRegister')) {
        return true;
    }
    return true;
}

/*Función para mostrar modal para editar e invoca a la función que
 * carga como corresponda los label, input y campo obligatorio.*/
function showEdit(
    id,
    version,
    nombre,
    descripcion,
    formula,
    fecha_creacion,
    fecha_modificacion,
    activo,
    id_categoria,
    creador,
    modificador,
    tipoModificacion
) {
    var lang = getCookie("lang");
    var fields = [
        "input_id_proceso_visible",
        "input_version_proceso",
        "input_fecha_creacion_proceso",
        "input_fecha_modificacion_proceso",
        "input_creador_proceso",
        "input_creador_proceso_visible",
        "input_activo_proceso"
    ];
    fieldsSelect = [];

    $("#botoneraBoxEdit").attr("style", "display:");
    if (getCookie("userRole") == "moderador") {
        //Si el usuario es moderador se bloquea la edición de la fórmula
        $("#botoneraBoxEdit").attr("style", "display: none !important");
        fields.push("input_formula_proceso");
        fields.push("input_nombre_proceso");
        fields.push("input_descripcion_proceso");
        fieldsSelect.push("input_categoria_proceso");
        if (tipoModificacion == "activate") {
            fieldsSelect.push("input_modificador_proceso");
            document.getElementById('input_activo_proceso').parentElement.classList.add("border");
            document.getElementById('input_activo_proceso').parentElement.classList.add("border-dark");

            document.getElementById('input_modificador_proceso').parentElement.classList.remove("border");
            document.getElementById('input_modificador_proceso').parentElement.classList.remove("border-dark");
        } else if (tipoModificacion == "reasign") {
            fieldsSelect.push("input_activo_proceso");
            document.getElementById('input_modificador_proceso').parentElement.classList.add("border");
            document.getElementById('input_modificador_proceso').parentElement.classList.add("border-dark");

            document.getElementById('input_activo_proceso').parentElement.classList.remove("border");
            document.getElementById('input_activo_proceso').parentElement.classList.remove("border-dark");
        }
    } else if (getCookie("userRole") == "formulador") {
        fieldsSelect.push("input_modificador_proceso");
        //Si es formulador y ya está activa, no se puede editar la formula
        if (activo == "1") {
            fields.push("input_formula_proceso");
            $("#botoneraBoxEdit").attr("style", "display: none !important");

            //Si hay una versión más reciente se bloquea la nueva version del proceso
            processes.resource.forEach(function (process) {
                if (id == process.id_proceso && version < process.version) {
                    fields.push("input_formula_proceso");
                    $("#btnCreateNewVersion").attr("style", "display: none !important");
                } else {
                    $("#btnCreateNewVersion").attr("style", "display: inline-block !important");
                    document.getElementById('btnCreateNewVersion').onclick = function () {
                        newVersion(id, nombre, descripcion, version, id_categoria);
                    };
                }
            });
        } else {
            $("#btnCreateNewVersion").attr("style", "display: none !important");
        }
    }


    if (getCookie("userRole") == "formulador") {
        //Si el usuario es formulador se bloquea la edición de activo (sólo moderador puyede activar)
        fieldsSelect.push("input_activo_proceso");
    }
    finalFormula = formula;

    editStructure();
    changeForm(
        "editForm",
        "javascript:editEntidad('" + tipoModificacion + "', '" + activo + "');",
        "return checkEditProcess();"
    );
    changeOnBlurFields(
        "return checkName('input_nombre_proceso', 'errorFormatoNombre', 'nameProcessRegister')",
        "return checkDescription('input_descripcion_proceso', 'errorFormatoDescripcion', 'descriptionProcessRegister')",
        "return checkFormula('input_formula_proceso', 'errorFormatoFormula', 'formulaProcessRegister')"
    );
    changeIcon("Resources/edit3.png", "ICONO_EDIT", "iconoEditarRol", "Editar");
    fillForm(
        id,
        version,
        nombre,
        descripcion,
        formula,
        fecha_creacion,
        fecha_modificacion,
        activo,
        id_categoria,
        creador,
        modificador
    );
    setCurrentEditDate();
    disableFields(fields);
    disableFieldsSelect(fieldsSelect);
    $("#formularioAcciones").modal("show");
    setLang(lang);
}

/**Función para dar una estructura a la ventana modal de editar.*/
function editStructure() {
    clearModalErrors();
    activateFieldsBlock();
    hideRequired();
    showLabels();
}

function checkEditProcess() {
    if (checkName('input_nombre_proceso', 'errorFormatoNombre', 'nameProcessRegister') &&
        checkDescription('input_descripcion_proceso', 'errorFormatoDescripcion', 'descriptionProcessRegister') &&
        checkFormula('input_formula_proceso', 'errorFormatoFormula', 'formulaProcessRegister')) {
        return true;
    }
    return false;
}

/* Función para cambiar onBlur de los campos.El objetivo es añadir onBlur en los input.*/
function changeOnBlurFields(
    onBlurNombre,
    onBlurDescripcion,
    onBlurFormula
) {
    if (onBlurNombre != "") {
        $("#input_nombre_proceso").attr("onblur", onBlurNombre);
    }

    if (onBlurDescripcion != "") {
        $("#input_descripcion_proceso").attr("onblur", onBlurDescripcion);
    }

    if (onBlurFormula != "") {
        $("#input_formula_proceso").attr("onblur", onBlurFormula);
    }
}

function setCurrentEditDate() {
    document.getElementById('input_fecha_modificacion_proceso').valueAsDate = new Date();
}

function fillParametersInForm() {
    var select = $("#idParametroE");

    select.empty();

    var option1 = document.createElement("option");
    option1.setAttribute("value", "");
    option1.setAttribute("label", "-----");
    option1.setAttribute("class", "PARAMETRO");
    option1.setAttribute("selected", "true");
    select.append(option1);

    parameters.resource.forEach(function (parameter) {
        option2 = document.createElement("option");
        option2.setAttribute("value", parameter.id_parametro);
        option2.setAttribute("name", parameter.nombre);
        optionTexto = document.createTextNode(parameter.id_parametro + " - " + parameter.nombre);
        option2.appendChild(optionTexto);
        select.append(option2);
    });
}

async function editEntidad(tipoModificacion, activo) {

    document.formularioGenerico.elements["input_formula_proceso"].value = finalFormula;

    if (getCookie("userRole") == "moderador") {
        insertField(
            document.formularioGenerico,
            "dni_usuario_modificacion",
            document.formularioGenerico.elements["input_modificador_proceso"].value
        );
        insertField(
            document.formularioGenerico,
            "id_categoria",
            document.formularioGenerico.elements["input_categoria_proceso"].value
        );
        insertField(
            document.formularioGenerico,
            "activo",
            document.formularioGenerico.elements["input_activo_proceso"].value
        );
    }

    if (getCookie("userRole") == "formulador") {
        insertField(
            document.formularioGenerico,
            "dni_usuario_modificacion",
            document.formularioGenerico.elements["input_modificador_proceso"].value
        );
        insertField(
            document.formularioGenerico,
            "activo",
            document.formularioGenerico.elements["input_activo_proceso"].value
        );
    }

    await ajaxPromise(document.formularioGenerico, "edit", "process", "EDITAR_PROCESO_OK", false)
        .then((res) => {
            $("#formularioAcciones").modal("toggle");

            ajaxResponseOK("EDITAR_PROCESO_OK", res.code);

            if (activo == 0 && document.formularioGenerico["input_activo_proceso"].value == 1 && tipoModificacion == "activate") {
                if (document.formularioGenerico.elements["version"].value == 1) {
                    sendNotification("v1", document.formularioGenerico["nombre"].value, document.formularioGenerico["input_modificador_proceso"].value);

                } else if (document.formularioGenerico.elements["version"].value > 1) {
                    sendNotification("v1+", document.formularioGenerico["nombre"].value, document.formularioGenerico["input_modificador_proceso"].value);
                    loadProcessUserExecutionParameterData(document.formularioGenerico);
                }
            }

            if (tipoModificacion == "reasign") {
                sendNotification("reasign", document.formularioGenerico["nombre"].value, document.formularioGenerico["input_modificador_proceso"].value);
            }

            finalFormula = "";
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        })
        .catch((res) => {
            $("#formularioAcciones").modal("toggle");
            ajaxResponseKO(res.code);
            let idElementoList = [
                "input_id_proceso_visible",
                "input_id_proceso",
                "input_version_proceso",
                "input_nombre_proceso",
                "input_descripcion_proceso",
                "input_formula_proceso",
                "input_fecha_creacion_proceso",
                "input_fecha_modificacion_proceso",
                "input_categoria_proceso",
                "input_creador_proceso_visible",
                "input_creador_proceso",
                "input_modificador_proceso",
                "input_activo_proceso",
                "idParametroE",
                "idValorE",
                "idOperadorE"
            ];

            resetForm("formularioGenerico", idElementoList);
            finalFormula = "";
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

async function loadProcessUserExecutionParameterData(data) {
    var lang = getCookie("lang");

    createHideForm("formProcessUserExecutionParameterManagement");

    insertField(
        document.formProcessUserExecutionParameterManagement,
        "id_proceso",
        data.elements["id_proceso"].value
    );

    await ajaxPromise(document.formProcessUserExecutionParameterManagement, "search", "processUserExecutionParameter", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            receivers = [];
            res.resource.forEach(function (elem) {
                if (!receivers.includes(elem.dni_usuario_ejecucion.dni_usuario_ejecucion)) {
                    receivers.push(elem.dni_usuario_ejecucion.dni_usuario_ejecucion)
                }
            });

            receivers.forEach(function (user) {
                sendNotification("v1+", data["nombre"].value, user);
            });
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
        });
    setLang(lang);
    deleteActionController();
}

async function sendNotification(notificationType, name, dni) {
    if (notificationType == "v1") {
        data = {
            "action": "add",
            "controller": "notification",
            "titulo": translateWord("NOTIFICACION_ANADIR_PROCESO_TITULO"),
            "cuerpo": translateWord("NOTIFICACION_ANADIR_PROCESO_CUERPO") + " " + name,
            "fecha": getCurrentDate(),
            "leida": 0,
            "dni_usuario_remitente": getCookie("userSystem"),
            "dni_usuario_destinatario": dni
        };
    } else if (notificationType == "v1+") {
        data = {
            "action": "add",
            "controller": "notification",
            "titulo": translateWord("NOTIFICACION_NUEVA_VERSION_PROCESO_TITULO"),
            "cuerpo": translateWord("NOTIFICACION_NUEVA_VERSION_PROCESO_CUERPO") + " " + name,
            "fecha": getCurrentDate(),
            "leida": 0,
            "dni_usuario_remitente": getCookie("userSystem"),
            "dni_usuario_destinatario": dni
        };
    } else if (notificationType == "reasign") {
        data = {
            "action": "add",
            "controller": "notification",
            "titulo": translateWord("NOTIFICACION_REASIGNACION_PROCESO_TITULO"),
            "cuerpo": translateWord("NOTIFICACION_REASIGNACION_PROCESO_CUERPO") + " " + name,
            "fecha": getCurrentDate(),
            "leida": 0,
            "dni_usuario_remitente": getCookie("userSystem"),
            "dni_usuario_destinatario": dni
        };
    }

    await ajaxPromiseNoSerialize(data, "ANADIR_NOTIFICACION_OK", false)
        .then((res) => {
            userNotifications();
        })
        .catch((res) => {
        });
}

async function newVersion(id, nombre, descripcion, version, categoria) {
    createHideForm("formularioNuevaVersion");

    insertField(
        document.formularioNuevaVersion,
        "id_proceso",
        id
    );
    insertField(
        document.formularioNuevaVersion,
        "activo",
        0
    );
    insertField(
        document.formularioNuevaVersion,
        "version",
        parseInt(version) + 1
    );
    insertField(
        document.formularioNuevaVersion,
        "dni_usuario_creacion",
        getCookie("userSystem")
    );
    insertField(
        document.formularioNuevaVersion,
        "dni_usuario_modificacion",
        getCookie("userSystem")
    );
    insertField(
        document.formularioNuevaVersion,
        "fecha_creacion",
        getCurrentDate()
    );
    insertField(
        document.formularioNuevaVersion,
        "fecha_modificacion",
        getCurrentDate()
    );
    insertField(
        document.formularioNuevaVersion,
        "formula",
        ""
    );
    insertField(
        document.formularioNuevaVersion,
        "nombre",
        nombre
    );
    insertField(
        document.formularioNuevaVersion,
        "descripcion",
        descripcion
    );
    insertField(
        document.formularioNuevaVersion,
        "id_categoria",
        categoria
    );

    await ajaxPromise(document.formularioNuevaVersion, "add", "process", "ANADIR_PROCESO_OK", false)
        .then((res) => {
            closeEntityModal()

            ajaxResponseOK("ANADIR_PROCESO_OK", res.code);

            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
            let idElementoList = [
                "nombreP",
                "descripcionP",
                "categoriaP"
            ];
            resetForm("formularioNuevaVersion", idElementoList);
        })
        .catch((res) => {
            closeEntityModal()
            ajaxResponseKO(res.code);
            let idElementoList = [
                "nombreP",
                "descripcionP",
                "categoriaP"
            ];
            resetForm("formularioNuevaVersion", idElementoList);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function alertaVersion() {
    document.getElementById("errorFormatoFormula").style.display = "block";
    if (getCookie("userRole") != "formulador") {
        addCodeWarning("errorFormatoFormula", "ALERTA_VERSION_PROCESO_FORMULADOR");
    } else {
        addCodeWarning("errorFormatoFormula", "ALERTA_VERSION_PROCESO_MODIFICACION");
    }
}

function addToFormula(typeForm) {
    if (typeForm == "add") {
        parametro = document.getElementById("idParametro");
        valor = document.getElementById("idValor");
        operador = document.getElementById("idOperador");

        formula = document.getElementById("formulaP");
    } else if (typeForm == "edit") {
        parametro = document.getElementById("idParametroE");
        valor = document.getElementById("idValorE");
        operador = document.getElementById("idOperadorE");

        formula = document.getElementById("input_formula_proceso");
    }

    if (parametro.value != "Parámetro" && parametro.value != "Parameter") {
        parameters.resource.forEach(function (parameter) {
            if (parameter.id_parametro == parametro.value) {
                formula.value += "#_" + parameter.nombre + "_#";
                finalFormula += "#_" + parametro.value + "_#";
            }
        });
        if (getCookie("lang") == "ES") {
            parametro.value = "Parámetro";
        } else if (getCookie("lang") == "EN") {
            parametro.value = "Parameter";
        } else if (getCookie("lang") == "GA") {
            parametro.value = "Parámetro";
        }
    } else if (valor.value != "") {
        formula.value += valor.value;
        finalFormula += valor.value;
        valor.value = "";
    } else if (operador.value != "Operador" && operador.value != "Operator") {
        formula.value += operador.value;
        finalFormula += operador.value;
        if (getCookie("lang") == "ES") {
            operador.value = "Operador";
        } else if (getCookie("lang") == "EN") {
            operador.value = "Operator";
        } else if (getCookie("lang") == "GA") {
            operador.value = "Operador";
        }
    }
    
    checkBotoneraFormula();
}

function updateFinalFormula() {
    finalFormula = document.getElementById("input_formula_proceso").value;
}

function checkBotoneraFormula(typeForm) {
    if (typeForm != "detail") {
        if (typeForm == "add") {
            parametro = document.getElementById("idParametro");
            valor = document.getElementById("idValor");
            operador = document.getElementById("idOperador");

            datosParam = document.getElementById("datosParametro");

            formula = document.getElementById("formulaP");
        } else if (typeForm == "edit") {
            parametro = document.getElementById("idParametroE");
            valor = document.getElementById("idValorE");
            operador = document.getElementById("idOperadorE");

            datosParam = document.getElementById("datosParametroE");

            formula = document.getElementById("input_formula_proceso");
        }

        if ((parametro.value == "Parámetro" || parametro.value == "Parameter") && valor.value == "" && (operador.value == "Operador" || operador.value == "Operator")) {
            $(parametro).attr("disabled", false);
            $(valor).attr("readonly", false);
            $(operador).attr("disabled", false);

            $(datosParam).attr("style", "display: none !important");
        } else if ((parametro.value != "Parámetro" || parametro.value != "Parameter") && valor.value == "" && (operador.value == "Operador" || operador.value == "Operator")) {
            $(valor).attr("readonly", true);
            $(operador).attr("disabled", true);

            $(datosParam).attr("style", "display: block");
        } else if ((parametro.value == "Parámetro" || parametro.value == "Parameter") && valor.value != "" && (operador.value == "Operador" || operador.value == "Operator")) {
            $(parametro).attr("disabled", true);
            $(operador).attr("disabled", true);

            $(datosParam).attr("style", "display: none !important");
        } else if ((parametro.value == "Parámetro" || parametro.value == "Parameter") && valor.value == "" && (operador.value != "Operador" && operador.value != "Operator")) {
            $(parametro).attr("disabled", true);
            $(valor).attr("readonly", true);

            $(datosParam).attr("style", "display: none !important");
        }
    } else {
        parametro = document.getElementById("idParametroE");
        valor = document.getElementById("idValorE");
        operador = document.getElementById("idOperadorE");

        $(parametro).attr("disabled", true);
        $(valor).attr("readonly", true);
        $(operador).attr("disabled", true);
    }
}

function translateFormula(formula) {
    searchRegExp = /#_(\w|á|é|í|ó|ú|ñ|\s)*_#/g;
    result = formula.match(searchRegExp);
    result.forEach(function (id) {
        parameters.resource.forEach(function (parameter) {
            if ("#_" + parameter.id_parametro + "_#" == id) {
                formula = formula.replaceAll(id, "#_" + parameter.nombre + "_#")
            }
        });
    });

    return formula;
}

function showDelete(id_proceso, version) {
    $('#myModalDel').modal('show');

    var el = document.getElementById('btnDelete'),
        elClone = el.cloneNode(true);

    el.parentNode.replaceChild(elClone, el);

    document.getElementById("btnDelete").addEventListener('click', () => {
        deleteProcess(id_proceso, version);
    });
}

async function deleteProcess(id_proceso, version) {
    data = {
        "action": "finalDelete",
        "controller": "process",
        "id_proceso": id_proceso,
        "version": version
    };
    await ajaxPromiseNoSerialize(data, "ELIMINAR_PROCESO_OK", false)
        .then((res) => {
            $('#myModalDel').modal('hide');
            ajaxResponseOK("ELIMINAR_PROCESO_OK", res.code);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        })
        .catch((res) => {
            $('#myModalDel').modal('hide');
            ajaxResponseKO(res.code);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function showFilters() {
    originalProcesses = processes.resource;
    document.getElementById("bversion").style.display = "block";
    document.getElementById("bnombre").style.display = "block";
    document.getElementById("bfechacreacion").style.display = "block";
    document.getElementById("bcategoria").style.display = "block";
    document.getElementById("bmodificador").style.display = "block";
    document.getElementById("bactivo").style.display = "block";

    $('#btnFilterShow').css('display', 'none');
    $('#btnFilterClose').css('display', 'inline-block');
}

function closeFilters() {
    originalProcesses = null;
    document.getElementById("bversion").value = "";
    document.getElementById("bversion").style.display = "none";
    document.getElementById("bnombre").value = "";
    document.getElementById("bnombre").style.display = "none";
    document.getElementById("bfechacreacion").value = "";
    document.getElementById("bfechacreacion").style.display = "none";
    document.getElementById("bcategoria").value = "";
    document.getElementById("bcategoria").style.display = "none";
    document.getElementById("bmodificador").value = "";
    document.getElementById("bmodificador").style.display = "none";
    document.getElementById("bactivo").value = "";
    document.getElementById("bactivo").style.display = "none";

    $('#btnFilterShow').css('display', 'inline-block');
    $('#btnFilterClose').css('display', 'none');

    loadProcessData();
}

function filtrar() {
    processes.resource = originalProcesses;

    version = document.getElementById("bversion").value;
    nombre = document.getElementById("bnombre").value;
    fechacreacion = document.getElementById("bfechacreacion").value;
    categoria = document.getElementById("bcategoria").value;
    modificador = document.getElementById("bmodificador").value;
    activo = document.getElementById("bactivo").value;

    if (version != null && version != "") {
        processes.resource = processes.resource.filter(function (process) {
            return process.version.toString().toLowerCase().includes(version.toLowerCase());
        });
    }

    if (nombre != null && nombre != "") {
        processes.resource = processes.resource.filter(function (process) {
            return process.nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (fechacreacion != null && fechacreacion != "") {
        processes.resource = processes.resource.filter(function (process) {
            return process.fecha_creacion.toString().toLowerCase().includes(fechacreacion.toLowerCase());
        });
    }

    if (categoria != null && categoria != "") {
        processes.resource = processes.resource.filter(function (process) {
            return (process.id_categoria.id_categoria.toString() + " - " + process.id_categoria.nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "")).includes(categoria.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (modificador != null && modificador != "") {
        processes.resource = processes.resource.filter(function (process) {
            return process.dni_usuario_modificacion.dni.toLowerCase().includes(modificador.toLowerCase());
        });
    }

    if (activo != null && activo != "") {
        processes.resource = processes.resource.filter(function (process) {
            aux = "";
            if (process.activo == 1) {
                aux = "Sí";
            } else {
                aux = "No";
            }
            return aux.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(activo.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    processes.total = processes.resource.length;

    setCookie("paintPager", "si");
    adjustPager();
    if (getCookie("paintPager") == "si") {
        setCookie("totalElements", processes.total);
        pager("process");
    }
    setCookie("totalElements", processes.total);
    fileTableMessage();
    searchEntities(getCookie('actualPage'));
}