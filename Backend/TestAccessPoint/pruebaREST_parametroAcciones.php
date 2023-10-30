<?php

    class parametroAcciones{
        function insertar(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_Insertar_Acciones.php';
            $rest = pruebaREST_Parametro_Insertar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_INSERTAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_INSERTAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_Borrar_Acciones.php';
            $rest = pruebaREST_Parametro_Borrar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BORRAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BORRAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_Buscar_Acciones.php';
            $rest = pruebaREST_Parametro_Buscar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BUSCAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_BUSCAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_Editar_Acciones.php';
            $rest = pruebaREST_Parametro_Editar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_EDITAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_EDITAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_VerEnDetalle_Acciones.php';
            $rest = pruebaREST_Parametro_VerEnDetalle_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_VERENDETALLE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_VERENDETALLE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function devolverPadre(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_DevolverPadre_Acciones.php';
            $rest = pruebaREST_Parametro_DevolverPadre_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_DEVOLVER_PADRE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_DEVOLVER_PADRE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    
        function devolverHijos(){
            include_once './Testing/GestionParametros/Acciones/pruebaREST_Parametro_DevolverHijos_Acciones.php';
            $rest = pruebaREST_Parametro_DevolverHijos_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_DEVOLVER_HIJOS_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PARAMETRO_DEVOLVER_HIJOS_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>