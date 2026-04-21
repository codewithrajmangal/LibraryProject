<?php
session_start();

// Database connection
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "lms";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['AdminRollNo'])) {
    if (isset($_GET['id'])) {
        $rollno = $_GET['id'];

        // Function to execute delete query and handle errors
        function deleteRecord($conn, $sql, $errorMessage) {
            if ($conn->query($sql) !== TRUE) {
                echo "<script type='text/javascript'>alert('$errorMessage');</script>";
                header("Refresh:0.01; url=student.php", true, 303);
                exit();
            }
        }

        // Delete related rows from the `record` table
        $sqlRecord = "DELETE FROM LMS.record WHERE RollNo='$rollno'";
        deleteRecord($conn, $sqlRecord, 'Error Removing Related Records');

        // Delete related rows from the `renew` table
        $sqlRenew = "DELETE FROM LMS.renew WHERE RollNo='$rollno'";
        deleteRecord($conn, $sqlRenew, 'Error Removing Related Renewals');

        // Delete related rows from the `return` table
        $sqlReturn = "DELETE FROM LMS.return WHERE RollNo='$rollno'";
        deleteRecord($conn, $sqlReturn, 'Error Removing Related Returns');

        // Delete related rows from the `message` table
        $sqlMessages = "DELETE FROM LMS.message WHERE RollNo='$rollno'";
        deleteRecord($conn, $sqlMessages, 'Error Removing Related Messages');

        // SQL query to delete the student
        $sql = "DELETE FROM LMS.user WHERE RollNo='$rollno'";
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Student Removed Successfully');</script>";
            header("Refresh:0.01; url=student.php", true, 303);
        } else {
            echo "<script type='text/javascript'>alert('Error Removing Student');</script>";
            header("Refresh:0.01; url=student.php", true, 303);
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid Student ID');</script>";
        header("Refresh:0.01; url=student.php", true, 303);
    }
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!');</script>";
    header("Refresh:0.01; url=../indexA.php", true, 303);
}

$conn->close();
?>
