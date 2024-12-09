
<?php
    include './admin/db.php';


    session_start();
    ;

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./admin/a-login.html");
        exit;
    }

    $user_id = $_SESSION['user_id'];

        
    // Fetch user data
    $sql = "SELECT fullname, email, address FROM users WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $fullname = $user['fullname'];
    $email = $user['email'];
    $address = $user['address'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        // Update profile details
        $sql = "UPDATE users SET fullname = ?, email = ?, address = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $fullname, $email, $address, $user_id);

        if ($stmt->execute()) {
            // Optional: Handle password update
            if (!empty($_POST['new_password']) && $_POST['new_password'] === $_POST['confirm_password']) {
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = ? WHERE ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $new_password, $user_id);
                $stmt->execute();
            } else {
                
            }
    
            header("Location: announcement.php");
           
            exit();
        } else {
            $error = "Failed to update profile. Please try again.";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrinurture</title>


    
    <link rel="stylesheet" href="css/document.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />
    
</head>
<body>

    <nav>
        
        <input type="checkbox" name="" id="check">
        <label for="check" class="checkbtn"> 
            <i class="fa-solid fa-bars" ></i>
        </label>
        
        
        <div class="logo-holder">
            <div class="holder">
                <a href="announcement.php"><img src="image/smaller pixels.png"  alt="agrinurure logo"></a>
            </div>
            <div class="holder">
                <a href="announcement.php"><h3>AGRI<span>NURTURE</span></h3></a>
            </div>    
        </div>
        

        <ul >        
            <li ><a href="announcement.php">Home</a></li>
            <li ><a href="documents.php">Documents</a></li>
            <li ><a href="videos.php">Videos</a></li> 
            
            <li class="login" id="logout"><a href="logout.php">Logout</a></li>                      
        </ul>

       
    </nav>

   

    <div class="document-container">

        

        <div class="sidebar">
               
            <div class="user-info">
            <h3><?php echo htmlspecialchars($fullname); ?></h3>
                <div class="settings">
                    <span><i class="fa-solid fa-gear"></i>  Setting  <i class="fa-solid fa-angle-down"> </i></span>
                    <ul class="settings-menu">
                        <li><a href="profile.php">Profile</a></li>
                        
                        <li><a href="logoutconfirmation.php">Logout</a></li>
                    </ul>
                </div>
            </div>

            <div class="category">
                <h3>Category</h3>
                <ul class="category-menu">
                    <li><a href="#">Crops</a></li>
                    <li><a href="#">Livestock</a></li>
                    <!-- <li><a href="#">Organic</a></li> -->
                </ul>
            </div>
            
        </div>

    
        <div class="search-bar">  
             <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="message error">
                        <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                    </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="message success">
                        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                    </div>
                <?php endif; ?>
           
            <div class="container">
            <form method="post">
                    <h3>Profile</h3>
                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

                    <br><br><br>
                    <h3>Change Password</h3>
                    <input type="password" name="new_password" placeholder="New Password">
                    <input type="password" name="confirm_password" placeholder="Confirm Password">

                    <button type="submit" class="submit">Save changes</button>
                </form>
                </div>

                    
         </div>

     
            
    </div>
    
        

</body>
</html>
