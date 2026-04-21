<?php
require('dbconn.php');

session_start();

if (!isset($_SESSION['AdminRollNo'])) {
    header('location: ../indexA.php'); // Redirect to login page if not logged in as admin
    exit();
}

// Check if the book ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookid = $_GET['id'];

    // Check if the book exists in the database
    $check_book_sql = "SELECT * FROM LMS.book WHERE BookId = $bookid";
    $check_book_result = $conn->query($check_book_sql);

    if ($check_book_result->num_rows > 0) {
        // Book exists, proceed with deletion

        // Delete related author records
        $delete_author_sql = "DELETE FROM LMS.author WHERE BookId = $bookid";
        if ($conn->query($delete_author_sql) === TRUE) {
            // Delete related records from renew table
            // (Add similar delete operations for other related tables)
            // ...

            // Delete the book record
            $delete_book_sql = "DELETE FROM LMS.book WHERE BookId = $bookid";
            if ($conn->query($delete_book_sql) === TRUE) {
                // Book deleted successfully
                echo "<script>alert('Book removed successfully');</script>";
                header("Refresh:0.01; url=book.php", true, 303);
                exit();
            } else {
                // Error deleting the book record
                echo "<script>alert('Error removing book');</script>";
                header("Refresh:0.01; url=book.php", true, 303);
                exit();
            }
        } else {
            // Error deleting author records
            echo "<script>alert('Error removing related author records');</script>";
            header("Refresh:0.01; url=book.php", true, 303);
            exit();
        }
    } else {
        // Book with the provided ID does not exist
        echo "<script>alert('Book with the provided ID does not exist');</script>";
        header("Refresh:0.01; url=book.php", true, 303);
        exit();
    }
} else {
    // Book ID is not provided or is not valid
    echo "<script>alert('Invalid Book ID');</script>";
    header("Refresh:0.01; url=book.php", true, 303);
    exit();
}
?>
