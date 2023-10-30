<?php
    
include_once './Validation/validate.php';

function validate_data_parameter() {

    include_once './Validation/Attribute/entityValidation/parameterAttValidation.php';
    
    $parameterValidation = new parameterAttValidation();

    switch(action){
        case 'search':
            $attributeList = array('id_parametro', 'nombre', 'descripcion', 'unidad', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'id_proceso', 'version');
            makeList($attributeList, $parameterValidation);
            $parameterValidation->validateSearchAttributes();
            break;
        case 'searchBy':
            $attributeList = array('id_parametro');
            makeList($attributeList, $parameterValidation);
            $parameterValidation->validateSearchByAttributes();
            break;
        case 'add':
            $attributeList = array('id_parametro', 'nombre', 'descripcion', 'unidad', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'id_proceso', 'version');
            makeList($attributeList, $parameterValidation);
            $parameterValidation->validateAddAttributes();
            break;
        case 'edit':
            $attributeList = array('id_parametro', 'nombre', 'descripcion', 'unidad', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'id_proceso', 'version');
            makeList($attributeList, $parameterValidation);
            $parameterValidation->validateEditAttributes();
            break;
    }
}
?>