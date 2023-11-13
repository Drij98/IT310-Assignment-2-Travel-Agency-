<?php
// modify_tour_process.php

// Include your database connection file
include("db_connection_ad.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and update tour data in the 'tours' table
    // Redirect to admin panel after successful modification

    $tour_id = isset($_POST["tour_id"]) ? $_POST["tour_id"] : "";
    $new_date = isset($_POST["new_date"]) ? $_POST["new_date"] : "";
    $new_capacity = isset($_POST["new_capacity"]) ? $_POST["new_capacity"] : "";

    // Validate form data before processing
    if (!empty($tour_id) && !empty($new_date) && !empty($new_capacity)) {
        $update_query = "UPDATE tours SET date = ?, capacity = ? WHERE id = ?";

        // Use prepared statement
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ssi", $new_date, $new_capacity, $tour_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("Location: admin_panel.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Form data is incomplete.";
    }

    mysqli_close($conn);
}
?>
