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
                <div class="content">

                    <div class="module">
                        <div class="module-head">
                            <h3>Student Details</h3>
                        </div>
                        <div class="module-body">
                            <?php
                            $rno = $_GET['id'];
                            $sql = "SELECT u.Name, u.EmailId, u.MobNo, COUNT(r.BookId) AS IssuedBooks
                             FROM LMS.user u LEFT JOIN LMS.record r ON u.RollNo = r.RollNo WHERE u.RollNo = '$rno'and Date_of_Issue is NOT NULL and Due_Date is NOT NULL and Date_of_Return is  NULL GROUP BY u.Name, u.EmailId, u.MobNo";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();

                                $name = $row['Name'];
                                $email = $row['EmailId'];
                                $mobno = $row['MobNo'];
                                $issuedBooks = $row['IssuedBooks'];

                                echo "<b><u>Name:</u></b> " . $name . "<br><br>";
                                echo "<b><u>Roll No:</u></b> " . $rno . "<br><br>";
                                echo "<b><u>Email Id:</u></b> " . $email . "<br><br>";
                                echo "<b><u>Mobile No:</u></b> " . $mobno . "<br><br>";
                                echo "<b><u>Number of Books Issued:</u></b> " . $issuedBooks . "<br><br>";
                            } else {
                                echo "No user found with Roll No: " . $rno;
                            }
                            ?>


                            <a href="student.php" class="btn btn-primary">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--main close-->
    </div>
    <script src="../js/scripts.js"></script>
</body>

</html>