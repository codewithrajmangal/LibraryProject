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
                    <div class="module">
                        <div class="module-head">
                            <h3>Update Details</h3>
                        </div>
                        <div class="module-body">
                            <?php
                            $rollno = $_SESSION['UserRollNo'];
                            $sql = "SELECT * FROM LMS.user WHERE RollNo='$rollno'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();

                            $name = $row['Name'];
                            $category = $row['Category'];
                            $email = $row['EmailId'];
                            $mobno = $row['MobNo'];
                            $pswd = $row['Password'];
                            ?>

                            <form class="form-horizontal row-fluid" action="edit_student_details.php?id=<?php echo $rollno ?>" method="post">

                                <div class="control-group">
                                    <label class="control-label" for="Name"><b>Name:</b></label>
                                    <div class="controls">
                                        <input type="text" id="Name" name="Name" value="<?php echo $name ?>" class="span8" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Category"><b>Category:</b></label>
                                    <div class="controls">
                                        <select name="Category" tabindex="1" data-placeholder="Select Category" class="span6" required>
                                            <option value="bca" <?php echo ($category == 'bca') ? 'selected' : ''; ?>>bca</option>
                                            <option value="csit" <?php echo ($category == 'csit') ? 'selected' : ''; ?>>csit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="EmailId"><b>Email Id:</b></label>
                                    <div class="controls">
                                        <input type="email" id="EmailId" name="EmailId" value="<?php echo $email ?>" class="span8" required>
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
                                        <input type="password" id="Password" name="Password" value="<?php echo $pswd ?>" class="span8" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn-primary"><center>Update Details</center></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!--main close-->
        </div>
        <script src="js/scripts.js"></script>
        <?php
if(isset($_POST['submit']))
{
    $rollno = $_GET['id'];
    $name=$_POST['Name'];
    $category=$_POST['Category'];
    $email=$_POST['EmailId'];
    $mobno=$_POST['MobNo'];
    // $pswd=$_POST['Password'];

    // $hashed_password = password_hash($pswd, PASSWORD_DEFAULT);
$sql1="update LMS.user set Name='$name', Category='$category', EmailId='$email', MobNo='$mobno'";



if($conn->query($sql1) === TRUE){
echo "<script type='text/javascript'>alert('Success')</script>";
header("Refresh:0.01; url=dashboard.php", true, 303);
}
else
{//echo $conn->error;
echo "<script type='text/javascript'>alert('Error')</script>";
}
}
?>
    </body>

    </html>

