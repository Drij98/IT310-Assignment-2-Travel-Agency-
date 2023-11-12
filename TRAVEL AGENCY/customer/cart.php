<!-- cart.php -->

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
    <title>Shopping Cart</title>
</head>
<body>
    <h2>Shopping Cart</h2>
    
    <!-- Display selected tours in the shopping cart -->
    
    <form action="checkout_process.php" method="post">
        <!-- Include a form to delete tours and proceed to checkout -->
        <input type="submit" value="Checkout">
    </form>
</body>
</html>
