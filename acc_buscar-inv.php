<?php
// Connect to the database
$servername = "192.168.0.20";
$username = "taktag";
$password = "taktag";
$dbname = "taktag";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch inventory data from the database
$sql = "SELECT * FROM responsables";
$result = $conn->query($sql);
// Close the database connection
$conn->close();
?>