<?php

    class categoriaAtributos{
        function insertar(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_Insertar_Atributos.php';
            $rest = pruebaREST_Categoria_Insertar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_INSERTAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_INSERTAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function borrar(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_Borrar_Atributos.php';
            $rest = pruebaREST_Categoria_Borrar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BORRAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BORRAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function buscar(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_Buscar_Atributos.php';
            $rest = pruebaREST_Categoria_Buscar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BUSCAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_BUSCAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editar(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_Editar_Atributos.php';
            $rest = pruebaREST_Categoria_Editar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_EDITAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_EDITAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function editarContrasena(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_EditarContrasena_Atributos.php';
            $rest = pruebaREST_Categoria_EditarContrasena_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_EDITARCONTRASENA_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_EDITARCONTRASENA_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function verEnDetalle(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_VerEnDetalle_Atributos.php';
            $rest = pruebaREST_Categoria_VerEnDetalle_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_VERENDETALLE_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_VERENDETALLE_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }

        function reactivar(){
            include_once './Testing/GestionCategorias/Atributos/pruebaREST_Categoria_Reactivar_Atributos.php';
            $rest = pruebaREST_Categoria_Reactivar_Atributos();
            $respuesta['datos'] = $rest;
            if(calcularCodeExito($respuesta['datos'])){
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_REACTIVAR_ATRIBUTOS_EXITO';
            }
            else{
                $respuesta['code'] = 'PETICION_TEST_CATEGORIA_REACTIVAR_ATRIBUTOS_FRACASO';
            }
            devolverRespuestaTest($respuesta);
        }
    }
?>