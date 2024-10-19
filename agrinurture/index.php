<?php
    session_start();
    $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Agrinurture is a website that provides information on agriculture and local farming.">
    <meta name="keywords" content="Agrinurture, agriculture, farming, farming techniques, farming videos, farming tips, 
                                farming advice, farming news, farming updates, farming information, resources">
    
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
                <a href="index.php"><img src="image/smaller pixels.png"></a>
            </div>
            <div class="holder">
                <a href="index.php"><h3>AGRI<span>NURTURE</span></h3></a>
            </div>    
        </div>
       

        <ul >        
            <li ><a href="index.php">Home</a></li>
            <li id="doc"><a href="documents.html">Documents</a></li>
            <li id="vid"><a href="videos.html">Videos</a></li>
            <li ><a href="about.html">About</a></li>
            <li ><a href="contact.html">Contact Us</a></li> 
            <li class="login"><a href="admin/a-login.html">Login</a></li>    
        </ul>

    </nav>
   
   <div class="slogan-container">  
        <div class="content">
            <h3>Agriculture Insights at your fingertips</h3>
        </div>
    </div>
   
    
    <div class="second-container">
        <div class="Title">
            <h2> Training on Organic Vegetable Production</h2>
        </div>
        <div class="timePosted">
            <p>Posted on 01.01.2022</p>
        </div>
        <div class="content">

                <p>Organic vegetable production is a growing field that emphasizes sustainable farming practices. This training program is designed to educate farmers, gardeners, and enthusiasts about the methods involved in cultivating vegetables without the use of synthetic fertilizers, pesticides, or genetically modified organisms (GMOs).</p>
                
                <p>The program covers various topics, including:</p>
                

                <p>Participants will also learn about the benefits of organic farming, including improving soil health, promoting biodiversity, and producing healthier, chemical-free food for consumers. The training will combine hands-on activities with classroom instruction to ensure participants gain practical experience in organic vegetable farming.</p>

                <p>Whether you're an experienced farmer looking to transition to organic methods, or a beginner just starting out, this training will provide you with the knowledge and skills needed to succeed in organic vegetable production.</p>

        </div>

    </div>

    <div class="second-container">
        <div class="heading">
            <h2>We are here to empower farmers</h2>
        </div>

        <div class="text-picture-container">
            <div class="text">
                <p>We believe that every farmer deserves to have control over their crops, and we are here to help them achieve just that. 
                Our platform provides farmers with the tools they need to grow better crops, sell their produce at fair prices, 
                and make informed decisions and connect with potential buyers.</p>
                <br><br>
                <a href="about.html"><button>About Us</button></a>
            </div>
        
            <div class="picture">
                <img src="image/organic1.JPG" alt="Organic Vegetables"> 
            </div>
        </div>
    </div>

    <div class="third-container">
        <div class="heading">
            <h2 id="features">Our Features</h2>
        </div>
        <p class="description">
            In a more general sense, the patterns of the strategic decision enforces the overall effect of the proper stem of the critical thinking. 
            It's a well-known fact that the possibility of achieving elements of the operational system, as far as the
            ground-breaking technology is questionable, must be compatible with the questionable thesis.
        </p>

        <div class="row">
            <div class="column">
                <img src="image/crops.jpg" alt="Crops">
                <h2>CROPS</h2>
                <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                <?php if ($isLoggedIn): ?>
                    <a href="documents.html" class="read-more">READ MORE</a>
                <?php else: ?>
                    <a href="./admin/a-login.html" class="read-more">READ MORE</a>
                <?php endif; ?>
            </div>

            <div class="column">
                <img src="image/livestock.jpg" alt="Livestock">
                <h2>LIVESTOCKS PRODUCTION</h2>
                <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                <?php if ($isLoggedIn): ?>
                    <a href="documents.html" class="read-more">READ MORE</a>
                <?php else: ?>
                    <a href="./admin/a-login.html" class="read-more">READ MORE</a>
                <?php endif; ?>
            </div>

            <div class="column">
                <img src="image/organic.jpg" alt="Organic Vegetables">
                <h2>ORGANIC VEGETABLES</h2>
                <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                <?php if ($isLoggedIn): ?>
                    <a href="documents.html" class="read-more">READ MORE</a>
                <?php else: ?>
                    <a href="./admin/a-login.html" class="read-more">READ MORE</a>
                <?php endif; ?>
            </div>
        </div>
        <br><br>
        <div class="video">
            <div class="videoHolder">
                
                <iframe width="320" height="240" src="https://www.youtube.com/embed/Bc1UJZTcHkc?autoplay=1&mute=1" 
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>
                <p>
                     Ever wondered how the food on your plate is grown, harvested, and delivered? Dive into the world of modern agriculture with this eye-opening video!
                     Learn how farmers are using cutting-edge technology to increase yields and protect the environment. Whether you're passionate about the environment, 
                     curious about where your food comes from, or just love learning something new, this video is a must-watch. 🌍🍃
                </p>
                
                <?php if ($isLoggedIn): ?>
                    <a href="videos.html"><button class="vidButton">Watch Video</button></a>
                <?php else: ?>
                    <a href="./admin/a-login.html"><button class="vidButton">Watch Video</button></a>
                <?php endif; ?>
                
                
            </div>
        </div>

    </div>

    <div class="contact-container">
        <div class="form-section">
            <h1>Contact Us</h1>
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


    <script src="./js/redirect.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
 

        
</body>
</html>

