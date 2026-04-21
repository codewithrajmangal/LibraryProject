<?php
require('dbconn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $name = trim($_POST['Name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['Password']);
    $mobno = trim($_POST['PhoneNumber']);
    $category = trim($_POST['Category']);
    $enrolledYear = trim($_POST['EnrolledYear']);
    $rollNumber = trim($_POST['RollNumber']);
    $type = 'Student';

    // Validate inputs
    if (!preg_match("/^[a-zA-Z]+ [a-zA-Z]+$/", $name)) {
        header("Location: register.php?error=Name must contain a valid first and last name.&" . http_build_query($_POST));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=Invalid email format.&" . http_build_query($_POST));
        exit();
    }

    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,14}$/", $password)) {
        header("Location: register.php?error=Password must be between 8 and 14 characters and contain at least one special symbol.&" . http_build_query($_POST));
        exit();
    }

    if (!preg_match("/^(984|980|986|985|984)\d{7}$/", $mobno)) {
        header("Location: register.php?error=Enter a valid phone number.&" . http_build_query($_POST));
        exit();
    }

    if (!preg_match("/^\d{4}$/", $enrolledYear)) {
        header("Location: register.php?error=Enter a valid enrolled year (4 digits).&" . http_build_query($_POST));
        exit();
    }
    
    $currentYear = date("Y") + 56;
    if ($enrolledYear > $currentYear) {
        header("Location: register.php?error=Enter a valid enrolled year not greater than the current year.&" . http_build_query($_POST));
        exit();
    }
    

    if (empty($category)) {
        header("Location: register.php?error=Please select a category.&" . http_build_query($_POST));
        exit();
    }

    if (!preg_match("/^(0[1-9]|[1-3][0-9]|40)$/", $rollNumber)) {
        header("Location: register.php?error=Enter a valid roll number (01-40).&" . http_build_query($_POST));
        exit();
    }

    // Generate combined roll number
    $yearLastThree = substr($enrolledYear, -3);
    $formattedRoll = ($category === 'bca' ? 'b' : 'c') . $yearLastThree . str_pad($rollNumber, 2, '0', STR_PAD_LEFT);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM user WHERE EmailId='$email'";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        header("Location: register.php?error=Email already registered.&" . http_build_query($_POST));
        exit();
    }

    $checkRollNoQuery = "SELECT * FROM user WHERE RollNo='$formattedRoll'";
    $result = $conn->query($checkRollNoQuery);
    if ($result->num_rows > 0) {
        header("Location: register.php?error=Roll Number already registered.&" . http_build_query($_POST));
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $verification_code = rand(100000, 999999);
    $verification_expiry = date("Y-m-d H:i:s", strtotime('+5 hour'));

    $query = "REPLACE INTO temp_user (Name, Type, Category, RollNo, EmailId, MobNo, Password, VerificationCode, VerificationExpiry)
              VALUES ('$name', '$type', '$category', '$formattedRoll', '$email', '$mobno', '$hashed_password', '$verification_code', '$verification_expiry')";

    if ($conn->query($query) === TRUE) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'countryaustralia0@gmail.com';
            $mail->Password = 'otpe rvyy ujmd fgbz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('countryaustralia0@gmail.com', 'Library Management System');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification Code';
            $mail->Body = "<p>Dear $name,</p><p>Your verification code is <strong>$verification_code</strong>.</p><p>This code will expire in 5 hours.</p>";

            $mail->send();
            header("Location: verify_code.php?email=" . urlencode($email));
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script type='text/javascript'>alert('There was an error.')</script>";
    }
    $conn->close();
}
?>
