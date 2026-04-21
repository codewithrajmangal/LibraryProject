<?php
require('dbconn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Library Management System</title>
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
</head>

<body>
	<div class="container1">

		<!--header start-->
		<header class="page-head">
			<p>this is header</p>

		</header>

		<div class="main-contain">
			<div class="form-container">
				<h2>Sign In</h2>
				<form action="indexA.php" method="post">
					<input type="text" Name="RollNo" placeholder="RollNo" required="">
					<input type="password" Name="Password" placeholder="Password" required="">


					<div class="send-button">
						<!--<form>-->
						<input type="submit" name="signin"  value="Sign In" class="form-bton">
				</form>
			</div>

			
		</div>

		<div class="form-container">
			<h2>Sign Up</h2>
			<form action="indexA.php" method="post">
				<input type="text" Name="Name" placeholder="Name" required>
				<input type="text" Name="Email" placeholder="Email" required>
				<input type="password" Name="Password" placeholder="Password" required>
				<input type="text" Name="PhoneNumber" placeholder="Phone Number" required>
				<input type="text" Name="RollNo" placeholder="Roll Number" required="">

				<select name="Category" id="Category">
					<option value="bca">bca</option>
					<option value="csit">csit</option>					
				</select>
				<br><br>
				<input type="submit" name="signup" value="Sign Up" class="form-bton">
			</form>
		</div>
		
	</div>

	<div class="clear"></div>

	</div>

	

	<?php
	if (isset($_POST['signin'])) {
		$u = $_POST['RollNo'];
		$p = $_POST['Password'];
		$c = $_POST['Category'];

		$sql = "select * from LMS.user where RollNo='$u'";

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$x = $row['Password'];
		$y = $row['Type'];
		if (strcasecmp($x, $p) == 0 && !empty($u) && !empty($p)) { 
			echo "Login Successful";
			$_SESSION['RollNo'] = $u;


			if ($y == 'Admin')
				header('location:admin/dashboard.php');
			else
				header('location:user/dashboard.php');
		} else {
			echo "<script type='text/javascript'>alert('Failed to Login! Incorrect RollNo or Password')</script>";
		}
	}

	if (isset($_POST['signup'])) {
		$name = $_POST['Name'];
		$email = $_POST['Email'];
		$password = $_POST['Password'];
		$mobno = $_POST['PhoneNumber'];
		$rollno = $_POST['RollNo'];
		$category = $_POST['Category'];
		$type = 'Student';

		$sql = "insert into LMS.user (Name,Type,Category,RollNo,EmailId,MobNo,Password) values ('$name','$type','$category','$rollno','$email','$mobno','$password')";

		if ($conn->query($sql) === TRUE) {
			echo "<script type='text/javascript'>alert('Registration Successful')</script>";
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
			echo "<script type='text/javascript'>alert('User Exists')</script>";
		}
	}

	?>

</body>
<!-- //Body -->

</html>

