
<?php
    include './admin/db.php';

    session_start();
    ;

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./admin/a-login.html");
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
                <a href="announcement.php"><img src="image/smaller pixels.png" alt="agrinurure logo"></a>
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


            <input class="search-bar-search" type="text" placeholder="Search here...">
            <button class="search-bar-button">Search</button>

                       

            <!-- <div class="document-list">
                <div class="video-item" >
                    <iframe   src="https://www.youtube.com/embed/xHgePNAQc3U?si=CGgRl-9zMR4zTeNj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>        
                    <p>1-Minute Facts: Overview of the Philippine Agriculture</p>
                </div>
                 <div class="video-item">
                    <iframe  src="https://www.youtube.com/embed/J_mMS3EkHok?si=jnK9IMthKTa3FtUg"  title="OneRepublic - Nobody (from Kaiju No. 8) [Official Music Video]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>     
                    <p>Rice Farming: Complete Guide from Seeds to Harvest</p>
                </div>
                <div class="video-item">
                    <iframe  src="https://www.youtube.com/embed/CF7pCSfKjZg?si=JoCWuC3IOAUIGZII"  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <p>Sheep farming in the Philippines | Sheep farming part 1</p>
                </div>
            
                <div class="video-item">
                    <iframe  src="https://www.youtube.com/embed/Ll4VzAFHzZQ?si=femKkeZY3udONbm1"  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <p>Sheep farming in the Philippines | Sheep farming part 2</p>
                </div>
               
                <div class="video-item">
                    <iframe  src="https://www.youtube.com/embed/zr3b3D7N9cw?si=G4XyavrO9ERPnhna"  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <p>Pekin Duck Breeding Part 2 : Pekin duck Breeding Management | Agribusiness Philippines</p>
                </div>
            
                <div class="video-item">
                    <iframe  src="https://www.youtube.com/embed/HQQ8AHOxNdw?si=t77kmnXf6b9xqq81"  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <p>Corn Farming in the Philippines : Complete Guide from Seeds to Harvest</p>
                </div> -->
                
         </div> 


            
    </div>
    
        
    
</body>
</html>