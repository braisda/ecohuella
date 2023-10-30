/**Function to change the flag languages.*/
function loadLang(lang) {
  if (lang == "spanish") {
    //document.getElementById("langImage").src = "View/Resources/Spain.png";
    setCookie("lang", "ES");
    setLang("ES");
  } else if (lang == "english") {
    //document.getElementById("langImage").src = "View/Resources/United-Kingdom.png";
    setCookie("lang", "EN");
    setLang("EN");
  } else if (lang == "galego") {
    //document.getElementById("langImage").src = "View/Resources/Galicia.png";
    setCookie("lang", "GA");
    setLang("GA");
  }
}

/**Function to include the footer.*/
function includeFooter() {
  $("#footer").html("");

  // TODO cambiar nombre de la APP
  var footer =
    '<footer class="fixed-bottom page-footer font-small footer">' +
    '<div class="footer-copyright text-center py-3">© 2023 Copyright:' +
    '<a href="#"> EcoHuella</a>' +
    "</div>" +
    "</footer>";

  $("#footer").append(footer);
}

/**Function to include the breadcrumb.*/
function includeBreadCrumb(page) {
  $("#breadcrumb").html("");

  text = "";
  switch (page) {

    case "userManagement":
      text = "GESTION_USUARIO";
      break;
    case "roleActionFunctionalityManagement":
      text = "GESTION_ROL_ACCION_FUNCIONALIDAD";
      break;
    case "actionFunctionalityManagement":
      text = "GESTION_ACCION_FUNCIONALIDAD";
      break;
    case "categoryManagement":
      text = "GESTION_CATEGORIAS";
      break;
    case "processManagement":
      text = "GESTION_PROCESO";
      break;
    case "parameterManagement":
      text = "GESTION_PARAMETRO";
      break;
    case "notificationManagement":
      text = "GESTION_NOTIFICACIONES";
      break;
    case "exploreManagement":
      text = "EXPLORAR_CATEGORIAS";
      break;
    case "historyManagement":
      text = "HISTORIAL_PROCESOS";
      break;
    default:
      text = "INICIO";
      break
  }

  var breadcrumb =
    '<ol id="listaBreadcrumb" class="breadcrumb">' +
    '<li class="breadcrumb-item"><a class="INICIO" href="menu.html"></a></li>' +
    '<li class="breadcrumb-item active disable-links"><a class="' + text + '" href="' + page + '.html"></a></li>' +
    '</ol>'

  $("#breadcrumb").append(breadcrumb);
}

function updateBreadcrumbCategory(elementId, elementName) {
  anterior = collection = document.getElementsByClassName("breadcrumb-item active disable-links")[0];
  anterior.classList.remove("disable-links");
  var newItem = '<li ' + 'id=bcCat_' + elementId + ' class="breadcrumb-item active disable-links"' + 'onclick="retrieveChildren(' + elementId + ', \'' + elementName + '\');"' + '><span>' + elementName + '</span></li>';

  // En caso de que el elemento seleccionado sea anterior (queremos retroceder),
  //borramos los elementos siguientes y lo añadimos de nuevo
  elem = document.getElementById('bcCat_' + elementId);
  if (elem != null) {
    next = elem.nextSibling;
    while (next != null) {
      aux = next.nextSibling;
      next.remove();
      next = aux;
    }
    elem.remove();
  }

  $("#listaBreadcrumb").append(newItem)
}

/*Function to obtains the cookie's value.*/
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");

  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }

  return null;
}

/*Function to stablish the cookie's value.*/
function setCookie(name, value, days) {
  var expires = "";

  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }

  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

/** Function to show error modals.**/
function errorFailAjax(status) {
  if (status === 500) {
    errorInternal("MENSAJE_ERROR_INTERNO");
  } else if (status === 403 || status === 412) {
    authenticationError("ERROR_AUTENTICACION");
  } else if (status === 0 || status === 404) {
    errorInternal("ERR_CONNECTION_REFUSED");
  }
}

