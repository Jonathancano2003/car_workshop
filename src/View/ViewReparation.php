<?php

use Model\Reparation;

class ViewReparation
{
    public function render()
    {
        echo '<h1>Car Workshop Reparation Menu</h1>';
    }
}

$role = $_POST['role'] ?? 'client';

$viewReparation = new ViewReparation();
$viewReparation->render();

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
