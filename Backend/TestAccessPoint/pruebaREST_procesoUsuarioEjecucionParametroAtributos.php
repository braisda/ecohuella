<?php

    class procesoUsuarioEjecucionParametroAtributos{
        function insertar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Atributos/pruebaREST_ProcesoUsuarioEjecucionParametro_Insertar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Insertar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_INSERTAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Atributos/pruebaREST_ProcesoUsuarioEjecucionParametro_Buscar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Buscar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_BUSCAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Atributos/pruebaREST_ProcesoUsuarioEjecucionParametro_Editar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_Editar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_EDITAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionProcesoUsuarioEjecucionParametro/Atributos/pruebaREST_ProcesoUsuarioEjecucionParametro_VerEnDetalle_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucionParametro_VerEnDetalle_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_PARAMETRO_VERENDETALLE_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

    }
?>