function errorInternal(code) {
  var lang = getCookie("lang");
  $("#modal-title").removeClass();
  $("#modal-title").addClass("ERROR_INTERNO");
  document.getElementById("modal-title").style.color = "#a50707";
  document.getElementById("modal-title").style.top = "10%";
  $("#modal-mensaje").removeClass();
  $("#modal-mensaje").addClass(code);
  $(".imagenAviso").attr("src", "./Resources/failed.png");
  document.getElementById("modal").style.display = "block";
  setLang(lang);
}

/** Function to check that user doesn't has the cap lock activated.*/
function capLock(e, elementId) {
  kc = e.keyCode ? e.keyCode : e.which;
  sk = e.shiftKey ? e.shiftKey : kc == 16 ? true : false;

  if ((kc >= 65 && kc <= 90 && !sk) || (kc >= 97 && kc <= 122 && sk)) {
    document.getElementById(elementId).style.display = "block";
  } else {
    document.getElementById(elementId).style.display = "none";
  }
}

function encrypt(elementId) {
  document.getElementById(elementId).value = hex_md5(
    document.getElementById(elementId).value
  );

  return true;
}

function closeModal(idElement) {
  document.getElementById(idElement).style.display = "none";

  modalType = document.getElementById("modal-mensaje").textContent;
  if (modalType == "Contraseña cambiada correctamente" || modalType == "Password changed successfully" || modalType == "Contrasinal cambiada correctamente" || modalType == "Sesión caducada") {
    logout();
    window.location.href = './index.html';
  }

}

/**Función que cierra la ventana modal*/
function closeModal(idElemento, accion, operacion) {
  var metodoEjecutar = operacion;

  document.getElementById(idElemento).style.display = "none";

  if (accion != "" && accion != undefined) {
    window.location.href = accion;
  }

  if (operacion != "" && operacion != undefined) {
    metodoEjecutar();
  }
}

function ajaxResponseKO(code) {
  $("#modal-title").removeClass();
  $("#modal-title").addClass("ERROR");
  document.getElementById("modal-title").style.color = "#a50707";
  document.getElementById("modal-title").style.top = "13%";
  $(".imagenAviso").attr("src", "./Resources/failed.png");
  $("#modal-mensaje").removeClass();
  $("#modal-mensaje").addClass(code);
  if (code == "PERMISOS_KO") {
    document.getElementById(("close")).onclick = function () { closeModal('modal'); };
    document.getElementById(("close")).onclick = function () { redirectHome(); };
  }
  setLang(getCookie("lang"));
}

function ajaxResponseOK(clase, codigo) {
  $(".imagenAviso").attr("src", "./Resources/ok.png");
  document.getElementById("modal-title").style.color = "#238f2a";
  document.getElementById("modal-title").style.top = "13%";
  $("#modal-title").removeClass();
  $("#modal-title").addClass(clase);
  $("#modal-mensaje").removeClass();
  $("#modal-mensaje").addClass(codigo);
  setLang(getCookie("lang"));
}

function redirectHome() {
  window.location.href = './menu.html';
}

