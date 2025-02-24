<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Unsuccessful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .message-box {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .message-box .icon {
            font-size: 100px;
            color: red;
        }
        .message-box h1 {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }
        .message-box p {
            font-size: 18px;
            margin: 10px 0;
        }
        .message-box button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .message-box button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <div class="icon">&#10060;</div>
        <h1>Payment Unsuccessful!</h1>
        <p>An error occurred. Please try again or contact support.</p>
        <button onclick="goHome()">OK</button>
    </div>

    <script>
        // Function to redirect to homepage
        function goHome() {
            window.location.href = 'homepage.php'; // Replace 'homepage.php' with your actual homepage URL
        }
    </script>
</body>
</html>
