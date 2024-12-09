<?php

require "db.php"; 

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullnames']);
    $address = trim($_POST['addres']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmpassword']);
    $userType = "Client";

    // Validate the form data
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (fullname, password, email, address, usertype ) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $hashedPassword, $email, $address, $userType);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>
            alert('Account created successfully!');
            window.location.href = 'a-login.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
 