function includeTopMenu() {
  $("#topMenu").html("");

  var topMenu =
    '<nav class="navbar navbar-expand-md navbar-dark menuIdioma">' +
    /*INICIO*/
    '<a class="navbar-brand" href="menu.html"><img src="Resources/indexIcon2.png" alt="Logo" class="imagenLogo"></a>' +
    /*BOTON PANTALLA REDUCIDA*/
    '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">' +
    '<span class="navbar-toggler-icon"></span>' +
    '</button>' +
    '<div class="collapse navbar-collapse" id="navbarSupportedContent">' +
    '<ul class="navbar-nav mr-auto listaNav">' +
    /*MENU*/
    '<li class="nav-item dropdown">' +
    '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
    '<img id="imagenHome" src="Resources/home.png"/>' +
    '<div class="home MENU">Menú</div>' +
    '</a>' +
    '<div class="dropdown-menu" aria-labelledby="navbarDropdown">' +
    '<a class="dropdown-item GESTION_USUARIO" href="userManagement.html">Gestión Usuarios</a>' +
    (getCookie("userRole") == "administrador" ?
      '<a class="dropdown-item GESTION_ACCION_FUNCIONALIDAD" href="actionFunctionalityManagement.html">Gestión Acción-Funcionalidad</a>' +
      '<a class="dropdown-item GESTION_ROL_ACCION_FUNCIONALIDAD" href="roleActionFunctionalityManagement.html">Gestión Rol-Acción-Funcionalidad</a>'
      : "") +
    '<div class="dropdown-divider"></div>' +
    /*IDIOMA*/
    '<a class="dropdown-item" href="#" onclick="loadLang(\'spanish\');">' +
    '<input type="submit" name="btnSpain" id="btnSpain" value="" onclick="loadLang(\'spanish\');" />' +
    "</a>" +
    '<a class="dropdown-item" href="#" onclick="loadLang(\'english\');">' +
    '<input type="submit" name="btnEnglish" id="btnEnglish" value="" onclick="loadLang(\'english\');" />' +
    "</a>" +
    '<a class="dropdown-item" href="#" onclick="loadLang(\'galego\');">' +
    '<input type="submit" name="btnGalician" id="btnGalician" value="" onclick="loadLang(\'galego\');" />' +
    "</a>" +
    /*CATEGORIAS*/
    (getCookie("userRole") == "moderador" ?
      '<li class="nav-item dropdown">' +
      '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
      '<img id="imagenHome" src="Resources/categorias.png"/>' +
      '<div class="home CATEGORIAS">Categorías</div>' +
      '</a>' +
      '<div class="dropdown-menu" aria-labelledby="navbarDropdown2">' +
      '<a class="dropdown-item GESTION_CATEGORIAS" href="categoryManagement.html">Gestión Categorias</a>' +
      '</div>' +
      '</li>'
      : "") +
    /*PROCESOS*/
    ((getCookie("userRole") != "administrador" && getCookie("userRole") != "basico") ?
      '<li class="nav-item dropdown">' +
      '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
      '<img id="imagenHome" src="Resources/procesos.png"/>' +
      '<div class="home PROCESOS">Procesos</div>' +
      '</a>' +
      '<div class="dropdown-menu" aria-labelledby="navbarDropdown3">' +
      '<a class="dropdown-item GESTION_PROCESOS" href="processManagement.html">Gestión Procesos</a>' +
      '</div>' +
      '</li>'
      : "") +
    /*PARAMETROS*/
    (getCookie("userRole") == "formulador" ?
      '<li class="nav-item dropdown">' +
      '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
      '<img id="imagenHome" src="Resources/parameter.png"/>' +
      '<div class="home PARAMETROS">Parámetros</div>' +
      '</a>' +
      '<div class="dropdown-menu" aria-labelledby="navbarDropdown4">' +
      '<a class="dropdown-item GESTION_PARAMETRO" href="parameterManagement.html">Gestión Parámetros</a>' +
      '</div>' +
      '</li>'
      : "") +
    /*EXPLORAR*/
    (getCookie("userRole") == "basico" ?
      '<li class="nav-item dropdown">' +
      '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown5" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
      '<img id="imagenHome" src="Resources/categorias.png"/>' +
      '<div class="home EXPLORAR_CATEGORIAS">Explorar Categorías</div>' +
      '</a>' +
      '<div class="dropdown-menu" aria-labelledby="navbarDropdown5">' +
      '<a class="dropdown-item EXPLORAR_CATEGORIAS" href="exploreManagement.html">Explorar Categorías</a>' +
      '</div>' +
      '</li>'
      : "") +
    /*HISTORICO*/
    (getCookie("userRole") == "basico" ?
      '<li class="nav-item dropdown">' +
      '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown6" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
      '<img id="imagenHome" src="Resources/parameter.png"/>' +
      '<div class="home HISTORIAL_PROCESOS">Historial de procesos</div>' +
      '</a>' +
      '<div class="dropdown-menu" aria-labelledby="navbarDropdown6">' +
      '<a class="dropdown-item HISTORIAL_PROCESOS" href="historyManagement.html">Historial de procesos</a>' +
      '</div>' +
      '</li>'
      : "") +
    /*USUARIO LOGUEADO*/
    '<li class="nav-item dropdown">' +
    '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown7" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
    '<img id="imagenHome" src="Resources/usuario.png"/>' +
    '<div class="usuarioConectado">' +
    getCookie("userSystem") +
    "</div>" +
    '</a>' +
    '<div class="dropdown-menu" aria-labelledby="navbarDropdown7">' +
    '<a class="dropdown-item PERFIL_USUARIO" href="#" data-toggle="modal" data-target="#viewProfile-modal" onclick="javascript:viewProfile()">Ver Perfil</a>' +
    '<a class="dropdown-item CAMBIAR_CONTRASEÑA_MENU" href="#" data-toggle="modal" data-target="#changePass-modal" onclick="javascript:modalChangePass()">Cambiar Contraseña</a>' +
    '<div class="dropdown-divider"></div>' +
    '<a class="dropdown-item DESCONECTAR" href="./index.html" onclick="javascript:logout()">Desconectar</a>' +
    '</div>' +
    '</li>' +
    '</ul>' +
    /*NOTIFICACIONES*/
    "<a href='notificationManagement.html'><button type='button' class='btn btn-warning col-md-12'> <img id='imagenUsuario' src='Resources/email.png' /> <span id='contadorNotificaciones' class='badge badge-light'>0</span></button></a>"
  "</div>" +
    "</nav>";

  $("#topMenu").append(topMenu);

  setLang(getCookie("lang"));
}

