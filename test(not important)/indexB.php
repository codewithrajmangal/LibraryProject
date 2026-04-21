 <?php
require('dbconn.php');
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
    <style>
        /* Hide input fields initially */
        .input-field {
            display: none;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('Category').addEventListener('change', function() {
                var selectedValue = this.value;

                document.getElementById('bca-field').style.display = 'none';
                document.getElementById('csit-field').style.display = 'none';

                if (selectedValue === 'bca') {
                    document.getElementById('bca-field').style.display = 'block';
                } else if (selectedValue === 'csit') {
                    document.getElementById('csit-field').style.display = 'block';
                }
            });

            document.querySelector('form').addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });

            function validateForm() {
                var name = document.forms["signupForm"]["Name"].value;
                var email = document.forms["signupForm"]["Email"].value;
                var password = document.forms["signupForm"]["Password"].value;
                var mobno = document.forms["signupForm"]["PhoneNumber"].value;
                var category = document.forms["signupForm"]["Category"].value;
                var rollno = category === 'bca' ? document.forms["signupForm"]["bca-input"].value : document.forms["signupForm"]["csit-input"].value;

                // Validate name
                var namePattern = /^[a-zA-Z]+ [a-zA-Z]+$/;
                if (!namePattern.test(name)) {
                    alert("Name must contain a valid first and last name.");
                    return false;
                }

                // Validate email
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    alert("Invalid email format.");
                    return false;
                }

                // Validate password
                var passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,14}$/;
                if (!passwordPattern.test(password)) {
                    alert("Password must be between 8 and 14 characters and contain at least one special symbol.");
                    return false;
                }

                // Validate phone number
                var phonePattern = /^(984|980|986|985|984)\d{7}$/;
                if (!phonePattern.test(mobno)) {
                    alert("Enter a valid phone number.");
                    return false;
                }

                // Validate roll number for BCA
                if (category === 'bca') {
                  var bcaPattern = /^b(0[6-9]|[1-9]\d)\d[0-3][0-9]$/;
                    if (!bcaPattern.test(rollno)) {
                        alert("BCA Roll Number must be in the format 'bXXXYY',where XXX should be las 3 digits of your academic year and YY should be your class roll number");
                        return false;
                    }
                }

				if (category === 'csit') {
                  var bcaPattern = /^c(0[6-9]|[1-9]\d)\d[0-3][0-9]$/;
                    if (!bcaPattern.test(rollno)) {
                        alert("CSIT Roll Number must be in the format 'cXXXYY',where XXX should be las 3 digits of your academic year and YY should be your class roll number");
                        return false;
                    }
                }

                return true; // Form is valid
            }
        });
    </script>
</head>
<body>
    <div class="container1">
        <!-- <header class="page-head">
            <p></p>
        </header> -->
		

        </div>
        <div class="main-contain">
			<div class="welcome"><p> <t>Welcome to our library.<br><br>Making your experience easier.</p></div>
            <div class="out">
                <div class="wrapper">
                    <form name="signupForm" action="indexB.php" method="post">
                        <h1>Register</h1>
                        <div class="input-box">
                            <label for="Category">Category:</label>
                            <select name="Category" id="Category">
                                <option value="">Select a category</option>
                                <option class="optn" value="bca">BCA</option>
                                <option class="optn" value="csit">CSIT</option>
                            </select>
                        </div>
                        <div id="bca-field" class="input-field">
                            <input type="text" id="bca-input" name="bca-input" placeholder="Enter roll no (Eg. b07801)">
                        </div>
                        <div id="csit-field" class="input-field">
                            <input type="text" id="csit-input" name="csit-input" placeholder="Enter roll no (Eg. c07801)">
                        </div>
                        <div class="input-box">
                            <input type="text" name="Name" placeholder="Enter your full name" required>
                        </div>
                        <div class="input-box">
                            <input type="email" name="Email" placeholder="Enter your email id" required>
                        </div>
                        <div class="input-box">
                            <input type="password" name="Password" placeholder="Password" required>
                        </div>
                        <div class="input-box">
                            <input type="text" name="PhoneNumber" placeholder="Enter your phone number" required>
                        </div>
                        <button type="submit" name="signup" class="btn">Register</button>
                        <div class="register-link">
                            <p>Already have an account? <a href="indexA.php">Login</a></p>
							<!-- <p>Do you want admin registeration? <a href="indexAdmin.php">Here you go</a></p> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "lms";
// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['signup'])) {
    // Sanitize and validate inputs
    $name = trim($_POST['Name']);
    $email = trim($_POST['Email']);
    $password = trim($_POST['Password']);
    $mobno = trim($_POST['PhoneNumber']);
    $rollno = trim($_POST['Category']) === 'bca' ? trim($_POST['bca-input']) : trim($_POST['csit-input']);
    $category = trim($_POST['Category']);
    $type = 'Student';

    // Validate name
    if (!preg_match("/^[a-zA-Z]+ [a-zA-Z]+$/", $name)) {
        echo "<script type='text/javascript'>alert('Name must contain a valid first and last name.')</script>";
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script type='text/javascript'>alert('Invalid email format.')</script>";
        exit();
    }

    // Validate password
    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,14}$/", $password)) {
        echo "<script type='text/javascript'>alert('Password must be between 8 and 14 characters and contain at least one special symbol.')</script>";
        exit();
    }

    // Validate phone number
    if (!preg_match("/^(984|980|986|985|984)\d{7}$/", $mobno)) {
        echo "<script type='text/javascript'>alert('Enter a valid phone number')</script>";
        exit();
    }

    // Validate roll number for BCA
    if ($category === 'bca') {
      if (!preg_match("/^b(0[6-9]\d|[1-9]\d\d)(0[1-9]|[1-3]\d|40)$/", $rollno)) {
          echo "<script type='text/javascript'>alert('BCA Roll Number must be in the format \'bXXXYY\', where XXX should be las 3 digits of your academic year and YY should be your class roll number')</script>";
          exit();
      }
  }

  if ($category === 'csit') {
	if (!preg_match("/^c(0[6-9]\d|[1-9]\d\d)(0[1-9]|[1-3]\d|40)$/", $rollno)) {
		echo "<script type='text/javascript'>alert('CSIT Roll Number must be in the format \'cXXXYY\', where XXX should be las 3 digits of your academic year and YY should be your class roll number')</script>";
		exit();
	}
}
  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO LMS.user (Name, Type, Category, RollNo, EmailId, MobNo, Password) VALUES ('$name', '$type', '$category', '$rollno', '$email', '$mobno', '$hashed_password')";

    
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Registration Successful');</script>";
        header( "Refresh:0.01; url=../indexA.php", true, 303);
    } else {
        echo "<script type='text/javascript'>alert('User Exists or there was an error.')</script>";
    }
    $conn->close();
}
?>
