<?php
require 'vendor/autoload.php'; // Load Composer dependencies

use RobThree\Auth\TwoFactorAuth;

session_start();

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=agrinurture', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    die("Unauthorized access. Please log in.");
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $twofaOption = filter_input(INPUT_POST, 'twofa', FILTER_SANITIZE_STRING);

    if ($twofaOption === 'enable') {
        try {
            // Enable 2FA
            $tfa = new TwoFactorAuth(null, 'agrinurture');
            $secret = $tfa->createSecret();

            // Save the 2FA secret to the database
            $stmt = $pdo->prepare("UPDATE users SET twofa_secret = :secret WHERE ID = :id");
            $stmt->execute([':secret' => $secret, ':id' => $userId]);

            // Generate QR Code
            $qrCodeUrl = $tfa->getQRCodeImageAsDataUri("Agrinurture ({$_SESSION['email']})", $secret);

            // Display success message and QR Code
            echo "Two-factor authentication enabled! Scan the QR code below with your authentication app:<br>";
            echo '<img src="' . $qrCodeUrl . '"><br>';
            echo '<a href="settings.php">Back to Settings</a>';
        } catch (Exception $e) {
            echo "An error occurred while enabling 2FA: " . htmlspecialchars($e->getMessage());
        }
    } elseif ($twofaOption === 'disable') {
        try {
            // Disable 2FA
            $stmt = $pdo->prepare("UPDATE users SET twofa_secret = NULL WHERE ID = :id");
            $stmt->execute([':id' => $userId]);

            echo "Two-factor authentication has been disabled.<br>";
            echo '<a href="settings.php">Back to Settings</a>';
        } catch (Exception $e) {
            echo "An error occurred while disabling 2FA: " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Invalid option. Please choose 'enable' or 'disable'.<br>";
        echo '<a href="setting.php">Back to Settings</a>';
    }
} else {
    echo "Invalid request method.<br>";
    echo '<a href="setting.php">Back to Settings</a>';
}
?>
