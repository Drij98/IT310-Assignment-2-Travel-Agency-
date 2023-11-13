<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastTravel - Your Adventure Awaits</title>
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
    </style>
</head>
<body>
    <header>
        <h1>FastTravel</h1>
    </header>

    <nav>
        <a href="#home">Home</a>
        <?php if (!isset($_SESSION["user_id"])): ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <a href="dashboard.php">dashboard</a>
        <?php else: ?>
            <a href="tours.php">Tours</a>
            <a href="cart.php">Shopping Cart</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="order_history.php">Order History</a>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>

    <div class="container">
        <div class="content">
            <?php
            // You can include the appropriate content based on the user's session status
            if (!isset($_SESSION["user_id"])) {
                echo '<h2>Welcome to FastTravel!</h2>';
                echo '<p>Discover amazing tours and plan your next adventure with us.</p>';
            } else {
                echo '<h2>Hello, ' . $_SESSION["username"] . '!</h2>';
                echo '<p>Explore our available tours and start planning your journey.</p>';
            }
            ?>
        </div>

        <form action="search_tours.php" method="get">
            <label for="search">Search Tours:</label>
            <input type="text" id="search" name="search" placeholder="Enter destination">
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="footer">
        &copy; 2023 FastTravel | All rights reserved
    </div>
</body>
</html>
