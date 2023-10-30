<?php

include_once './Model/ModelBase.php';

class categoryModel extends ModelBase {

    public function __construct() {
      parent::__construct();
      $this->table = 'categoria';
      $this->id = array('id_categoria');
      $this->foraneas = array('categoria' => 'id_categoria_padre', 'usuario' => array('dni_usuario_creacion', 'dni_usuario_modificacion'));
      $this->orden = '';
      $this->tipoOrden = '';
    }

}
?>