<?php

    class procesoUsuarioEjecucionAtributos{
        function insertar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Atributos/pruebaREST_ProcesoUsuarioEjecucion_Insertar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Insertar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_INSERTAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Atributos/pruebaREST_ProcesoUsuarioEjecucion_Borrar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Borrar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BORRAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Atributos/pruebaREST_ProcesoUsuarioEjecucion_Buscar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Buscar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_BUSCAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Atributos/pruebaREST_ProcesoUsuarioEjecucion_Editar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Editar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editarContrasena(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Atributos/pruebaREST_ProcesoUsuarioEjecucion_EditarContrasena_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_EditarContrasena_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITARCONTRASENA_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_EDITARCONTRASENA_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionProcesoUsuarioEjecucion/Atributos/pruebaREST_ProcesoUsuarioEjecucion_VerEnDetalle_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_VerEnDetalle_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_VERENDETALLE_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function reactivar(){
            include_once './Testing/GestionProcesoUsuarioEjecucions/Atributos/pruebaREST_ProcesoUsuarioEjecucion_Reactivar_Atributos.php';
            $rest = pruebaREST_ProcesoUsuarioEjecucion_Reactivar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_REACTIVAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_USUARIO_EJECUCION_REACTIVAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>