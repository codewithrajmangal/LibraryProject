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
                    <table class="table" id="tables">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rollno = $_SESSION['UserRollNo'];
                            $sql = "select * from LMS.message where RollNo='$rollno' order by Date DESC,Time DESC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $msg = $row['Msg'];
                                $date = $row['Date'];
                                $time = $row['Time'];
                            ?>
                                <tr>
                                    <td><?php echo $msg ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <!--main close-->
        </div>
        <script src="js/scripts.js"></script>
    </body>

    </html>
