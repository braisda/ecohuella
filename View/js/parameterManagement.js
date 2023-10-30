var parameters;
var formulators;
var processes;
var originalParameters;

function checkPermissions() {
    if (getCookie("userRole") != "formulador") {
        window.location.href = './menu.html';
    }
}

async function loadParameterData() {
    var lang = getCookie("lang");

    createHideForm("formParameterManagement");

    await ajaxPromise(document.formParameterManagement, "search", "parameter", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            parameters = res;
            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", res.total);
                pager("parameter");
            }
            setCookie("totalElements", res.total);
            fileTableMessage();
            searchEntities(getCookie('actualPage'));
            fillSelectFather();
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
        "3"
    );

    await ajaxPromise(document.formUserManagement, "search", "user", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            formulators = res.resource;
            fillSelectModificator(res.resource);
        })
        .catch((res) => {
            ajaxResponseKO(res.code);
        });
    setLang(lang);
    deleteActionController();
}

async function loadProcessData() {
    var lang = getCookie("lang");

    createHideForm("formProcessManagement");

    insertField(
        document.formProcessManagement,
        "dni_usuario_modificacion",
        getCookie("userSystem")
    );

    await ajaxPromise(document.formProcessManagement, "search", "process", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            processes = res.resource;
            fillSelectProcessesAndVersion(res.resource);
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

    if (parameters.resource.length < finalBucle) {
        finalBucle = parameters.resource.length;
    }

    for (var i = start; i < finalBucle; i++) {
        var tr = makeRow(parameters.resource[i]);
        $("#datosEntidades").append(tr);
        setLang(getCookie('lang'));
    }
}

function makeRow(row) {
    atributosFunciones = [
        "'" + row.id_parametro + "'",
        "'" + row.nombre + "'",
        "'" + row.descripcion + "'",
        "'" + row.unidad + "'",
        "'" + row.dni_usuario_creacion.dni + "'",
        "'" + row.dni_usuario_modificacion.dni + "'",
        "'" + row.id_proceso.id_proceso + "'",
        "'" + row.version.version + "'",
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
    } else if (getCookie('userRole') == 'formulador' && getCookie("userSystem") != row.dni_usuario_modificacion.dni) {
        celdaAcciones = celdaAccionesDetalle;
    } else if (getCookie('userRole') == 'moderador') {
        celdaAcciones = celdaAccionesDetalle + celdaAccionesEditar;
    } else {
        celdaAcciones = '';
    }
    var rowTable =
        '<tr class="impar" id="datoEntidad">' +
        "</td> <td>" +
        row.id_parametro +
        "</td> <td>" +
        row.nombre +
        "</td> <td>" +
        row.dni_usuario_creacion.dni +
        "</td> <td class='text-nowrap'>" +
        row.dni_usuario_modificacion.dni +
        "</td> <td class='text-nowrap'>" +
        row.id_proceso.id_proceso +
        "</td> <td>" +
        row.version.version +
        "</td> <td>" +
        celdaAcciones
    "</td> </tr>";

    return rowTable;
}

function showDetail(
    id,
    nombre,
    descripcion,
    unidad,
    creador,
    modificador,
    proceso,
    version
) {
    var idioma = getCookie("lang");
    var fields = [
        "input_id_parametro_visible",
        "input_nombre_parametro",
        "input_descripcion_parametro",
        "input_unidad_parametro",
        "input_creador_parametro",
        "input_creador_parametro_visible",
        "input_proceso_parametro",
        "input_proceso_parametro_visible",
        "input_version_parametro",
        "input_version_parametro_visible"
    ];
    var fieldsSelect = [
        "input_modificador_parametro"
    ];
    seeInDetailStructure();
    changeForm("detailForm", "javascript:closeEntityModal();", "");
    changeIcon("Resources/close2.png", "CERRARMODAL", "iconoCerrar", "Ok");
    fillForm(
        id,
        nombre,
        descripcion,
        unidad,
        creador,
        modificador,
        proceso,
        version
    );
    disableFields(fields);
    disableFieldsSelect(fieldsSelect);
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
        "errorFormatoNombre",
        "errorFormatoDescripcion",
        "errorFormatoUnidad",
        "errorFormatoCreador",
        "errorFormatoModificador",
        "errorFormatoProceso",
        "errorFormatoVersion"
    ];
    errores.forEach((element) => {
        deleteFieldId(element);
    });
}

