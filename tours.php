<!-- tours.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file
include("db_connection.php");

// Fetch available tours from the database
$tours_query = "SELECT * FROM tours";
$tours_result = mysqli_query($conn, $tours_query);

// Check if there are tours available
if (mysqli_num_rows($tours_result) > 0) {
    $tours = mysqli_fetch_all($tours_result, MYSQLI_ASSOC);
} else {
    $tours = [];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tours</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    <h3>Available Tours</h3>

    <?php if (!empty($tours)): ?>
        <ul>
            <?php foreach ($tours as $tour): ?>
                <li>
                    <strong><?php echo $tour['location']; ?></strong>
                    <br>
                    Date: <?php echo $tour['date']; ?>
                    <br>
                    Capacity: <?php echo $tour['capacity']; ?> travelers
                    <br>
                    <!-- Include a form to add selected tours to the shopping cart -->
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                        <label for="travelers">Number of Travelers:</label>
                        <input type="number" id="travelers" name="travelers" min="1" max="<?php echo $tour['capacity']; ?>" required>
                        <input type="submit" value="Add to Cart">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tours available at the moment.</p>
    <?php endif; ?>
</body>
</html>

