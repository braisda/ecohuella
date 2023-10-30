var categories;
var moderators;
var originalCategories;

function checkPermissions() {
    if (getCookie("userRole") != "moderador") {
        window.location.href = './menu.html';
    }
}

async function loadCategoryData() {
    var lang = getCookie("lang");

    createHideForm("formCategoryManagement");

    await ajaxPromise(document.formCategoryManagement, "search", "category", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            categories = res;
            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", res.total);
                pager("category");
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
        "2"
    );

    await ajaxPromise(document.formUserManagement, "search", "user", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            moderators = res.resource;
            fillSelectModificator(res.resource);
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

    if (categories.resource.length < finalBucle) {
        finalBucle = categories.resource.length;
    }

    for (var i = start; i < finalBucle; i++) {
        var tr = makeRow(categories.resource[i]);
        $("#datosEntidades").append(tr);
        setLang(getCookie('lang'));
    }
}

function makeRow(row) {
    atributosFunciones = [
        "'" + row.id_categoria + "'",
        "'" + row.nombre + "'",
        "'" + row.descripcion + "'",
        "'" + row.id_categoria_padre.id_categoria + "'",
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
        atributosFunciones[0] +
        ')" alt="Eliminar"/><span class="tooltiptext ICONO_ELIMINAR"></span></div>';
    if ((getCookie('userRole') == 'moderador' && row.id_categoria != "1") && getCookie("userSystem") == row.dni_usuario_modificacion.dni) {
        celdaAcciones = celdaAccionesDetalle + celdaAccionesEditar + celdaAccionesEliminar;
    } else if ((getCookie('userRole') == 'moderador' && row.id_categoria != "1") && getCookie("userSystem") != row.dni_usuario_modificacion.dni) {
        celdaAcciones = celdaAccionesDetalle;
    } else if (getCookie('userRole') == 'moderador' && row.id_categoria == "1") {
        celdaAcciones = celdaAccionesDetalle;
    } else {
        celdaAcciones = '';
    }
    var rowTable =
        '<tr class="impar" id="datoEntidad">' +
        "</td> <td>" +
        row.id_categoria +
        "</td> <td>" +
        row.nombre +
        "</td> <td>" +
        row.descripcion +
        "</td> <td>" +
        row.id_categoria_padre.id_categoria +
        "</td> <td>" +
        row.dni_usuario_creacion.dni +
        "</td> <td class='text-nowrap'>" +
        row.dni_usuario_modificacion.dni +
        "</td> <td class='text-nowrap'>" +
        celdaAcciones
    "</td> </tr>";

    return rowTable;
}

function showDetail(
    id,
    nombre,
    descripcion,
    padre,
    creador,
    modificador
) {
    var idioma = getCookie("lang");
    var fields = [
        "input_id_categoria_visible",
        "input_nombre_categoria",
        "input_descripcion_categoria",
        "input_creador_categoria",
        "input_creador_categoria_visible"
    ];
    var fieldsSelect = [
        "input_padre_categoria",
        "input_modificador_categoria"
    ];
    seeInDetailStructure();
    changeForm("detailForm", "javascript:closeEntityModal();", "");
    changeIcon("Resources/close2.png", "CERRARMODAL", "iconoCerrar", "Ok");
    fillForm(
        id,
        nombre,
        descripcion,
        padre,
        creador,
        modificador
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

    /*$("#passwdUsuario1").attr("style", "display: none");
    $("#passwdUsuario2").attr("style", "display: none");
    $("#label_usuario_borrado_logico").attr("style", "display: none");
    $("#input_usuario_borrado_logico").attr("style", "display: none");
    $("#select_borrado_logico").attr("style", "display: none");
    $("#select_id_rol").attr("style", "display: none");*/
}

function clearModalErrors() {
    let errores = [
        "errorFormatoId",
        "errorFormatoNombre",
        "errorFormatoDescripcion",
        "errorFormatoPadre",
        "errorFormatoCreador",
        "errorFormatoModificador"
    ];
    errores.forEach((element) => {
        deleteFieldId(element);
    });
}

function activateFieldsBlock() {
    $("#input_id_categoria_visible").attr("style", "display: block");
    $("#input_nombre_categoria").attr("style", "display: block");
    $("#input_descripcion_categoria").attr("style", "display: block");
    $("#input_padre_categoria").attr("style", "display: block");
    $("#input_creador_categoria").attr("style", "display: block");
    $("#input_creador_categoria_visible").attr("style", "display: block");
    $("#input_modificador_categoria").attr("style", "display: block");

    enableFields([
        "input_id_categoria",
        "input_id_categoria_visible",
        "input_nombre_categoria",
        "input_descripcion_categoria",
        "input_creador_categoria",
        "input_creador_categoria_visible"
    ]);
    enableFieldsSelect([
        "input_padre_categoria",
        "input_modificador_categoria"
    ]);
}

function hideRequired() {
    $("#obligatorio_categoria_id").attr("style", "display: none");
    $("#obligatorio_categoria_nombre").attr("style", "display: none");
    $("#obligatorio_categoria_descripcion").attr("style", "display: none");
    $("#obligatorio_categoria_padre").attr("style", "display: none");
    $("#obligatorio_categoria_creador").attr("style", "display: none");
    $("#obligatorio_categoria_modificador").attr("style", "display: none");
}

function showLabels() {
    $("#label_categoria_id").attr("style", "display: block");
    $("#label_categoria_nombre").attr("style", "display: block");
    $("#label_categoria_descripcion").attr("style", "display: block");
    $("#label_categoria_padre").attr("style", "display: block");
    $("#label_categoria_creador").attr("style", "display: block");
    $("#label_categoria_modificador").attr("style", "display: block");
}

/**Función que rellenado los datos del formulario para realizar la petición.*/
function fillForm(
    id,
    nombre,
    descripcion,
    padre,
    creador,
    modificador
) {
    $("#input_id_categoria").val(id);
    $("#input_id_categoria_visible").val(id);
    $("#input_nombre_categoria").val(nombre);
    $("#input_descripcion_categoria").val(descripcion);

    var selectFather = $("#input_padre_categoria");

    selectFather.empty();

    categories.resource.forEach(function (category) {
        option = document.createElement("option");
        option.setAttribute("value", category.id_categoria);
        option.setAttribute("name", category.id_categoria);
        optionTexto = document.createTextNode(category.id_categoria + " - " + category.nombre);
        if (padre == category.id_categoria) {
            option.setAttribute("selected", "true");
        }
        option.appendChild(optionTexto);
        selectFather.append(option);
    });

    moderators.forEach(function (user) {
        if (creador == user.dni) {
            $("#input_creador_categoria").val(creador);
            $("#input_creador_categoria_visible").val(creador + " / " + user.nombre + " " + user.apellidos_usuario);
        }
    });

    var selectModificator = $("#input_modificador_categoria");

    selectModificator.empty();

    moderators.forEach(function (user) {
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
    var showBtn = getCookie('userRole') == 'moderador' ? '<button type="button" class="btn btn-dark ANADIR_CATEGORIA my-3" data-toggle="modal" data-target="#registro-modal" class="tooltip"></button>' : '';

    showBtn += getCookie('userRole') == 'moderador' ? ' <button id="btnFilterShow" type="button" class="btn btn-dark FILTRAR my-3" onclick="showFilters()" class="tooltip"></button>' +
        ' <button id="btnFilterClose" type="button" class="btn btn-dark CERRAR_FILTRADO my-3" onclick="closeFilters()" class="tooltip" style="display:none"></button>' : '';

    document.getElementById("btnAdd").innerHTML += showBtn;

}

async function addCategory() {
    await ajaxPromise(document.formularioCategoria, "add", "category", "ANADIR_CATEGORIA_OK", false)
        .then((res) => {
            $("#registro-modal").modal("toggle");

            ajaxResponseOK("ANADIR_CATEGORIA_OK", res.code);
            sendNotification("add", document.formularioCategoria);

            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
            let idElementoList = [
                "nombreC",
                "descripcionC",
                "select_id_padre",
                "creadorC",
                "select_id_modificador"
            ];
            resetForm("formularioCategoria", idElementoList);
        })
        .catch((res) => {
            $("#registro-modal").modal("toggle");
            ajaxResponseKO(res.code);

            let idElementoList = [
                "nombreC",
                "descripcionC",
                "select_id_padre",
                "creadorC",
                "select_id_modificador"
            ];
            resetForm("formularioCategoria", idElementoList);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

async function sendNotification(notificationType, data) {
    if (notificationType == "add") {
        data = {
            "action": "add",
            "controller": "notification",
            "titulo": translateWord("NOTIFICACION_ANADIR_CATEGORIA_TITULO"),
            "cuerpo": translateWord("NOTIFICACION_ANADIR_CATEGORIA_CUERPO") + ": " + data["nombre"].value,
            "fecha": getCurrentDate(),
            "leida": 0,
            "dni_usuario_remitente": getCookie("userSystem"),
            "dni_usuario_destinatario": data["select_id_modificador"].value
        };
    } else if (notificationType == "edit") {
        data = {
            "action": "edit",
            "controller": "notification",
            "titulo": translateWord("NOTIFICACION_MODIFICAR_CATEGORIA_TITULO"),
            "cuerpo": translateWord("NOTIFICACION_MODIFICAR_CATEGORIA_CUERPO") + ": " + data["nombre"].value,
            "fecha": getCurrentDate(),
            "leida": 0,
            "dni_usuario_remitente": getCookie("userSystem"),
            "dni_usuario_destinatario": data["select_id_modificador"].value
        };
    }
    await ajaxPromiseNoSerialize(data, "ANADIR_NOTIFICACION_OK", false)
        .then((res) => {
            userNotifications();
        })
        .catch((res) => {
        });
}

function fillSelectFather() {
    var select = $("#select_id_padre");

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

function fillCreator() {
    document.getElementById('creadorC').value = getCookie("userSystem");
}

function fillSelectModificator(users) {
    var select = $("#select_id_modificador");

    select.empty();

    var option1 = document.createElement("option");
    option1.setAttribute("value", "");
    option1.setAttribute("label", "-----");
    option1.setAttribute("class", "-----");
    option1.setAttribute("selected", "true");
    select.append(option1);

    users.forEach(function (user) {
        option2 = document.createElement("option");
        option2.setAttribute("value", user.dni);
        option2.setAttribute("name", user.dni);
        optionTexto = document.createTextNode(user.dni + " - " + user.nombre + " " + user.apellidos_usuario);
        option2.appendChild(optionTexto);
        select.append(option2);
    });
}

function checkAddCategory() {
    if (checkName('nombreC', 'errorFormatNameCategory', 'nameCategoryRegister') &&
        checkDescription('descripcionC', 'errorFormatDescripcionC', 'descriptionCategoryRegister')) {
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
    padre,
    creador,
    modificador
) {
    var lang = getCookie("lang");
    var fields = [
        "input_id_categoria_visible",
        "input_creador_categoria",
        "input_creador_categoria_visible"
    ];

    editStructure();
    changeForm(
        "editForm",
        "javascript:editEntidad();",
        "return checkEditCategory();"
    );
    changeOnBlurFields(
        "return checkName('input_nombre_categoria', 'errorFormatoNombre', 'nameCategoryRegister')",
        "return checkDescription('input_descripcion_categoria', 'errorFormatoDescripcion', 'descriptionCategoryRegister')"
    );
    changeIcon("Resources/edit3.png", "ICONO_EDIT", "iconoEditarRol", "Editar");
    fillForm(
        id,
        nombre,
        descripcion,
        padre,
        creador,
        modificador
    );
    disableFields(fields);
    $("#formularioAcciones").modal("show");
    setLang(lang);/**/
}

/**Función para dar una estructura a la ventana modal de editar.*/
function editStructure() {
    clearModalErrors();
    activateFieldsBlock();
    hideRequired();
    showLabels();
}

function checkEditCategory() {
    if (checkName('input_nombre_categoria', 'errorFormatoNombre', 'nameCategoryRegister') &&
        checkDescription('input_descripcion_categoria', 'errorFormatoDescripcion', 'descriptionCategoryRegister')) {
        return true;
    }
    return false;
}

/* Función para cambiar onBlur de los campos.El objetivo es añadir onBlur en los input.*/
function changeOnBlurFields(
    onBlurNombre,
    onBlurDescripcion
) {
    if (onBlurNombre != "") {
        $("#input_nombre_categoria").attr("onblur", onBlurNombre);
    }

    if (onBlurDescripcion != "") {
        $("#input_descripcion_categoria").attr("onblur", onBlurDescripcion);
    }
}

async function editEntidad() {
    await ajaxPromise(document.formularioGenerico, "edit", "category", "EDITAR_CATEGORIA_OK", false)
        .then((res) => {
            $("#formularioAcciones").modal("toggle");

            ajaxResponseOK("EDITAR_CATEGORIA_OK", res.code);

            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        })
        .catch((res) => {
            $("#formularioAcciones").modal("toggle");
            ajaxResponseKO(res.code);
            let idElementoList = [
                "input_id_categoria_visible",
                "input_id_categoria",
                "input_nombre_categoria",
                "input_descripcion_categoria",
                "input_padre_categoria",
                "input_creador_categoria_visible",
                "input_creador_categoria",
                "input_modificador_categoria"
            ];

            resetForm("formularioGenerico", idElementoList);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function showDelete(id_categoria) {
    $('#myModalDel').modal('show');

    var el = document.getElementById('btnDelete'),
        elClone = el.cloneNode(true);

    el.parentNode.replaceChild(elClone, el);

    document.getElementById("btnDelete").addEventListener('click', () => {
        deleteCategory(id_categoria);
    });
}

async function deleteCategory(id_categoria) {
    data = {
        "action": "delete",
        "controller": "category",
        "id_categoria": id_categoria,
        "dni_usuario_modificacion": getCookie("userSystem")
    };
    await ajaxPromiseNoSerialize(data, "ELIMINAR_CATEGORIA_OK", false)
        .then((res) => {
            $('#myModalDel').modal('hide');
            ajaxResponseOK("ELIMINAR_CATEGORIA_OK", res.code);
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
    originalCategories = categories.resource;
    document.getElementById("bnombre").style.display = "block";
    document.getElementById("bdescripcion").style.display = "block";
    document.getElementById("bpadre").style.display = "block";
    document.getElementById("bcreador").style.display = "block";
    document.getElementById("bmodificador").style.display = "block";

    $('#btnFilterShow').css('display', 'none');
    $('#btnFilterClose').css('display', 'inline-block');
}

function closeFilters() {
    originalCategories = null;
    document.getElementById("bnombre").value = "";
    document.getElementById("bnombre").style.display = "none";
    document.getElementById("bdescripcion").value = "";
    document.getElementById("bdescripcion").style.display = "none";
    document.getElementById("bpadre").value = "";
    document.getElementById("bpadre").style.display = "none";
    document.getElementById("bcreador").value = "";
    document.getElementById("bcreador").style.display = "none";
    document.getElementById("bmodificador").value = "";
    document.getElementById("bmodificador").style.display = "none";

    $('#btnFilterShow').css('display', 'inline-block');
    $('#btnFilterClose').css('display', 'none');

    loadCategoryData();
}

function filtrar() {
    categories.resource = originalCategories;
    nombre = document.getElementById("bnombre").value;
    descripcion = document.getElementById("bdescripcion").value;
    padre = document.getElementById("bpadre").value;
    creador = document.getElementById("bcreador").value;
    modificador = document.getElementById("bmodificador").value;

    if (nombre != null && nombre != "") {
        categories.resource = categories.resource.filter(function (cateory) {
            return cateory.nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(nombre.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (descripcion != null && descripcion != "") {
        categories.resource = categories.resource.filter(function (cateory) {
            return cateory.descripcion.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(descripcion.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (padre != null && padre != "") {
        categories.resource = categories.resource.filter(function (cateory) {
            return cateory.id_categoria_padre.id_categoria.toString().includes(padre.toString());
        });
    }

    if (creador != null && creador != "") {
        categories.resource = categories.resource.filter(function (cateory) {
            return cateory.dni_usuario_creacion.dni.toLowerCase().includes(creador.toLowerCase());
        });
    }

    if (modificador != null && modificador != "") {
        categories.resource = categories.resource.filter(function (cateory) {
            return cateory.dni_usuario_modificacion.dni.toLowerCase().includes(modificador.toLowerCase());
        });
    }

    categories.total = categories.resource.length;

    setCookie("paintPager", "si");
    adjustPager();
    if (getCookie("paintPager") == "si") {
        setCookie("totalElements", categories.total);
        pager("category");
    }
    setCookie("totalElements", categories.total);
    fileTableMessage();
    searchEntities(getCookie('actualPage'));
}