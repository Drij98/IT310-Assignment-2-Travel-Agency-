<?php
// db_connection.php

$servername = "localhost";
$username = "root";
$password = "Aa123456@";
$database = "travel_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}