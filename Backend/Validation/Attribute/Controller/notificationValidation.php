<?php

include_once './Validation/validate.php';

function validate_data_notification()
{

    include_once './Validation/Attribute/entityValidation/notificationAttValidation.php';

    $notificationValidation = new notificationAttValidation();

    switch (action) {
        case 'search':
            $attributeList = array('id_notificacion', 'titulo', 'cuerpo', 'fecha', 'leida', 'dni_usuario_remitente', 'dni_usuario_destinatario');
            makeList($attributeList, $notificationValidation);
            $notificationValidation->validateSearchAttributes();
            break;
        case 'searchBy':
            $attributeList = array('id_notificacion');
            makeList($attributeList, $notificationValidation);
            $notificationValidation->validateSearchByAttributes();
            break;
        case 'add':
            $attributeList = array('id_notificacion', 'titulo', 'cuerpo', 'fecha', 'leida', 'dni_usuario_remitente', 'dni_usuario_destinatario');
            makeList($attributeList, $notificationValidation);
            $notificationValidation->validateAddAttributes();
            break;
        case 'edit':
            $attributeList = array('id_notificacion', 'leida');
            makeList($attributeList, $notificationValidation);
            $notificationValidation->validateEditAttributes();
            break;
        case 'finalDelete':
            $attributeList = array('id_notificacion');
            makeList($attributeList, $notificationValidation);
            $notificationValidation->validateDeleteAttributes();
            break;
    }
}
