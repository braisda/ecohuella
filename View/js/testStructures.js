function checkPermissions() {
  if (getCookie("userRole") != "administrador") {
      window.location.href = './menu.html';
  }
}

/*Función para generar estructura básica de los test*/
function createTest(arrayDatosAccordion) {
  var aUno = "";

  if (arrayDatosAccordion[2] === null) {
    aUno =
      '<a class="collapsed card-link" data-toggle="collapse" href="#' +
      arrayDatosAccordion[1] +
      '">' +
      " " +
      arrayDatosAccordion[3] +
      " " +
      "</a>";
  } else {
    aUno =
      '<a class="collapsed card-link" data-toggle="collapse" href="#' +
      arrayDatosAccordion[1] +
      '"  onclick="' +
      arrayDatosAccordion[2] +
      '">' +
      " " +
      arrayDatosAccordion[3] +
      " " +
      "</a>";
  }

  var cardHeaderUno =
    '<div class="card-header card-header-test">' +
    aUno +
    '<img class="iconTab" id="' +
    arrayDatosAccordion[4] +
    ' src="Resources/failed.png" hidden>' +
    "</div>";

  var cardsUno = "";

  if (arrayDatosAccordion[2] === null) {
    var arrayUno = arrayDatosAccordion[7];
    cardsUno = creaCards(arrayUno);
  } else {
    cardsUno = creaTableResponsive(
      arrayDatosAccordion[5],
      arrayDatosAccordion[6]
    );
  }

  var aDos = "";

  if (arrayDatosAccordion[9] === null) {
    aDos =
      '<a class="collapsed card-link" data-toggle="collapse" href="#' +
      arrayDatosAccordion[8] +
      '">' +
      " " +
      arrayDatosAccordion[10] +
      " " +
      "</a>";
  } else {
    aDos =
      '<a class="collapsed card-link" data-toggle="collapse" href="#' +
      arrayDatosAccordion[8] +
      '"  onclick="' +
      arrayDatosAccordion[9] +
      '">' +
      " " +
      arrayDatosAccordion[10] +
      " " +
      "</a>";
  }

  var cardHeaderDos =
    '<div class="card-header card-header-test">' +
    aDos +
    '<img class="iconTab" id="' +
    arrayDatosAccordion[11] +
    ' src="Resources/failed.png" hidden>' +
    "</div>";

  var cardsDos = "";

  if (arrayDatosAccordion[9] === null) {
    var arrayDos = arrayDatosAccordion[14];
    cardsDos = creaCards(arrayDos);
  } else {
    cardsDos = creaTableResponsive(
      arrayDatosAccordion[12],
      arrayDatosAccordion[13]
    );
  }

  var contenidoTest =
    '<div id="' +
    arrayDatosAccordion[0] +
    '">' +
    '<div class="card">' +
    cardHeaderUno +
    '<div id="' +
    arrayDatosAccordion[1] +
    '" class="collapse" data-parent="#' +
    arrayDatosAccordion[0] +
    '">' +
    '<div class="card-body card-body-test">' +
    cardsUno +
    "</div>" +
    "</div>" +
    cardHeaderDos +
    '<div id="' +
    arrayDatosAccordion[8] +
    '" class="collapse" data-parent="#' +
    arrayDatosAccordion[0] +
    '">' +
    '<div class="card-body card-body-test">' +
    cardsDos +
    "</div>" +
    "</div>" +
    " </div>" +
    "</div>";

  return contenidoTest;
}

/*Función para crear los cards*/
function creaCards(arrayDatos) {
  var cards = "";

  for (let step = 1; step < arrayDatos.length; step++) {
    var array = arrayDatos[step];

    cards =
      cards +
      '<div class="card">' +
      '<div class="card-header card-header-test">' +
      '<a class="collapsed card-link" data-toggle="collapse" href="#' +
      array[0] +
      '" onclick="' +
      array[1] +
      '">' +
      " " +
      array[2] +
      " " +
      "</a>" +
      '<img class="iconTab" id="' +
      array[3] +
      '" src="Resources/failed.png" hidden>' +
      "</div>" +
      '<div id="' +
      array[0] +
      '" class="collapse" data-parent="#' +
      arrayDatos[0] +
      '">' +
      '<div class="card-body card-body-test">' +
      '<div class="table-responsive controlTamTabla">' +
      '<table class="table table-bordered">' +
      '<thead class="cabeceraTablasTest" id="' +
      array[4] +
      '"></thead>' +
      '<tbody id="' +
      array[5] +
      '"></tbody>' +
      "</table>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>";
  }

  var resultCards = '<div id="' + arrayDatos[0] + '">' + cards + "</div>";

  return resultCards;
}

/*Función que crea la tabla responsive si no tenemos subniveles*/
function creaTableResponsive(idCabecera, idCuerpo) {
  var table =
    '<div class="table-responsive">' +
    '<table class="table table-bordered">' +
    '<thead class="cabeceraTablasTest" id="' +
    idCabecera +
    '"></thead>' +
    '<tbody id="' +
    idCuerpo +
    '"></tbody>' +
    "</table>" +
    "</div>";
  return table;
}

