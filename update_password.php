<?php
require('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $verification_code = $_POST['VerificationCode'];
    $new_password = $_POST['NewPassword'];
    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,14}$/", $new_password)) {
        echo "<script type='text/javascript'>alert('Password must be between 8 and 14 characters and contain at least one special symbol.')</script>";
        exit();
    }
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    echo "Email: $email<br>";
    echo "Verification Code: $verification_code<br>";

    // Check if the verification code is correct and not expired
    $sql = "SELECT * FROM temp_user WHERE EmailId='$email' AND VerificationCode='$verification_code' AND VerificationExpiry > NOW()";
    $result = $conn->query($sql);

    echo "Query: $sql<br>";
    echo "Rows: " . $result->num_rows . "<br>";

    if ($result->num_rows == 1) {
        // Update the password in the LMS.user table
        $sql = "UPDATE LMS.user SET Password='$hashed_password' WHERE EmailId='$email'";
        if ($conn->query($sql) === TRUE) {
            // Delete the verification code from temp_user table
            $sql = "DELETE FROM temp_user WHERE EmailId='$email'";
            $conn->query($sql);

            echo "<script type='text/javascript'>alert('Password reset successful.');</script>";
            header("Location: indexA.php");
            exit();
        } else {
            echo "<script type='text/javascript'>alert('Error updating password.');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid or expired verification code.');</script>";
    }

    $conn->close();
}
?>
