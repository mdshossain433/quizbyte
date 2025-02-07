<?php
session_start();
header('Content-Type: application/json');

// Include database configuration
require_once 'config.php';

$response = []; // Initialise the response array

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["UserID"])) {
    // Get the user ID from the session
    $param_user_id = $_SESSION["UserID"];
    
    // Prepare the SQL query to fetch user scores
    $sql = "SELECT Score, Date FROM Scores WHERE UserID = ? ORDER BY Date DESC LIMIT 20";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the user ID parameter
        $stmt->bind_param("i", $param_user_id);

        // Execute the query
        if ($stmt->execute()) {
            // Get the result set
            $result = $stmt->get_result();

            // Fetch scores as an associative array
            $scores = $result->fetch_all(MYSQLI_ASSOC);
            

            // Add scores to the response
            $response['scores'] = $scores;
        } else {
            $response['error'] = 'Failed to execute the query.';
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        $response['error'] = 'Failed to prepare the query.';
    }
} else {
    $response['error'] = 'Not logged in.';
}

// Close the database connection
$conn->close();

// Send the response as JSON
echo json_encode($response);
