<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the user is logged in
    if (isset($_SESSION["userid"])) {

    // Sisällytä tietokantayhteys
    require_once 'dbh.inc.php';

        // Retrieve form data
        $newEmail = $_POST['newEmail'];
        $newName = $_POST['newName'];
        $newUsername = $_POST['newUsername'];

        // Validate input
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";

            // Stop execution if validation fails
            exit(); 
        }

        // Prepare SQL statement to update name, username, and email
        $stmt = $conn->prepare("UPDATE users SET usersName = ?, usersUid = ?, usersEmail = ? WHERE usersId = ?");
        $stmt->bind_param("sssi", $newName, $newUsername, $newEmail, $_SESSION['userid']); // Bind parameters
        $result = $stmt->execute(); // Execute the statement

        if ($result) {

            // Close the statement and database connection
            $stmt->close();
            $conn->close();
            
            // Show alert
            echo "<script>alert('Settings updated successfully');</script>";

            // Redirect user to the homepage
            echo "<script>window.location.href = '../index.php';</script>";
        } else {
            echo "Error updating settings: " . $conn->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "User not logged in";
    }
} else {
    echo "Invalid request method";
}
?>
