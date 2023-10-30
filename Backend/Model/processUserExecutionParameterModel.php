<?php

include_once './Model/ModelBase.php';

class processUserExecutionParameterModel extends ModelBase {

    public function __construct() {
      parent::__construct();
      $this->table = 'proceso_usuario_ejecucion_parametro';
      $this->id = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro');
      $this->foraneas = array('proceso' => array('id_proceso', 'version'), 'proceso_usuario_ejecucion' => array('dni_usuario_ejecucion'), 'parametro' => 'id_parametro');
      $this->orden = '';
      $this->tipoOrden = '';
    }

}
?>