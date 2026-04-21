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
    <div class="requests">

<div class="span3">
    <center>
        <a href="issue_requests.php" class="btn btn-info">Issue Requests</a>
    </center>
</div>
<div class="span3">
    <center>
        <a href="renew_requests.php" class="btn btn-info">Renew Request</a>
    </center>
</div>
<div class="span3">
    <center>
        <a href="return_requests.php" class="btn btn-info">Return Requests</a>
    </center>
</div>
</div>
                        <h1><i>Return Requests</i></h1>
                        <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Roll Number</th>
                                      <th>Book Id</th>
                                      <th>Book Name</th>
                                      <th>Dues</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                        <?php
                            $sql="select return.BookId,return.RollNo,Title,datediff(curdate(),Due_Date) as x from LMS.return,LMS.book,LMS.record where return.BookId=book.BookId and return.BookId=record.BookId and return.RollNo=record.RollNo";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['BookId'];
                                $rollno=$row['RollNo'];
                                $name=$row['Title'];
                                $dues=$row['x'];
                                
                            
                           
                        ?>
                                    <tr>
                                      <td><?php echo strtoupper($rollno) ?></td>
                                      <td><?php echo $bookid ?></td>
                                      <td><b><?php echo $name ?></b></td>
                                      <td><?php 
                                      if($dues > 0)
                                          echo $dues;
                                          else
                                          echo 0; ?></td>
                                      <td><center>
                                                                                
                                        <a href="acceptreturn.php?id1=<?php echo $bookid; ?>&id2=<?php echo $rollno; ?>&id3=<?php echo $dues ?>" class="btn btn-success">Accept</a>
                                         
                                        <!--a href="rejectreturn.php?id1=<?php echo $bookid; ?>&id2=<?php echo $rollno; ?>" class="btn btn-danger">Reject</a-->
                                    </center></td>
                                    </tr>
                               <?php } ?>
                               </tbody>
                                </table>
                            </div>
    </main>
    <!--main close-->
</div>
<script src="../js/scripts.js"></script>
</body>
</html>
