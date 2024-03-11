<?php

// Start, clear, and destroy the session, then redirect back to the homepage
session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();
?>