async function viewProfile() {
  data = {
    "action": "searchBy",
    "controller": "user",
    "dni": getCookie("userSystem")
  };
  await ajaxPromiseNoSerialize(data, "RECORDSET_DATOS", true)
    .then((res) => {
      $("#viewProfile-modal").html("");

      var resource = res["resource"];
      var modalContent =
        '<div class="modal-dialog">' +
        '<div class="viewProfile-container">' +
        '<h1 class="PERFIL_USUARIO"></h1>' +
        "<div class='col-12'>" +
        '<div class="form-group mx-3">' +
        '<label class="DNI" id="DNI"> </label>' +
        ' <input type="text" name="dni" placeholder="DNI" id="dniP" value="' + resource["dni"] + '" class="dni DNI form-control" maxlength="9" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="NOMBRE_PERSONA" id="NOMBRE_PERSONA"> </label>' +
        ' <input type="text" name="nombre" placeholder="NOMBRE_PERSONA" id="nombreP" value="' + resource["nombre"] + '" class="nombre NOMBRE_PERSONA form-control" maxlength="45" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="APELLIDOS_PERSONA" id="APELLIDOS_PERSONA"> </label>' +
        ' <input type="text" name="apellidos" placeholder="APELLIDOS_PERSONA" id="apellidosP" value="' + resource["apellidos_usuario"] + '" class="apellidos APELLIDOS_PERSONA form-control" maxlength="45" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="FECHA_NAC" id="FECHA_NAC"> </label>' +
        ' <input type="text" name="fecha_nac" placeholder="FECHA_NAC" id="fechaNacP" value="' + resource["fecha_nac"] + '" class="fecha_nac FECHA_NAC form-control" maxlength="10" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="DIRECCION_PERSONA" id="DIRECCION_PERSONA"> </label>' +
        ' <input type="text" name="direccion" placeholder="DIRECCION_PERSONA" id="direccionP" value="' + resource["direccion"] + '" class="direccion DIRECCION_PERSONA form-control" maxlength="200" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="TELEFONO" id="TELEFONO"> </label>' +
        ' <input type="text" name="telefono" placeholder="TELEFONO" id="telefonoP" value="' + resource["telefono"] + '" class="telefono TELEFONO form-control" maxlength="9" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="EMAIL" id="EMAIL"> </label>' +
        ' <input type="text" name="email" placeholder="EMAIL" id="emailP" value="' + resource["email"] + '" class="email EMAIL form-control" maxlength="9" size="30" disabled>' +
        '</div><div class="form-group mx-3"><label class="ROL" id="ROL"> </label>' +
        ' <input type="text" name="id_rol" placeholder="ROL" id="rolP" value="' + getCookie("userRole") + '" class="rol ROL form-control" maxlength="9" size="30" disabled>' +
        "</div>" +
        "<button name='btnAcciones' style='background-color: #222;' class='tooltip6 btn w-100 border border-dark' id='btnAcciones' onclick='closeProfile()'>" +
        "<img class='iconoCerrar' src='Resources/close2.png' alt='' id='iconoAcciones' />" +
        "<span class='tooltiptext ICONO_CERRAR' id='spanAcciones'></span>" +
        "</button>" +
        "</div>" +
        "</div>";

      $("#viewProfile-modal").append(modalContent);
      document.getElementById("viewProfile-modal").style.display = 'block';

      setLang(getCookie("lang"));
    })
    .catch((res) => {
      ajaxResponseKO(res.code);
      setLang(getCookie("lang"));
      document.getElementById("modal").style.display = "block";
    });
  deleteActionController();
}

