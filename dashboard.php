<!-- dashboard.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file
include("db_connection.php");

// Fetch user information for the logged-in user
$user_id = $_SESSION["user_id"];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);

// Check if the user exists
if (mysqli_num_rows($user_result) == 1) {
    $user_data = mysqli_fetch_assoc($user_result);
} else {
    $user_data = [];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        header {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }

        nav {
            margin-bottom: 20px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        nav a:hover {
            color: #ff4500;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-top: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        form button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Dashboard</h1>
    </header>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="order_history.php">Order History</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>

        <?php if (!empty($user_data)): ?>
            <h3>Your Information</h3>
            <table>
                <tr>
                    <th>Username</th>
                    <td><?php echo $user_data['username']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $user_data['email']; ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $user_data['phone']; ?></td>
                </tr>
                <!-- Add more fields as needed -->
            </table>

            <!-- Form to update user information -->
            <h3>Update Information</h3>
            <form action="update_profile_process.php" method="post">
                <label for="email">New Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
                <label for="phone">New Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" required>
                <!-- Add more fields as needed -->
                <button type="submit">Update Profile</button>
            </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        &copy; 2023 FastTravel | All rights reserved
    </div>
</body>
</html>