/*Función para cargar las opciones de Tests de Autenticacion*/
function cargarTestAutenticaciones() {
  $("#testAutenticacion").html("");

  let arraySubAccordionUno = [
    "collapseAtributosLoginAutenticacion",
    "javascript:testAutenticacion('Login', 'Atributos')",
    "Login",
    "iconoTestAutenticacionAtributosLogin",
    "cabeceraAtributosAutenticacionLogin",
    "cuerpoAtributosAutenticacionLogin",
  ];
  let arraySubAccordionDos = [
    "collapseAtributosRegistroAutenticacion",
    "javascript:testAutenticacion('Registro', 'Atributos')",
    "Registro",
    "iconoTestAutenticacionAtributosRegistro",
    "cabeceraAtributosAutenticacionRegistro",
    "cuerpoAtributosAutenticacionRegistro",
  ];
  let arraySubAccordionTres = [
    "collapseAutenticacionAtributoObtenerContrasenaCorreo",
    "javascript:testAutenticacion('ObtenerContrasenaCorreo', 'Atributos')",
    "Obtener contraseña",
    "iconoTestAutenticacionAtributosObtenerContrasenaCorreo",
    "cabeceraAtributosAutenticacionObtenerContrasenaCorreo",
    "cuerpoAtributosAutenticacionObtenerContrasenaCorreo",
  ];
  let arrayAccordionUno = [
    "accordion3",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres
  ];

  let arraySubAccordionCuatro = [
    "collapseAutenticacionAccionesLogin",
    "javascript:testAutenticacion('Login', 'Acciones')",
    "Login",
    "iconoTestAutenticacionAccionesLogin",
    "cabeceraAccionesAutenticacionLogin",
    "cuerpoAccionesAutenticacionLogin",
  ];
  let arraySubAccordionCinco = [
    "collapseAutenticacionAccionesRegistro",
    "javascript:testAutenticacion('Registro', 'Acciones')",
    "Registro",
    "iconoTestAutenticacionAccionesRegistro",
    "cabeceraAccionesAutenticacionRegistro",
    "cuerpoAccionesAutenticacionRegistro",
  ];
  let arraySubAccordionSeis = [
    "collapseAutenticacionAccionesObtenerContrasenaCorreo",
    "javascript:testAutenticacion('ObtenerContrasenaCorreo', 'Acciones')",
    "Obtener contraseña",
    "iconoTestAutenticacionAccionesObtenerContrasenaCorreo",
    "cabeceraAccionesAutenticacionObtenerContrasenaCorreo",
    "cuerpoAccionesAutenticacionObtenerContrasenaCorreo",
  ];
  let arrayAccordionDos = [
    "accordion4",
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
    arraySubAccordionSeis
  ];

  let arrayAccordionTres = [
    "accordion2",
    "collapseAutenticacionAtributos",
    null,
    "Atributos",
    "iconoTestAutenticacionAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseAutenticacionAcciones",
    null,
    "Acciones",
    "iconoTestAutenticacionAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testAutenticacion").append(contenidoTest);
}

/*Función para cargar las opciones de Tests de Usuarios*/
function cargarTestGestionUsuario() {
  $("#testUsuario").html("");
  
  let arraySubAccordionUno = [
    "collapseAtributosInsertarUsuario",
    "javascript:testUsuario('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestUsuarioAtributosInsertar",
    "cabeceraAtributosUsuarioInsertar",
    "cuerpoAtributosUsuarioInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseUsuarioAtributoBuscar",
    "javascript:testUsuario('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestUsuarioAtributosBuscar",
    "cabeceraAtributosUsuarioBuscar",
    "cuerpoAtributosUsuarioBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseUsuarioAtributoModificar",
    "javascript:testUsuario('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestUsuarioAtributosModificar",
    "cabeceraAtributosUsuarioModificar",
    "cuerpoAtributosUsuarioModificar",
  ];
  let arraySubAccordionCuatro = [
    "collapseAtributosBorrarUsuario",
    "javascript:testUsuario('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestUsuarioAtributosBorrar",
    "cabeceraAtributosUsuarioBorrar",
    "cuerpoAtributosUsuarioBorrar",
  ];
  let arraySubAccordionCinco = [
    "collapseUsuarioAtributoVerEnDetalle",
    "javascript:testUsuario('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestUsuarioAtributosVerEnDetalle",
    "cabeceraAtributosUsuarioVerEnDetalle",
    "cuerpoAtributosUsuarioVerEnDetalle",
  ];
  let arraySubAccordionSeis = [
    "collapseUsuarioAtributoEditarContrasena",
    "javascript:testUsuario('EditarContrasena', 'Atributos')",
    "EditarContrasena",
    "iconoTestUsuarioAtributosEditarContrasena",
    "cabeceraAtributosUsuarioEditarContrasena",
    "cuerpoAtributosUsuarioEditarContrasena",
  ];
  let arrayAccordionUno = [
    "accordion19",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
    arraySubAccordionSeis
  ];

  let arraySubAccordionOcho = [
    "collapseUsuarioAccionesInsertar",
    "javascript:testUsuario('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestUsuarioAccionesInsertar",
    "cabeceraAccionesUsuarioInsertar",
    "cuerpoAccionesUsuarioInsertar",
  ];
  let arraySubAccordionNueve = [
    "collapseUsuarioAccionesBuscar",
    "javascript:testUsuario('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestUsuarioAccionesBuscar",
    "cabeceraAccionesUsuarioBuscar",
    "cuerpoAccionesUsuarioBuscar",
  ];
  let arraySubAccordionDiez = [
    "collapseUsuarioAccionesModificar",
    "javascript:testUsuario('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestUsuarioAccionesModificar",
    "cabeceraAccionesUsuarioModificar",
    "cuerpoAccionesUsuarioModificar",
  ];
  let arraySubAccordionOnce = [
    "collapseUsuarioAccionesBorrar",
    "javascript:testUsuario('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestUsuarioAccionesBorrar",
    "cabeceraAccionesUsuarioBorrar",
    "cuerpoAccionesUsuarioBorrar",
  ];
  let arraySubAccordionDoce = [
    "collapseUsuarioAccionesVerEnDetalle",
    "javascript:testUsuario('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestUsuarioAccionesVerEnDetalle",
    "cabeceraAccionesUsuarioVerEnDetalle",
    "cuerpoAccionesUsuarioVerEnDetalle",
  ];
  let arraySubAccordionTrece = [
    "collapseUsuarioAccionesEditarContrasena",
    "javascript:testUsuario('EditarContrasena', 'Acciones')",
    "EditarContrasena",
    "iconoTestUsuarioAccionesEditarContrasena",
    "cabeceraAccionesUsuarioEditarContrasena",
    "cuerpoAccionesUsuarioEditarContrasena",
  ];
  let arrayAccordionDos = [
    "accordion20",
    arraySubAccordionOcho,
    arraySubAccordionNueve,
    arraySubAccordionDiez,
    arraySubAccordionOnce,
    arraySubAccordionDoce,
    arraySubAccordionTrece
  ];

  let arrayAccordionTres = [
    "accordion18",
    "collapseUsuarioAtributos",
    null,
    "Atributos",
    "iconoTestUsuarioAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseUsuarioAcciones",
    null,
    "Acciones",
    "iconoTestUsuarioAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testUsuario").append(contenidoTest);
}

