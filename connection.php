<?php
$servername = "localhost";
$username = "root";  
$password = "root"; 
$dbname = "edoc"; 
$port = 3307;

$database = new mysqli($servername, $username, $password, $dbname, $port);

if ($database->connect_error) {
    die("Failed to connect : " . $database->connect_error);
}
?>

