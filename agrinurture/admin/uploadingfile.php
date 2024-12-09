
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

    
    <div class="sidebar ">
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

  

  
     <!-- ======== Upload ======= -->
     <section class="upload-container">

        <div class="group">
            <button  class="uploads" id="uploadButton">Upload Files</button>
            <button  class="posts" id="postButton">Post</button>
        </div>

       

        <div class="upload-box" id="upload-box" >

        <?php
        // Check if the form was submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formType']) && $_POST['formType'] === 'fileUpload') {

                        
                        // Check if a file was uploaded
                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    // Get the category
                    $category = isset($_POST['category']) ? htmlspecialchars($_POST['category']) : '';

                    // Validate category
                    $allowedCategories = ['Crops', 'Livestock', 'Organic'];
                    if (!in_array($category, $allowedCategories)) {
                        $_SESSION['error_message'] = "Invalid category selected.";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }

                    // File details
                    $fileTmpPath = $_FILES['file']['tmp_name'];
                    $fileName = $_FILES['file']['name'];
                    $fileType = $_FILES['file']['type'];
                    $fileSize = $_FILES['file']['size'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    // Validate file extension
                    $allowedExtensions = ['docx', 'doc', 'pdf', 'mp4'];
                    if (!in_array($fileExtension, $allowedExtensions)) {
                        $_SESSION['error_message'] = "Invalid file type. Only .docx, .doc, .pdf, and .mp4 are allowed.";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }

                    // Check file size (optional)
                    $maxFileSize = 16 * 1024 * 1024; // 16MB
                    
                    if ($fileSize > $maxFileSize) {
                        $_SESSION['error_message'] = "File size exceeds the allowed limit of 5MB.";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }

                    // Read the file content
                    $fileData = file_get_contents($fileTmpPath);

                    // Insert file into the database
                    $stmt = $conn->prepare("INSERT INTO uploaded_files (file_name, file_data, file_type, file_size, category, uploaded_at) VALUES (?, ?, ?, ?, ?, NOW())");
                    $stmt->bind_param("sssis", $fileName, $fileData, $fileType, $fileSize, $category);

                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = "File uploaded successfully.";
                    } else {
                        $_SESSION['error_message'] = "Failed to save the file in the database.";
                    }

                    $stmt->close();
                } else {
                    $_SESSION['error_message'] = "No file uploaded or there was an error.";
                }

                            

                // Redirect to the same page to prevent form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        ?>


            <h2>Upload Here</h2>

            <!-- Display success or error message -->
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="message success">
                        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="message error">
                        <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                    </div>
                <?php endif; ?>

            <br><br>

                <!-- Progress Bar -->
            <div id="progress-container" style="display:none;">
                <progress id="upload-progress" value="0" max="100"></progress>
                <p id="progress-status">0%</p>
            </div>

            <form id="uploadForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return confirmUpload();">


                <input type="hidden" name="formType" value="fileUpload">
                <input class="file-selector" type="file" name="file" id="file"  accept=".docx, .doc, .pdf, .mp4" required > <br><br>
           

                <label for="category">Choose a Category:</label><br><br>

                <select class="category" name="category" id="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="Crops">Crop</option>
                    <option value="Livestock">Livestock</option>
                    <option value="Organic">Organic Vegetable</option>
                </select><br>

                <button class="uploadBtn" type="submit">Upload</button>
            </form>
        </div>
           
        <!-- Loading Spinner -->
        <div id="spinner" style="display:none;">Uploading...</div>

         <!-- ------------------------------------ Admin Interface for Announcement --------------------------------------------- -->
        <div id="announcement" class="announcement">
        
            <?php 
                        // Check if the request is POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formType']) && $_POST['formType'] === 'announcementPost') {
                    // Retrieve form data
                    $title = $conn->real_escape_string($_POST['titleofannouncement']);
                    $description = $conn->real_escape_string($_POST['message']);
                    $category = $conn->real_escape_string($_POST['category']);

                    // SQL query to insert data with the current date
                    $sql = "INSERT INTO announcement (title, description, category, date) 
                            VALUES ('$title', '$description', '$category', CURDATE())";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>
                                alert('Announcement posted successfully!');
                                window.location.href = 'dashboard.php'; // Redirect to the form after success
                            </script>";
                    } else {
                        echo "<script>
                                alert('Error: Unable to post the announcement.');
                                window.location.href = 'uploadingfile.php'; // Redirect on error
                            </script>";
                    }


                    // Close the connection
                    $conn->close();
             }
         
         
         ?>

            <h3>New Post</h3>

            <form id="announcementForm" action="" method="POST">
                <input type="hidden" name="formType" value="announcementPost">
                    <div class="innerbox" id="innerbox"> 
                        <div class="boxed">
                            <label for="title">Title</label>
                            <input type="text" name="titleofannouncement" id="title" placeholder=" Title" required>
                        
                            <label for="description">Description</label>
                            <textarea name="message" placeholder="Description" required></textarea>

                            <label for="category">Category</label>
                            <select class="category" name="category" id="category" required>
                                <option value="Announcement">Announcement</option>
                                <option value="Update">Update</option>                          
                                <option value="Event">Event</option>
                            </select>   
                        </div>
                        <div class="btnPost">
                            <button type="submit" id="postAnnouncement">Post</button>
                        </div>
                    </div>
            </form>
        </div>

    </section>

  


        
        


    <script type="module"  src="../js/admin.js"></script>

    <script>
          function confirmUpload() {
                return confirm("Are you sure you want to upload this file?");
         }

            
       
    </script>
    
</body>
</html>


