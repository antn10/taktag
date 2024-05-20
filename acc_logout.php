<?php
// Start the session
session_start();// Unset all session variables
$_SESSION = array();
session_destroy();// Destroy the session
echo "success";// Return a success message
?>