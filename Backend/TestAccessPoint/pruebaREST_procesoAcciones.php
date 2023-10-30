<?php

    class procesoAcciones{
        function insertar(){
            include_once './Testing/GestionProcesos/Acciones/pruebaREST_Proceso_Insertar_Acciones.php';
            $rest = pruebaREST_Proceso_Insertar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_INSERTAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_INSERTAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionProcesos/Acciones/pruebaREST_Proceso_Buscar_Acciones.php';
            $rest = pruebaREST_Proceso_Buscar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_BUSCAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_BUSCAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionProcesos/Acciones/pruebaREST_Proceso_VerEnDetalle_Acciones.php';
            $rest = pruebaREST_Proceso_VerEnDetalle_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_VERENDETALLE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_VERENDETALLE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionProcesos/Acciones/pruebaREST_Proceso_Editar_Acciones.php';
            $rest = pruebaREST_Proceso_Editar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_PROCESO_EDITAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_PROCESO_EDITAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>