function closeProfile() {
  $('#viewProfile-modal').css('display', 'none');
  $('#viewProfile-modal').modal('hide');
}

/**Function to system logout.*/
function logout() {
  deleteAllCookies();
}

function backMenu() {
  $("#viewProfile-modal").html("");

  $("#viewProfile-modal").append("");
  document.getElementById("viewProfile-modal").style.display = 'none';

  cleanSearchCookies();
}

function cleanSearchCookies() {
  setCookie("nombreRol", "");
  setCookie("descripcionRol", "");
}

/*Función que elimina las cookies del navegador cuando cambiamos de pestaña html*/
function deleteAllCookies() {
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i];
    var eqPos = cookie.indexOf("=");
    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    setCookie(name, "");
  }
}

function authenticationError(responseCode) {
  var lang = getCookie("lang");
  $("#modal-title").removeClass();
  $("#modal-title").addClass("STOP");
  document.getElementById("modal-title").style.color = "#a50707";
  document.getElementById("modal-title").style.top = "13%";
  $("#modal-mensaje").removeClass();
  $("#modal-mensaje").addClass(responseCode);
  $(".imagenAviso").attr("src", "images/stop.png");
  document.getElementById("modal").style.display = "block";
  setLang(lang);
}

async function userRole() {
  var lang = getCookie("lang");
  createHideForm("formularioRolUsuario", "javascript:userRole()");
  insertField(
    document.formularioRolUsuario,
    "dni",
    getCookie("userSystem")
  );

  await ajaxPromise(document.formularioRolUsuario, "search", "user", "RECORDSET_DATOS", true)
    .then((res) => {
      setCookie("userRole", res.resource[0].id_rol.nombre_rol);
      includeTopMenu();
    })
    .catch((res) => {
      actionError(res.code);
      setLang(lang);
    });
  deleteActionController();
}

async function userNotifications() {
  createHideForm("formularioNotificacion", "javascript:userRole()");
  if (getCookie("userRole") != "administrador") {
    var lang = getCookie("lang");
    insertField(
      document.formularioNotificacion,
      "dni_usuario_destinatario",
      getCookie("userSystem")
    );
    insertField(
      document.formularioNotificacion,
      "leida",
      0
    );
  }

  await ajaxPromise(document.formularioNotificacion, "search", "notification", ["RECORDSET_DATOS", "RECORDSET_VACIO"], true)
    .then((res) => {
      updateNotificationCounter(res.total);
    })
    .catch((res) => {
      actionError(res.code);
      setLang(lang);
    });
  deleteActionController();
}

function updateNotificationCounter(notifications) {
  document.getElementById("contadorNotificaciones").textContent = notifications;
}

function actionError(responseCode) {
  $("#modal-title").addClass("ERROR");
  $("#formularioAcciones").modal("hide");
  $(".imagenAviso").attr("src", "Resources/failed.png");
  $("#close").attr("onclick", "closeModal('modal', 'index.html', '')");
  $("#modal-title").attr("style", "color: #ff0000;");
  $("#modal-mensaje").removeClass();
  $("#modal-mensaje").addClass(responseCode);
  $(".imagenAviso").attr("style", "width: 16%; margin-top: 0");
  $("#modal").attr("style", "display: block");
  deleteAllCookies();
}


function ajaxPromise(form, action, method, errorMsg, checkToken) {
  var token = getCookie("token");
  addActionControler(form, action, method);
  if (checkToken && token == null) {
    authenticationError("ACCESO_DENEGADO");
  } else {
    return new Promise(function (resolve, reject) {
      $.ajax({
        method: "POST",
        url: URL_REST,
        data: $(form).serialize(),
        headers: token != null ? { Authorization: token } : "",
      })
        .done((res) => {
          if (Array.isArray(errorMsg)) {
            if (!errorMsg.includes(res.code)) {
              reject(res);
            }
          } else {
            if (res.code != errorMsg) {
              reject(res);
            }
          }

          resolve(res);
        })
        .fail(function (jqXHR) {
          errorFailAjax(jqXHR.status);
        });
    });
  }
}

