<?php
session_start();
require('dbconn.php');

$error = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
    $email = trim($_POST['Email']);
    $password = trim($_POST['Password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (empty($password)) {
        $error = "Password is required.";
    } else {
        // Check if email exists
        $sql = "SELECT * FROM LMS.user WHERE EmailId = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Check password
            if (password_verify($password, $row['Password'])) {
                $type = $row['Type'];

                // Clear any existing session variables to avoid conflicts
                session_unset();

                if ($type == 'Admin') {
                    $_SESSION['AdminRollNo'] = $row['RollNo'];
                    header('location: admin/dashboard.php');
                } else {
                    $_SESSION['UserRollNo'] = $row['RollNo'];
                    header('location: user/dashboard.php');
                }
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Email not registered.";
        }
    }

    $conn->close();
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
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
</head>

<body>
    <div class="main-contain">
        <div class="welcome">
            <p>Welcome to our library.<br><br>Making your experience easier.</p>
        </div>
        <div class="wrapper">
            <form action="login.php" method="post">
                <h1>Login</h1>
                <?php if (!empty($error)): ?>
                    <div style="color: red; margin-top: 10px;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <div class="input-box">
                    <input type="text" name="Email" placeholder="Enter your email" value="<?php echo isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : ''; ?>" required>
                </div>
                <div class="input-box">
                    <input type="password" name="Password" placeholder="Enter your Password" required>
                </div>
                <div class="forgot">
                    <a href="forgot_password.php">Forgot Password</a>
                </div>
                <button type="submit" name="signin" class="btn">Login</button>
                <div class="register-link">
                    <button type="button"><a href="indexA.php">Go to Landing Page</a></button>
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