/*Función para cargar las opciones de Tests de Acción-Funcionalidad*/
function cargarTestGestionAccionFuncionalidad() {
  $("#testAccionFuncionalidad").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarAccionFuncionalidad",
    "javascript:testAccionFuncionalidad('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestAccionFuncionalidadAtributosInsertar",
    "cabeceraAtributosAccionFuncionalidadInsertar",
    "cuerpoAtributosAccionFuncionalidadInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseAccionFuncionalidadAtributoBuscar",
    "javascript:testAccionFuncionalidad('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestAccionFuncionalidadAtributosBuscar",
    "cabeceraAtributosAccionFuncionalidadBuscar",
    "cuerpoAtributosAccionFuncionalidadBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseAccionFuncionalidadAtributoEliminar",
    "javascript:testAccionFuncionalidad('Eliminar', 'Atributos')",
    "Eliminar",
    "iconoTestAccionFuncionalidadAtributosEliminar",
    "cabeceraAtributosAccionFuncionalidadEliminar",
    "cuerpoAtributosAccionFuncionalidadEliminar",
  ];
  let arrayAccordionUno = [
    "accordion7",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
  ];

  let arraySubAccordionSiete = [
    "collapseAccionFuncionalidadAccionesInsertar",
    "javascript:testAccionFuncionalidad('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestAccionFuncionalidadAccionesInsertar",
    "cabeceraAccionesAccionFuncionalidadInsertar",
    "cuerpoAccionesAccionFuncionalidadInsertar",
  ];
  let arraySubAccordionOcho = [
    "collapseAccionFuncionalidadAccionesBuscar",
    "javascript:testAccionFuncionalidad('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestAccionFuncionalidadAccionesBuscar",
    "cabeceraAccionesAccionFuncionalidadBuscar",
    "cuerpoAccionesAccionFuncionalidadBuscar",
  ];
  let arraySubAccordionNueve = [
    "collapseAccionFuncionalidadAccionesEliminar",
    "javascript:testAccionFuncionalidad('Eliminar', 'Acciones')",
    "Eliminar",
    "iconoTestAccionFuncionalidadAccionesEliminar",
    "cabeceraAccionesAccionFuncionalidadEliminar",
    "cuerpoAccionesAccionFuncionalidadEliminar",
  ];
  let arrayAccordionDos = [
    "accordion8",
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve
  ];

  let arrayAccordionTres = [
    "accordion6",
    "collapseAccionFuncionalidadAtributos",
    null,
    "Atributos",
    "iconoTestAccionFuncionalidadAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseAccionFuncionalidadAcciones",
    null,
    "Acciones",
    "iconoTestAccionFuncionalidadAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testAccionFuncionalidad").append(contenidoTest);
}

/*Función para cargar las opciones de Tests de Funcionalidades*/
function cargarTestGestionFuncionalidades() {
  $("#testFuncionalidad").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarFuncionalidad",
    "javascript:testFuncionalidad('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestFuncionalidadAtributosInsertar",
    "cabeceraAtributosFuncionalidadInsertar",
    "cuerpoAtributosFuncionalidadInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseFuncionalidadAtributoBuscar",
    "javascript:testFuncionalidad('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestFuncionalidadAtributosBuscar",
    "cabeceraAtributosFuncionalidadBuscar",
    "cuerpoAtributosFuncionalidadBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseFuncionalidadAtributoModificar",
    "javascript:testFuncionalidad('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestFuncionalidadAtributosModificar",
    "cabeceraAtributosFuncionalidadModificar",
    "cuerpoAtributosFuncionalidadModificar",
  ];
  let arraySubAccordionCuatro = [
    "collapseAtributosBorrarFuncionalidad",
    "javascript:testFuncionalidad('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestFuncionalidadAtributosBorrar",
    "cabeceraAtributosFuncionalidadBorrar",
    "cuerpoAtributosFuncionalidadBorrar",
  ];
  let arraySubAccordionCinco = [
    "collapseFuncionalidadAtributoVerEnDetalle",
    "javascript:testFuncionalidad('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestFuncionalidadAtributosVerEnDetalle",
    "cabeceraAtributosFuncionalidadVerEnDetalle",
    "cuerpoAtributosFuncionalidadVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseFuncionalidadAccionesInsertar",
    "javascript:testFuncionalidad('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestFuncionalidadAccionesInsertar",
    "cabeceraAccionesFuncionalidadInsertar",
    "cuerpoAccionesFuncionalidadInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseFuncionalidadAccionesBuscar",
    "javascript:testFuncionalidad('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestFuncionalidadAccionesBuscar",
    "cabeceraAccionesFuncionalidadBuscar",
    "cuerpoAccionesFuncionalidadBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseFuncionalidadAccionesModificar",
    "javascript:testFuncionalidad('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestFuncionalidadAccionesModificar",
    "cabeceraAccionesFuncionalidadModificar",
    "cuerpoAccionesFuncionalidadModificar",
  ];
  let arraySubAccordionNueve = [
    "collapseFuncionalidadcAcionesBorrar",
    "javascript:testFuncionalidad('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestFuncionalidadAccionesBorrar",
    "cabeceraAccionesFuncionalidadBorrar",
    "cuerpoAccionesFuncionalidadBorrar",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve,
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseFuncionalidadAtributos",
    null,
    "Atributos",
    "iconoTestFuncionalidadAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseFuncionalidadAcciones",
    null,
    "Acciones",
    "iconoTestFuncionalidadAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testFuncionalidad").append(contenidoTest);
}

