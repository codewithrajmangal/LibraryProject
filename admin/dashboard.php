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
                <div class="main-title">
                    <p class="font-weight-bold">DASHBOARD</p>
                </div>

                <div class="main-cards">
                    <?php
                    $rollno = $_SESSION['AdminRollNo'];
                    // Include the database connection file


                    // SQL queries to count the required items

                    $sql_available_books = "SELECT SUM(Availability) AS total_books FROM book ";
                    $sql_book_issues = "SELECT COUNT(BookId) AS total_book_issues FROM lms.record WHERE Date_of_Issue is  NULL and Date_of_Return is  NULL";
                    $sql_book_renews = "SELECT COUNT(BookId) AS total_book_renews FROM lms.renew";
                    $sql_book_returns = "SELECT COUNT(RollNo) AS total_book_returns FROM lms.return";
                    // Execute the queries and fetch the results

                    $result_available_books = $conn->query($sql_available_books);
                    $result_book_issues = $conn->query($sql_book_issues);
                    $result_book_renews = $conn->query($sql_book_renews);
                    $result_book_returns = $conn->query($sql_book_returns);


                    $total_books = $result_available_books->fetch_assoc()['total_books'];
                    $total_book_issues = $result_book_issues->fetch_assoc()['total_book_issues'];
                    $total_book_renews = $result_book_renews->fetch_assoc()['total_book_renews'];
                    $total_book_returns = $result_book_returns->fetch_assoc()['total_book_returns'];
                    $conn->close();
                    ?>


                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">Total Number of Books </p>
                            <span class="material-icons-outlined text-orange"></span>
                        </div>
                        <span class="text-primary font-weight-bold"><?php echo $total_books; ?></span>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">Total Number of Book Issue Request</p>
                            <span class="material-icons-outlined text-green"></span>
                        </div>
                        <span class="text-primary font-weight-bold"><?php echo $total_book_issues; ?></span>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">Total Number of Book Renew Request</p>
                            <span class="material-icons-outlined text-red"></span>
                        </div>
                        <span class="text-primary font-weight-bold"><?php echo $total_book_renews; ?></span>
                    </div>

                    <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Total Number of Book Return Request</p>
                        <span class="material-icons-outlined text-blue"></span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $total_book_returns; ?></span>
                </div>

                </div>

                
        </main>
        <!--main close-->
        </div>
        <script src="../js/scripts.js"></script>
    </body>

    </html>
