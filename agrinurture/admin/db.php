<?php

$servername = "localhost";
$username = "root";
$dbpassword = ""; // Replace with your database password
$dbname = "agrinurture";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
     
}




