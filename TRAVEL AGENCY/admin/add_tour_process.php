<?php
// add_tour_process.php

// Include your database connection file
include("db_connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and insert new tour data into the 'tours' table
    // Redirect to admin panel after successful addition
    
    $location = $_POST["location"];
    $date = $_POST["date"];
    $capacity = $_POST["capacity"];

    $insert_query = "INSERT INTO tours (location, date, capacity) VALUES ('$location', '$date', $capacity)";

    if (mysqli_query($conn, $insert_query)) {
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

