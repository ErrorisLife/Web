<?php

include "db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL to select the admin from the database
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $admin['password'])) {
            // Password is correct, create a session
           
            header("Location: index.php"); // Redirect to admin dashboard
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
}
$conn->close();

