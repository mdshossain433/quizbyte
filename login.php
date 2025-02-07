<?php
// Start a PHP session to manage user sessions and data
session_start();

// Include database configuration file
require_once 'config.php';

// Initialise variables
$username = $password = "";
$username_err = $password_err = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Proceed if no validation errors
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT UserID, Username, Password, Name, Email FROM Users WHERE Username = ?";

        // Prepare and execute SQL statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Check if username exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $name, $email);
                   
                    // Fetch results
                    if (mysqli_stmt_fetch($stmt)) {
                        
                        // Get email
                        $userEmail = $email;

                          // Save to session
                          $_SESSION['Email'] = $userEmail;
                          
                        // Verify password
                        if (password_verify($password, $hashed_password)) {
                            // Start session and store user data
                            $_SESSION["loggedin"] = true;
                            $_SESSION["UserID"] = $id;
                            $_SESSION["Username"] = $username;
                            $_SESSION["Name"] = $name;
                            $_SESSION["Email"] = $email;
                            
                            // Redirect to welcome page
                            echo json_encode(["location" => "welcome.php"]);
                        } else {
                            // Password incorrect
                            $password_err = "The password you entered was not valid.";
                            echo json_encode(["password_err" => $password_err]);
                        }
                    }
                } else {
                     // Username not found
                    $username_err = "No account found with that username.";
                    echo json_encode(["username_err" => $username_err]);
                }
            } else {
                // SQL execution error
                echo json_encode(["error" => "Oops! Something went wrong. Please try again later."]);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
        // Validation errors
        echo json_encode(["username_err" => $username_err, "password_err" => $password_err]);
    }

    // Close connection
    mysqli_close($conn);
}

