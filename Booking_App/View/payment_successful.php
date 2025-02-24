<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
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
        .message-box .checkmark {
            font-size: 100px;
            color: green;
        }
        .message-box h1 {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }
        .message-box button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .message-box button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="message-box">
        
        <div class="checkmark">&#10004;</div>
        <h1>Payment Successful!</h1>
        <button onclick="goHome()">OK</button>
    </div>

    <script>
        // Function to redirect to homepage
        function goHome() {
            alert("Payment successful! Redirecting to homepage...");
            window.location.href = 'Home.php'; // Replace 'index.html' with your homepage URL
        }
    </script>
</body>
</html>