<?php
require('dbconn.php');
?><?php
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
                        <form class="form-horizontal row-fluid" action="current.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="Search"><b>Search:</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Enter Book Name/Book Id." class="span8" required>
                                                <button type="submit" name="submit"class="btn">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <?php
                                    $rollno = $_SESSION['UserRollNo'];
                                    if(isset($_POST['submit']))
                                        {$s=$_POST['title'];
                                            $sql="select * from LMS.record,LMS.book where RollNo = '$rollno' and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId and (record.BookId='$s' or Title like '%$s%')";

                                        }
                                    else
                                        $sql="select * from LMS.record,LMS.book where RollNo = '$rollno' and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId";

                                    $result=$conn->query($sql);
                                    $rowcount=mysqli_num_rows($result);

                                    if(!($rowcount))
                                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                                    else
                                    {

                                
                                    ?>
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Book id</th>
                                      <th>Book name</th>
                                      <th>Issue Date</th>
                                      <th>Due date</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                <?php

                            
                            //$result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['BookId'];
                                $name=$row['Title'];
                                $issuedate=$row['Date_of_Issue'];
                                $duedate=$row['Due_Date'];
                                $renewals=$row['Renewals_left'];
                            
                            ?>

                                    <tr>
                                      <td><?php echo $bookid ?></td>
                                      <td><?php echo $name ?></td>
                                      <td><?php echo $issuedate ?></td>
                                      <td><?php echo $duedate ?></td>
                                        <td><center>
                                        <?php 
                                         if($renewals)
                                            echo "<a href=\"renew_request.php?id=".$bookid."\" class=\"btn btn-success\">Renew</a>";
                                        ?>
                                        <a href="return_request.php?id=<?php echo $bookid; ?>" class="btn btn-primary">Return</a>
                                        </center></td>
                                    </tr>
                            <?php }} ?>
                                    </tbody>
                                </table>
                    </div>
        </main>
        <!--main close-->
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>
