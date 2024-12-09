<?php
session_start();
include 'db.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Retrieve user from database
    $stmt = $conn->prepare("SELECT id, password, usertype FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword, $userType);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['userType'] = $userType;

            // Redirect based on user type
            if ($userType === 'Client') {
                header("Location: ../announcement.php");
            } elseif ($userType === 'Admin') {
                header("Location: dashboard.php");
            }
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
}

