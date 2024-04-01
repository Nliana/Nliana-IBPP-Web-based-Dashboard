<?php

// connecting to the phpmyadmin database for register_login
$dbServername = "localhost";
$user = 'root';
$pass = '';
$db2 = 'register_login'; // the name of the database

// Create connection if the connection is unsuccessful, display an error message
$db2 = new mysqli('localhost', $user, $pass, $db2) or die("Sorry, Unable to connect");

//echo "Connected to the database";
?>