<?php

// Start the session 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>peehoopee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tektur:wght@400;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="header-container">
        <img id="logo" src="img/gim_logo.png" alt="logo">

        <h1>THE PHP APP</h1>
    
        <!-- Navigation -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php
                if (isset($_SESSION["userid"])) {

                    // If logged in, display links to the profile, settings, and log out
                    echo "<li><a href='profile.php'>Profile Page</a></li>";
                    echo "<li><a href='settings.php'>Settings</a></li>";
                    echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
                }
                else {

                    // If not logged in, display links to sign up and log in
                    echo "<li><a href='signup.php'>Sign Up</a></li>";
                    echo "<li><a href='login.php'>Log In</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
    <hr>
</header>
</body>
</html>





