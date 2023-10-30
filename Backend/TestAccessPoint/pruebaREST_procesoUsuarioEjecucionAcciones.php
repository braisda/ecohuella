<?php

    class procesoUsuarioEjecucionAcciones{
        function insertar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_Insertar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Insertar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_Borrar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Borrar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_Buscar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Buscar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_Editar_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Editar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_VerEnDetalle_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_VerEnDetalle_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function devolverPadre(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_DevolverPadre_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_DevolverPadre_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_DEVOLVER_PADRE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_DEVOLVER_PADRE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    
        function devolverHijos(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Acciones/pruebaREST_ProcesoUsuarioEjecucion_DevolverHijos_Acciones.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_DevolverHijos_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_DEVOLVER_HIJOS_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_DEVOLVER_HIJOS_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>