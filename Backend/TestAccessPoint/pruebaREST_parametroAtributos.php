<?php

    class parametroAtributos{
        function insertar(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_Insertar_Atributos.php';
            $rest = pruebaREST_Parametro_Insertar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_INSERTAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_INSERTAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_Borrar_Atributos.php';
            $rest = pruebaREST_Parametro_Borrar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BORRAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BORRAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_Buscar_Atributos.php';
            $rest = pruebaREST_Parametro_Buscar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BUSCAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BUSCAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_Editar_Atributos.php';
            $rest = pruebaREST_Parametro_Editar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_EDITAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_EDITAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editarContrasena(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_EditarContrasena_Atributos.php';
            $rest = pruebaREST_Parametro_EditarContrasena_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_EDITARCONTRASENA_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_EDITARCONTRASENA_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_VerEnDetalle_Atributos.php';
            $rest = pruebaREST_Parametro_VerEnDetalle_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_VERENDETALLE_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_VERENDETALLE_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function reactivar(){
            include_once './Testing/GestionParametros/Atributos/pruebaREST_Parametro_Reactivar_Atributos.php';
            $rest = pruebaREST_Parametro_Reactivar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_REACTIVAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_REACTIVAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>