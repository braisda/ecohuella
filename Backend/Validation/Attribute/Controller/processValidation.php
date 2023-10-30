<?php
    
include_once './Validation/validate.php';

function validate_data_process() {

    include_once './Validation/Attribute/entityValidation/processAttValidation.php';
    
    $processValidation = new processAttValidation();

    switch(action){
        case 'search':
            $attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion');
            makeList($attributeList, $processValidation);
            $processValidation->validateSearchAttributes();
            break;
        case 'searchBy':
            $attributeList = array('id_proceso', 'version');
            makeList($attributeList, $processValidation);
            $processValidation->validateSearchByAttributes();
            break;
        case 'add':
            $attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion');
            makeList($attributeList, $processValidation);
            $processValidation->validateAddAttributes();
            break;
        case 'edit':
            $attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion');
            makeList($attributeList, $processValidation);
            $processValidation->validateEditAttributes();
            break;
    }
}
?>