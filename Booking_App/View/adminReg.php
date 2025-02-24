
    <!DOCTYPE html>

    <html>

    <head>
        <title>User Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                display: flex;
                justify-content: center;
                width: 100%;
                padding: 20px;
            }

            .userContainer {
                width: 400px;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .signUp {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .signUp h2 {
                font-family: 'Arial', sans-serif;
                color: #333;
                text-align: center;
                margin-bottom: 20px;
            }

            .signUp label {
                font-weight: bold;
                color: #666;
            }

            .signUp input[type="text"],
            .signUp input[type="password"],
            .signUp input[type="number"]{
                padding: 10px;
                font-size: 14px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 90%;
            }

            .signUp input[type="text"]:focus,
            .signUp input[type="password"],
            .signUp input[type="number"]:focus {
                outline: none;
                border-color: #e31e25;
            }

            .signUp {
                display: flex;
                gap: 10px;
                align-items: center;
            }

            .signUp .btn-submit {
                padding: 12px;
                background-color: #e31e25;
                color: white;
                border: none;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s;
                align-self: center; 
            }
            .btn-submit {
                margin-top: 10px;
            }
            .signUp .btn-submit:hover {
                background-color: #c21a21;
            }
           .error {
                color: red;
                font-size: 12px;
            }
            .btn-back {
            padding: 12px;
            background-color: #ddd;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 40%;
        }

        .btn-back:hover {
            background-color: #bbb;
        }
            
            
        </style>

   
 <script>
     
document.addEventListener('DOMContentLoaded', function() {
  const togglePasswordButton = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('textPass');
 
  togglePasswordButton.addEventListener('click', () => {
      if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          togglePasswordButton.textContent = '🙈'; 
      } else {
          passwordInput.type = 'password';
          togglePasswordButton.textContent = '👁️'; 
      }
  });

   
 function clearError(event) {
      const fieldId = event.target.id;
      const errorElement = document.querySelector(`.error[data-field="${fieldId}"]`);
      if (errorElement) {
          errorElement.textContent = '';
      }
  }

   
  document.querySelectorAll('input').forEach(input => {
      input.addEventListener('input', clearError);
  });

 
 
});
  function goBack() {
            window.location.href = 'UserReg.html'; 
            }
        </script>

          
     </head>
    <body>

        <header>
        <a href="email.html"><img id="logo" src="../../image/logo" alt="Logo"></a>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="BookingFlight.php">Flight</a></li>
                <li><a href="booking_history.php">Booking History</a></li>
                <li><a href="index.html"><img id="ProLogo" src="../../image/profileLogo.png" alt="Profile Logo"> Sign In</a></li>
            </ul>
        </nav>
    </header>

        <main id="content">
            <div class="userContainer">
                <div class="signUp">
                    <h2>Sign Up As Admin</h2>
                    <form id="registrationForm" method="post"  >
                        <label for="textName">Name:</label>
                        <input type="text" name="textName" id="textName" placeholder="Enter your name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                        <div class="error" data-field="textName"><?php echo $errors['textName'] ?? ''; ?></div>

                        <label for="textPass">Password:</label>
                        <div style="position: relative;">
                            <input type="password" name="textPass" id="textPass" placeholder="Enter your password" value="<?php echo htmlspecialchars($pas ?? ''); ?>" required>
                            <button type="button" id="togglePassword" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                                👁
                            </button>
                            <div class="error" data-field="textPass"><?php echo $errors['textPass'] ?? ''; ?></div>
                        </div>

                        <label for="textID">ID Number:</label>
                        <input type="text" name="textID" id="textID" placeholder="Enter your ID number" value="<?php echo htmlspecialchars($IDNumber ?? ''); ?>" required>
                        <div class="error" data-field="textID"><?php echo $errors['textID'] ?? ''; ?></div>

                        <label for="textAdd">Address:</label>
                        <input type="text" name="textAdd" id="textAdd" placeholder="Enter your address" value="<?php echo htmlspecialchars($add ?? ''); ?>" required>
                        <div class="error" data-field="textAdd"><?php echo $errors['textAdd'] ?? ''; ?></div>

                        <label for="textDate">Birthday Date:</label>
                        <input type="text" name="textDate" id="textDate" placeholder="Enter your birthdate (YYYY-MM-DD)" value="<?php echo htmlspecialchars($birthdayDate ?? ''); ?>" required>
                        <div class="error" data-field="textDate"><?php echo $errors['textDate'] ?? ''; ?></div>

                        <label for="textAge">Age:</label>
                        <input type="text" name="textAge" id="textAge" placeholder="Enter your age" value="<?php echo htmlspecialchars($Age ?? ''); ?>" required>
                        <div class="error" data-field="textAge"><?php echo $errors['textAge'] ?? ''; ?></div>
                        <label for="textReference">Reference Code:</label>
                        <input type="text" name="textReference" id="textReference" placeholder="Enter your Reference Code" value="<?php echo htmlspecialchars($referenceCode ?? ''); ?>"  required>
                        <div class="error" data-field="textReference"><?php echo $errors['textReference'] ?? ''; ?></div>

                        <input type="submit" id="btn-submit" class="btn-submit" value="Register As Admin" >
                        <button type="button" class="btn-back" onclick="goBack()">Back</button>

                    </form>
                    
                    
                    
                </div>
            </div>
        </main>

    </body>
    </html>
