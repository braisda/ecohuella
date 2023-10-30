<?php
    
include_once './Validation/validate.php';

function validate_data_category() {

    include_once './Validation/Attribute/entityValidation/categoryAttValidation.php';
    
    $categoryValidation = new categoryAttValidation();

    switch(action){
        case 'search':
            $attributeList = array('id_categoria', 'nombre', 'descripcion', 'activa', 'id_categoria_padre', 'dni_usuario_creacion', 'dni_usuario_modificacion');
            makeList($attributeList, $categoryValidation);
            $categoryValidation->validateSearchAttributes();
            break;
        case 'searchBy':
            $attributeList = array('id_categoria');
            makeList($attributeList, $categoryValidation);
            $categoryValidation->validateSearchByAttributes();
            break;
        case 'add':
            $attributeList = array('id_categoria', 'nombre', 'descripcion', 'activa', 'id_categoria_padre', 'dni_usuario_creacion', 'dni_usuario_modificacion');
            makeList($attributeList, $categoryValidation);
            $categoryValidation->validateAddAttributes();
            break;
        case 'edit':
            $attributeList = array('id_categoria', 'nombre', 'descripcion', 'activa', 'id_categoria_padre', 'dni_usuario_creacion', 'dni_usuario_modificacion');
            makeList($attributeList, $categoryValidation);
            $categoryValidation->validateEditAttributes();
            break;
        case 'delete':
            $attributeList = array('id_categoria', 'dni_usuario_modificacion');
            makeList($attributeList, $categoryValidation);
            $categoryValidation->validateDeleteAttributes();
            break;
    }
}
?>