/*Función para cargar las opciones de Tests de Acciones*/
function cargarTestGestionAcciones() {
  $("#testAccion").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarAccion",
    "javascript:testAccion('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestAccionAtributosInsertar",
    "cabeceraAtributosAccionInsertar",
    "cuerpoAtributosAccionInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseAccionAtributoBuscar",
    "javascript:testAccion('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestAccionAtributosBuscar",
    "cabeceraAtributosAccionBuscar",
    "cuerpoAtributosAccionBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseAccionAtributoModificar",
    "javascript:testAccion('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestAccionAtributosModificar",
    "cabeceraAtributosAccionModificar",
    "cuerpoAtributosAccionModificar",
  ];
  let arraySubAccordionCuatro = [
    "collapseAtributosBorrarAccion",
    "javascript:testAccion('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestAccionAtributosBorrar",
    "cabeceraAtributosAccionBorrar",
    "cuerpoAtributosAccionBorrar",
  ];
  let arraySubAccordionCinco = [
    "collapseAccionAtributoVerEnDetalle",
    "javascript:testAccion('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestAccionAtributosVerEnDetalle",
    "cabeceraAtributosAccionVerEnDetalle",
    "cuerpoAtributosAccionVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion13",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseAccionAccionesInsertar",
    "javascript:testAccion('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestAccionAccionesInsertar",
    "cabeceraAccionesAccionInsertar",
    "cuerpoAccionesAccionInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseAccionAccionesBuscar",
    "javascript:testAccion('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestAccionAccionesBuscar",
    "cabeceraAccionesAccionBuscar",
    "cuerpoAccionesAccionBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseAccionAccionesModificar",
    "javascript:testAccion('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestAccionAccionesModificar",
    "cabeceraAccionesAccionModificar",
    "cuerpoAccionesAccionModificar",
  ];
  let arraySubAccordionNueve = [
    "collapseAccionAccionesBorrar",
    "javascript:testAccion('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestAccionAccionesBorrar",
    "cabeceraAccionesAccionBorrar",
    "cuerpoAccionesAccionBorrar",
  ];
  let arrayAccordionDos = [
    "accordion14",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve,
  ];

  let arrayAccordionTres = [
    "accordion12",
    "collapseAccionAtributos",
    null,
    "Atributos",
    "iconoTestAccionAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseAccionAcciones",
    null,
    "Acciones",
    "iconoTestAccionAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testAccion").append(contenidoTest);
}

/*Función para cargar las opciones de Tests de Permisos*/
function cargarTestGestionRolAccionFuncionalidad() {
  $("#testRolAccionFuncionalidad").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarRolAccionFuncionalidad",
    "javascript:testRolAccionFuncionalidad('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestRolAccionFuncionalidadAtributosInsertar",
    "cabeceraAtributosRolAccionFuncionalidadInsertar",
    "cuerpoAtributosRolAccionFuncionalidadInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseRolAccionFuncionalidadAtributoBuscar",
    "javascript:testRolAccionFuncionalidad('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestRolAccionFuncionalidadAtributosBuscar",
    "cabeceraAtributosRolAccionFuncionalidadBuscar",
    "cuerpoAtributosRolAccionFuncionalidadBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseAtributosBorrarRolAccionFuncionalidad",
    "javascript:testRolAccionFuncionalidad('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestRolAccionFuncionalidadAtributosBorrar",
    "cabeceraAtributosRolAccionFuncionalidadBorrar",
    "cuerpoAtributosRolAccionFuncionalidadBorrar",
  ];
  let arrayAccordionUno = [
    "accordion16",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
  ];

  let arraySubAccordionCuatro = [
    "collapseRolAccionFuncionalidadAccionesInsertar",
    "javascript:testRolAccionFuncionalidad('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestRolAccionFuncionalidadAccionesInsertar",
    "cabeceraAccionesRolAccionFuncionalidadInsertar",
    "cuerpoAccionesRolAccionFuncionalidadInsertar",
  ];
  let arraySubAccordionCinco = [
    "collapseRolAccionFuncionalidadAccionesBuscar",
    "javascript:testRolAccionFuncionalidad('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestAccionAccionesBuscar",
    "cabeceraAccionesRolAccionFuncionalidadBuscar",
    "cuerpoAccionesRolAccionFuncionalidadBuscar",
  ];
  let arraySubAccordionSeis = [
    "collapseRolAccionFuncionalidadAccionesBorrar",
    "javascript:testRolAccionFuncionalidad('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestAccionAccionesBorrar",
    "cabeceraAccionesRolAccionFuncionalidadBorrar",
    "cuerpoAccionesRolAccionFuncionalidadBorrar",
  ];
  let arrayAccordionDos = [
    "accordion17",
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
    arraySubAccordionSeis,
  ];

  let arrayAccordionTres = [
    "accordion15",
    "collapseRolAccionFuncionalidadAtributos",
    null,
    "Atributos",
    "iconoTestAccionAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseRolAccionFuncionalidadAcciones",
    null,
    "Acciones",
    "iconoTestRolAccionFuncionalidadAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testRolAccionFuncionalidad").append(contenidoTest);
}

