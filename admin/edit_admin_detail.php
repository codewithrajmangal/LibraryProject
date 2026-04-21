<?php
ob_start();
require('dbconn.php');
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
                <div class="module">
                    <div class="module-head">
                        <h3>Update Details</h3>
                    </div>
                    <div class="module-body">
                        <?php
                        $rollno = $_SESSION['AdminRollNo'];
                        $sql = "SELECT * FROM LMS.user WHERE RollNo='$rollno'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $name = $row['Name'];
                        $email = $row['EmailId'];
                        $mobno = $row['MobNo'];
                        ?>

                        <form class="form-horizontal row-fluid" action="edit_admin_detail.php?id=<?php echo $rollno ?>" method="post">
                            <div class="control-group">
                                <label class="control-label" for="Name"><b>Name:</b></label>
                                <div class="controls">
                                    <input type="text" id="Name" name="Name" value="<?php echo $name ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="EmailId"><b>Email Id:</b></label>
                                <div class="controls">
                                    <input type="text" id="EmailId" name="EmailId" value="<?php echo $email ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="MobNo"><b>Mobile Number:</b></label>
                                <div class="controls">
                                    <input type="text" id="MobNo" name="MobNo" value="<?php echo $mobno ?>" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="Password"><b>New Password:</b></label>
                                <div class="controls">
                                    <input type="password" id="Password" name="Password" class="span8" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" name="submit" class="btn-primary">
                                        <center>Update Details</center>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!--main close-->
    </div>
    <!--/.wrapper-->
    <?php
    if (isset($_POST['submit'])) {
        $rollno = $_GET['id'];
        $name = $_POST['Name'];
        $email = $_POST['EmailId'];
        $mobno = $_POST['MobNo'];
       

        // Hash the new password
        

        $sql1 = "UPDATE LMS.user SET Name='$name', EmailId='$email', MobNo='$mobno', WHERE RollNo='$rollno'";

        if ($conn->query($sql1) === TRUE) {
            echo "<script type='text/javascript'>alert('Success');</script>";
            header("Refresh:0.01; url=dashboard.php", true, 303);
        } else {
            echo "<script type='text/javascript'>alert('Error');</script>";
        }
    }
    ?>
</body>

</html>
