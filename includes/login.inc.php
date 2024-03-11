<?php

// Check if the form has been submitted
if (isset($_POST["submit"])) {
    
    // Get the username and password from the form
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    // Include the database connection and necessary action functions
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Check if the form inputs are empty
    if (emptyInputLogin($username, $pwd) !== false) {
        // If inputs are empty, redirect back to the login page
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    // Log in the user using the loginUser function
    loginUser($conn, $username, $pwd);
}
else {
    // If the form has not been submitted, redirect back to the login page
    header("location: ../login.php");
    exit();
}
?>

