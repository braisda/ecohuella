<?php

include_once './Model/ModelBase.php';

class processModel extends ModelBase {

    public function __construct() {
      parent::__construct();
      $this->table = 'proceso';
      $this->id = array('id_proceso', 'version');
      $this->foraneas = array('categoria' => 'id_categoria', 'usuario' => array('dni_usuario_creacion', 'dni_usuario_modificacion'));
      $this->orden = '';
      $this->tipoOrden = '';
    }

}
?>