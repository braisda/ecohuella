var notifications;
var originalNotifications;

function checkPermissions() {
    if (getCookie("userRole") != "basico" && getCookie("userRole") != "formulador" && getCookie("userRole") != "moderador" && getCookie("userRole") != "administrador") {
        window.location.href = './menu.html';
    }
}

function addButton() {
    showBtn = '<button id="btnFilterShow" type="button" class="btn btn-dark FILTRAR my-3" onclick="showFilters()" class="tooltip"></button>' +
        ' <button id="btnFilterClose" type="button" class="btn btn-dark CERRAR_FILTRADO my-3" onclick="closeFilters()" class="tooltip" style="display:none"></button>';

    document.getElementById("btnAdd").innerHTML += showBtn;

}

async function loadNotificationData() {
    var lang = getCookie("lang");
    createHideForm("formNotificationManagement");
    if (getCookie("userRole") != "administrador") {
        insertField(
            document.formNotificationManagement,
            "dni_usuario_destinatario",
            getCookie("userSystem")
        );
    }
    await ajaxPromise(document.formNotificationManagement, "search", "notification", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
        .then((res) => {
            notifications = res;
            setCookie("paintPager", "si");
            adjustPager();
            if (getCookie("paintPager") == "si") {
                setCookie("totalElements", res.total);
                pager("Notification");
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

function getList(start, end) {
    $("#datosEntidades").html("");

    finalBucle = parseInt(start) + parseInt(end);

    if (notifications.resource.length < finalBucle) {
        finalBucle = notifications.resource.length;
    }

    for (var i = start; i < finalBucle; i++) {
        var tr = makeRow(notifications.resource[i]);
        $("#datosEntidades").append(tr);
        setLang(getCookie('lang'));
    }
}

function makeRow(row) {
    atributosFunciones = [
        "'" + row.id_notificacion + "'",
        "'" + row.titulo + "'",
        "'" + row.cuerpo + "'",
        "'" + row.fecha + "'",
        "'" + row.leida + "'",
        "'" + row.dni_usuario_remitente.dni + " / " + row.dni_usuario_remitente.nombre + " " + row.dni_usuario_remitente.apellidos_usuario + "'",
        "'" + row.dni_usuario_destinatario.dni + "'"
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

    celdaAcciones = celdaAccionesDetalle + celdaAccionesEliminar;

    var rowTable =
        '<tr class="impar" id="datoEntidad">' +
        "</td>" +
        "<td " +
        (row.leida == "0" ?
            "class='NO'> </td>"
            : "class='SI'> </td>") +
        "<td>" +
        row.titulo +
        "</td> <td>" +
        row.fecha +
        "</td> <td>" +
        row.dni_usuario_remitente.dni +
        "</td> <td class='text-nowrap'>" +
        celdaAcciones
    "</td> </tr> ";

    return rowTable;
}

function showDetail(
    id,
    titulo,
    cuerpo,
    fecha,
    leida,
    remitente,
    destinatario
) {
    var idioma = getCookie("lang");
    var fields = [
        "input_titulo_notificacion",
        "input_cuerpo_notificacion",
        "input_fecha_notificacion",
        "input_remitente_notificacion"
    ];
    seeInDetailStructure();
    changeForm("detailForm", "javascript:closeEntityModal();", "");
    changeIcon("Resources/close2.png", "CERRARMODAL", "iconoCerrar", "Ok");
    fillForm(
        id,
        titulo,
        cuerpo,
        fecha,
        leida,
        remitente,
        destinatario
    );
    disableFieldsSelect(fields);
    $("#formularioAcciones").modal("show");
    if (getCookie("userRole") != "administrador") {
        editEntidad();
    }
    setLang(idioma);
}

/**Función para dar una estructura a la ventana modal de ver en detalle.*/
function seeInDetailStructure() {
    activateFieldsBlock();
    showLabels();
}

function activateFieldsBlock() {
    $("#input_id_notificacion").attr("style", "display: block");
    $("#input_titulo_notificacion").attr("style", "display: block");
    $("#input_cuerpo_notificacion").attr("style", "display: block");
    $("#input_fecha_notificacion").attr("style", "display: block");
    $("#input_leida_notificacion").attr("style", "display: block");
    $("#input_remitente_notificacion").attr("style", "display: block");

    enableFields([
        "input_id_notificacion",
        "input_titulo_notificacion",
        "input_cuerpo_notificacion",
        "input_fecha_notificacion",
        "input_leida_notificacion",
    ]);
    enableFieldsSelect([
        "input_remitente_notificacion"
    ]);
}

function showLabels() {
    $("#label_notificacion_titulo").attr("style", "display: block");
    $("#label_notificacion_cuerpo").attr("style", "display: block");
    $("#label_notificacion_fecha").attr("style", "display: block");
    $("#label_notificacion_remitente").attr("style", "display: block");
}

/**Función que rellenado los datos del formulario para realizar la petición.*/
function fillForm(
    id,
    titulo,
    cuerpo,
    fecha,
    leida,
    remitente,
    destinatario
) {
    $("#input_id_notificacion").val(id);
    $("#input_titulo_notificacion").val(titulo);
    $("#input_cuerpo_notificacion").val(cuerpo);
    $("#input_fecha_notificacion").val(fecha);
    $("#input_leida_notificacion").val(leida);
    $("#input_remitente_notificacion").val(remitente);
}

/**Función para cerrar la ventana de detalle de usuario*/
function closeEntityModal() {
    $("#formularioAcciones").modal("hide");
    closeModal("formularioAcciones", "", "");
}

async function editEntidad() {
    document.formularioGenerico.elements["leida"].value = 1
    await ajaxPromise(document.formularioGenerico, "edit", "notification", "EDITAR_NOTIFICACION_OK", false)
        .then((res) => {
            $("#formularioAcciones").modal("toggle");

            ajaxResponseOK("EDITAR_NOTIFICACION_OK", res.code);
            userNotifications();
            loadNotificationData()
            setLang(getCookie("lang"));
        })
        .catch((res) => {
            $("#formularioAcciones").modal("toggle");
            ajaxResponseKO(res.code);
            userNotifications();
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
        });
}

function showDelete(id_notificacion) {
    $('#myModalDel').modal('show');

    var el = document.getElementById('btnDelete'),
        elClone = el.cloneNode(true);

    el.parentNode.replaceChild(elClone, el);

    document.getElementById("btnDelete").addEventListener('click', () => {
        deleteNotification(id_notificacion);
    });
}

async function deleteNotification(id_notificacion) {
    data = {
        "action": "finalDelete",
        "controller": "notification",
        "id_notificacion": id_notificacion
    };
    await ajaxPromiseNoSerialize(data, "ELIMINAR_NOTIFICACION_OK", false)
        .then((res) => {
            $('#myModalDel').modal('hide');
            ajaxResponseOK("ELIMINAR_NOTIFICACION_OK", res.code);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
            userNotifications();
        })
        .catch((res) => {
            $('#myModalDel').modal('hide');
            ajaxResponseKO(res.code);
            setLang(getCookie("lang"));
            document.getElementById("modal").style.display = "block";
            userNotifications();
        });
}

function showFilters() {
    originalNotifications = notifications.resource;
    document.getElementById("bleida").style.display = "block";
    document.getElementById("btitulo").style.display = "block";
    document.getElementById("bfecha").style.display = "block";
    document.getElementById("bremitente").style.display = "block";

    $('#btnFilterShow').css('display', 'none');
    $('#btnFilterClose').css('display', 'inline-block');
}

function closeFilters() {
    originalNotifications = null;
    document.getElementById("bleida").value = "";
    document.getElementById("bleida").style.display = "none";
    document.getElementById("btitulo").value = "";
    document.getElementById("btitulo").style.display = "none";
    document.getElementById("bfecha").value = "";
    document.getElementById("bfecha").style.display = "none";
    document.getElementById("bremitente").value = "";
    document.getElementById("bremitente").style.display = "none";

    $('#btnFilterShow').css('display', 'inline-block');
    $('#btnFilterClose').css('display', 'none');

    loadNotificationData();
}

function filtrar() {
    notifications.resource = originalNotifications;
    leida = document.getElementById("bleida").value;
    titulo = document.getElementById("btitulo").value;
    fecha = document.getElementById("bfecha").value;
    remitente = document.getElementById("bremitente").value;

    if (leida != null && leida != "") {
        notifications.resource = notifications.resource.filter(function (notification) {
            leida2 = notification.leida;
            lang = getCookie("lang");
            if (lang == "ES") {
                if(leida2 == 1){
                    leida2 = "Sí"
                } else {
                    leida2 = "No"
                }
            } else if (lang == "EN") {
                if(leida2 == 1){
                    leida2 = "Yes"
                } else {
                    leida2 = "No"
                }
            } else if (lang == "GA") {
                if(leida2 == 1){
                    leida2 = "Si"
                } else {
                    leida2 = "No"
                }
            }
            
            return leida2.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(leida.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (titulo != null && titulo != "") {
        notifications.resource = notifications.resource.filter(function (notification) {
            return notification.titulo.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(titulo.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, ""));
        });
    }

    if (fecha != null && fecha != "") {
        notifications.resource = notifications.resource.filter(function (notification) {
            return notification.fecha.toString().includes(fecha.toString());
        });
    }

    if (remitente != null && remitente != "") {
        notifications.resource = notifications.resource.filter(function (notification) {
            return notification.dni_usuario_remitente.dni.toLowerCase().includes(remitente.toLowerCase());
        });
    }

    notifications.total = notifications.resource.length;

    setCookie("paintPager", "si");
    adjustPager();
    if (getCookie("paintPager") == "si") {
        setCookie("totalElements", notifications.total);
        pager("notification");
    }
    setCookie("totalElements", notifications.total);
    fileTableMessage();
    searchEntities(getCookie('actualPage'));
}