function ajaxPromiseNoSerialize(form, errorMsg, checkToken) {
  var token = getCookie("token");
  if (checkToken && token == null) {
    authenticationError("ACCESO_DENEGADO");
  } else {
    return new Promise(function (resolve, reject) {
      $.ajax({
        method: "POST",
        url: URL_REST,
        data: form,
        headers: { Authorization: token }
      })
        .done((res) => {
          if (res.code != errorMsg) {
            reject(res);
          }
          resolve(res);
        })
        .fail(function (jqXHR) {
          errorFailAjax(jqXHR.status);
        });
    });
  }
}

/**Función que genera la modal para que el usuario pueda cambiar su contraseña*/
function modalChangePass() {
  $("#changePass-modal").html("");

  var contenidoModal =
    '<div class="modal-dialog">' +
    '<div class="changePassmodal-container">' +
    '<h1 class="CAMBIAR_CONTRASEÑA"></h1>' +
    '<div class-form-group>' +
    '<form name="formularioChangePass" id="formularioChangePass" action="javascript:changePass()" onsubmit="return checkChangePass()">' +
    '<label class="CAMBIAR_CONTRASEÑA mt-3"> </label>' +
    '<input type="password" name="password" class="PASS_USUARIO_NUEVA form-control" maxlength="45" size="45" id="passChangePass1" placeholder="" placeholder="Contraseña" onKeyPress="capLock(event,\'bloqueoMayusculasChangePass\');" onblur="return checkPass(\'passChangePass1\', \'errorFormatoChangePass1\', \'passwordChange\')"; autocomplete="new-password">' +
    '<div style="display:none" id="errorFormatoChangePass1"></div>' +
    '<label class="CONFIRMAR_PASS_USUARIO"> </label>' +
    '<input type="password" name="passwordConfirm" class="CONFIRMAR_PASS_USUARIO form-control mb-3" id="passChangePass2" maxlength="45" size="45" placeholder="Contraseña" onKeyPress="capLock(event,\'bloqueoMayusculasChangePass\');" onblur="return checkPassConfirmChangePass(\'passChangePass2\', \'errorFormatoChangePass2\', \'passwordChange\')" autocomplete="new-password">' +
    '<div style="display:none" class="BLOQUEO_MAYUSCULAS alert alert-warning" id="bloqueoMayusculasChangePass"></div>' +
    '<div style="display:none" id="errorFormatoChangePass2" class="alert alert-danger ocultar"></div>' +
    '<div id="error" class="alert alert-danger ocultar" role="alert" class="CONTRASEÑAS_NO_COINCIDEN"></div>' +
    '<button type="submit" name="btnChangePass" value="Cambiar contraseña" class="btnChangePass tooltip3">' +
    '<img class=iconoResetPass iconResetPass" src="Resources/resetPass.png" alt="CAMBIAR_CONTRASEÑA" />' +
    '<span class="tooltiptext3 ICONO_RESET_PASS"></span>' +
    "</button>" +
    "</form>" +
    "</div>" +
    "</div>" +
    "</div>";

  $("#changePass-modal").append(contenidoModal);

  setLang(getCookie("lang"));
}

