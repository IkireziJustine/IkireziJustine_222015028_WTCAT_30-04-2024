<?php
// Connection details
$host = "localhost";
$user = "Justine";
$pass = "222015028";
$database = "online_transport_ticket_booking";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>