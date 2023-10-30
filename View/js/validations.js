/**Function that validate the user.*/
function checkUserDNI(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (checkNotEmpty(elementId, elementIdError, field) &&
    checkLettersNumbers(elementId, elementIdError, field) &&
    checkMinLength(elementId, 9, elementIdError, field) &&
    checkMaxLength(elementId, 9, elementIdError, field) &&
    checkEnhe(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

/**Function that validate the user's password.*/
function checkPass(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (checkNotEmpty(elementId, elementIdError, field) &&
    checkLettersNumbers(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field) &&
    checkEnhe(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function verificarPasswd() {
  passwdUsuario1 = $("#passwdUsuario1").val();
  passwdUsuario2 = $("#passwdUsuario2").val();

  if (passwdUsuario1 != passwdUsuario2) {
    addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
    return false;
  } else {
    $("#error").removeClass();
    $("#error").html("");
    $("#error").css("display", "none");
    return true;
  }
}

/**Función que valida si un field está vacío*/
function checkNotEmpty(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;
  var length = document.getElementById(elementId).value.length;

  if (value == null || length == 0) {
    switch (field) {
      case "userLogin":
        code = "LOGIN_USUARIO_VACIO";
        break;
      case "passwdUserLogin":
        code = "CONTRASENA_USUARIO_VACIA";
        break;
      case "passUserLogin":
        code = "CONTRASENA_USUARIO_VACIA";
        break;
      case "passwdUserRegister":
        code = "CONTRASENA_USUARIO_VACIA";
        break;
      case "passUserRegister":
        code = "CONTRASENA_USUARIO_VACIA";
        break;
      case "passwordChange":
        code = "CONTRASENA_USUARIO_VACIA";
        break;
      case "emailUsuarioRecPass":
        code = "EMAIL_VACIO";
        break;
      case "personDni":
        code = "DNI_VACIO";
        break;
      case "namePersonRegister":
        code = "NOMBRE_VACIO";
        break;
      case "nameCategoryRegister":
        code = "NOMBRE_VACIO";
        break;
      case "nameParameterRegister":
        code = "NOMBRE_VACIO";
        break;
      case "nameProcessRegister":
        code = "NOMBRE_VACIO";
        break;
      case "surnamePersonRegister":
        code = "APELLIDOS_VACIO";
        break;
      case "datePersonRegister":
        code = "FECHA_NACIMIENTO_VACIA";
        break;
      case "addressPersonRegister":
        code = "DIRECCION_VACIA";
        break;
      case "phonePersonRegister":
        code = "TELEFONO_VACIO";
        break;
      case "emailPersonRegister":
        code = "EMAIL_VACIO";
        break;
      case "passwordChange":
        code = "CONTRASENA_USUARIO_VACIA";
        break;
      case "loginUsuarioRecPass":
        code = "LOGIN_USUARIO_VACIO";
        break;
      case "descriptionCategoryRegister":
        code = "DESCRIPCION_VACIO";
        break;
      case "descriptionParameterRegister":
        code = "DESCRIPCION_VACIO";
        break;
      case "descriptionProcessRegister":
        code = "DESCRIPCION_VACIO";
        break;
      case "formulaProcessRegister":
        code = "FORMULA_VACIA";
        break;
      case "paramExploreRegister":
        code = "PARAMETRO_VACIO";
        break;
      case "unitParameterRegister":
        code = "UNIDAD_VACIO";
        break;
      case "procesoParameterRegister":
        code = "PROCESO_VACIO";
        break;
      case "versionParameterRegister":
        code = "VERSION_VACIO";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  } else {
    return true;
  }
}

/**Function that validates that a field contains letters and numbers.**/
function checkLettersNumbers(idElement, idElementError, field) {
  var code = "";

  var value = document.getElementById(idElement).value;

  var pattern = /^[a-zA-Z0-9\u00f1\u00d1]+$/;

  if (!pattern.test(value)) {
    switch (field) {
      case "loginUsuario":
        code = "LOGIN_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passwdUserLogin":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passwdUserRegister":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passwordChange":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passUserRegister":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "personDni":
        code = "DNI_ALFANUMERICO_INCORRECTO";
      case "loginUsuarioRecPass":
        code = "LOGIN_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
    }

    addCodeError(idElementError, code);
    return false;
  } else {
    return true;
  }
}

/**Function that validates the minimun length of a field.**/
function checkMinLength(elementId, sizeMin, elementIdError, field) {
  var code = "";

  var longitud = document.getElementById(elementId).value.length;

  if (longitud < sizeMin) {
    switch (field) {
      case "loginUsuario":
        code = "LOGIN_USUARIO_MENOR_QUE_3";
        break;
      case "passwdUserLogin":
        code = "CONTRASENA_USUARIO_MENOR_QUE_3";
        break;
      case "passwdUserRegister":
        code = "CONTRASENA_USUARIO_MENOR_QUE_3";
        break;
      case "passUserRegister":
        code = "CONTRASENA_USUARIO_MENOR_QUE_3";
        break;
      case "passwordChange":
        code = "CONTRASENA_USUARIO_MENOR_QUE_3";
        break;
      case "personDni":
        code = "DNI_USUARIO_MENOR_QUE_9";
        break;
      case "phonePersonRegister":
        code = "PHONE_USUARIO_MENOR_QUE_9";
        break;
      case "addressPersonRegister":
        code = "ADDRESS_USUARIO_MENOR_QUE_5";
        break;
      case "loginUsuarioRecPass":
        code = "LOGIN_USUARIO_MENOR_QUE_3";
        break;
      case "namePersonRegister":
        code = "NOMBRE_MENOR_QUE_3";
        break;
      case "surnamePersonRegister":
        code = "APELLIDOS_MENOR_QUE_3";
        break;
      case "nameCategoryRegister":
        code = "NOMBRE_MENOR_QUE_3";
        break;
      case "nameProcessRegister":
        code = "NOMBRE_MENOR_QUE_3";
        break;
      case "nameParameterRegister":
        code = "NOMBRE_MENOR_QUE_3";
        break;
      case "descriptionCategoryRegister":
        code = "DESCRIPCION_MENOR_QUE_3";
        break;
      case "descriptionProcessRegister":
        code = "DESCRIPCION_MENOR_QUE_3";
        break;
      case "descriptionParameterRegister":
        code = "DESCRIPCION_MENOR_QUE_3";
        break;
      case "formulaProcessRegister":
        code = "FORMULA_MENOR_QUE_3";
        break;
      case "unitParameterRegister":
        code = "UNIDAD_MENOR_QUE_1";
        break;
      case "userLogin":
        code = "DNI_MENOR_QUE_9";
        break;
    }

    addCodeError(elementIdError, code);
    return false;
  } else {
    return true;
  }
}

/**Function that check the max length of a field.**/
function checkMaxLength(elementId, sizeMax, elementIdError, field) {
  var code = "";

  var longitud = document.getElementById(elementId).value.length;

  if (longitud > sizeMax) {
    switch (field) {
      case "loginUsuario":
        code = "LOGIN_USUARIO_MAYOR_QUE_15";
        break;
      case "passwdUserLogin":
        code = "CONTRASENA_USUARIO_MAYOR_QUE_45";
        break;
      case "passwdUserRegister":
        code = "CONTRASENA_USUARIO_MAYOR_QUE_45";
        break;
      case "passUserRegister":
        code = "CONTRASENA_USUARIO_MAYOR_QUE_45";
        break;
      case "passwordChange":
        code = "CONTRASENA_USUARIO_MAYOR_QUE_45";
        break;
      case "personDni":
        code = "DNI_USUARIO_MAYOR_QUE_9";
        break;
      case "phonePersonRegister":
        code = "PHONE_USUARIO_MAYOR_QUE_9";
        break;
      case "addressPersonRegister":
        code = "ADDRESS_USUARIO_MAYOR_QUE_200";
        break;
      case "loginUsuarioRecPass":
        code = "LOGIN_USUARIO_MENOR_QUE_3";
        break;
      case "nameCategoryRegister":
        code = "NOMBRE_MAYOR_QUE_45";
        break;
      case "nameProcessRegister":
        code = "NOMBRE_MAYOR_QUE_45";
        break;
      case "descriptionCategoryRegister":
        code = "DESCRIPCION_MAYOR_QUE_500";
        break;
      case "descriptionProcessRegister":
        code = "DESCRIPCION_MAYOR_QUE_500";
        break;
      case "formulaProcessRegister":
        code = "FORMULA_MAYOR_QUE_500";
        break;
      case "userLogin":
        code = "DNI_MAYOR_QUE_9";
        break;
    }

    addCodeError(elementIdError, code);
    return false;
  } else {
    return true;
  }
}

/**Function that check a field not contains ñ.**/
function checkEnhe(elementId, elementIdError, field) {
  var code = "";
  var value = document.getElementById(elementId).value;
  var pattern = /[ñÑ]/;

  if (pattern.test(value)) {
    switch (field) {
      case "loginUsuario":
        code = "LOGIN_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passwdUserLogin":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passwdUserRegister":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "passwordChange":
        code = "CONTRASEÑA_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
      case "personDni":
        code = "DNI_ALFANUMERICO_INCORRECTO";
        break;
      case "loginUsuarioRecPass":
        code = "LOGIN_USUARIO_ALFANUMERICO_INCORRECTO";
        break;
    }

    addCodeError(elementIdError, code);
    return false;
  } else {
    return true;
  }
}

/**Function to add error messages.*/
function addCodeError(elementIdError, code) {
  var lang = getCookie("lang");

  $("#" + elementIdError).removeClass();
  $("#" + elementIdError).addClass(code);
  $("#" + elementIdError).addClass("alert alert-danger");

  setLang(lang);
}

/**Function to add warning messages.*/
function addCodeWarning(elementIdError, code) {
  var lang = getCookie("lang");

  $("#" + elementIdError).removeClass();
  $("#" + elementIdError).addClass(code);
  $("#" + elementIdError).addClass("alert alert-warning");

  setLang(lang);
}

/** Function to show success message.*/
function checkOK(elementId, elementIdError) {
  document.getElementById(elementIdError).style.display = "none";
  document.getElementById(elementId).style.borderColor = "#00e600";
}

/** Function to show error message.*/
function checkKO(elementId, elementIdError) {
  document.getElementById(elementIdError).setAttribute("style", "");
  document.getElementById(elementId).style.borderColor = "#ff0000";
}

function checkName(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkOnlyLettersAndNumbers(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkDescription(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkOnlyLettersAndNumbers(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 500, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkSurname(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";
  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkOnlyLetters(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkBirthDate(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 10, elementIdError, field) &&
    checkFormatDates(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkAddress(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkMinLength(elementId, 5, elementIdError, field) &&
    checkMaxLength(elementId, 200, elementIdError, field) &&
    checkLettersNumbersCaracteres(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkPhone(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkMinLength(elementId, 9, elementIdError, field) &&
    checkMaxLength(elementId, 9, elementIdError, field) &&
    checkOnlyNumbers(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkEmail(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkFormatEmail(elementId, elementIdError, field) &&
    checkMinLength(elementId, 6, elementIdError, field) &&
    checkMaxLength(elementId, 40, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkPassConfirmChangePass(idElemento, idElementoError, campo) {
  document.getElementById(idElemento).style.borderWidth = "2px";

  if (
    checkNotEmpty(idElemento, idElementoError, campo) &&
    checkLettersNumbers(idElemento, idElementoError, campo) &&
    checkMinLength(idElemento, 3, idElementoError, campo) &&
    checkMaxLength(idElemento, 45, idElementoError, campo) &&
    checkEnhe(idElemento, idElementoError, campo)
  ) {
    checkOK(idElemento, idElementoError);
    if ($("#passChangePass1").val() != $("#passChangePass2").val()) {
      addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
      return false;
    } else {
      $("#error").removeClass();
      $("#error").html("");
      $("#error").css("display", "none");
      return true;
    }
  } else {
    checkKO(idElemento, idElementoError);
    if ($("#passChangePass1").val() != $("#passChangePass2").val()) {
      addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
      return false;
    } else {
      $("#error").removeClass();
      $("#error").html("");
      $("#error").css("display", "none");
    }
    return false;
  }
}

function checkPassRep(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkLettersNumbers(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field) &&
    checkEnhe(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    if ($("#passwdUsuario1").val() != $("#passwdUsuario2").val()) {
      addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
      $("#error").css("display", "block");
      return false;
    } else {
      $("#error").removeClass();
      $("#error").html("");
      $("#error").css("display", "none");
      return true;
    }
  } else {
    checkKO(elementId, elementIdError);
    if ($("#passwdUsuario1").val() != $("#passwdUsuario2").val()) {
      addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
      $("#error").css("display", "block");
      return false;
    } else {
      $("#error").removeClass();
      $("#error").html("");
      $("#error").css("display", "none");
    }
    return false;
  }
}

function checkPassRepAdd(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkLettersNumbers(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field) &&
    checkEnhe(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    if ($("#passUsuario1").val() != $("#passUsuario2").val()) {
      addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
      $("#error").css("display", "block");
      return false;
    } else {
      $("#error").removeClass();
      $("#error").html("");
      $("#error").css("display", "none");
      return true;
    }
  } else {
    checkKO(elementId, elementIdError);
    if ($("#passUsuario1").val() != $("#passUsuario2").val()) {
      addCodeError("error", "CONTRASEÑAS_NO_COINCIDEN");
      $("#error").css("display", "block");
      return false;
    } else {
      $("#error").removeClass();
      $("#error").html("");
      $("#error").css("display", "none");
    }
    return false;
  }
}

function checkFormula(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 500, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkUnit(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkOnlyLetters(elementId, elementIdError, field) &&
    checkMinLength(elementId, 1, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkId(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkOnlyNumbers(elementId, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkDescriptionParameter(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";

  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkOnlyLetters(elementId, elementIdError, field) &&
    checkMinLength(elementId, 3, elementIdError, field) &&
    checkMaxLength(elementId, 500, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkParameter(elementId, elementIdError, field) {
  document.getElementById(elementId).style.borderWidth = "2px";
  if (
    checkNotEmpty(elementId, elementIdError, field) &&
    checkMaxLength(elementId, 45, elementIdError, field)
  ) {
    checkOK(elementId, elementIdError);
    return true;
  } else {
    checkKO(elementId, elementIdError);
    return false;
  }
}

function checkOnlyLetters(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;

  var pattern = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/g;

  if (!pattern.test(value)) {
    switch (field) {
      case "namePersonRegister":
        code = "NOMBRE_FORMATO_INCORRECTO";
        break;
      case "surnamePersonRegister":
        code = "APELLIDOS_FORMATO_INCORRECTO";
        break;
      case "nameCategoryRegister":
        code = "NOMBRE_FORMATO_INCORRECTO";
        break;
      case "descriptionCategoryRegister":
        code = "DESCRIPCION_FORMATO_INCORRECTO";
        break;
      case "descriptionProcessRegister":
        code = "DESCRIPCION_FORMATO_INCORRECTO";
        break;
      case "unitParameterRegister":
        code = "UNIDAD_FORMATO_INCORRECTO";
        break;
      case "descriptionParameterRegister":
        code = "DESCRIPCION_PARAMETRO_FORMATO_INCORRECTO";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  }

  return true;
}

function checkOnlyLettersAndNumbers(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;

  var pattern = /^[a-zA-Z0-9À-ÿ\u00f1\u00d1\s]+$/g;

  if (!pattern.test(value)) {
    switch (field) {
      case "namePersonRegister":
        code = "NOMBRE_FORMATO_INCORRECTO";
        break;
      case "nameCategoryRegister":
        code = "NOMBRE_FORMATO_INCORRECTO";
        break;
      case "descriptionCategoryRegister":
        code = "DESCRIPCION_FORMATO_INCORRECTO";
        break;
      case "nameProcessRegister":
        code = "NOMBRE_FORMATO_INCORRECTO";
        break;
      case "descriptionProcessRegister":
        code = "DESCRIPCION_FORMATO_INCORRECTO";
        break;
      case "nameParameterRegister":
        code = "NOMBRE_FORMATO_INCORRECTO";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  }

  return true;
}

function checkFormatDates(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;

  var pattern = /^[0-9]{4}(-)[0-9]{2}(-)[0-9]{2}/g;

  if (!pattern.test(value)) {
    switch (field) {
      case "datePersonRegister":
        code = "FECHA_NACIMIENTO_NUMERICA_INCORRECTA";
        break;
      case "fecha":
        code = "FECHA_NUMERICA_INCORRECTA";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  }

  return true;
}

function checkLettersNumbersCaracteres(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;

  var pattern = /^[a-zA-Z0-9À-ÿ\u00f1\u00d1\u00AA\u00BA///-\s]+$/;

  if (!pattern.test(value)) {
    switch (field) {
      case "addressPersonRegister":
        code = "DIRECCION_FORMATO_INCORRECTO";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  } else {
    return true;
  }
}

function checkOnlyNumbers(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;

  var pattern = /^[0-9]+$/;

  if (!pattern.test(value)) {
    switch (field) {
      case "phonePersonRegister":
        code = "TELEFONO_FORMATO_INCORRECTO";
        break;
      case "procesoParameterRegister":
        code = "ID_PROCESO_ERROR_FORMATO";
        break;
      case "versionParameterRegister":
        code = "VERSION_ERROR_FORMATO";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  } else {
    return true;
  }
}

function checkFormatEmail(elementId, elementIdError, field) {
  var code = "";

  var value = document.getElementById(elementId).value;

  var pattern =
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/; // establecemos un pattern para un email
  if (!pattern.test(value)) {
    switch (field) {
      case "emailUsuarioRecPass":
        code = "EMAIL_ALFANUMERICO_INCORRECTO";
        break;
      case "emailPersonRegister":
        code = "EMAIL_ALFANUMERICO_INCORRECTO";
        break;
    }
    addCodeError(elementIdError, code);
    return false;
  }

  return true;
}

function checkEditUser() {
  if (
    checkUserDNI("input_dni_usuario", "errorFormatoDni", "dniPersona") &&
    checkName(
      "input_nombre_usuario",
      "errorFormatoNombre",
      "nombrePersonaRegistro"
    ) &&
    checkSurname(
      "input_apellidos_usuario",
      "errorFormatoApellidos",
      "apellidosPersonaRegistro"
    ) &&
    checkBirthDate(
      "input_fechaNacimiento_usuario",
      "errorFormatoFecha",
      "fechaPersonaRegistro"
    ) &&
    checkAddress(
      "input_direccion_usuario",
      "errorFormatoDireccion",
      "direccionPersonaRegistro"
    ) &&
    checkPhone(
      "input_telefono_usuario",
      "errorFormatoTelefono",
      "telefonoPersonaRegistro"
    ) &&
    checkEmail(
      "input_email_usuario",
      "errorFormatoEmail",
      "emailPersonaRegistro"
    )
  ) {
    return true;
  } else {
    return false;
  }
}

/** Función que valida el formulario de cambio de contraseña **/
function checkChangePass() {
  if (
    checkPass(
      "passChangePass1",
      "errorFormatoChangePass1",
      "passwordChange"
    ) &&
    checkPassConfirmChangePass(
      "passChangePass2",
      "errorFormatoChangePass2",
      "passwordChange"
    )
  ) {
    return true;
  } else {
    return false;
  }
}