/*Función para cargar las opciones de Tests de RolAccionFuncionalidads*/
/*function cargarTestGestionRolAccionFuncionalidad() {
  $("#testRolAccionFuncionalidad").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarRolAccionFuncionalidad",
    "javascript:testRolAccionFuncionalidad('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestRolAccionFuncionalidadAtributosInsertar",
    "cabeceraAtributosRolAccionFuncionalidadInsertar",
    "cuerpoAtributosRolAccionFuncionalidadInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseRolAccionFuncionalidadAtributoBuscar",
    "javascript:testRolAccionFuncionalidad('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestRolAccionFuncionalidadAtributosBuscar",
    "cabeceraAtributosRolAccionFuncionalidadBuscar",
    "cuerpoAtributosRolAccionFuncionalidadBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseAtributosBorrarRolAccionFuncionalidad",
    "javascript:testRolAccionFuncionalidad('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestRolAccionFuncionalidadAtributosBorrar",
    "cabeceraAtributosRolAccionFuncionalidadBorrar",
    "cuerpoAtributosRolAccionFuncionalidadBorrar",
  ];
  let arrayAccordionUno = [
    "accordion22",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
  ];

  let arraySubAccordionOcho = [
    "collapseRolAccionFuncionalidadAccionesInsertar",
    "javascript:testRolAccionFuncionalidad('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestRolAccionFuncionalidadAccionesInsertar",
    "cabeceraAccionesRolAccionFuncionalidadInsertar",
    "cuerpoAccionesRolAccionFuncionalidadInsertar",
  ];
  let arraySubAccordionNueve = [
    "collapseRolAccionFuncionalidadAccionesBuscar",
    "javascript:testRolAccionFuncionalidad('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestRolAccionFuncionalidadAccionesBuscar",
    "cabeceraAccionesRolAccionFuncionalidadBuscar",
    "cuerpoAccionesRolAccionFuncionalidadBuscar",
  ];
  let arraySubAccordionDiez = [
    "collapseRolAccionFuncionalidadAccionesBorrar",
    "javascript:testRolAccionFuncionalidad('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestRolAccionFuncionalidadAccionesBorrar",
    "cabeceraAccionesRolAccionFuncionalidadBorrar",
    "cuerpoAccionesRolAccionFuncionalidadBorrar",
  ];
  let arrayAccordionDos = [
    "accordion23",
    arraySubAccordionOcho,
    arraySubAccordionNueve,
    arraySubAccordionDiez,
  ];

  let arrayAccordionTres = [
    "accordion21",
    "collapseRolAccionFuncionalidadAtributos",
    null,
    "Atributos",
    "iconoTestRolAccionFuncionalidadAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseRolAccionFuncionalidadAcciones",
    null,
    "Acciones",
    "iconoTestRolAccionFuncionalidadAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testRolAccionFuncionalidad").append(contenidoTest);
}*/

//*Función para cargar las opciones de Tests de Categorias*/
function cargarTestGestionCategoria() {
  $("#testCategoria").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarCategoria",
    "javascript:testCategoria('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestCategoriaAtributosInsertar",
    "cabeceraAtributosCategoriaInsertar",
    "cuerpoAtributosCategoriaInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseCategoriaAtributoBuscar",
    "javascript:testCategoria('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestCategoriaAtributosBuscar",
    "cabeceraAtributosCategoriaBuscar",
    "cuerpoAtributosCategoriaBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseCategoriaAtributoModificar",
    "javascript:testCategoria('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestCategoriaAtributosModificar",
    "cabeceraAtributosCategoriaModificar",
    "cuerpoAtributosCategoriaModificar",
  ];
  let arraySubAccordionCuatro = [
    "collapseAtributosBorrarCategoria",
    "javascript:testCategoria('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestCategoriaAtributosBorrar",
    "cabeceraAtributosCategoriaBorrar",
    "cuerpoAtributosCategoriaBorrar",
  ];
  let arraySubAccordionCinco = [
    "collapseCategoriaAtributoVerEnDetalle",
    "javascript:testCategoria('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestCategoriaAtributosVerEnDetalle",
    "cabeceraAtributosCategoriaVerEnDetalle",
    "cuerpoAtributosCategoriaVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseCategoriaAccionesInsertar",
    "javascript:testCategoria('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestCategoriaAccionesInsertar",
    "cabeceraAccionesCategoriaInsertar",
    "cuerpoAccionesCategoriaInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseCategoriaAccionesBuscar",
    "javascript:testCategoria('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestCategoriaAccionesBuscar",
    "cabeceraAccionesCategoriaBuscar",
    "cuerpoAccionesCategoriaBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseCategoriaAccionesModificar",
    "javascript:testCategoria('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestCategoriaAccionesModificar",
    "cabeceraAccionesCategoriaModificar",
    "cuerpoAccionesCategoriaModificar",
  ];
  let arraySubAccordionNueve = [
    "collapseCategoriacAcionesBorrar",
    "javascript:testCategoria('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestCategoriaAccionesBorrar",
    "cabeceraAccionesCategoriaBorrar",
    "cuerpoAccionesCategoriaBorrar",
  ];
  let arraySubAccordionDiez = [
    "collapseCategoriaAccionesVerEnDetalle",
    "javascript:testCategoria('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestCategoriaAccionesVerEnDetalle",
    "cabeceraAccionesCategoriaVerEnDetalle",
    "cuerpoAccionesCategoriaVerEnDetalle",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve,
    arraySubAccordionDiez
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseCategoriaAtributos",
    null,
    "Atributos",
    "iconoTestCategoriaAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseCategoriaAcciones",
    null,
    "Acciones",
    "iconoTestCategoriaAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testCategoria").append(contenidoTest);
}

