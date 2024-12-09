<?php
include "db.php";

function verifyUserTypeAndPassword($dbHost, $dbUser, $dbPass, $dbName, $email, $password) {
    // Create a new database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to get usertype and hashed password based on email
    $stmt = $conn->prepare("SELECT usertype, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userType, $hashedPassword);
    $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Verify the password and return userType if correct
    if ($userType && password_verify($password, $hashedPassword)) {
        return $userType; // Return the user type if the password is correct
    }

    return false; // Return false if user type does not match or password is incorrect
}