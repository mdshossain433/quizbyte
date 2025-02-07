<?php
// Start a PHP session to manage user sessions and data
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    exit("Unauthorized access.");
}

// Include database configuration
require_once 'config.php';

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = $_POST['score'];
    $userID = $_SESSION["UserID"];

    // SQL to insert the score
    $sql = "INSERT INTO Scores (UserID, Score) VALUES (?, ?)";

    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ii", $userID, $score);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Score submitted successfully.";
        } else {
            echo "Error submitting score.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }

     // Close the connection
    mysqli_close($conn);
}