//*Función para cargar las opciones de Tests de Procesos*/
function cargarTestGestionProceso() {
  $("#testProceso").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarProceso",
    "javascript:testProceso('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestProcesoAtributosInsertar",
    "cabeceraAtributosProcesoInsertar",
    "cuerpoAtributosProcesoInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseProcesoAtributoBuscar",
    "javascript:testProceso('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestProcesoAtributosBuscar",
    "cabeceraAtributosProcesoBuscar",
    "cuerpoAtributosProcesoBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseProcesoAtributoModificar",
    "javascript:testProceso('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestProcesoAtributosModificar",
    "cabeceraAtributosProcesoModificar",
    "cuerpoAtributosProcesoModificar",
  ];
  let arraySubAccordionCuatro = [
    "collapseProcesoAtributoVerEnDetalle",
    "javascript:testProceso('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestProcesoAtributosVerEnDetalle",
    "cabeceraAtributosProcesoVerEnDetalle",
    "cuerpoAtributosProcesoVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    arraySubAccordionCuatro
  ];

  let arraySubAccordionSeis = [
    "collapseProcesoAccionesInsertar",
    "javascript:testProceso('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestProcesoAccionesInsertar",
    "cabeceraAccionesProcesoInsertar",
    "cuerpoAccionesProcesoInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseProcesoAccionesBuscar",
    "javascript:testProceso('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestProcesoAccionesBuscar",
    "cabeceraAccionesProcesoBuscar",
    "cuerpoAccionesProcesoBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseProcesoAccionesModificar",
    "javascript:testProceso('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestProcesoAccionesModificar",
    "cabeceraAccionesProcesoModificar",
    "cuerpoAccionesProcesoModificar",
  ];
  let arraySubAccordionNueve = [
    "collapseProcesoAccionesVerEnDetalle",
    "javascript:testProceso('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestProcesoAccionesVerEnDetalle",
    "cabeceraAccionesProcesoVerEnDetalle",
    "cuerpoAccionesProcesoVerEnDetalle",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseProcesoAtributos",
    null,
    "Atributos",
    "iconoTestProcesoAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseProcesoAcciones",
    null,
    "Acciones",
    "iconoTestProcesoAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testProceso").append(contenidoTest);
}

//*Función para cargar las opciones de Tests de Notficaciones*/
function cargarTestGestionNotificacion() {
  $("#testNotificacion").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarNotificacion",
    "javascript:testNotificacion('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestNotificacionAtributosInsertar",
    "cabeceraAtributosNotificacionInsertar",
    "cuerpoAtributosNotificacionInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseNotificacionAtributoBuscar",
    "javascript:testNotificacion('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestNotificacionAtributosBuscar",
    "cabeceraAtributosNotificacionBuscar",
    "cuerpoAtributosNotificacionBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseNotificacionAtributoModificar",
    "javascript:testNotificacion('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestNotificacionAtributosModificar",
    "cabeceraAtributosNotificacionModificar",
    "cuerpoAtributosNotificacionModificar",
  ];
  let arraySubAccordionCuatro = [
    "collapseAtributosBorrarNotificacion",
    "javascript:testNotificacion('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestNotificacionAtributosBorrar",
    "cabeceraAtributosNotificacionBorrar",
    "cuerpoAtributosNotificacionBorrar",
  ];
  let arraySubAccordionCinco = [
    "collapseNotificacionAtributoVerEnDetalle",
    "javascript:testNotificacion('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestNotificacionAtributosVerEnDetalle",
    "cabeceraAtributosNotificacionVerEnDetalle",
    "cuerpoAtributosNotificacionVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseNotificacionAccionesInsertar",
    "javascript:testNotificacion('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestNotificacionAccionesInsertar",
    "cabeceraAccionesNotificacionInsertar",
    "cuerpoAccionesNotificacionInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseNotificacionAccionesBuscar",
    "javascript:testNotificacion('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestNotificacionAccionesBuscar",
    "cabeceraAccionesNotificacionBuscar",
    "cuerpoAccionesNotificacionBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseNotificacionAccionesModificar",
    "javascript:testNotificacion('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestNotificacionAccionesModificar",
    "cabeceraAccionesNotificacionModificar",
    "cuerpoAccionesNotificacionModificar",
  ];
  let arraySubAccordionNueve = [
    "collapseNotificacioncAcionesBorrar",
    "javascript:testNotificacion('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestNotificacionAccionesBorrar",
    "cabeceraAccionesNotificacionBorrar",
    "cuerpoAccionesNotificacionBorrar",
  ];
  let arraySubAccordionDiez = [
    "collapseNotificacionAccionesVerEnDetalle",
    "javascript:testNotificacion('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestNotificacionAccionesVerEnDetalle",
    "cabeceraAccionesNotificacionVerEnDetalle",
    "cuerpoAccionesNotificacionVerEnDetalle",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve,
    arraySubAccordionDiez
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseNotificacionAtributos",
    null,
    "Atributos",
    "iconoTestNotificacionAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseNotificacionAcciones",
    null,
    "Acciones",
    "iconoTestNotificacionAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testNotificacion").append(contenidoTest);
}

//*Función para cargar las opciones de Tests de Parametros*/
function cargarTestGestionParametro() {
  $("#testParametro").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarParametro",
    "javascript:testParametro('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestParametroAtributosInsertar",
    "cabeceraAtributosParametroInsertar",
    "cuerpoAtributosParametroInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseParametroAtributoBuscar",
    "javascript:testParametro('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestParametroAtributosBuscar",
    "cabeceraAtributosParametroBuscar",
    "cuerpoAtributosParametroBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseParametroAtributoModificar",
    "javascript:testParametro('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestParametroAtributosModificar",
    "cabeceraAtributosParametroModificar",
    "cuerpoAtributosParametroModificar",
  ];
  /*let arraySubAccordionCuatro = [
    "collapseAtributosBorrarParametro",
    "javascript:testParametro('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestParametroAtributosBorrar",
    "cabeceraAtributosParametroBorrar",
    "cuerpoAtributosParametroBorrar",
  ];*/
  let arraySubAccordionCinco = [
    "collapseParametroAtributoVerEnDetalle",
    "javascript:testParametro('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestParametroAtributosVerEnDetalle",
    "cabeceraAtributosParametroVerEnDetalle",
    "cuerpoAtributosParametroVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    //arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseParametroAccionesInsertar",
    "javascript:testParametro('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestParametroAccionesInsertar",
    "cabeceraAccionesParametroInsertar",
    "cuerpoAccionesParametroInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseParametroAccionesBuscar",
    "javascript:testParametro('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestParametroAccionesBuscar",
    "cabeceraAccionesParametroBuscar",
    "cuerpoAccionesParametroBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseParametroAccionesModificar",
    "javascript:testParametro('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestParametroAccionesModificar",
    "cabeceraAccionesParametroModificar",
    "cuerpoAccionesParametroModificar",
  ];
  /*let arraySubAccordionNueve = [
    "collapseParametrocAcionesBorrar",
    "javascript:testParametro('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestParametroAccionesBorrar",
    "cabeceraAccionesParametroBorrar",
    "cuerpoAccionesParametroBorrar",
  ];*/
  let arraySubAccordionDiez = [
    "collapseParametroAccionesVerEnDetalle",
    "javascript:testParametro('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestParametroAccionesVerEnDetalle",
    "cabeceraAccionesParametroVerEnDetalle",
    "cuerpoAccionesParametroVerEnDetalle",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    //arraySubAccordionNueve,
    arraySubAccordionDiez
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseParametroAtributos",
    null,
    "Atributos",
    "iconoTestParametroAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseParametroAcciones",
    null,
    "Acciones",
    "iconoTestParametroAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testParametro").append(contenidoTest);
}

