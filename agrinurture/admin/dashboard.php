
<?php
     include 'db.php';

    session_start();

   
    // Restrict access to Admins only
    if (!isset($_SESSION['user_id']) || $_SESSION['userType'] !== 'Admin') {
        header("Location: a-login.html");
        exit;
    }

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
    <section class="admin-container">

          

        <div class="content-box">
           <div><h3>Documents</h3></div>
          
           <div class="box">
                <div class="box-container">
                    <h2>17</h2>
                </div>
                  
           </div>          
        </div>
        
        <div class="content-box">
            <div><h3>Videos</h3></div>
           
            <div class="box">
                 <div class="box-container">
                    <h2>10</h2>
                 </div>
                   
            </div>          
         </div>  

         <div class="content-box">
            <div><h3>Total of Users</h3></div>
           
            <div class="box">
                 <div class="box-container">
                    <h2>5</h2>
                 </div>
                   
            </div>          
         </div>  

         <div class="second-container">
            
            <?php // Fetch the latest announcement
                $category = "";
                    $sql = "SELECT * FROM announcement ORDER BY ID DESC LIMIT 1";  // Adjust table name as needed
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Fetch the announcement data
                        $row = $result->fetch_assoc();
                        $title = $row['title'];
                        $content = $row['description'];
                        $date_posted = $row['date'];
                        $category = $row['category'];
                    } else {
                        $title = "No Announcement Available";
                        $date_posted = "";
                        $content = "There are currently no announcements to display.";
                    }

                    $conn->close();
            ?>



                <div class="Title">
                        <h5><?php echo htmlspecialchars($category); ?></h5>
                    <h3 class="titlePosted"> <?php echo htmlspecialchars($title); ?></h3>
                </div>
                <div class="timePosted">
                    <p>Posted on <?php echo htmlspecialchars($date_posted); ?></p>
                </div>
                <div class="content">

                        <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
                           
                </div>

    </div>


</section>

    

  
  


    <script type="module"  src="../js/admin.js"></script>

    <!-- <script>// Hide the message after 5 seconds
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


