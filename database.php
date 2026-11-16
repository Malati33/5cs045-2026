<?php
$host = "localhost";
$user = "2421979";
$password = "University3841";
$database = "db2421979";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>