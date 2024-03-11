<?php include_once "header.php"; ?>

<?php

// Check if the user is logged in
if (isset($_SESSION["userid"])) {

    // Output the profile greeting
    echo "<p class='profile-greeting'>Here you can customize the user-settings for " . $_SESSION["useruid"] . "</p>";

// Include database connection
require_once 'includes/dbh.inc.php';

    // Prepare SQL query to fetch user data
    $stmt = $conn->prepare("SELECT usersName, usersUid, usersEmail, usersPwd FROM users WHERE usersId = ?");
    $stmt->bind_param("i", $_SESSION['userid']); // Bind the user ID parameter
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result set

    // Check if there are any rows returned
    if ($result->num_rows > 0) {

        // Fetch the user data
        $userData = $result->fetch_assoc();
        
        // Output current user data
        echo "<div class='wrapper'>";
        echo "<h2>Your Current Information:</h2>";
        echo "<p>Your current name: " . $userData["usersName"] . "</p>";
        echo "<p>Your current username: " . $userData["usersUid"] . "</p>";
        echo "<p>Your current email address: " . $userData["usersEmail"] . "</p>";

        // Display the settings form
        echo "<h2>Update Your Information:</h2>";
        echo "<form action='includes\update_settings.inc.php' method='post'>";
        echo "<label for='newName'>New Name:</label>";
        echo "<input type='text' id='newName' name='newName' value='" . $userData["usersName"] . "'><br>";
        echo "<label for='newUsername'>New Username:</label>";
        echo "<input type='text' id='newUsername' name='newUsername' value='" . $userData["usersUid"] . "'><br>";
        echo "<label for='newEmail'>New Email Address:</label>";
        echo "<input type='email' id='newEmail' name='newEmail' value='" . $userData["usersEmail"] . "'><br>";
        echo "<button type='submit' id='saveSettingsBtn'>Save Settings</button>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "<p>Error: User data not found.</p>";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<?php include_once "footer.php"; ?>
