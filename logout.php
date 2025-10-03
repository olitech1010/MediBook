<?php 
// Start the session
session_start();

// Clear the session data
$_SESSION = array();

// Check if the session cookie exists and delete it
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/', '', true, true); // Secure and HttpOnly flags
}

// Destroy the session
session_destroy();

// Redirect to the login page with a logout action
header('Location: login.php?action=logout');
exit(); // Ensure no further code is executed
?>
