<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Car WorkShop</h1>
    <h2>Choose role</h2>
    <form action="View/ViewReparation.php" method="post">
        <select name="role">
            <option value="client" selected>Client</option>
            <option value="employee">Employee</option>
        </select>
        <br>
        <input type="submit" value="Enter">
    </form>
</body>
</html>
