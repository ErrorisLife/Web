<?php
            // Configuration
            $resetLinkBaseURL = "http://localhost:3000/agrinurture/admin/forgotpass.html"; // Change to your reset page URL
            $expirationTime = 3600; // 1 hour in seconds

            // Generate a secure token
            function generateSecureToken($length = 32) {
                return bin2hex(random_bytes($length));
            }

            // Send the password reset email
            function sendPasswordResetEmail($userEmail, $userId) {
                global $resetLinkBaseURL, $expirationTime;

                // Generate the token
                $token = generateSecureToken();

                // Save the token and expiration time in the database
                saveResetTokenToDatabase($userId, $token, time() + $expirationTime);

                // Construct the reset link
                $resetLink = $resetLinkBaseURL . "?token=" . urlencode($token);

                // Email content
                $subject = "Password Reset Request";
                $message = "
                    <html>
                    <head>
                        <title>Password Reset Request</title>
                    </head>
                    <body>
                        <p>Hello,</p>
                        <p>We received a request to reset your password. Please use the link below to set a new password:</p>
                        <p><a href='$resetLink'>$resetLink</a></p>
                        <p>This link will expire in 1 hour.</p>
                        <p>If you didn't request this reset, please ignore this email. Your account is safe.</p>
                    </body>
                    </html>
                ";

                // Email headers
                $headers = [
                    "MIME-Version: 1.0",
                    "Content-type: text/html; charset=UTF-8",
                    "From: no-reply@example.com",
                ];

                // Send the email
                if (mail($userEmail, $subject, $message, implode("\r\n", $headers))) {
                    echo "Password reset email sent.";
                } else {
                    echo "Failed to send password reset email.";
                }
            }

            // Save token to database
            function saveResetTokenToDatabase($userId, $token, $expiration) {
                // Example connection (replace with your actual database connection)
                $pdo = new PDO("mysql:host=localhost;dbname=agrinurture", "root", "");

                // Store token and expiration time
                $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)
                                    ON DUPLICATE KEY UPDATE token = ?, expires_at = ?");
                $stmt->execute([$userId, $token, $expiration, $token, $expiration]);
            }

            // Example usage
            $userEmail = "user@example.com"; // Replace with the user's email
            $userId = 1; // Replace with the user's ID in your database
            sendPasswordResetEmail($userEmail, $userId);
    ?>

