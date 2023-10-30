<?php

include_once './Controller/ControllerBase.php';

class process extends ControllerBase
{
    function explore()
    {
        returnRest($this->checkPermission() ? $this->service->startRest() : $this->createNonPermissionMessage());
    }
}
