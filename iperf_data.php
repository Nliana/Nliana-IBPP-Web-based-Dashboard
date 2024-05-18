<?php

// Database connection details
$username = 'root';
$password = '';
$dbname = "ibppdb";

// Create connection if the connection is unsuccessful, display an error message
$conn = new mysqli('localhost', $username, $password, $dbname) or die("Sorry, Unable to connect");
mysqli_set_charset($conn,"utf8");

?>
