<?php

class accionFuncionalidadAtributos {
    function insertar() {
        include_once './Testing/AccionFuncionalidad/Atributos/pruebaREST_AccionFuncionalidad_Insertar_Atributos.php';
        $rest = pruebaREST_AccionFuncionalidad_Insertar_Atributos();
        $respuesta['datos'] = $rest;
        if(calcularCodeExito($respuesta['datos'])){
            $respuesta['code'] = 'PETICION_TEST_ACCION_FUNCIONALIDAD_INSERTAR_ATRIBUTOS_EXITO';
        }
        else{
            $respuesta['code'] = 'PETICION_TEST_ACCION_FUNCIONALIDAD_INSERTAR_ATRIBUTOS_FRACASO';
        }
        devolverRespuestaTest($respuesta);
    }

    function buscar() {
        include_once './Testing/AccionFuncionalidad/Atributos/pruebaREST_AccionFuncionalidad_Buscar_Atributos.php';
        $rest = pruebaREST_AccionFuncionalidad_Buscar_Atributos();
        $respuesta['datos'] = $rest;
        if(calcularCodeExito($respuesta['datos'])){
            $respuesta['code'] = 'PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ATRIBUTOS_EXITO';
        }
        else{
            $respuesta['code'] = 'PETICION_TEST_ACCION_FUNCIONALIDAD_BUSCAR_ATRIBUTOS_FRACASO';
        }
        devolverRespuestaTest($respuesta);
    }

    function eliminar() {
        include_once './Testing/AccionFuncionalidad/Atributos/pruebaREST_AccionFuncionalidad_Borrar_Atributos.php';
        $rest = pruebaREST_AccionFuncionalidad_Borrar_Atributos();
        $respuesta['datos'] = $rest;
        if(calcularCodeExito($respuesta['datos'])){
            $respuesta['code'] = 'PETICION_TEST_ACCION_FUNCIONALIDAD_BORRAR_ATRIBUTOS_EXITO';
        }
        else{
            $respuesta['code'] = 'PETICION_TEST_ACCION_FUNCIONALIDAD_BORRAR_ATRIBUTOS_FRACASO';
        }
        devolverRespuestaTest($respuesta);
    }
}
?>