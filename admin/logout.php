<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page or homepage
header("Location: ../"); // Change to index.php if needed
exit;
?>