//*Función para cargar las opciones de Tests de Proceso Usuario Ejecucion*/
function cargarTestProcesoUsuarioEjecucion() {
  $("#testProcesoUsuarioEjecucion").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarProcesoUsuarioEjecucion",
    "javascript:testProcesoUsuarioEjecucion('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestProcesoUsuarioEjecucionAtributosInsertar",
    "cabeceraAtributosProcesoUsuarioEjecucionInsertar",
    "cuerpoAtributosProcesoUsuarioEjecucionInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseTestProcesoUsuarioEjecucionAtributoBuscar",
    "javascript:testProcesoUsuarioEjecucion('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestProcesoUsuarioEjecucionAtributosBuscar",
    "cabeceraAtributosProcesoUsuarioEjecucionBuscar",
    "cuerpoAtributosProcesoUsuarioEjecucionBuscar",
  ];
  /*let arraySubAccordionTres = [
    "collapseTestProcesoUsuarioEjecucionAtributoModificar",
    "javascript:testProcesoUsuarioEjecucion('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestProcesoUsuarioEjecucionAtributosModificar",
    "cabeceraAtributosProcesoUsuarioEjecucionModificar",
    "cuerpoAtributosProcesoUsuarioEjecucionModificar",
  ];*/
  let arraySubAccordionCuatro = [
    "collapseAtributosBorrarTestProcesoUsuarioEjecucion",
    "javascript:testProcesoUsuarioEjecucion('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestProcesoUsuarioEjecucionAtributosBorrar",
    "cabeceraAtributosProcesoUsuarioEjecucionBorrar",
    "cuerpoAtributosProcesoUsuarioEjecucionBorrar",
  ];
  let arraySubAccordionCinco = [
    "collapseTestProcesoUsuarioEjecucionAtributoVerEnDetalle",
    "javascript:testProcesoUsuarioEjecucion('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestProcesoUsuarioEjecucionAtributosVerEnDetalle",
    "cabeceraAtributosProcesoUsuarioEjecucionVerEnDetalle",
    "cuerpoAtributosProcesoUsuarioEjecucionVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    //arraySubAccordionTres,
    arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseTestProcesoUsuarioEjecucionAccionesInsertar",
    "javascript:testProcesoUsuarioEjecucion('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestProcesoUsuarioEjecucionAccionesInsertar",
    "cabeceraAccionesProcesoUsuarioEjecucionInsertar",
    "cuerpoAccionesProcesoUsuarioEjecucionInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseTestProcesoUsuarioEjecucionAccionesBuscar",
    "javascript:testProcesoUsuarioEjecucion('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestProcesoUsuarioEjecucionAccionesBuscar",
    "cabeceraAccionesProcesoUsuarioEjecucionBuscar",
    "cuerpoAccionesProcesoUsuarioEjecucionBuscar",
  ];
  /*let arraySubAccordionOcho = [
    "collapseTestProcesoUsuarioEjecucionAccionesModificar",
    "javascript:testProcesoUsuarioEjecucion('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestProcesoUsuarioEjecucionAccionesModificar",
    "cabeceraAccionesProcesoUsuarioEjecucionModificar",
    "cuerpoAccionesProcesoUsuarioEjecucionModificar",
  ];*/
  let arraySubAccordionNueve = [
    "collapseTestProcesoUsuarioEjecucioncAcionesBorrar",
    "javascript:testProcesoUsuarioEjecucion('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestProcesoUsuarioEjecucionAccionesBorrar",
    "cabeceraAccionesProcesoUsuarioEjecucionBorrar",
    "cuerpoAccionesProcesoUsuarioEjecucionBorrar",
  ];
  let arraySubAccordionDiez = [
    "collapseTestProcesoUsuarioEjecucionAccionesVerEnDetalle",
    "javascript:testProcesoUsuarioEjecucion('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestProcesoUsuarioEjecucionAccionesVerEnDetalle",
    "cabeceraAccionesProcesoUsuarioEjecucionVerEnDetalle",
    "cuerpoAccionesProcesoUsuarioEjecucionVerEnDetalle",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    //arraySubAccordionOcho,
    arraySubAccordionNueve,
    arraySubAccordionDiez
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseTestProcesoUsuarioEjecucionAtributos",
    null,
    "Atributos",
    "iconoTestProcesoUsuarioEjecucionAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseTestProcesoUsuarioEjecucionAcciones",
    null,
    "Acciones",
    "iconoTestProcesoUsuarioEjecucionAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);

  $("#testProcesoUsuarioEjecucion").append(contenidoTest);
}

