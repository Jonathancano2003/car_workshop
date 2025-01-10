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
function insertReparation(): void
{
    // Get form data
    $workshopId = $_POST['workshopId'];
    $workshopName = $_POST['workshopName'];
    $registerDate = $_POST['registerDate'];
    $licensePlate = $_POST['licensePlate'];

    // Insert reparation
    $service = new ServiceReparation();
    $reparation = $service->insertReparation(
        workshopId: $workshopId,
        workshopName: $workshopName,
        registerDate: $registerDate,
        licensePlate: $licensePlate
    );

    // Pass reparation (model) to view
    $view = new ViewReparation();
    $view->render($reparation);
}
