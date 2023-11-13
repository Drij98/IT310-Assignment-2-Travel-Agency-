<!-- update_profile_process.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $new_email = $_POST["email"];
    $new_phone = $_POST["phone"];

    // Update user information in the database
    $update_query = "UPDATE users SET email = '$new_email', phone = '$new_phone' WHERE id = $user_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
