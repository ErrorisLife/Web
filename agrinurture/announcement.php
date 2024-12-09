<?php
    include './admin/db.php';

    session_start();
    ;

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./admin/a-login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Fetch user name from the database
    $sql = "SELECT fullname FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $fullname = $user['fullname'];


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
            <li ><a href="cont.php">Contact Us</a></li> 
            <li id="profile"><a href="profile.php">Profile</a></li>
            <li class="login" id="logout"><a href="logoutconfirmation.php">Logout</a></li>                         
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

        <div class="second-container">
            
            <?php // Fetch the latest announcement
                    $sql = "SELECT * FROM announcement ORDER BY ID DESC LIMIT 1";  // Adjust table name as needed
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Fetch the announcement data
                        $row = $result->fetch_assoc();
                        $title = $row['title'];
                        $content = $row['description'];
                        $date_posted = $row['date'];
                    } else {
                        $title = "No Announcement Available";
                        $date_posted = "";
                        $content = "There are currently no announcements to display.";
                    }

                    $conn->close();
            ?>



                <div class="Title">
                    <h2> <?php echo htmlspecialchars($title); ?></h2>
                </div>
                <div class="timePosted">
                    <p>Posted on <?php echo htmlspecialchars($date_posted); ?></p>
                </div>
                <div class="content">

                        <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
                           
                </div>

    </div>

                
         </div>


            
    </div>

   

    
    
</body>
</html>
