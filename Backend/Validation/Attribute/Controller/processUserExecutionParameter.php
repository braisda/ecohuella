<?php

include_once './Validation/validate.php';

function validate_data_processUserExecutionParameter()
{

    include_once './Validation/Attribute/entityValidation/processUserExecutionParameterAttValidation.php';

    $processUserExecutionParameterValidation = new processUserExecutionParameterAttValidation();

    switch (action) {
        case 'search':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro', 'fecha_ejecucion', 'valor_parametro');
            makeList($attributeList, $processUserExecutionParameterValidation);
            $processUserExecutionParameterValidation->validateSearchAttributes();
            break;
        case 'searchBy':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro');
            makeList($attributeList, $processUserExecutionParameterValidation);
            $processUserExecutionParameterValidation->validateSearchByAttributes();
            break;
        case 'add':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro', 'fecha_ejecucion', 'valor_parametro');
            makeList($attributeList, $processUserExecutionParameterValidation);
            $processUserExecutionParameterValidation->validateAddAttributes();
            break;
        case 'edit':
            $attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro', 'fecha_ejecucion', 'valor_parametro');
            makeList($attributeList, $processUserExecutionParameterValidation);
            $processUserExecutionParameterValidation->validateEditAttributes();
            break;
    }
}
