<?php include_once "header.php"; ?>

<section class="signup-form">

    <h2>Log In</h2>

    <!-- Login form submitted to includes/login.inc.php -->
    <form action="includes/login.inc.php" method="post">

    <input type="text" name="uid" placeholder="Username..."><br>
    <input type="password" name="pwd" placeholder="Password..."><br>

    <button type="submit" name="submit">Log In</button>
        
    </form>

<?php

// Check for any errors in the input data and display error message

if (isset($_GET["error"])) {
    
    // Display error message if form fields are missing
    if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
    }

    // Display error message if login information is incorrect
    else if ($_GET["error"] == "wronglogin") {
        echo "<p>Incorrect login information!</p>";
    }
}
?>

</section>

<?php include_once "footer.php"; ?>
