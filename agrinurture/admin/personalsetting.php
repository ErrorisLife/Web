<?php
     include 'db.php';

    session_start();

   
    // Restrict access to Admins only
    if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'Admin') {
        header("Location: a-login.html");
        exit;
    }

    
    $user_id = $_SESSION['user_id'];

    // Fetch user details from the database
    $sql = "SELECT fullname, email FROM users WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $adminName = $user['fullname'];
    $adminEmail = $user['email'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['fullname'];
        $newEmail = $_POST['email'];
        $newPassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

        // Update user details
        $sql = "UPDATE users SET fullname = ?, email = ?" . ($newPassword ? ", password = ?" : "") . " WHERE ID = ?";
        $stmt = $conn->prepare($sql);

        if ($newPassword) {
            $stmt->bind_param("sssi", $newName, $newEmail, $newPassword, $user_id);
        } else {
            $stmt->bind_param("ssi", $newName, $newEmail, $user_id);
        }

        if ($stmt->execute()) {
            $successMessage = "Profile updated successfully!";
            // Refresh the current admin details after update
            $adminName = $newName;
            $adminEmail = $newEmail;

            echo '<a href="setting.php">Back to Settings</a>';
        } else {
            $errorMessage = "Error updating profile. Please try again.";
        }
    }
?>
