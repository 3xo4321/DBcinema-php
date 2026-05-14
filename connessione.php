<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "CinemaDB";

$conn = new mysqli($host, $user, $password, $database);
if($conn -> connect_error) {
    die("connessione fallita " . $conn -> connect_error);
} 
?>