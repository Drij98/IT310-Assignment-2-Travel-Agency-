<!-- dashboard.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Dashboard</title>
</head>
<body>
    <h2>Personal Dashboard</h2>

    <!-- Display user information -->
    
    <form action="update_profile_process.php" method="post">
        <!-- Include a form to update personal information -->
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>