//*Función para cargar las opciones de Tests de Proceso Usuario Ejecucion Parametro*/
function cargarTestProcesoUsuarioEjecucionParametro() {
  $("#testProcesoUsuarioEjecucionParametro").html("");

  let arraySubAccordionUno = [
    "collapseAtributosInsertarProcesoUsuarioEjecucionParametro",
    "javascript:testProcesoUsuarioEjecucionParametro('Insertar', 'Atributos')",
    "Añadir",
    "iconoTestProcesoUsuarioEjecucionParametroAtributosInsertar",
    "cabeceraAtributosProcesoUsuarioEjecucionParametroInsertar",
    "cuerpoAtributosProcesoUsuarioEjecucionParametroInsertar",
  ];
  let arraySubAccordionDos = [
    "collapseTestProcesoUsuarioEjecucionParametroAtributoBuscar",
    "javascript:testProcesoUsuarioEjecucionParametro('Buscar', 'Atributos')",
    "Buscar",
    "iconoTestProcesoUsuarioEjecucionParametroAtributosBuscar",
    "cabeceraAtributosProcesoUsuarioEjecucionParametroBuscar",
    "cuerpoAtributosProcesoUsuarioEjecucionParametroBuscar",
  ];
  let arraySubAccordionTres = [
    "collapseTestProcesoUsuarioEjecucionParametroAtributoModificar",
    "javascript:testProcesoUsuarioEjecucionParametro('Modificar', 'Atributos')",
    "Modificar",
    "iconoTestProcesoUsuarioEjecucionParametroAtributosModificar",
    "cabeceraAtributosProcesoUsuarioEjecucionParametroModificar",
    "cuerpoAtributosProcesoUsuarioEjecucionParametroModificar",
  ];
  /*let arraySubAccordionCuatro = [
    "collapseAtributosBorrarTestProcesoUsuarioEjecucionParametro",
    "javascript:testProcesoUsuarioEjecucionParametro('Borrar', 'Atributos')",
    "Borrar",
    "iconoTestProcesoUsuarioEjecucionParametroAtributosBorrar",
    "cabeceraAtributosProcesoUsuarioEjecucionParametroBorrar",
    "cuerpoAtributosProcesoUsuarioEjecucionParametroBorrar",
  ];*/
  let arraySubAccordionCinco = [
    "collapseTestProcesoUsuarioEjecucionParametroAtributoVerEnDetalle",
    "javascript:testProcesoUsuarioEjecucionParametro('VerEnDetalle', 'Atributos')",
    "Ver en detalle",
    "iconoTestProcesoUsuarioEjecucionParametroAtributosVerEnDetalle",
    "cabeceraAtributosProcesoUsuarioEjecucionParametroVerEnDetalle",
    "cuerpoAtributosProcesoUsuarioEjecucionParametroVerEnDetalle",
  ];
  let arrayAccordionUno = [
    "accordion10",
    arraySubAccordionUno,
    arraySubAccordionDos,
    arraySubAccordionTres,
    //arraySubAccordionCuatro,
    arraySubAccordionCinco,
  ];

  let arraySubAccordionSeis = [
    "collapseTestProcesoUsuarioEjecucionParametroAccionesInsertar",
    "javascript:testProcesoUsuarioEjecucionParametro('Insertar', 'Acciones')",
    "Añadir",
    "iconoTestProcesoUsuarioEjecucionParametroAccionesInsertar",
    "cabeceraAccionesProcesoUsuarioEjecucionParametroInsertar",
    "cuerpoAccionesProcesoUsuarioEjecucionParametroInsertar",
  ];
  let arraySubAccordionSiete = [
    "collapseTestProcesoUsuarioEjecucionParametroAccionesBuscar",
    "javascript:testProcesoUsuarioEjecucionParametro('Buscar', 'Acciones')",
    "Buscar",
    "iconoTestProcesoUsuarioEjecucionParametroAccionesBuscar",
    "cabeceraAccionesProcesoUsuarioEjecucionParametroBuscar",
    "cuerpoAccionesProcesoUsuarioEjecucionParametroBuscar",
  ];
  let arraySubAccordionOcho = [
    "collapseTestProcesoUsuarioEjecucionParametroAccionesModificar",
    "javascript:testProcesoUsuarioEjecucionParametro('Modificar', 'Acciones')",
    "Modificar",
    "iconoTestProcesoUsuarioEjecucionParametroAccionesModificar",
    "cabeceraAccionesProcesoUsuarioEjecucionParametroModificar",
    "cuerpoAccionesProcesoUsuarioEjecucionParametroModificar",
  ];
  let arraySubAccordionNueve = [
    "collapseTestProcesoUsuarioEjecucionParametroAcionesBorrar",
    "javascript:testProcesoUsuarioEjecucionParametro('Borrar', 'Acciones')",
    "Borrar",
    "iconoTestProcesoUsuarioEjecucionParametroAccionesBorrar",
    "cabeceraAccionesProcesoUsuarioEjecucionParametroBorrar",
    "cuerpoAccionesProcesoUsuarioEjecucionParametroBorrar",
  ];
  let arraySubAccordionDiez = [
    "collapseTestProcesoUsuarioEjecucionParametroAccionesVerEnDetalle",
    "javascript:testProcesoUsuarioEjecucionParametro('VerEnDetalle', 'Acciones')",
    "Ver en detalle",
    "iconoTestProcesoUsuarioEjecucionParametroAccionesVerEnDetalle",
    "cabeceraAccionesProcesoUsuarioEjecucionParametroVerEnDetalle",
    "cuerpoAccionesProcesoUsuarioEjecucionParametroVerEnDetalle",
  ];
  let arrayAccordionDos = [
    "accordion11",
    arraySubAccordionSeis,
    arraySubAccordionSiete,
    arraySubAccordionOcho,
    arraySubAccordionNueve,
    arraySubAccordionDiez
  ];

  let arrayAccordionTres = [
    "accordion9",
    "collapseTestProcesoUsuarioEjecucionParametroAtributos",
    null,
    "Atributos",
    "iconoTestProcesoUsuarioEjecucionParametroAtributos",
    null,
    null,
    arrayAccordionUno,
    "collapseTestProcesoUsuarioEjecucionParametroAcciones",
    null,
    "Acciones",
    "iconoTestProcesoUsuarioEjecucionParametroAcciones",
    null,
    null,
    arrayAccordionDos,
  ];

  var contenidoTest = createTest(arrayAccordionTres);
  $("#testProcesoUsuarioEjecucionParametro").append(contenidoTest);
}