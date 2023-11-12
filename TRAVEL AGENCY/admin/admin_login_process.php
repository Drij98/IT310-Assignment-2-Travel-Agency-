<?php
// admin_login_process.php

// Include your database connection file
include("db_connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check admin credentials
    $login_query = "SELECT * FROM users WHERE username = '$username' AND is_admin = 1";
    $login_result = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_result) > 0) {
        $user_data = mysqli_fetch_assoc($login_result);

        // Verify the password
        if (password_verify($password, $user_data["password"])) {
            $_SESSION["admin_id"] = $user_data["id"];
            $_SESSION["admin_username"] = $user_data["username"];
            header("Location: admin_panel.php");
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Admin not found. Please check your credentials.";
    }

    mysqli_close($conn);
}
?>
