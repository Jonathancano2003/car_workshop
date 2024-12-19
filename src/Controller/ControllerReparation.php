<?php

use Model\Reparation;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["getReparation"])) {
    getReparation();
}

if (isset($_POST["insertReparation"])) {
    insertReparation();
}


function getReparation()
{
    $role = $_SESSION['role'];
    $idReparation = $_POST['uuid'];

    $service = new ServiceReparation();
    $model = $service->getReparation($role, $idReparation);
    $view = new ViewReparation();
    $view->render($model);
}
function insertReparation() {}
