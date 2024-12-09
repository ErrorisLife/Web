
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
        } else {
            $errorMessage = "Error updating profile. Please try again.";
        }
    }

    $sidebarClass = isset($_SESSION['sidebarClosed']) && $_SESSION['sidebarClosed'] ? 'close' : '';

    echo $sidebarClass; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="10"> --> 
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../css/dashboard.css">
   
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    
    <div class="sidebar">
       <!-- ======Logo====== -->
        <a href="#" class="logo-box">
            <img src="../image/smaller pixels.png" alt="logo">
            <div class="logo-name">Agrinurture</div>
        </a>

     
        <!-- ======Menu====== -->
        <ul class="sidebar-list">     
             <li>
                 <div class="title" >
                    <a href="dashboard.php" class="link" id="adminDashboard" >
                        <i class='bx bxs-grid-alt'></i>
                        <span  class="name">Dashboard</span>
                    </a>
                    
                 </div>
             </li>
             
             <li>
                <div class="title"  >
                   <a href="uploadingfile.php" class="link" id="upload-link">
                    <i class='bx bxs-plus-circle'></i>
                       <span class="name">Upload</span>
                   </a>
                   
                </div>
            </li>
        
        <!-- 
            <li class="userManage">
                <div class="title" >
                   <a href="#" class="link" id="userManagement">
                    <i class='bx bxs-user-detail'></i>
                       <span  class="name" > User Management </span>   
                    </a>
                          
                </div>
               
        </li>  -->
            
           
            <!-- <li >
                <div class="title" >
                   <a href="#" class="link" id="reports">
                    <i class='bx bxs-report'></i>
                       <span  class="name">Reports</span>
                   </a>
                </div>
            </li>  -->
              
            <li >
                <div class="title" >
                   <a href="setting.php" class="link" id="setting">
                    <i class='bx bxs-cog'></i>
                       <span  class="name">Setting</span>
                   </a>
                </div>
            </li> 
          
            <li>
                <div class="title" >
                   <a href="confirmation.php" class="link" id="logout">
                    <i class='bx bxs-log-out'></i>
                       <span  class="name">Log Out</span>
                   </a>
                   
                </div>
            </li>     
        </ul>
    </div>
   
      <!-- ==========Home Section========= -->
      <section class="home">
            <div class="toggle-sidebar">
                <i class='bx bx-menu'></i>
                <div class="text">Admin</div>
            </div>
      </section>

    <!-- ==========Dashboard Container-Content========= -->
   
    </section>

  

    <!------------------------------- Settings  ------------------------------->
    <section class="setting-container" id="setting-container"> 

                
        <h1>Settings</h1>
            <div class="settings-section">
                <!-- Account Settings -->
                <h3>Account Setting</h3>

            
                <form method="POST" action="">
                    <div class="input-setting">
                        <div class="settingInputGroup">
                            <label for="username">Fullname:</label>
                            <input type="text" id="accSettingUsername" name="fullname" value="<?php echo htmlspecialchars($adminName); ?>" required>
                        </div>
                        <div class="settingInputGroup">
                            <label for="email">Email:</label>
                            <input type="email" id="accSettingEmail" name="email" value="<?php echo htmlspecialchars($adminEmail); ?>" required>
                        </div>
                        <div class="settingInputGroup">
                            <label for="password">Change Password:</label>
                            <input type="password" id="accSettingPassword" name="password" placeholder="New Password">
                        </div>
                        <div class="settingInputGroup">
                            <button type="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="settings-section">
                <!-- Security Settings -->
                <h3>Security Setting</h3>

                <form method="POST" action="save_2fa_setting.php">
                    <div class="security-setting">
                        <div class="security"> 
                            <label for="two-factor">Two-Factor Authentication</label>
                            <p>
                                <input type="radio" name="twoFactor" class="yes" value="enable" id="enable-2fa"> 
                                Yes, enable two-factor authentication.
                            </p>
                            <p>
                                <input type="radio" name="twoFactor" class="no" value="disable" id="disable-2fa" checked> 
                                No, default.
                            </p> 
                        </div>
                        <div class="securityButton">
                            <button type="submit">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="settings-section">
                <!-- Backup Settings  -->
                <h3>Backup & Restore</h3>

                <div class="backup-setting">
                    <div class="backupGroup">
                        <label for="two-factor">Backup and Restore</label>
                        <button type="button">Create Backup</button>
                    </div>
                    <div class="backupGroup">
                        <label for="two-factor">Restore from Backup</label>
                        <button type="button">Restore</button>
                    </div>
                </div>
            </div>

            <div class="settings-section">
                <!-- Help and Support Settings -->
                <h3>Help and Support</h3>

                <div class="helpandsupport">
                    <div class="help">
                        <p>If you need any help, feel free to reach out to our support team <a href="" target="_blank">support@agrinurture.com</a></p>
                        <p>Visit our <a href="" target="_blank"> FAQ</a>  or check the <a href="" target="_blank">User Guides</a>  for quick help.</p>
                    </div>
                    
                </div>
            </div>

    </section>



    <script type="module"  src="../js/admin.js"></script>
    
</body>
</html>