function activateFieldsBlock() {
    $("#input_id_parametro_visible").attr("style", "display: block");
    $("#input_nombre_parametro").attr("style", "display: block");
    $("#input_descripcion_parametro").attr("style", "display: block");
    $("#input_unidad_parametro").attr("style", "display: block");
    $("#input_creador_parametro").attr("style", "display: block");
    $("#input_creador_parametro_visible").attr("style", "display: block");
    $("#input_modificador_parametro").attr("style", "display: block");
    $("#input_proceso_parametro").attr("style", "display: block");
    $("#input_proceso_parametro_visible").attr("style", "display: block");
    $("#input_version_parametro").attr("style", "display: block");
    $("#input_version_parametro_visible").attr("style", "display: block");

    enableFields([
        "input_id_parametro",
        "input_id_parametro_visible",
        "input_nombre_parametro",
        "input_descripcion_parametro",
        "input_unidad_parametro",
        "input_creador_parametro",
        "input_creador_parametro_visible",
        "input_proceso_parametro",
        "input_proceso_parametro_visible",
        "input_version_parametro",
        "input_version_parametro_visible"
    ]);
    enableFieldsSelect([
        "input_modificador_parametro"
    ]);
}

function hideRequired() {
    $("#obligatorio_parametro_id").attr("style", "display: none");
    $("#obligatorio_parametro_nombre").attr("style", "display: none");
    $("#obligatorio_parametro_descripcion").attr("style", "display: none");
    $("#obligatorio_parametro_unidad").attr("style", "display: none");
    $("#obligatorio_parametro_creador").attr("style", "display: none");
    $("#obligatorio_parametro_modificador").attr("style", "display: none");
    $("#obligatorio_parametro_proceso").attr("style", "display: none");
    $("#obligatorio_parametro_version").attr("style", "display: none");
}

function showLabels() {
    $("#label_parametro_id").attr("style", "display: block");
    $("#label_parametro_nombre").attr("style", "display: block");
    $("#label_parametro_descripcion").attr("style", "display: block");
    $("#label_parametro_unidad").attr("style", "display: block");
    $("#label_parametro_creador").attr("style", "display: block");
    $("#label_parametro_modificador").attr("style", "display: block");
    $("#label_parametro_proceso").attr("style", "display: block");
    $("#label_parametro_version").attr("style", "display: block");
}

/**Función que rellenado los datos del formulario para realizar la petición.*/
function fillForm(
    id,
    nombre,
    descripcion,
    unidad,
    creador,
    modificador,
    proceso,
    version
) {
    $("#input_id_parametro").val(id);
    $("#input_id_parametro_visible").val(id);
    $("#input_nombre_parametro").val(nombre);
    if (descripcion == null || descripcion == "") {
        $("#input_descripcion_parametro").val("-");
    } else {
        $("#input_descripcion_parametro").val(descripcion);
    }
    $("#input_unidad_parametro").val(unidad);

    formulators.forEach(function (user) {
        if (creador == user.dni) {
            $("#input_creador_parametro").val(creador);
            $("#input_creador_parametro_visible").val(creador + " / " + user.nombre + " " + user.apellidos_usuario);
        }
    });

    var selectModificator = $("#input_modificador_parametro");

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

    $("#input_proceso_parametro").val(proceso);
    $("#input_proceso_parametro_visible").val(proceso);
    $("#input_version_parametro").val(version);
    $("#input_version_parametro_visible").val(version);
}

/**Función para cerrar la ventana de detalle de usuario*/
function closeEntityModal() {
    $("#formularioAcciones").modal("hide");
    closeModal("formularioAcciones", "", "");
}

function addButton() {
    var showBtn = getCookie('userRole') == 'formulador' ? '<button type="button" class="btn btn-dark ANADIR_PARAMETRO my-3" data-toggle="modal" data-target="#registro-modal" class="tooltip"></button>' : '';

    showBtn += getCookie('userRole') == 'formulador' ? ' <button id="btnFilterShow" type="button" class="btn btn-dark FILTRAR my-3" onclick="showFilters()" class="tooltip"></button>' +
        ' <button id="btnFilterClose" type="button" class="btn btn-dark CERRAR_FILTRADO my-3" onclick="closeFilters()" class="tooltip" style="display:none"></button>' : '';

    document.getElementById("btnAdd").innerHTML += showBtn;
}

