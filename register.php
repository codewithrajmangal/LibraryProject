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
                var email = document.forms["signupForm"]["email"].value;
                var password = document.forms["signupForm"]["Password"].value;
                var year = document.forms["signupForm"]["EnrolledYear"].value;
                var mobno = document.forms["signupForm"]["PhoneNumber"].value;
                var category = document.forms["signupForm"]["Category"].value;
                var rollno = document.forms["signupForm"]["RollNumber"].value;

                var error = "";

                // Validate name
                var namePattern = /^[a-zA-Z]+ [a-zA-Z]+$/;
                if (!namePattern.test(name)) {
                    error = "Name must contain a valid first and last name.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }

                // Validate email
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    error = "Invalid email format.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }

                // Validate password
                var passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,14}$/;
                if (!passwordPattern.test(password)) {
                    error = "Password must be between 8 and 14 characters and contain at least one special symbol.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }

                // Validate phone number
                var phonePattern1 = /^(984|980|986|985|976|975|974)\d{7}$/;
                var phonePattern2 = /^(97)\d{8}$/;

                if (!phonePattern1.test(mobno) && !phonePattern2.test(mobno)) {
                    error = "Enter a valid phone number.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }

                // Validate enrolled year
                // Get the current VS year
                var currentYear = new Date().getFullYear() + 56; // Add 56 to convert Gregorian to VS

                // Validate enrolled year
                if (isNaN(year) || year <= 2074 || year > currentYear) {
                    error = "Enter a valid enrolled year greater than 2074 and less than or equal to the current year.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }


                // Validate category
                if (category == "") {
                    error = "Please select a category.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }

                // Validate roll number
                var rollNumberPattern = /^(0[1-9]|[1-3][0-9]|40)$/;
                if (!rollNumberPattern.test(rollno)) {
                    error = "Roll number must be between 01 and 40.";
                    document.getElementById('formError').innerText = error;
                    return false;
                }

                return true; // If all validations pass
            }
        });
    </script>
</head>

<body>
    <div class="container1">
        <div class="main-contain">
            <div class="welcome">
                <p>Welcome to our library.<br><br>Making your experience easier.</p>
            </div>
            <div class="out">
                <div class="wrapper">
                    <form name="signupForm" action="verify.php" method="post">
                        <h1>Register</h1>
                        <div id="formError" style="color: red; margin-top: 5px;">
                            <?php echo isset($_GET['error']) ? htmlspecialchars($_GET['error']) : ''; ?>
                        </div>
                        <div class="input-box">
                            <label for="Category">Category:</label>
                            <select name="Category" id="Category">
                                <option value="">Select a category</option>
                                <option class="optn" value="bca" <?php echo isset($_GET['Category']) && $_GET['Category'] == 'bca' ? 'selected' : ''; ?>>BCA</option>
                                <option class="optn" value="csit" <?php echo isset($_GET['Category']) && $_GET['Category'] == 'csit' ? 'selected' : ''; ?>>CSIT</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <input type="text" name="EnrolledYear" placeholder="Enter enrolled year (e.g., 2078)" value="<?php echo isset($_GET['EnrolledYear']) ? htmlspecialchars($_GET['EnrolledYear']) : ''; ?>" required>
                        </div>
                        <div class="input-box">
                            <input type="text" name="RollNumber" placeholder="Enter roll number (e.g., 01)" value="<?php echo isset($_GET['RollNumber']) ? htmlspecialchars($_GET['RollNumber']) : ''; ?>" required>
                        </div>
                        <div class="input-box">
                            <input type="text" name="Name" placeholder="Enter your full name" value="<?php echo isset($_GET['Name']) ? htmlspecialchars($_GET['Name']) : ''; ?>" required>
                        </div>
                        <div class="input-box">
                            <input type="email" name="email" placeholder="Enter your email id" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" required>
                        </div>
                        <div class="input-box">
                            <input type="password" name="Password" placeholder="Password" required>
                        </div>
                        <div class="input-box">
                            <input type="text" name="PhoneNumber" placeholder="Enter your phone number" value="<?php echo isset($_GET['PhoneNumber']) ? htmlspecialchars($_GET['PhoneNumber']) : ''; ?>" required>
                        </div>
                        <button type="submit" name="signup" class="btn">Register</button>
                        <div class="register-link">
                            <button type="button"><a href="indexA.php">Go to Landing Page</a></button>
                            <p>Already have an account? <a href="login.php">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>