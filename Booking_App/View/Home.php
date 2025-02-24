<?php

require_once dirname(__FILE__) . '/../../helper/SessionClass.php';


SessionClass::start();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../helper/Header.css">
    <style>
   
        body {
            
            position:relative;
            width: 100%;
            height: 100%;
            
        }

       

        
 footer {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}

.footer-left, .footer-center, .footer-right {
    flex: 1;
    padding: 10px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
}

.footer-links li {
    margin: 0 10px;
}

.footer-links a {
    color: #fff;
    text-decoration: none;
}

.footer-links a:hover {
    text-decoration: underline;
}

.social-media {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
}

.social-media li {
    margin: 0 10px;
   
}

.social-media img {
    width: 50px;
    height: 50px;
     border-radius: 320px;
}

 body{
            position:relative;
            width: 100%;
            height: 100%;
        }
        
        video::-webkit-media-controls,
        video::-webkit-media-controls-panel,
        video::-webkit-media-controls-play-button,
        video::-webkit-media-controls-timeline,
        video::-webkit-media-controls-current-time-display,
        video::-webkit-media-controls-time-remaining-display,
        video::-webkit-media-controls-mute-button,
        video::-webkit-media-controls-toggle-closed-captions-button {
            display: none;
        }

        .video-container {
            position: relative;
            width: 100%;
            max-height: 100%;
            overflow: hidden;
            top: 0px;
            left: 0px;
            height: 100%;
        }
        
        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .text-onfront{
            position: absolute;
            padding-top: 15px;
            top: 60%;
            left: 25.5%;
            transform: translate(-50%, -50%);
            color: black;
            font-size: 1.5em;
            text-align: center;
            z-index: 1;
            height: 250px;
            width: 918px;
        }
        
        .text-onfront button{
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.5em;
            font-weight: bold;
          ;
        }
        
        .recommendation-section {
            padding: 20px;
            text-align: center;
            background-color: #f5f5f5;
        }

        .recommendation-section h2 {
            margin-bottom: 20px;
        }

        .recommendation-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .recommendation {
            position: relative;
            width: 300px;
            height: 200px;
            overflow: hidden;
            cursor: pointer;
        }

        .recommendation img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .recommendation:hover img {
            transform: scale(1.1);
        }

        .info-tag {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .recommendation:hover .info-tag {
            opacity: 1;
        }

        .flight-icon {
            margin-bottom: 3px;
        }

        .flight-info {
            font-size: 1em;
            margin-bottom: 5px;
        }

        .flight-price {
            font-size: 1em;
            font-weight: bold;
        }
        
         .flight-info-container {
            
            align-items:center;
            justify-content: center;
            gap: 2px;
        }

        </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>


<body>
    <header>
        <a href="Home.php"><img id="logo" src="../../image/logo" alt="Logo"></a>
        <nav>
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="BookingFlight.php">Flight</a></li>
            <li><a href="booking_history.php">Booking History</a></li>
            <?php if (isset($_SESSION['Logged']) && $_SESSION['Logged'] == true): ?>
                    
                    <li><a href="UserProfile.php"><img id="ProLogo" src="../../image/profileLogo.png" alt="User Logo"> My Profile</a></li>
            <?php else: ?>
                   
                    <li><a href="email.html"><img id="ProLogo" src="../../image/profileLogo.png" alt="Profile Logo"> Sign In</a></li>
            <?php endif; ?>
        </ul>
        </nav>
    </header>
    <main>
        <body>
        <div class="video-container">
            <video controls autoplay loop muted disablepictureinpicture controlslist="nodownload noplaybackrate">
                <source src="../../image/airplane.mp4" type="video/mp4">
            </video>
        
            <div class="text-onfront">
                <h1>Search Your Destination Now</h1>
                 <form action="BookingFlight.php" method="get">
                    <button type="submit">BOOK NOW</button>
                </form>
            </div>
        </div>
       
        
          <div class="recommendation-section">
        <h2>Recommended Flights</h2>
        <div class="recommendation-container">
            <a href="BookingFlight.php">
            <div class="recommendation">
                <img src="../../image/flight1.jpg" alt="Flight 1">
                <div class="info-tag">
                    <div class="flight-info-container">
                        <div class="flight-icon"><i class="fas fa-plane"></i></div>
                        <div class="flight-info">Penang → Kuala Lumpur</div>
                        <div class="flight-price">Start From RM99</div>
                    </div>
                </div>
            </a>
            </div>
            <div class="recommendation">
                <a href="BookingFlight.php">
                <img src="../../image/flight2.jpg" alt="Flight 2">
                <div class="info-tag">
                    <div class="flight-info-container">
                        <div class="flight-icon"><i class="fas fa-plane"></i></div>
                        <div class="flight-info">Kuala Lumpur → Langkawi</div>
                        <div class="flight-price">Start From RM188</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="recommendation">
                <a href="BookingFlight.php">
                <img src="../../image/flight3.jpg" alt="Flight 3">
                <div class="info-tag">
                    <div class="flight-info-container">
                        <div class="flight-icon"><i class="fas fa-plane"></i></div>
                        <div class="flight-info">Kuala Lumpur→ Kota Kinabalu</div>
                        <div class="flight-price">Start From RM388</div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
        
         <div class="recommendation-container">
            <div class="recommendation">
                <a href="BookingFlight.php">
                <img src="../../image/flight4.jpg" alt="Flight 4">
                <div class="info-tag">
                    <div class="flight-info-container">
                        <div class="flight-icon"><i class="fas fa-plane"></i></div>
                        <div class="flight-info">Kuching → Penang</div>
                        <div class="flight-price">$359</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="recommendation">
                <a href="BookingFlight.php">
                <img src="../../image/flight5.jpg" alt="Flight 5">
                <div class="info-tag">
                    <div class="flight-info-container">
                        <div class="flight-icon"><i class="fas fa-plane"></i></div>
                        <div class="flight-info">Kuching → Sandakan</div>
                        <div class="flight-price">$279</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="recommendation">
                <a href="BookingFlight.php">
                <img src="../../image/flight6.jpg" alt="Flight 6">
                <div class="info-tag">
                    <div class="flight-info-container">
                        <div class="flight-icon"><i class="fas fa-plane"></i></div>
                        <div class="flight-info">Kota Kinabalu → Kuching</div>
                        <div class="flight-price">$199</div>
                    </div>
                </div>
                </a>
            </div>
        </div>
            <br>
    </body>
    </main>
    <footer>
    <div class="footer-content">
        <div class="footer-left">
            <p>&copy; 2024 AirFlyWithUs. All rights reserved.</p>
        </div>
        <div class="footer-center">
            <ul class="footer-links">
                <li><a href="privacy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-right">
            <p>Follow us:</p>
            <ul class="social-media">
                <li><a href="https://facebook.com" target="_blank"><img src="../../image/facebook.png" alt="Facebook"></a></li>
                <li><a href="https://twitter.com" target="_blank"><img src="../../image/twitter.jpeg" alt="Twitter"></a></li>
                <li><a href="https://instagram.com" target="_blank"><img src="../../image/ig.png" alt="Instagram"></a></li>
                <li><a href="https://linkedin.com" target="_blank"><img src="../../image/linkin.png" alt="LinkedIn"></a></li>
            </ul>
        </div>
    </div>
</footer>

</body>
</html>
