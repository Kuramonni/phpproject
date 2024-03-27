<?php

// Start session
session_start();

// Include database connection
require_once 'dbh.inc.php';

// Check if the user is logged in
if (isset($_SESSION["userid"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
     // Delete user account
        $stmt = $conn->prepare("DELETE FROM users WHERE usersId = ?");
        $stmt->bind_param("i", $_SESSION['userid']); 
        $stmt->execute(); 

        if ($stmt->affected_rows > 0) {

            // User data deleted successfully
            // Clean up sessions
            session_unset();
            session_destroy();

            // Redirect to confirmation page or homepage
            header("Location: ../index.php");
            exit();
        } else {
            
            // Error deleting user data
            $error_message = "Error: Unable to delete user data.";
        }

        $stmt->close();
    }
} else {
    // User not logged in
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove User Account</title>
</head>
<body>
    <h1>Remove User Account</h1>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <p>Are you sure you want to delete your account?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <button type="submit" name="submit">Delete Account</button>
    </form>
</body>
</html>
