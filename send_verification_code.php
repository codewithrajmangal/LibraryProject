// send_verification_code.php
<?php
require('dbconn.php');
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $verification_code = rand(100000, 999999);

    // Create DateTime object and add 1 hour to it
    $dateTime = new DateTime();
    $dateTime->add(new DateInterval('PT5H'));
    $verification_expiry = $dateTime->format('Y-m-d H:i:s');

    // Check if the email exists in the LMS.user table
    $sql = "SELECT * FROM LMS.user WHERE EmailId='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Insert or update the verification code and expiry in temp_user table
        $sql = "INSERT INTO temp_user (EmailId, VerificationCode, VerificationExpiry) VALUES ('$email', '$verification_code', '$verification_expiry')
                ON DUPLICATE KEY UPDATE VerificationCode='$verification_code', VerificationExpiry='$verification_expiry'";
        if ($conn->query($sql) === TRUE) {
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
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Verification Code';
                $mail->Body = "<p>Your verification code is <strong>$verification_code</strong>. This code will expire in 1 hour.</p>";

                $mail->send();
                echo "<script type='text/javascript'>alert('Verification code sent to your email.');</script>";
                header("Location: reset_password.php?email=" . urlencode($email));
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "<script type='text/javascript'>alert('No user found with this email.');</script>";
    }

    $conn->close();
}
?>
