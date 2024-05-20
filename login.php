<?php 

$_SESSION = array();// Unset all session variables
session_destroy();// Destroy the session
session_start();
 include "utils.php";
 include "form_login.php";
 include "form_foot.php";
 echo "</div>";
?>