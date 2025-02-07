<?php
// Start a PHP session to manage user sessions and data
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the logout confirmation page
header("Location: ../logout_form.php");
exit;

