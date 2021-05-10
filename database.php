<?php
$servername = "localhost";
$username = "root";
$password = "admin@123";
$dbname = "book_parking_slot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
