
<?php
     include 'db.php';

    session_start();

   
    // Restrict access to Admins only
    if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'Admin') {
        header("Location: a-login.html");
        exit;
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
            
           
            <li >
                <div class="title" >
                   <a href="#" class="link" id="reports">
                    <i class='bx bxs-report'></i>
                       <span  class="name">Reports</span>
                   </a>
                </div>
            </li> 
              
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

    
 
  
  


     <script type="module"  src="../js/admin.js"></script>

    <!-- <script>
        setTimeout(() => {
            const messageElement = document.getElementById('success-message');
            if (messageElement) {
                messageElement.classList.add('fade-out'); // Add fade-out effect
                setTimeout(() => messageElement.remove(), 1000); // Remove the element after the fade-out
            }
        }, 5000);
    </script> -->
   
</body>
</html>


