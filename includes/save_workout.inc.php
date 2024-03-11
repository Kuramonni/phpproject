<?php

// Start a new or resume an existing session
session_start(); 

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php"); // Redirect the user to the login page if not logged in
    exit(); 
}

// Include the database connection
require_once 'dbh.inc.php';

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO workout_sessions (usersId, exercise_type, weights, reps, session_date) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {

    // If preparing statement fails, print error message
    die("Error preparing statement: " . $conn->error); 
}

// Get the user ID, exercise types, weights, reps, and session date from the form
$userId = $_SESSION['userid']; 
$exerciseTypes = $_POST['exerciseType']; 
$weights = $_POST['weights']; 
$reps = $_POST['reps']; 
$sessionDate = date("Y-m-d"); 

// Loop through the input data
for ($i = 0; $i < count($exerciseTypes); $i++) {
    $exerciseType = $exerciseTypes[$i];
    $weight = $weights[$i];
    $rep = $reps[$i];

    // Bind parameters to the prepared statement, specifying their types ("isids" for integer, string, integer, double, string), and include the sessionDate parameter
    if (!$stmt->bind_param("isids", $userId, $exerciseType, $weight, $rep, $sessionDate)) { 

        // If binding parameters fails, print error message
        die("Error binding parameters: " . $stmt->error); 
    }

    if (!$stmt->execute()) {

        // If executing statement fails, print error message
        die("Error executing statement: " . $stmt->error); 
    }
}

$stmt->close(); // Close the SQL statement
$conn->close(); // Close the database connection

// Display a message and redirect the user to the homepage
echo "<script>alert('Workout saved successfully!'); window.location.href = '../index.php';</script>";
?>
