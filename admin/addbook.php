<?php
require('dbconn.php');
?>
<?php
session_start();
if (!isset($_SESSION['AdminRollNo'])) {
    header('location: ../indexA.php'); // Redirect to login page if not logged in as admin
    exit();
}
// Admin-specific code
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik+Microbe&display=swap" rel="stylesheet">
   
    <!--icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">

    <!--css-->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<div class="grid-container">
    
    <!--header start-->
    <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">
                <a href="message.php" class="up-icon"><span class="material-icons-outlined">notifications</span></a>

                <a href="edit_admin_detail.php" class="up-icon"><span class="material-icons-outlined">account_circle</span></a>
            </div>
        </header>
    <!--header close-->

    <!--sidebar start-->
    <aside id="sidebar">
        <div class="sidebar-title">
            <div class="sidebar-brand">
                <span class="material-icons-outlined">menu</span>Menu
            </div>
            <a href=""><span class="material-icons-outlined" onclick="closeSidebar()">close</span></a>
        </div>
        <ul class="sidebar-list">
            <li class="sidebar-list-items">
                <a href="dashboard.php"><span class="material-icons-outlined">dashboard</span> Dashboard </a> 
            </li>
            <li class="sidebar-list-items">
                <a href="student.php"><span class="material-icons-outlined">group</span> Manage Students</a>
            </li>
            <li class="sidebar-list-items">
                <a href="book.php"><span class="material-icons-outlined">menu_book</span> All Books</a>
            </li>
            <li class="sidebar-list-items">
                <a href="addbook.php"><span class="material-icons-outlined">playlist_add</span> Add Books</a> 
            </li>
            <li class="sidebar-list-items">
                <a href="issue_requests.php"><span class="material-icons-outlined">change_circle</span> Issue/Return Requests</a> 
            </li>
            <li class="sidebar-list-items">
                <a href="current.php"><span class="material-icons-outlined">list_alt</span> Currently Issued Books</a> 
            </li>
            <li class="sidebar-list-items">
                <a href="logout.php"><span class="material-icons-outlined">logout</span> Logout </a> 
            </li>
            
        </ul>
    </aside>
    <!--sidebar close-->
    
    <!--main start-->
    <main class="main-container">
    <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Add Book</h3>
                                <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit"class="btn"><a href="recommendations.php">Recommendations</a></button>
                                            </div>
                                        </div>
                            </div>
                           
                            <div class="module-body">

                                    
                                    <br>

                                    <form class="form-horizontal row-fluid" action="addbook.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="Title"><b>Book Title</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Title" class="span8" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Author"><b>Author</b></label>
                                            <div class="controls">
                                                <input type="text" id="author1" name="author1" class="span8" required>
                                                <input type="text" id="author2" name="author2" class="span8">
                                                <input type="text" id="author3" name="author3" class="span8">

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Publisher"><b>Publisher</b></label>
                                            <div class="controls">
                                                <input type="text" id="publisher" name="publisher" placeholder="Publisher" class="span8" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Year"><b>Year</b></label>
                                            <div class="controls">
                                                <input type="text" id="year" name="year" placeholder="Year" class="span8" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Availability"><b>Number of Copies</b></label>
                                            <div class="controls">
                                                <input type="text" id="availability" name="availability" placeholder="Number of Copies" class="span8" required>
                                            </div>
                                        </div>
                                        

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit"class="btn">Add Book</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        
                        
                    </div><!--/.content-->
                </div>

                </div>
            </div>
            <!--/.container-->

        </div>

    </main>
    <!--main close-->
</div>
<script src="../js/scripts.js"></script>
<?php
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $author1=$_POST['author1'];
    $author2=$_POST['author2'];
    $author3=$_POST['author3'];
    $publisher=$_POST['publisher'];
    $year=$_POST['year'];
    $availability=$_POST['availability'];

    // Check if the combination of book title and authors already exists
    $check_sql = "SELECT b.BookId FROM LMS.book b INNER JOIN LMS.author a ON b.BookId = a.BookId WHERE b.Title = '$title' AND (a.Author = '$author1'";
    if(!empty($author2)){
        $check_sql .= " OR a.Author = '$author2'";
    }
    if(!empty($author3)){
        $check_sql .= " OR a.Author = '$author3'";
    }
    $check_sql .= ")";

    $check_result = $conn->query($check_sql);
    if($check_result->num_rows > 0){
        echo "<script type='text/javascript'>alert('This book with the same author(s) already exists.')</script>";
    } else {
        // Insert book details
        $sql1="INSERT INTO LMS.book (Title,Publisher,Year,Availability) VALUES ('$title','$publisher','$year','$availability')";

        if($conn->query($sql1) === TRUE){
            // Retrieve the BookId of the newly inserted book
            $book_id = $conn->insert_id;

            // Insert authors
            $author_sql = "INSERT INTO LMS.author (BookId, Author) VALUES ";
            $authors = array($author1, $author2, $author3);
            $author_values = array();
            foreach($authors as $author){
                if(!empty($author)){
                    $author_values[] = "($book_id, '$author')";
                }
            }
            $author_sql .= implode(", ", $author_values);
            if(!empty($author_values)){
                if($conn->query($author_sql) === TRUE){
                    echo "<script type='text/javascript'>alert('Success')</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error adding authors.')</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('At least one author must be provided.')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error adding book.')</script>";
        }
    }
}
?>

?>
</body>
</html>
