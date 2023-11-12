<?php
// modify_tour_process.php

// Include your database connection file
include("db_connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and update tour data in the 'tours' table
    // Redirect to admin panel after successful modification
    
    $tour_id = $_POST["tour_id"];
    $new_date = $_POST["new_date"];
    $new_capacity = $_POST["new_capacity"];

    $update_query = "UPDATE tours SET date = '$new_date', capacity = $new_capacity WHERE id = $tour_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

