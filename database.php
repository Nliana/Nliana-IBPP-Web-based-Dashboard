<?php

// connecting to the phpmyadmin database
$dbServername = "localhost";
$user = 'root';
$pass = '';
$db = 'fyp'; // the name of the database

// Create connection if the connection is unsuccessful, display an error message
$db = new mysqli('localhost', $user, $pass, $db) or die("Sorry, Unable to connect");

//echo "Connected to the database";

?>