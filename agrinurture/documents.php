
<?php
    include './admin/db.php';
    
    session_start();
    ;

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./admin/a-login.html");
        exit;
    }

    $user_id = $_SESSION['user_id'];

   
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
            <?php 
                            // Fetch user name from the database
                $sql = "SELECT fullname FROM users WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                $fullname = $user['fullname'];
            ?>
               
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

                <?php
                    // Query the database for files
                    $query = "SELECT * FROM uploaded_files ORDER BY uploaded_at DESC";
                    $result = $conn->query($query);

                    $documents = []; // Array to store document files
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $fileName = $row['file_name'];
                            $fileType = $row['file_type']; // e.g., application/pdf
                            $fileId = $row['ID'];

                            // Supported document extensions
                            $documentExtensions = ['application/pdf', 'application/msword', 'docx'];

                            // Filter supported files
                            if (in_array($fileType, $documentExtensions)) {
                                $documents[] = ['ID' => $fileId, 'name' => $fileName, 'type' => $fileType];
                            }
                        }
                    }       
                ?>
           

                <input class="search-bar-search" type="text" placeholder="Search here...">
                <button class="search-bar-button">Search</button>

                <div class="document-list">
                    <?php

                    if (!empty($documents)) {
                        foreach ($documents as $document) {
                            // Default icon
                            $icon = "image/png icon.png";

                            // Set icon based on file type
                            switch ($document['type']) {
                                case 'application/pdf':
                                    $icon = 'image/png icon.png';
                                    break;
                                case 'application/msword':
                                    $icon = 'image/doc.png';
                                    break;
                                case 'docx':
                                    $icon = 'image/docx.png';
                                    break;
                            }

                            // Generate links for view and download
                            echo '<div class="pdf-item">';
                            echo '  <a href="retrieve_file.php?ID=' . $document['ID'] .$document['name'] . '" target="_blank">
                                        <img src="' . $icon . '" alt="File Icon" class="pdf-icon">
                                    </a>';
                            echo '  <a href="retrieve_file.php?ID=' . $document['ID'] .$document['name']  . '" target="_blank">' . htmlspecialchars($document['name']) . '</a>';
                            echo '  <a href="retrieve_file.php?ID=' . $document['ID'] . '&download=true">
                                        <button class="download">Download</button>
                                    </a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No documents found.</p>';
                    }
                    
                    ?>
                </div>

            </div>

            
    </div>
    
        
    
</body>
</html>