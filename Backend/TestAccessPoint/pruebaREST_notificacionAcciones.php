<?php

    class notificacionAcciones{
        function insertar(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_Insertar_Acciones.php';
            $rest = pruebaREST_Notificacion_Insertar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_INSERTAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_INSERTAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_Borrar_Acciones.php';
            $rest = pruebaREST_Notificacion_Borrar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BORRAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BORRAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_Buscar_Acciones.php';
            $rest = pruebaREST_Notificacion_Buscar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BUSCAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BUSCAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_Editar_Acciones.php';
            $rest = pruebaREST_Notificacion_Editar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_EDITAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_EDITAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_VerEnDetalle_Acciones.php';
            $rest = pruebaREST_Notificacion_VerEnDetalle_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_VERENDETALLE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_VERENDETALLE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function devolverPadre(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_DevolverPadre_Acciones.php';
            $rest = pruebaREST_Notificacion_DevolverPadre_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_DEVOLVER_PADRE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_DEVOLVER_PADRE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    
        function devolverHijos(){
            include_once './Testing/GestionNotificaciones/Acciones/pruebaREST_Notificacion_DevolverHijos_Acciones.php';
            $rest = pruebaREST_Notificacion_DevolverHijos_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_DEVOLVER_HIJOS_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_DEVOLVER_HIJOS_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>