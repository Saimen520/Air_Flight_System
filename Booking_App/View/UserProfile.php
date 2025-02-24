
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Page Title</title>
        <link rel="stylesheet" href="../../helper/Header.css">
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #f0f0f0;
                font-family: 'Arial', sans-serif;
            }

            body {
                display: flex;
                justify-content: center;
                align-items: center;
                padding-top: 100px;
            }

            main {
                width: 80%;
                padding: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;

            }

            th, td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f4f4f4;
            }

            td {
                background-color: #fff;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            #UserLogo{
                width: 60px
            }
            #logOut, #deleteAccount {
                padding: 10px 20px;
                margin: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
                color: white;
                transition: background-color 0.3s ease;
            }

            #logOut {
                background-color: #4CAF50;
            }

            #logOut:hover {
                background-color: #45a049;
            }

            #deleteAccount {
                background-color: #f44336;
            }

            #deleteAccount:hover {
                background-color: #d32f2f;
            }

            form {
                display: inline-block;
            }

        </style>

    </head>
    <body>
        <header>
            <a href="Home.php"><img id="logo" src="../../image/logo" alt="Logo"></a>
            <nav>
                <ul>
                    <li><a href="Home.php">Home</a></li>
                    <li><a href="BookingFlight.php">Flight</a></li>
                    <li><a href="booking_history.php">Booking History</a></li>
                    <li><a href="UserProfile.php"><img id="ProLogo" src="../../image/profileLogo.png" alt="User Logo"> My Profile</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php 
            require_once dirname(__FILE__) . '/../Controller/profileController.php';
   
            echo $html; 
            ?>
            <br>
            <form action="../Controller/LogoutProcess.php" method="post">
                <input type="submit" id="logOut" value='Log Out'>
            </form>

            <form action="../Controller/DeleteUser.php" method="post" id="deleteAccountForm">
                <input type="submit" id="deleteAccount" value='Delete Account'>
            </form>
        </main>
    </body>
</html>
