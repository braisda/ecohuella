<?php

include_once './Model/ModelBase.php';

class notificationModel extends ModelBase {

    public function __construct() {
      parent::__construct();
      $this->table = 'notificacion';
      $this->id = array('id_notificacion');
      $this->foraneas = array('usuario' => array('dni_usuario_remitente', 'dni_usuario_destinatario'));
      $this->orden = '';
      $this->tipoOrden = '';
    }

}
?>