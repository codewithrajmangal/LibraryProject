<?php
require('dbconn.php');

// Enable error logging for debugging
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\php\logs\php_error.log'); // Adjust the path to your needs

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
    $email = $_POST['Email'];
    $verification_code = $_POST['VerificationCode'];

    // Log the received inputs
    error_log("Email: $email");
    error_log("Verification Code: $verification_code");

    // Log the current timestamp for debugging purposes
    $current_time = date('Y-m-d H:i:s');
    error_log("Current Time: $current_time");

    // Log the SQL query being run
    $sql = "SELECT * FROM temp_user WHERE EmailId = '$email' AND VerificationCode = '$verification_code' AND VerificationExpiry > NOW()";
    error_log("SQL Query: $sql");

    $result = $conn->query($sql);

    // Check for query execution errors
    if ($result === false) {
        error_log("Error executing query: " . $conn->error);
        echo "<script type='text/javascript'>alert('Database query error.');</script>";
    } elseif ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $name = $user['Name'];
        $type = $user['Type'];
        $category = $user['Category'];
        $rollno = $user['RollNo'];
        $mobno = $user['MobNo'];
        $hashed_password = $user['Password'];

        // Log user details
        error_log("User Details: " . print_r($user, true));

        // Insert into LMS.user
        $sql_insert = "INSERT INTO LMS.user (Name, Type, Category, RollNo, EmailId, MobNo, Password) VALUES ('$name', '$type', '$category', '$rollno', '$email', '$mobno', '$hashed_password')";
        error_log("SQL Insert Query: $sql_insert");

        if ($conn->query($sql_insert) === true) {
            // Delete from temp_user
            $sql_delete = "DELETE FROM temp_user WHERE EmailId = '$email'";
            error_log("SQL Delete Query: $sql_delete");

            if ($conn->query($sql_delete) === true) {
                echo "<script type='text/javascript'>alert('Registration Successful');</script>";
                error_log("Registration Successful");
                header("Refresh:0.01; url=indexA.php", true, 303);
                exit(); // Ensure script execution stops after redirect
            } else {
                error_log("Error deleting from temp_user: " . $conn->error);
                echo "<script type='text/javascript'>alert('There was an error during deletion.');</script>";
            }
        } else {
            error_log("Error inserting into LMS.user: " . $conn->error);
            echo "<script type='text/javascript'>alert('There was an error during insertion.');</script>";
        }
    } else {
        error_log("Invalid or expired verification code.");
        echo "<script type='text/javascript'>alert('Invalid or expired verification code.');</script>";
    }

    // Close the connection
    $conn->close();
} elseif (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Library Management System</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
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
                <form action="verify_code.php" method="post">
                    <h1>Verify</h1>
                    <div class="input-box">
                    <input type="hidden" name="Email" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div class="input-box">
                    <input type="text" name="VerificationCode" placeholder="Verification Code" required>
                    </div>
                    <!-- <div class="forgot">
                       <a href="#">Forgot Password</a> 
                    </div> -->
                    <button type="submit" name="verify" class="btn">Verify</button>
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
