<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file
include("db_connection.php");

// Get the user ID
$user_id = $_SESSION["user_id"];

// Fetch items from the shopping cart
$cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_query);

if (mysqli_num_rows($cart_result) > 0) {
    // Start a transaction to ensure atomicity
    mysqli_autocommit($conn, false);

    $success = true;

    while ($cart_item = mysqli_fetch_assoc($cart_result)) {
        $tour_id = $cart_item['tour_id'];
        $travelers = $cart_item['travelers'];

        // Decrease tour capacity
        $decrease_capacity_query = "UPDATE tours SET capacity = capacity - $travelers WHERE id = $tour_id";
        if (!mysqli_query($conn, $decrease_capacity_query)) {
            $success = false;
            break;
        }

        // Move items to order history
        $insert_order_query = "INSERT INTO orders (user_id, tour_id, travelers) VALUES ($user_id, $tour_id, $travelers)";
        if (!mysqli_query($conn, $insert_order_query)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        // Commit the transaction
        mysqli_commit($conn);

        // Clear the shopping cart
        $clear_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
        mysqli_query($conn, $clear_cart_query);

        echo "Checkout successful. Items moved to order history.";
    } else {
        // Rollback the transaction if any query fails
        mysqli_rollback($conn);
        echo "Error during checkout. Please try again.";
    }

    // Restore autocommit mode
    mysqli_autocommit($conn, true);
} else {
    echo "No items in the shopping cart.";
}

mysqli_close($conn);
?>
