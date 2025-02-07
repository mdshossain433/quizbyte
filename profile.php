<?php
// Start a PHP session to manage user sessions and data
session_start();

// Include the database configuration file
require_once 'config.php';

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login_form.php");
    exit;
}

// Prepare variables for user info
$username = $_SESSION["username"];
$email = ""; // Placeholder for email
$scores = []; // Placeholder for scores

// Fetch user information
if($stmt = $conn->prepare("SELECT email FROM users WHERE username = ?")){
    $stmt->bind_param("s", $param_username);
    $param_username = $username;

    // Execute the query
    if($stmt->execute()){
        $stmt->store_result();

        // Check if the user exists, if yes then get email
        if($stmt->num_rows == 1){
            $stmt->bind_result($email);
            $stmt->fetch();
        }
    }
    $stmt->close();
}

// Fetch user scores
if($stmt = $conn->prepare("SELECT score FROM scores WHERE user_id = ? ORDER BY created_at DESC LIMIT 5")){
    $stmt->bind_param("i", $param_user_id);
    $param_user_id = $_SESSION["id"]; // Assuming you store user's ID in session upon login

    // Execute the query
    if($stmt->execute()){
        $result = $stmt->get_result();
        $scores = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
}

// Close connection
$conn->close();

