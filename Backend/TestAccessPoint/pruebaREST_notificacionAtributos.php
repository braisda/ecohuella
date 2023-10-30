<?php

    class notificacionAtributos{
        function insertar(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_Insertar_Atributos.php';
            $rest = pruebaREST_Notificacion_Insertar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_INSERTAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_INSERTAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_Borrar_Atributos.php';
            $rest = pruebaREST_Notificacion_Borrar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BORRAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BORRAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_Buscar_Atributos.php';
            $rest = pruebaREST_Notificacion_Buscar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BUSCAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_BUSCAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_Editar_Atributos.php';
            $rest = pruebaREST_Notificacion_Editar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_EDITAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_EDITAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editarContrasena(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_EditarContrasena_Atributos.php';
            $rest = pruebaREST_Notificacion_EditarContrasena_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_EDITARCONTRASENA_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_EDITARCONTRASENA_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_VerEnDetalle_Atributos.php';
            $rest = pruebaREST_Notificacion_VerEnDetalle_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_VERENDETALLE_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_VERENDETALLE_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function reactivar(){
            include_once './Testing/GestionNotificaciones/Atributos/pruebaREST_Notificacion_Reactivar_Atributos.php';
            $rest = pruebaREST_Notificacion_Reactivar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_REACTIVAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_NOTIFICACION_REACTIVAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>