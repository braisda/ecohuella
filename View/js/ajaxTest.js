/**Función para recuperar los test con ajax y promesas*/
function test(code, codeFracaso, controladorTest, actionTest) {
  var lang = getCookie("lang");
  var token = getCookie("token");

  createHideFormNoAction("formularioTest");
  insertField(document.formularioTest, "controller", controladorTest);
  insertField(document.formularioTest, "action", actionTest);

  if (token == null) {
    authenticationError("ACCESO_DENEGADO", lang);
  } else {
    return new Promise(function (resolve, reject) {
      $.ajax({
        method: "POST",
        url: URL_TEST,
        data: $("#formularioTest").serialize(),
        headers: { Authorization: token },
      })
        .done((res) => {
          if (res.code != code && res.code != codeFracaso) {
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////AUTH////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Función que obtiene los test de autenticacion */
async function testAutenticacion(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "autenticacionAtributos";
      switch (accion) {
        case "Login":
          code = "PETICION_TEST_LOGIN_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_LOGIN_ATRIBUTOS_FRACASO";
          actionTest = "login";
          break;
        case "Registro":
          code = "PETICION_TEST_REGISTRO_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_REGISTRO_ATRIBUTOS_FRACASO";
          actionTest = "registrar";
          break;
        case "ObtenerContrasenaCorreo":
          code = "PETICION_TEST_OBTENER_CONTRASENA_CORREO_ATRIBUTOS_EXITO";
          codeFracaso =
            "PETICION_TEST_OBTENER_CONTRASENA_CORREO_ATRIBUTOS_FRACASO";
          actionTest = "obtenerContrasenaCorreo";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "autenticacionAcciones";
      switch (accion) {
        case "Login":
          code = "PETICION_TEST_LOGIN_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_LOGIN_ACCIONES_FRACASO";
          actionTest = "login";
          break;
        case "Registro":
          code = "PETICION_TEST_REGISTRO_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_REGISTRO_ACCIONES_FRACASO";
          actionTest = "registrar";
          break;
        case "ObtenerContrasenaCorreo":
          code = "PETICION_TEST_OBTENER_CONTRASENA_CORREO_ACCIONES_EXITO";
          codeFracaso =
            "PETICION_TEST_OBTENER_CONTRASENA_CORREO_ACCIONES_FRACASO";
          actionTest = "obtenerContrasenaCorreo";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestAuth",
        "iconoTestAutenticacion" + tipoTest,
        "iconoTestAutenticacion" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "Autenticacion" + accion,
        "cuerpo" + tipoTest + "Autenticacion" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////GESTION DE USUARIOS///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Función que obtiene los test de usuario */
async function testUsuario(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "usuarioAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_USUARIO_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_USUARIO_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_USUARIO_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_USUARIO_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_USUARIO_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
        case "EditarContrasena":
          code = "PETICION_TEST_USUARIO_EDITARCONTRASENA_ATRIBUTOS_EXITO";
          codeFracaso =
            "PETICION_TEST_USUARIO_EDITARCONTRASENA_ATRIBUTOS_FRACASO";
          actionTest = "editarContrasena";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "usuarioAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_USUARIO_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_USUARIO_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_USUARIO_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_USUARIO_BORRAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_BORRAR_ACCIONES_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_USUARIO_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_USUARIO_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
        case "EditarContrasena":
          code = "PETICION_TEST_USUARIO_EDITARCONTRASENA_ACCIONES_EXITO";
          codeFracaso =
            "PETICION_TEST_USUARIO_EDITARCONTRASENA_ACCIONES_FRACASO";
          actionTest = "editarContrasena";
          break;
      }
      break;
  }


  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestUsuario",
        "iconoTestUsuario" + tipoTest,
        "iconoTestUsuario" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "Usuario" + accion,
        "cuerpo" + tipoTest + "Usuario" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////GESTION DE ACCIÓN-FUNCIONALIDAD//////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

async function testAccionFuncionalidad(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "accionFuncionalidadAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_ACCION_FUNCIONALIDAD_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Eliminar":
          code = "PETICION_TEST_ACCION_FUNCIONALIDAD_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "eliminar";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "accionFuncionalidadAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_ACCION_FUNCIONALIDAD_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Eliminar":
          code = "PETICION_TEST_ACCION_FUNCIONALIDAD_ELIMINAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_ELIMINAR_ACCIONES_FRACASO";
          actionTest = "eliminar";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestAccionFuncionalidad",
        "iconoTestAccionFuncionalidad" + tipoTest,
        "iconoTestAccionFuncionalidad" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "AccionFuncionalidad" + accion,
        "cuerpo" + tipoTest + "AccionFuncionalidad" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////GESTION DE ROL-ACCIÓN-FUNCIONALIDAD//////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

async function testRolAccionFuncionalidad(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "rolAccionFuncionalidadAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Borrar":
          code = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "eliminar";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "rolAccionFuncionalidadAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Borrar":
          code = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_ELIMINAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_ROL_ACCION_FUNCIONALIDAD_ELIMINAR_ACCIONES_FRACASO";
          actionTest = "eliminar";
          break;
      }
      break;
  }
  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestRolAccionFuncionalidad",
        "iconoTestRolAccionFuncionalidad" + tipoTest,
        "iconoTestRolAccionFuncionalidad" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "RolAccionFuncionalidad" + accion,
        "cuerpo" + tipoTest + "RolAccionFuncionalidad" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////GESTION DE CATEGORIAS///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Función que obtiene los test de categoria */
async function testCategoria(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "categoriaAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_CATEGORIA_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_CATEGORIA_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_CATEGORIA_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_CATEGORIA_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_CATEGORIA_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "categoriaAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_CATEGORIA_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_CATEGORIA_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_CATEGORIA_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_CATEGORIA_BORRAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_BORRAR_ACCIONES_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_CATEGORIA_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_CATEGORIA_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestCategoria",
        "iconoTestCategoria" + tipoTest,
        "iconoTestCategoria" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "Categoria" + accion,
        "cuerpo" + tipoTest + "Categoria" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////GESTION DE PROCESOS///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Función que obtiene los test de proceso */
async function testProceso(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "procesoAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PROCESO_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PROCESO_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PROCESO_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PROCESO_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "procesoAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PROCESO_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PROCESO_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PROCESO_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PROCESO_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestProceso",
        "iconoTestProceso" + tipoTest,
        "iconoTestProceso" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "Proceso" + accion,
        "cuerpo" + tipoTest + "Proceso" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////GESTION DE NOTIFICACIONES///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Función que obtiene los test de notificacion */
async function testNotificacion(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "notificacionAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_NOTIFICACION_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_NOTIFICACION_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_NOTIFICACION_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_NOTIFICACION_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_NOTIFICACION_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "notificacionAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_NOTIFICACION_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_NOTIFICACION_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_NOTIFICACION_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_NOTIFICACION_BORRAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_BORRAR_ACCIONES_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_NOTIFICACION_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_NOTIFICACION_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestNotificacion",
        "iconoTestNotificacion" + tipoTest,
        "iconoTestNotificacion" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "Notificacion" + accion,
        "cuerpo" + tipoTest + "Notificacion" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////GESTION DE PARAMETROS///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

/*Función que obtiene los test de parametro */
async function testParametro(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "parametroAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PARAMETRO_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PARAMETRO_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PARAMETRO_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_PARAMETRO_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PARAMETRO_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "parametroAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PARAMETRO_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PARAMETRO_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PARAMETRO_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_PARAMETRO_BORRAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_BORRAR_ACCIONES_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PARAMETRO_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PARAMETRO_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestParametro",
        "iconoTestParametro" + tipoTest,
        "iconoTestParametro" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "Parametro" + accion,
        "cuerpo" + tipoTest + "Parametro" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

/*Función que obtiene los test de Proceso Usuario Ejecucion */
async function testProcesoUsuarioEjecucion(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "procesoUsuarioEjecucionAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "procesoUsuarioEjecucionAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ACCIONES_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestProcesoUsuarioEjecucion",
        "iconoTestProcesoUsuarioEjecucion" + tipoTest,
        "iconoTestProcesoUsuarioEjecucion" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "ProcesoUsuarioEjecucion" + accion,
        "cuerpo" + tipoTest + "ProcesoUsuarioEjecucion" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}

/*Función que obtiene los test de Proceso Usuario Ejecucion */
async function testProcesoUsuarioEjecucionParametro(accion, tipoTest) {
  imagenErrorTestOcultar();

  var code = "";
  var codeFracaso = "";
  var controladorTest = "";
  var actionTest = "";

  switch (tipoTest) {
    case "Atributos":
      controladorTest = "procesoUsuarioEjecucionParametroAtributos";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ATRIBUTOS_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ATRIBUTOS_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ATRIBUTOS_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BORRAR_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BORRAR_ATRIBUTOS_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ATRIBUTOS_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ATRIBUTOS_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
    case "Acciones":
      controladorTest = "procesoUsuarioEjecucionParametroAcciones";
      switch (accion) {
        case "Insertar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ACCIONES_FRACASO";
          actionTest = "insertar";
          break;
        case "Buscar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ACCIONES_FRACASO";
          actionTest = "buscar";
          break;
        case "Modificar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ACCIONES_FRACASO";
          actionTest = "editar";
          break;
        case "Borrar":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BORRAR_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BORRAR_ACCIONES_FRACASO";
          actionTest = "borrar";
          break;
        case "VerEnDetalle":
          code = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ACCIONES_EXITO";
          codeFracaso = "PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ACCIONES_FRACASO";
          actionTest = "verEnDetalle";
          break;
      }
      break;
  }

  await test(code, codeFracaso, controladorTest, actionTest)
    .then((res) => {
      let idElementoList = [
        "iconoTestProcesoUsuarioEjecucionParametro",
        "iconoTestProcesoUsuarioEjecucionParametro" + tipoTest,
        "iconoTestProcesoUsuarioEjecucionParametro" + tipoTest + accion,
      ];
      cargarRespuestaOkTest(
        res.datos,
        "cabecera" + tipoTest + "ProcesoUsuarioEjecucionParametro" + accion,
        "cuerpo" + tipoTest + "ProcesoUsuarioEjecucionParametro" + accion,
        "",
        "",
        idElementoList,
        tipoTest.toLowerCase()
      );
    })
    .catch((res) => {
      cargarModalErroresTest();
    });
  removeFields();
}