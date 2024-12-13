<?php
// Formulario para ingresar una nueva reparación
?>

<form method="POST" enctype="multipart/form-data">
    <label for="workshop_id">Workshop ID:</label>
    <input type="text" name="workshop_id" required><br>

    <label for="workshop_name">Workshop Name:</label>
    <input type="text" name="workshop_name" required><br>

    <label for="register_date">Register Date:</label>
    <input type="date" name="register_date" required><br>

    <label for="license_plate">License Plate:</label>
    <input type="text" name="license_plate" required><br>

    <label for="photo">Photo of Damaged Vehicle:</label>
    <input type="file" name="photo" required><br>

    <input type="submit" value="Submit">
</form>
