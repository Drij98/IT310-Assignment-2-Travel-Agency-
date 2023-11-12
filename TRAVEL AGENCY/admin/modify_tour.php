<!-- modify_tour.php -->

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
    <title>Modify Tour</title>
</head>
<body>
    <h2>Modify Tour</h2>
    
    <!-- HTML form for modifying tour details -->
    
    <form action="modify_tour_process.php" method="post">
        <!-- Include fields like tour ID, new date, new capacity, etc. -->
        <input type="submit" value="Modify Tour">
    </form>
</body>
</html>

