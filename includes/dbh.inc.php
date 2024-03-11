<?php

// Database server information
$serverName = "localhost";
$dBUserName = "phpproject";
$dBPassword = "5RUq4!O2T9;B5Hf83i9y";
$dBName = "phpproject";

// Create connection to the database
$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if (!$conn) {
    
    // If connection fails, display error message and terminate the program
    die("Connection failed: " . mysqli_connect_error());
}