async function addParameter() {
    insertField(
        document.formularioParametro,
        "dni_usuario_creacion",
        getCookie("userSystem")
    );
    insertField(
        document.formularioParametro,
        "dni_usuario_modificacion",
        getCookie("userSystem")
    );
    await ajaxPromise(document.formularioParametro, "add", "parameter", "ANADIR_PARAMETRO_OK", false)
        .then((res) => {
            $("#registro-modal").modal("toggle");

            ajaxResponseOK("ANADIR_PARAMETRO_OK", res.code);

            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
            let idElementoList = [
                "nombreP",
                "descripcionP",
                "unidadP",
                "select_id_proceso",
                "select_version"
            ];
            resetForm("formularioParametro", idElementoList);
        })
        .catch((res) => {
            $("#registro-modal").modal("toggle");
            ajaxResponseKO(res.code);

            let idElementoList = [
                "nombreP",
                "descripcionP",
                "unidadP",
                "select_id_proceso",
                "select_version"
            ];
            resetForm("formularioParametro", idElementoList);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function fillSelectProcessesAndVersion(processes) {
    var select = $("#select_id_proceso");

    select.empty();

    var option1 = document.createElement("option");
    option1.setAttribute("value", "");
    option1.setAttribute("label", "-----");
    option1.setAttribute("class", "-----");
    option1.setAttribute("selected", "true");
    select.append(option1);

    processes.forEach(function (process) {
        if (process.activo == 0) {
            option2 = document.createElement("option");
            option2.setAttribute("value", process.id_proceso);
            option2.setAttribute("name", process.id_proceso);
            optionTexto = document.createTextNode(process.id_proceso + " - " + process.nombre);
            option2.appendChild(optionTexto);
            select.append(option2);
        }
    });
}

function updateVersionSelect(selectedProcess) {
    var select = $("#select_version");

    select.empty();

    var option1 = document.createElement("option");
    option1.setAttribute("value", "");
    option1.setAttribute("label", "-----");
    option1.setAttribute("class", "-----");
    select.append(option1);

    processes.forEach(function (process) {
        if (process.id_proceso == selectedProcess.value && process.activo == 0) {
            option2 = document.createElement("option");
            option2.setAttribute("value", process.version);
            option2.setAttribute("name", process.version);
            option2.setAttribute("selected", "true");
            optionTexto = document.createTextNode(process.version);
            option2.appendChild(optionTexto);
            select.append(option2);
        }
    });

}

function checkAddParameter() {
    if (checkName('nombreP', 'errorFormatNameParameter', 'nameParameterRegister') &&
        checkDescriptionParameter('descripcionP', 'errorFormatDescripcionP', 'descriptionParameterRegister') &&
        checkUnit('unidadP', 'errorFormatUnitParameter', 'unitParameterRegister') &&
        checkId('select_id_proceso', 'errorFormatoProcessParameter', 'procesoParameterRegister') &&
        checkId('select_version', 'errorFormatoVersionParameter', 'versionParameterRegister')) {
        return true;
    }
    return false;
}

/*Función para mostrar modal para editar e invoca a la función que
 * carga como corresponda los label, input y campo obligatorio.*/
function showEdit(
    id,
    nombre,
    descripcion,
    unidad,
    creador,
    modificador,
    proceso,
    version
) {
    var lang = getCookie("lang");
    var fields = [
        "input_id_parametro_visible",
        "input_creador_parametro",
        "input_creador_parametro_visible",
        "input_proceso_parametro",
        "input_proceso_parametro_visible",
        "input_version_parametro",
        "input_version_parametro_visible"
    ];
    if (getCookie("userRole") != "formulador") {
        //Si el usuario no es formulador se bloquea la edición del nombre
        fields.push("input_nombre_parametro");
    }

    editStructure();
    changeForm(
        "editForm",
        "javascript:editEntidad();",
        "return checkEditParameter();"
    );
    changeOnBlurFields(
        "return checkName('input_nombre_parametro', 'errorFormatoNombre', 'nameParameterRegister')",
        "return checkDescriptionParameter('input_descripcion_parametro', 'errorFormatoDescripcion', 'descriptionParameterRegister')",
        "return checkUnit('input_unidad_parametro', 'errorFormatoUnidad', 'unitParameterRegister')"
    );
    changeIcon("Resources/edit3.png", "ICONO_EDIT", "iconoEditarRol", "Editar");
    fillForm(
        id,
        nombre,
        descripcion,
        unidad,
        creador,
        modificador,
        proceso,
        version
    );
    disableFields(fields);
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

function checkEditParameter() {
    if (checkName('input_nombre_parametro', 'errorFormatoNombre', 'nameParameterRegister') &&
        checkDescriptionParameter('input_descripcion_parametro', 'errorFormatoDescripcion', 'descriptionParameterRegister') &&
        checkUnit('input_unidad_parametro', 'errorFormatoUnidad', 'unitParameterRegister')) {
        return true;
    }
    return false;
}

/* Función para cambiar onBlur de los campos.El objetivo es añadir onBlur en los input.*/
function changeOnBlurFields(
    onBlurNombre,
    onBlurDescripcion,
    onBlurUnidad
) {
    if (onBlurNombre != "") {
        $("#input_nombre_parametro").attr("onblur", onBlurNombre);
    }

    if (onBlurDescripcion != "") {
        $("#input_descripcion_parametro").attr("onblur", onBlurDescripcion);
    }

    if (onBlurUnidad != "") {
        $("#input_unidad_parametro").attr("onblur", onBlurUnidad);
    }
}

async function editEntidad() {
    await ajaxPromise(document.formularioGenerico, "edit", "parameter", "EDITAR_PARAMETRO_OK", false)
        .then((res) => {
            $("#formularioAcciones").modal("toggle");
            ajaxResponseOK("EDITAR_PARAMETRO_OK", res.code);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        })
        .catch((res) => {
            $("#formularioAcciones").modal("toggle");
            ajaxResponseKO(res.code);
            let idElementoList = [
                "input_id_parametro_visible",
                "input_id_parametro",
                "input_nombre_parametro",
                "input_descripcion_parametro",
                "input_unidad_parametro",
                "input_creador_parametro_visible",
                "input_creador_parametro",
                "input_modificador_parametro",
                "input_proceso_parametro",
                "input_proceso_parametro_visible",
                "input_version_parametro",
                "input_version_parametro_visible"
            ];

            resetForm("formularioGenerico", idElementoList);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function alertaName() {
    document.getElementById("errorFormatoNombre").style.display = "block";
    if (getCookie("userRole") != "formulador") {
        addCodeWarning("errorFormatoNombre", "ALERTA_NOMBRE_PARAMETRO_FORMULADOR");
    }
}

function showDelete(id_parametro) {
    $('#myModalDel').modal('show');

    var el = document.getElementById('btnDelete'),
        elClone = el.cloneNode(true);

    el.parentNode.replaceChild(elClone, el);

    document.getElementById("btnDelete").addEventListener('click', () => {
        deleteParameter(id_parametro);
    });
}

async function deleteParameter(id_parametro) {
    data = {
        "action": "finalDelete",
        "controller": "parameter",
        "id_parametro": id_parametro
    };
    await ajaxPromiseNoSerialize(data, "ELIMINAR_PARAMETRO_OK", false)
        .then((res) => {
            $('#myModalDel').modal('hide');
            ajaxResponseOK("ELIMINAR_PARAMETRO_OK", res.code);
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
    originalParameters = parameters.resource;
    document.getElementById("bnombre").style.display = "block";
    document.getElementById("bcreador").style.display = "block";
    document.getElementById("bmodificador").style.display = "block";
    document.getElementById("bproceso").style.display = "block";
    document.getElementById("bversion").style.display = "block";

    $('#btnFilterShow').css('display', 'none');
    $('#btnFilterClose').css('display', 'inline-block');
}

function closeFilters() {
    originalParameters = null;
    document.getElementById("bnombre").value = "";
    document.getElementById("bnombre").style.display = "none";
    document.getElementById("bcreador").value = "";
    document.getElementById("bcreador").style.display = "none";
    document.getElementById("bmodificador").value = "";
    document.getElementById("bmodificador").style.display = "none";
    document.getElementById("bproceso").value = "";
    document.getElementById("bproceso").style.display = "none";
    document.getElementById("bversion").value = "";
    document.getElementById("bversion").style.display = "none";

    $('#btnFilterShow').css('display', 'inline-block');
    $('#btnFilterClose').css('display', 'none');

    loadParameterData();
}

function filtrar() {
    parameters.resource = originalParameters;

    nombre = document.getElementById("bnombre").value;
    creador = document.getElementById("bcreador").value;
    modificador = document.getElementById("bmodificador").value;
    proceso = document.getElementById("bproceso").value;
    version = document.getElementById("bversion").value;

    if (nombre != null && nombre != "") {
        parameters.resource = parameters.resource.filter(function (parameter) {
            return parameter.nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (creador != null && creador != "") {
        parameters.resource = parameters.resource.filter(function (parameter) {
            return parameter.dni_usuario_creacion.dni.toLowerCase().includes(creador.toLowerCase());
        });
    }

    if (modificador != null && modificador != "") {
        parameters.resource = parameters.resource.filter(function (parameter) {
            return parameter.dni_usuario_modificacion.dni.toLowerCase().includes(modificador.toLowerCase());
        });
    }

    if (proceso != null && proceso != "") {
        parameters.resource = parameters.resource.filter(function (parameter) {
            return parameter.id_proceso.id_proceso.toString().toLowerCase().includes(proceso.toString().toLowerCase());
        });
    }

    if (version != null && version != "") {
        parameters.resource = parameters.resource.filter(function (parameter) {
            return parameter.version.version.toString().toLowerCase().includes(version.toString().toLowerCase());
        });
    }

    parameters.total = parameters.resource.length;

    setCookie("paintPager", "si");
    adjustPager();
    if (getCookie("paintPager") == "si") {
        setCookie("totalElements", parameters.total);
        pager("parameter");
    }
    setCookie("totalElements", parameters.total);
    fileTableMessage();
    searchEntities(getCookie('actualPage'));
}