<?php
require('dbconn.php');
session_start();
try {
    // Check if 'id' parameter exists in $_GET
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Check if UserRollNo is set in the session
        if(isset($_SESSION['UserRollNo'])) {
            $roll = $_SESSION['UserRollNo'];
            
            // Prepare and execute SQL query to insert record
            $sql = "INSERT INTO LMS.renew (RollNo, BookId) VALUES ('$roll', '$id')";
            if($conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
                header("Refresh:0.01; url=current.php", true, 303);
                exit(); // Exit after redirection
            } else {
                echo "<script type='text/javascript'>alert('Error: Request Already Sent.')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error: UserRollNo not set in session.')</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Error: Missing 'id' parameter in URL.')</script>";
    }
} catch (Exception $e) {
    echo "<script type='text/javascript'>alert('Error: Couldn't act per your request.');</script>";
    header("Refresh:0.01; url=book.php", true, 303);
}
?>
