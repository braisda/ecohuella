<?php
    
include_once './Validation/validate.php';

function validate_data_processUserExecution() {

    include_once './Validation/Attribute/entityValidation/processUserExecutionAttValidation.php';
    
    $processUserExecutionValidation = new processUserExecutionAttValidation();

    switch(action){
        case 'search':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
            makeList($attributeList, $processUserExecutionValidation);
            $processUserExecutionValidation->validateSearchAttributes();
            break;
        case 'searchBy':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
            makeList($attributeList, $processUserExecutionValidation);
            $processUserExecutionValidation->validateSearchByAttributes();
            break;
        case 'add':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
            makeList($attributeList, $processUserExecutionValidation);
            $processUserExecutionValidation->validateAddAttributes();
            break;
        case 'finalDelete':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
            makeList($attributeList, $processUserExecutionValidation);
            $processUserExecutionValidation->validateDeleteAttributes();
            break;
    }
}
?>