<?php
    include './admin/db.php';
    session_start();
    ;

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./admin/a-login.html");
        exit;
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrinurture</title>

    
    
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
                <a href="index.html"><img src="image/smaller pixels.png"></a>
            </div>
            <div class="holder">
                <a href="index.html"><h3>AGRI<span>NURTURE</span></h3></a>
            </div>    
        </div>
       

        <ul >        
            <li ><a href="announcement.php">Home</a></li>
            <li id="doc"><a href="documents.php">Documents</a></li>
            <li id="vid"><a href="videos.php">Videos</a></li>
            <!-- <li ><a href="cont.php">Contact Us</a></li>  -->
            <!-- <li ><a href="contact.html">Contact Us</a></li>  -->
            <li class="login" id="logout"><a href="logoutconfirmation.php">Logout</a></li>          
          
        </ul>

    </nav>

    <div class="contact-header">   
        <a href="contact.html"><h1>Contact Us</h1></a>
    </div>

    <div class="contact-container">
        <div class="form-section">
            
            <form>
                <input type="text" name="name" placeholder="Name" required>
                <input type="tel" name="subject" placeholder="Subject" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" placeholder="Message" required></textarea>
                <button type="submit">Submit</button>
            </form> 
        </div>
        <div class="profile-section">
            <img src="image/Fernan.jpg" alt="Profile Picture">
            <h2>Fernan Cabuso</h2>
            <p>agrinurture3@gmail.com</p>
            <p>(480) 502-7514</p>
        </div>
    </div>

    <footer class="footer">

        <div class="footer-logos">
            <a target="_blank" href="https://www.quezonpalawan.org/" class="footer-logo"> <img src="image/QuezonLogo.png" alt="Municipality of Quezon" > </a>
            <a target="_blank" href="" class="footer-logo"> <img src="image/Da-Logo.png" alt="Department of Agriculture" > </a>
        </div>

        <ul class="social-icon">
              <li class="social-icon__item"><a class="social-icon__link" href="https://www.facebook.com/profile.php?id=61552913120874" target="_blank">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
              <li class="social-icon__item"><a class="social-icon__link" href="https://mail.google.com/mail/u/1/#inbox" target="_blank">
                    <ion-icon name="mail-outline"></ion-icon>
                </a></li>
              
        </ul>

        <ul class="menu">
              <li class="menu__item"><a class="menu__link" href="index.php">Home</a></li>
             
              <li class="menu__item"><a class="menu__link" href="about.html">About</a></li>
              <li class="menu__item"><a class="menu__link" href="contact.html">Contact Us</a></li>
        </ul>
        
        <div class="copyright">
            <p>&copy;2024 Agrinurture | All Rights Reserved</p>
        </div>
    </footer>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



</body>
</html>