<?php

function pruebaREST_Proceso_Buscar_Atributos()
{

    include_once './Testing/pruebaREST_class.php';

    $pruebas = new testRest();

    $tipo = 'Atributo';
    $vaciarPost = NULL;

    //---------------------------------------------------------------------------------------------------------------------

    //login correcto
    $POST = $vaciarPost;
    $POST['controller'] = 'auth';
    $POST['action'] = 'login';
    $POST['dni'] = '62167251E';
    $POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

    $pruebas->peticionLogin($POST);

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO ID y VERSION
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ID_PROCESO_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['id_proceso'] = '1$';


    $prueba = 'Id de proceso presenta un formato incorrecto';
    $codeEsperado = 'ID_PROCESO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //VERSION_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['version'] = '1$';


    $prueba = 'Version de proceso presenta un formato incorrecto';
    $codeEsperado = 'VERSION_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO NAME
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_NOMBRE_MENOR_QUE_3
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['nombre'] = 'ro';

    $prueba = 'Nombre de proceso menor que 3';
    $codeEsperado = 'NOMBRE_MENOR_QUE_3';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_NOMBRE_MAYOR_QUE_48
    $POST['nombre'] = 'procesoTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

    $prueba = 'Nombre de proceso mayor que 48';
    $codeEsperado = 'NOMBRE_MAYOR_QUE_45';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO DESCRIPCION
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_DESCRIPCION_MENOR_QUE_3
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['descripcion'] = 'ro';

    $prueba = 'Descripcion de proceso menor que 3';
    $codeEsperado = 'DESCRIPCION_MENOR_QUE_3';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_DESCRIPCION_MAYOR_QUE_500
    $POST['descripcion'] = 'Iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii';

    $prueba = 'Descripción de proceso mayor de 500';
    $codeEsperado = 'DESCRIPCION_MAYOR_QUE_500';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO FORMULA
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_FORMULA_MENOR_QUE_3
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['formula'] = 'ro';

    $prueba = 'Formula de proceso menor que 3';
    $codeEsperado = 'FORMULA_MENOR_QUE_3';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_FORMULA_MAYOR_QUE_500
    $POST['formula'] = 'Iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii';

    $prueba = 'Fórmula de proceso mayor de 500';
    $codeEsperado = 'FORMULA_MAYOR_QUE_500';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PARAMETRO_PROCESO_FORMULA_SOBRA_LLAVE_ABRIENDO
    /*$POST['formula'] = '( 4.567 * {Temp(F)} ) * {{CantidadViajesAlAnho}';

    $prueba = 'Formula de proceso con llave abriendo de sobra';
    $codeEsperado = 'PROCESO_FORMULA_SOBRA_LLAVE_ABRIENDO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);*/

    //---------------------------------------------------------------------------------------------------------------------

    //PARAMETRO_PROCESO_FORMULA_SOBRA_LLAVE_CERRANDO
    /*$POST['formula'] = '( 4.567 * {Temp(F)}} ) * {CantidadViajesAlAnho}';

    $prueba = 'Formula de proceso con llave cerrando de sobra';
    $codeEsperado = 'PROCESO_FORMULA_SOBRA_LLAVE_CERRANDO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);*/

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_FORMULA_SOBRA_PARENTESIS_CERRANDO //Dentro del parámetro hay caracteres no válidos
    /*$POST['formula'] = '( 4.567 * {Temp(F))} ) * {CantidadViajesAlAnho}';

    $prueba = 'Formula de proceso con paréntesis cerrando de sobra';
    $codeEsperado = 'PROCESO_FORMULA_SOBRA_PARENTESIS_CERRANDO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);*/

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_FORMULA_SOBRA_PARENTESIS_ABRIENDO //La unidad del parámetro contiene caracteres reservados a los operadores
    /*$POST['formula'] = '( 4.567 * {Temp((F)} ) * {CantidadViajesAlAnho}';

    $prueba = 'Formula de proceso con paréntesis abriendo de sobra';
    $codeEsperado = 'PROCESO_FORMULA_SOBRA_PARENTESIS_ABRIENDO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);*/



    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO Fecha creacion
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //FECHA_CREACION_FORMATO_INCORRECTO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['fecha_creacion'] = '12-2021-06';

    $prueba = 'El formato de la fecha no es correcto: aaaa-mm-dd.';
    $codeEsperado = 'FECHA_CREACION_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //FECHA_CREACION_SOLO_NUMEROS_Y_GUIONES
    $POST['fecha_creacion'] = '2021-1$-06';

    $prueba = 'La fecha solo puede contener números y -.';
    $codeEsperado = 'FECHA_CREACION_SOLO_NUMEROS_Y_GUIONES';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //FECHA_CREACION_MENOR_QUE_10
    $POST['fecha_creacion'] = '2021-12-6';

    $prueba = 'La fecha no puede ser menor que 10 dígitos.';
    $codeEsperado = 'FECHA_CREACION_MENOR_QUE_10';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //FECHA_CREACION_MAYOR_QUE_10
    $POST['fecha_creacion'] = '202121212121-12-06';

    $prueba = 'La fecha no puede ser mayor que 10 dígitos.';
    $codeEsperado = 'FECHA_CREACION_MAYOR_QUE_10';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

 

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO Fecha modificacion
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //FECHA_MODIFICACION_FORMATO_INCORRECTO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['fecha_modificacion'] = '12-2021-06';

    $prueba = 'El formato de la fecha no es correcto: aaaa-mm-dd.';
    $codeEsperado = 'FECHA_MODIFICACION_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //FECHA_MODIFICACION_SOLO_NUMEROS_Y_GUIONES
    $POST['fecha_modificacion'] = '2021-1$-06';

    $prueba = 'La fecha solo puede contener números y -.';
    $codeEsperado = 'FECHA_MODIFICACION_SOLO_NUMEROS_Y_GUIONES';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //FECHA_MODIFICACION_MENOR_QUE_10
    $POST['fecha_modificacion'] = '2021-12-6';

    $prueba = 'La fecha no puede ser menor que 10 dígitos.';
    $codeEsperado = 'FECHA_MODIFICACION_MENOR_QUE_10';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //FECHA_MODIFICACION_MAYOR_QUE_10
    $POST['fecha_modificacion'] = '202121212121-12-06';

    $prueba = 'La fecha no puede ser mayor que 10 dígitos.';
    $codeEsperado = 'FECHA_MODIFICACION_MAYOR_QUE_10';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO ID_CATEGORIA
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_ID_CATEGORIA_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['id_categoria'] = '9m';

    $prueba = 'Id de categoria de proceso mayor de 12';
    $codeEsperado = 'ID_CATEGORIA_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO DNI_CREACION
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //DNI_MENOR_QUE_9
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['dni_usuario_creacion'] = '11111111';

    $prueba = 'DNI creador menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_creacion'] = '11111111HH';

    $prueba = 'DNI creador mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_creacion'] = '1234 5678';

    $prueba = 'El dni de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
    $codeEsperado = 'DNI_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADORDNI_LETRA_INCORRECTA
    $POST['dni_usuario_creacion'] = '12345678A';

    $prueba = 'El dni de usuario debe ser real.';
    $codeEsperado = 'DNI_LETRA_INCORRECTA';

    //---------------------------------------------------------------------------------------------------------------------

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //ERRORES_ATRIBUTO DNI_MODIFICACION
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_CREADOR_DNI_MENOR_QUE_9
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['dni_usuario_modificacion'] = '11111111';

    $prueba = 'DNI modificador menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_modificacion'] = '11111111HH';

    $prueba = 'DNI modificador mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_modificacion'] = '1234 5678';

    $prueba = 'El dni modificador no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
    $codeEsperado = 'DNI_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADORDNI_LETRA_INCORRECTA
    $POST['dni_usuario_modificacion'] = '12345678A';

    $prueba = 'El dni de usuario debe ser real.';
    $codeEsperado = 'DNI_LETRA_INCORRECTA';

    //---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;
}
