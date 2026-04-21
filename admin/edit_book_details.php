<?php
ob_start();
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
                        <div class="module">
                            <div class="module-head">
                                <h3>Update Book Details</h3>
                            </div>
                            <div class="module-body">

                                <?php
                                    $bookid = $_GET['id'];
                                    $sql = "select * from LMS.book where Bookid='$bookid'";
                                    $result=$conn->query($sql);
                                    $row=$result->fetch_assoc();
                                    $name=$row['Title'];
                                    $publisher=$row['Publisher'];
                                    $year=$row['Year'];
                                    $avail=$row['Availability'];


                                ?>

                                    <br >
                                    <form class="form-horizontal row-fluid" action="edit_book_details.php?id=<?php echo $bookid ?>" method="post">
                                        <div class="control-group">
                                            <b>
                                            <label class="control-label" for="Title">Book Title:</label></b>
                                            <div class="controls">
                                                <input type="text" id="Title" name="Title" value= "<?php echo $name?>" class="span8" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <b>
                                            <label class="control-label" for="Publisher">Publisher:</label></b>
                                            <div class="controls">
                                                <input type="text" id="Publisher" name="Publisher" value= "<?php echo $publisher?>" class="span8" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <b>
                                            <label class="control-label" for="Year">Year:</label></b>
                                            <div class="controls">
                                                <input type="text" id="Year" name="Year" value= "<?php echo $year?>" class="span8" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <b>
                                            <label class="control-label" for="Availability">Availability:</label></b>
                                            <div class="controls">
                                                <input type="text" id="Availability" name="Availability" value= "<?php echo $avail?>" class="span8" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit"class="btn">Update Details</button>
                                            </div>
                                        </div>

                                    </form> 
                                    </div>   
                                    </div>          
                    </div>
                    
    </main>
    <!--main close-->
</div>
<?php
if(isset($_POST['submit']))
{
    $bookid = $_GET['id'];
    $name=$_POST['Title'];
    $publisher=$_POST['Publisher'];
    $year=$_POST['Year'];
    $avail=$_POST['Availability'];

$sql1="update LMS.book set Title='$name', Publisher='$publisher', Year='$year', Availability='$avail' where BookId='$bookid'";



if($conn->query($sql1) === TRUE){
echo "<script type='text/javascript'>alert('Success')</script>";
header( "Refresh:0.01; url=book.php", true, 303);
}
else
{//echo $conn->error;
echo "<script type='text/javascript'>alert('Error')</script>";
}
}
?>
     <script src="../js/scripts.js"></script>
</body>
</html>