/**Función para ordenar una tabla por columna*/
function sortTable(n, idTable) {
  var table,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;

  table = document.getElementById(idTable);
  switching = true;

  dir = "asc";

  while (switching) {
    switching = false;
    rows = table.rows;

    for (i = 1; i < rows.length - 1; i++) {
      shouldSwitch = false;

      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }

    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;

      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

/**Función que habilita los campos de un formulario*/
function enableFields(idElementoList) {
  idElementoList.forEach(function (idElemento) {
    $("#" + idElemento).attr("readonly", false);
  });
}

/**Función que habilita los campos de un formulario de tipo select*/
function enableFieldsSelect(idElementoList) {
  idElementoList.forEach(function (idElemento) {
    $("#" + idElemento).attr("disabled", false);
  });
}

/**Función que deshabilita los campos de un formulario*/
function disableFields(idElementoList) {
  idElementoList.forEach(function (idElemento) {
    $("#" + idElemento).attr("readonly", true);
  });
}

/**Función que deshabilita los campos de un formulario de tipo select*/
function disableFieldsSelect(idElementoList) {
  idElementoList.forEach(function (idElemento) {
    $("#" + idElemento).attr("disabled", true);
  });
}

/**Función para cambiar valores del formulario.*/
function changeForm(tituloForm, action, onsubmit) {
  $("#formularioAcciones").attr("style", "display: block");
  $("#cerrarForm").attr("onclick", "closeModal('formularioAcciones', '', '')");
  $("#tituloForms").addClass(tituloForm);
  if (action != "") {
    $("#formularioGenerico").attr("action", action);
  }

  if (onsubmit != "") {
    $("#formularioGenerico").attr("onsubmit", onsubmit);
  } else {
    $("#formularioGenerico").attr("onsubmit", "");
  }
}

/**Función para cambiar valores del icono **/
function changeIcon(ruta, nombreIcono, estiloIcono, valorIcono) {
  $("#iconoAcciones").attr("src", ruta);
  $("#iconoAcciones").removeClass();
  $("#iconoAcciones").addClass(nombreIcono);
  $("#iconoAcciones").addClass(estiloIcono);
  $("#spanAcciones").removeClass();
  $("#spanAcciones").addClass("tooltiptext");
  $("#spanAcciones").addClass(nombreIcono);
  $("#btnAcciones").attr("value", valorIcono);
}

/* Funcion para cambiar la contraseña */
async function changePass() {
  addActionControler(
    document.formularioChangePass,
    "editPass",
    "user"
  );
  await changePassUserAjaxPromesa()
    .then((res) => {
      $("#changePass-modal").modal("toggle");
      setCookie("token", res.resource); //Actualizamos el token de sesión
      ajaxResponseOK("USUARIO_EDITAR_CONTRASENA_OK", res.code);

      let idElementoList = ["passChangePass1", "passChangePass2"];
      resetForm("formularioChangePass", idElementoList);
      setLang(getCookie("lang"));
      document.getElementById("modal").style.display = "block";

    })
    .catch((res) => {
      $("#changePass-modal").modal("toggle");
      ajaxResponseKO(res.code);

      let idElementoList = ["passChangePass1", "passChangePass2"];
      cleanForm(idElementoList);
      resetForm("formularioChangePass", idElementoList);
      setLang(getCookie("lang"));
      document.getElementById("modal").style.display = "block";
    });
}

/* Función para cambiar la contraseña con ajax y promesas */
function changePassUserAjaxPromesa() {
  var token = getCookie("token");
  if (token == null) {
    errorAutenticado("ACCESO_DENEGADO");
  } else {
    return new Promise(function (resolve, reject) {
      if (verificarPasswd()) {
        encrypt("passChangePass1");

        $.ajax({
          method: "POST",
          url: URL_REST,
          data: $("#formularioChangePass").serialize(),
          headers: { Authorization: token },
        })
          .done((res) => {
            if (res.code != "USUARIO_EDITAR_CONTRASENA_OK") {
              reject(res);
            }
            resolve(res);
          })
          .fail(function (jqXHR) {
            errorFailAjax(jqXHR.status);
          });
      } else {
        document.getElementById("error").setAttribute("style", "");
      }
    });
  }
}

/**Función para limpiar los campos de un formulario*/
function cleanForm(idElementoList) {
  idElementoList.forEach(function (idElemento) {
    $("#" + idElemento).val("");
  });
}

/**Función que resetear los valores del formulario*/
function resetForm(idFormulario, idElementoList) {
  document.getElementById(idFormulario).reset();

  idElementoList.forEach(function (idElemento) {
    document.getElementById(idElemento).style.borderColor = "#c8c8c8";
  });
}

function getCurrentDate() {
  date = new Date();
  day = String(date.getDate());
  if (day.length == 1) {
    day = "0".concat(day);
  }
  month = String(date.getMonth() + 1);
  if (month.length == 1) {
    month = "0".concat(month);
  }
  year = date.getFullYear();

  currentDate = `${year}-${month}-${day}`;
  return currentDate;
}