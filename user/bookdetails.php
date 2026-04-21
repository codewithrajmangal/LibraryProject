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
                            <h3>Book Details</h3>
                        </div>
                        <div class="module-body">
                            <?php
                            $x = $_GET['id'];
                            $sql = "select * from LMS.book where BookId='$x'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $bookid = $row['BookId'];
                            $name = $row['Title'];
                            $publisher = $row['Publisher'];
                            $year = $row['Year'];
                            $avail = $row['Availability'];
                            echo "<b>Book ID:</b> " . $bookid . "<br><br>";
                            echo "<b>Title:</b> " . $name . "<br><br>";
                            $sql1 = "select * from LMS.author where BookId='$bookid'";
                            $result = $conn->query($sql1);

                            echo "<b>Author:</b> ";
                            while ($row1 = $result->fetch_assoc()) {
                                echo $row1['Author'] . "&nbsp;";
                            }
                            echo "<br><br>";
                            echo "<b>Publisher:</b> " . $publisher . "<br><br>";
                            echo "<b>Year:</b> " . $year . "<br><br>";
                            echo "<b>Availability:</b> " . $avail . "<br><br>";




                            ?>

                            <a href="book.php" class="btn btn-primary">Go Back</a>
                        </div>
                    </div>
                </div>
                <!--/.span3-->
                <!--/.span9-->

                <!--/.span3-->
                <!--/.span9-->
            
        </main>
        <!--main close-->
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>
