<?php

include_once './Model/ModelBase.php';

class processUserExecutionModel extends ModelBase {

    public function __construct() {
      parent::__construct();
      $this->table = 'proceso_usuario_ejecucion';
      $this->id = array('id_proceso', 'version', 'dni_usuario_ejecucion');
      $this->foraneas = array('proceso' => array('id_proceso', 'version'), 'usuario' => 'dni_usuario_ejecucion');
      $this->orden = '';
      $this->tipoOrden = '';
    }

}
?>