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
                <form class="form-horizontal row-fluid" action="current.php" method="post">
                    <div class="control-group">
                        <label class="control-label" for="Search"><b>Search:</b></label>
                        <div class="controls">
                            <input type="text" id="title" name="title" placeholder="Enter Roll No of Student/Book Name/Book Id." class="span8" required>
                            <button type="submit" name="submit" class="btn">Search</button>
                        </div>
                    </div>
                </form>
                <br>
                <?php
                if (isset($_POST['submit'])) {
                    $s = $_POST['title'];
                    $sql = "select record.BookId,RollNo,Title,Due_Date,Date_of_Issue,datediff(curdate(),Due_Date) as x from LMS.record,LMS.book where (Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId) and (RollNo='$s' or record.BookId='$s' or Title like '%$s%')";
                } else
                    $sql = "select record.BookId,RollNo,Title,Due_Date,Date_of_Issue,datediff(curdate(),Due_Date) as x from LMS.record,LMS.book where Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId";
                $result = $conn->query($sql);
                $rowcount = mysqli_num_rows($result);

                if (!($rowcount))
                    echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                else {


                ?>
                    <table class="table" id="tables">
                        <thead>
                            <tr>
                                <th>Roll No</th>
                                <th>Book id</th>
                                <th>Book name</th>
                                <th>Issue Date</th>
                                <th>Due date</th>
                                <th>Dues</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            //$result=$conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $rollno = $row['RollNo'];
                                $bookid = $row['BookId'];
                                $name = $row['Title'];
                                $issuedate = $row['Date_of_Issue'];
                                $duedate = $row['Due_Date'];
                                $dues = $row['x'];

                            ?>

                                <tr>
                                    <td><?php echo strtoupper($rollno) ?></td>
                                    <td><?php echo $bookid ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $issuedate ?></td>
                                    <td><?php echo $duedate ?></td>
                                    <td><?php if ($dues > 0)
                                            echo "<font color='red'>" . $dues . "</font>";
                                        else
                                            echo "<font color='green'>0</font>";
                                        ?>
                                </tr>
                        <?php }
                        } ?>
                        </tbody>
                    </table>
            </div>

            <!--/.span9-->
    </div>
    </main>
    <!--main close-->
    </div>
    <script src="../js/scripts.js"></script>
</body>

</html>
