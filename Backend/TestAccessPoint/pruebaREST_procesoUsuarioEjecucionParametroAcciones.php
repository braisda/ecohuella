<?php

    class procesoUsuarioEjecucionParametroAcciones{
        function insertar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Acciones/pruebaREST_ProcesoUsuarioEjecucionParametro_Insertar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Insertar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Acciones/pruebaREST_ProcesoUsuarioEjecucionParametro_Borrar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Borrar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BORRAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BORRAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Acciones/pruebaREST_ProcesoUsuarioEjecucionParametro_Buscar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Buscar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Acciones/pruebaREST_ProcesoUsuarioEjecucionParametro_Editar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Editar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Acciones/pruebaREST_ProcesoUsuarioEjecucionParametro_VerEnDetalle_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_VerEnDetalle_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>