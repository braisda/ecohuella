<?php

include_once './Validation/validate.php';

class categoryValidationAction extends Validate
{

    function validateSearch()
    {
        if ($this->isAdmin()) {
            fillExceptionAction('ACCION_DENEGADA_BUSCAR_CATEGORIAS');
        }
    }

    function validateAdd()
    {
        if ($this->categoryNameDuplicated()) {
            fillExceptionAction('CATEGORIA_DUPLICADA');
        }

        if ($this->isNotModerator()) {
            fillExceptionAction('ACCION_DENEGADA_INSERTAR_CATEGORIA');
        }
    }

    function validateEdit()
    {
        if ($this->isNotModerator()) {
            fillExceptionAction('ACCION_DENEGADA_EDITAR_CATEGORIA');
        }
        if (!$this->categoryExists()) {
            fillExceptionAction('CATEGORIA_NO_EXISTE');
        }
        if (!$this->isModificator()) {
            fillExceptionAction('ACCION_DENEGADA_NO_MODIFICADOR');
        }
        if (!$this->denyEditAction()) {
            fillExceptionAction('CATEGORIA_RAIZ_NO_SE_PUEDE_MODIFICAR');
        }
    }

    function validateDelete()
    {
        if (!$this->categoryExists()) {
            fillExceptionAction('CATEGORIA_NO_EXISTE');
        }
        if (!$this->denyDeleteAction()) {
            fillExceptionAction('CATEGORIA_RAIZ_NO_SE_PUEDE_BORRAR');
        }
        if ($this->categoryHasDescendants()) {
            fillExceptionAction('CATEGORIA_TIENE_HIJOS');
        }
        //TODO: Comprobar si tiene procesos
        if ($this->isNotModerator()) {
            fillExceptionAction('ACCION_DENEGADA_BORRAR_CATEGORIA');
        }
        if (!$this->isModificator()) {
            fillExceptionAction('ACCION_DENEGADA_NO_MODIFICADOR');
        }
    }

    function categoryExists()
    {
        $category = $this->model->getById(array($this->model->arrayDataValue['id_categoria']));
        return !empty($category['resource']);
    }

    function categoryNameDuplicated()
    {
        $category = $this->model->seek(array("nombre"), array($this->model->arrayDataValue['nombre']));
        return !empty($category['resource']);
    }

    function categoryHasDescendants()
    {
        $children = $this->model->seek(array("id_categoria_padre"), array($this->model->arrayDataValue['id_categoria']));
        return !empty($children['resource']);
    }

    function isModificator()
    {
        if ($this->categoryExists()) {
            $modificator = $this->model->seek(array("id_categoria", "dni_usuario_modificacion"), array($this->model->arrayDataValue['id_categoria'], userSystem));
            $toret = !empty($modificator['resource']);
        }
        return $toret;
    }

    function isNotModerator()
    {
        return rolUserSystem != '2';
    }

    function isAdmin()
    {
        return rolUserSystem == '1';
    }

    function denyEditAction()
    {
        $row = $this->model->getById(array($this->model->arrayDataValue['id_categoria']))['resource'];
        return !($row['id_categoria'] == '1');
    }

    function denyDeleteAction()
    {
        $row = $this->model->getById(array($this->model->arrayDataValue['id_categoria']))['resource'];
        return !($row['id_categoria'] == '1');
    }
}
