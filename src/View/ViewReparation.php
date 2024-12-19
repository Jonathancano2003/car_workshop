<?php

use Model\Reparation;

class ViewReparation
{
    public function render($model)
    {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reparation Details</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body class="bg-light">
            <div class="container mt-5">
                <h1 class="mb-4">Reparation Details</h1>
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> ' . $model->getIdReparation() . '</li>
                    <li class="list-group-item"><strong>Workshop ID:</strong> ' . $model->getIdWorkshop() . '</li>
                    <li class="list-group-item"><strong>Workshop Name:</strong> ' . $model->getWorkshopName() . '</li>
                    <li class="list-group-item"><strong>Registration Date:</strong> ' . $model->getRegisterDate() . '</li>
                    <li class="list-group-item"><strong>License Plate:</strong> ' . $model->getLicensePlate() . '</li>
                </ul>
            </div>
        </body>
        </html>';
    }
}

$role = $_POST['role'] ;
$viewReparation = new ViewReparation();
?>

<form method="POST" action="../Service/ServiceReparation.php">
    <h2>Search car reparation</h2>
    <label for="uuid">ID Reparation Number:</label>
    <input type="text" id="uuid" name="uuid">
    <input type="submit" value="Search" name="getReparation">
</form>

<?php
if ($role === 'employee') {
    echo '
    <h2>Create New Reparation</h2>
    <form method="POST" action="../Service/ServiceReparation.php">
        <label for="workshopId">Workshop ID:</label>
        <input type="text" id="workshopId" name="workshopId"><br>

        <label for="workshopName">Workshop Name:</label>
        <input type="text" id="workshopName" name="workshopName"><br>

        <label for="registerDate">Register Date:</label>
        <input type="date" id="registerDate" name="registerDate"><br>

        <label for="licensePlate">License Plate:</label>
        <input type="text" id="licensePlate" name="licensePlate"><br>

        <label for="photoPath">Photo Path:</label>
        <input type="file" id="photoPath" name="photoPath"><br>

        <input type="submit" value="Create Reparation" name="createReparation">
    </form>';
}
?>
