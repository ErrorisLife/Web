<?php

include "db.php"; 

// Assume this is coming from a form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the username and password from the form
    $user = htmlspecialchars(trim($_POST['username']));
    $pass = htmlspecialchars(trim($_POST['password']));

    // Validate that username and password are not empty
    if (!empty($user) && !empty($pass)) {
        // Hash the password using the default algorithm (bcrypt)
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // SQL query to insert the username and hashed password into the database
        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";

        // Prepare the SQL statement to prevent SQL injection
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the SQL query
            $stmt->bind_param("ss", $user, $hashed_password);

            // Execute the prepared statement
            if ($stmt->execute()) {
                header("Location: a-login.html");
                exit(); // Ensure no further code is executed after redirection
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Username or password cannot be empty.";
    }
}

// Close the database connection
$conn->close();


