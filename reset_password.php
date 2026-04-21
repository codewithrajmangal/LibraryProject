
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Library Management System</title>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });
            
            function validateForm() {
               
                var password = document.forms["signupForm"]["NewPassword"].value;
                var passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,14}$/;
                if (!passwordPattern.test(password)) {
                    alert("Password must be between 8 and 14 characters and contain at least one special symbol.");
                    return false;
                }
                return true;
            }
    </script>
</head>

<body>
    <!-- <div class="container1"> -->

        <!--header start-->
        <!-- <header class="page-head">
            <p></p>

        </header> -->
    <?php    if (isset($_GET['email'])) {
        $email = htmlspecialchars($_GET['email']);
    } else {
        echo "<p>Email parameter is missing. Please use the link from your email to reset your password.</p>";
        exit;
    }
    ?>
       <div class="clear"></div>

        <div class="main-contain">

           <div class="welcome"><p> <t>Welcome to our library.<br><br>Making your experience easier.</p></div>
           
              <div class="wrapper">
                <form action="update_password.php" method="post">
                    <h1>Forgot Password</h1>
                    <div class="input-box">
                    <input type="hidden" name="Email" value="<?php echo $email; ?>">
                    </div>
                     <div class="input-box">
                    <input type="text" name="VerificationCode" placeholder="Verification Code" required>
                    </div> 
                    <div class="input-box">
                    <input type="password" name="NewPassword" placeholder="Enter New Password" required>
                    </div> 
                    <button type="submit" class="btn">Reset Password</button>
                    <div class="register-link">
                       <p>Having verification error? Register again. <a href="register.php">Register</a></p>
                       <!--   <p>Already have an account? <a href="indexA.php"> Login Now!</a></p> -->
                    </div>
                </form>
              
            </div>
            
        </div>      
    </div>
</body>
</html>
