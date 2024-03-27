<?php

// Check if the form has been submitted
if (isset($_POST["submit"])) {

    // Get form inputs into variables
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    // Include the database connection and necessary action functions
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Check if the form inputs are valid, if not, redirect back to the signup page
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) === false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    // Create user
    createUser($conn, $name, $email, $username, $pwd);
}

else {
    
    // If the form has not been submitted, redirect back to the signup page
    header("location: ../signup.php");
    exit();
}
?>
