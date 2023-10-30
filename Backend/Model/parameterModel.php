<?php

include_once './Model/ModelBase.php';

class parameterModel extends ModelBase {

    public function __construct() {
      parent::__construct();
      $this->table = 'parametro';
      $this->id = array('id_parametro');
      $this->foraneas = array('proceso' => array('id_proceso', 'version'), 'usuario' => array('dni_usuario_creacion', 'dni_usuario_modificacion'));
      $this->orden = '';
      $this->tipoOrden = '';
    }

}
?>