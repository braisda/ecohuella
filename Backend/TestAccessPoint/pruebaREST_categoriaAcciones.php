<?php

    class categoriaAcciones{
        function insertar(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_Insertar_Acciones.php';
            $rest = pruebaREST_Categoria_Insertar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_INSERTAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_INSERTAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_Borrar_Acciones.php';
            $rest = pruebaREST_Categoria_Borrar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BORRAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BORRAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_Buscar_Acciones.php';
            $rest = pruebaREST_Categoria_Buscar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BUSCAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BUSCAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_Editar_Acciones.php';
            $rest = pruebaREST_Categoria_Editar_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_EDITAR_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_EDITAR_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_VerEnDetalle_Acciones.php';
            $rest = pruebaREST_Categoria_VerEnDetalle_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_VERENDETALLE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_VERENDETALLE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function devolverPadre(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_DevolverPadre_Acciones.php';
            $rest = pruebaREST_Categoria_DevolverPadre_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_DEVOLVER_PADRE_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_DEVOLVER_PADRE_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    
        function devolverHijos(){
            include_once './Testing/GestionCategorias/Acciones/pruebaREST_Categoria_DevolverHijos_Acciones.php';
            $rest = pruebaREST_Categoria_DevolverHijos_Acciones();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_DEVOLVER_HIJOS_ACCIONES_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_DEVOLVER_HIJOS_ACCIONES_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>