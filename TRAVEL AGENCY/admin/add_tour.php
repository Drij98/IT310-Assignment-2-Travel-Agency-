<!-- add_tour.php -->

<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tour</title>
</head>
<body>
    <h2>Add New Tour</h2>
    
    <!-- HTML form for adding new tours -->
    
    <form action="add_tour_process.php" method="post">
        <!-- Include fields like location, date, capacity, etc. -->
        <input type="submit" value="Add Tour">
    </form>
</body>
</html>
