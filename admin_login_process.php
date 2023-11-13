<?php
// admin_login_process.php

// Include your database connection file with an absolute path
include(__DIR__ . "/db_connection_ad.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check admin credentials
    $login_query = "SELECT * FROM users WHERE username = '$username' AND is_admin = 1";
    
    // Ensure $conn is defined before using it
    if ($conn) {
        $login_result = mysqli_query($conn, $login_query);

        if ($login_result) {
            if (mysqli_num_rows($login_result) > 0) {
                $user_data = mysqli_fetch_assoc($login_result);
                // Verify the password
                if (password_verify($password, $user_data["password"])) {

                    $_SESSION["admin_id"] = $user_data["id"];
                    $_SESSION["admin_username"] = $user_data["username"];
                    header("Location: admin_panel.php");
                    exit(); // Ensure no further code execution after redirection
                } 
                else 
                {
                    echo "Invalid password. Please try again.";
                }
            } else {
                echo "Admin not found. Please check your credentials.";
            }

            mysqli_free_result($login_result);
        } else {
            echo "Error in the login query: " . mysqli_error($conn);
        }

        // Close the connection
        mysqli_close($conn);
    } else {
        echo "Error connecting to the database.";
    }
}
?>
