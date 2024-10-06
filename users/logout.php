<?php
session_start(); // Start session to access the session variables

// Unset only the user session
if (isset($_SESSION['user_username'])) {
  session_destroy();
}

header("Location: ../index.php"); // Redirect to the homepage after logout
exit();
?>
