
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Library Management System</title>
</head>

<body>
    <!-- <div class="container1"> -->

        <!--header start-->
        <!-- <header class="page-head">
            <p></p>

        </header> -->

       <div class="clear"></div>

        <div class="main-contain">

           <div class="welcome"><p> <t>Welcome to our library.<br><br>Making your experience easier.</p></div>
           
              <div class="wrapper">
                <form action="send_verification_code.php" method="post">
                    <h1>Forgot Password</h1>
                    <div class="input-box">
                    <input type="email" name="Email" placeholder="Enter your registered email" required>
                    </div>
                    <!-- <div class="input-box">
                    <input type="text" name="VerificationCode" placeholder="Send Verification Code" required>
                    </div> -->
                    <!-- <div class="forgot">
                       <a href="#">Forgot Password</a> 
                    </div> -->
                    <button type="submit" class="btn">Send Verification Code</button>
                    <div class="register-link">
                       <!-- <p>Having verification error? Register again. <a href="register.php">Register</a></p> -->
                         <p>Goto Landing Page <a href="indexA.php"> Landing Page</a></p>
                    </div>
                </form>
              
            </div>
            
        </div>      
    </div>
</body>
</html>
