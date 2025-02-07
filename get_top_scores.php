<?php
// Start a PHP session to manage user sessions and data
session_start();

// Include database configuration
require_once 'config.php';

// SQL to fetch top five scores with usernames and names
$sql = "SELECT Users.Username, Users.Name, Scores.Score FROM Scores 
        JOIN Users ON Scores.UserID = Users.UserID 
        ORDER BY Scores.Score DESC LIMIT 5";

// Execute the query
$result = mysqli_query($conn, $sql);

// Initialize an array to store scores
$scores = [];

// Fetch each row from the result and add it to the scores array
while($row = mysqli_fetch_assoc($result)) {
    $scores[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the scores as JSON
echo json_encode($scores);

