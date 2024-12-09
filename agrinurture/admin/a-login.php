
<?php
    include 'db.php';
    session_start();
 // Database connection file

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
                    $_SESSION['error_message'] = "incorrect email or password.";
                }
            } else {
               
                $_SESSION['error_message'] = "No account found with that email.";
            }

            $stmt->close();
            $conn->close();
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>

    <div class="signup-container" id="signup-container" > 
            <div class="closeButton">
               <a href="../index.php"> <span><i class="fa-solid fa-circle-xmark"></i></span> </a>
            </div>
        <h2>Welcome!</h2>

            <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="message error">
                        <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                    </div>
            <?php endif; ?>
            <br>
        
        <form  method="POST" action=" ">
                <div class="input-group">
                    <label for="username">
                        <span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="text" id="username"  placeholder="Email" name="email"  autocomplete="on" required>
                    </label>
                </div>
                <div class="input-group">
                    <label for="loginpassword">
                        <span class="icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <input type="password" id="loginpassword" name="password" placeholder="Password" required>
                    </label>
                </div>

                <div class="forgot">
                    <div class="block">
                        <input type="checkbox" class="showpass" id="showpass"> Show Password
                    </div>
                    <div class="block">
                        <a href="../forgotpass.php">Forgot password?</a>
                    </div>
                    
                </div>
                
                <button type="submit" value="Login" class="signup-button">Login</button>
                
        </form>
        <br>
        <p class="dontHaveAccount" id="register">Don't have an account? <a href="createacc.html">Create Account</a></p>
        
    </div>



  
    <script  type="module" src="../js/show-password.js"></script>
</body>
</html>