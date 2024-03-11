<?php include_once "header.php"; ?>

<?php

// Check if the user is logged in
if (isset($_SESSION["userid"])) {

    // Output the profile greeting
    echo "<p class='profile-greeting'>This is the profile page of " . $_SESSION["useruid"] . "</p>";

// Include database connection
require_once 'includes/dbh.inc.php';

// Prepare SQL query to fetch workout data for the current user including the date
$stmt = $conn->prepare("SELECT * FROM workout_sessions WHERE usersId = ?");
$stmt->bind_param("i", $_SESSION['userid']); // Bind the user ID parameter
$stmt->execute(); // Execute the query
$result = $stmt->get_result(); // Get the result set

// Check if there are any rows returned
if ($result->num_rows > 0) {

    // Output data of each row
    echo "<div id='workoutDataContainer' class='wrapper'>"; // Open container for workout data
    echo "<h2 id='workoutDataHeader'>Your Workout Data:</h2>";
    echo "<div id='workoutData'>"; // Open div for workout data
    while ($row = $result->fetch_assoc()) {

        // Display the workout data
        echo "Date: " . $row['session_date'] . ", Exercise Type: " . $row['exercise_type'] . ", Weight: " . $row['weights'] . ", Reps: " . $row['reps'] . "<br>";
    }
    echo "</div>"; // Close div for workout data
    echo "</div>"; // Close container for workout data
} else {
    echo "<p>No workout data found.</p>";
}

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!-- Link the JavaScript file -->
<script src="js\script.js" defer></script>

<div class="wrapper">

    <!-- Workout data toggle -->
<button type="button" id="toggleWorkoutDataBtn">Toggle Workout Data</button> 
    <div id="workoutDataContainer" style="display: none;"> 
        <h2 id="workoutDataHeader" style="display: none;">Your Workout Data:</h2>
        <div id="workoutData" style="display: none;">
        </div>
    </div>
    
    <h1>Exercise Tracker</h1> 

    <!-- Tracker input form -->
    <form id="workoutForm" action="includes\save_workout.inc.php" method="post"> 

        <!-- Exercise row container -->
        <div id="exerciseContainer"> 

            <!-- Exercise row -->
            <div class="exerciseRow"> 
                <select name="exerciseType[]" id="exerciseType"> 
                    <option value="">Select an exercise</option> 
                    <optgroup label="Lower Body"> 
                        <option value="Deadlift">Deadlift</option> 
                        <option value="Barbell Squat">Barbell Squat</option> 
                    </optgroup>
                    <optgroup label="Upper Body">
                        <option value="Bench Press">Bench Press</option> 
                        <option value="Bicep Curl">Bicep Curl</option> 
                    </optgroup>
                </select>

                <input type="number" name="weights[]" placeholder="Weights (kg)"> 
                <input type="number" name="reps[]" placeholder="Reps"> 
                <button type="button" class="duplicateBtn">Duplicate</button> 
                <button type="button" class="deleteBtn">Delete</button> 
            </div>
        </div>
        <button type="button" id="addExerciseBtn">Add Another Exercise</button><br> 
        <button type="submit" id="saveWorkoutBtn">Save Workout</button> 
    </form>
</div>

<?php include_once "footer.php"; ?> 


