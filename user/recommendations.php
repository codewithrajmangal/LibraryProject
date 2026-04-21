<?php
require('dbconn.php');
?>
<?php
session_start();
if (!isset($_SESSION['UserRollNo'])) {
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

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

                    <a href="profile.php" class="up-icon"><span class="material-icons-outlined">account_circle</span></a>
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
                    <a href="book.php"><span class="material-icons-outlined">menu_book</span> All Books</a>
                </li>
                <li class="sidebar-list-items">
                    <a href="history.php"><span class="material-icons-outlined">history</span>Book Borrow History</a>
                </li>
                <li class="sidebar-list-items">
                    <a href="recommendations.php"><span class="material-icons-outlined">recommend</span> Recommend Books</a>
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
                            <h3>Reccomend a Book</h3>
                        </div>
                        <div class="module-body">


                            <br>

                            <form class="form-horizontal row-fluid" action="recommendations.php" method="post">
                                <div class="control-group">
                                    <label class="control-label" for="Title"><b>Book Title</b></label>
                                    <div class="controls">
                                        <input type="text" id="title" name="title" placeholder="Title" class="span8" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Description"><b>Description</b></label>
                                    <div class="controls">
                                        <input type="text" id="Description" name="Description" placeholder="Description" class="span8" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn">Submit Recommendation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                </div><!--/.content-->
            </div>

        </main>
        <!--main close-->
    </div>
    <script src="js/scripts.js"></script>
    <?php
if(isset($_POST['submit']))
{
    $title=$_POST['title'];
    $Description=$_POST['Description'];
    $rollno=$_SESSION['UserRollNo'];

$sql1="insert into LMS.recommendations (Book_Name,Description,RollNo) values ('$title','$Description','$rollno')"; 



if($conn->query($sql1) === TRUE){


echo "<script type='text/javascript'>alert('Success')</script>";
}
else
{//echo $conn->error;
echo "<script type='text/javascript'>alert('Error')</script>";
}
    
}
?> 
</body>

</html>
