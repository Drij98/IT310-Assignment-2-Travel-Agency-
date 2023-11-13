<?php
// add_tour_process.php

// Include your database connection file
include("db_connection_ad.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and insert new tour data into the 'tours' table
    // Redirect to admin panel after successful addition
    
    $tour_id = $_POST["tour_id"];
    $name = $_POST["Name"];
    $location = $_POST["location"];
    $depart_date = $_POST["Depart_date"];
    $capacity = $_POST["capacity"];

    if (mysqli_query($conn, $insert_query)) {
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
