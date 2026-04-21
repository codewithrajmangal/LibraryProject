<!-- <?php

@include 'dbconn.php';

if(isset($_POST['register'])){

   $name = mysqli_real_escape_string($conn, $_POST['Name']);
   $email = mysqli_real_escape_string($conn, $_POST['EmailId']);
   $id = mysqli_real_escape_string($conn, $_POST['ID']);
   $phone=$_POST['MobNo'];
   $pass = mysqli_real_escape_string($conn, md5($_POST['Password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['Type'];

   $select = " SELECT * FROM lms.user WHERE EmailId = '$email' && Password = '$pass' && RollNo= '$id' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password did not matched!';
      }else{
         $insert = "INSERT INTO lms.user(Name, EmailId,RollNo,MobNo, Password,Type) VALUES('$name','$email','$id', '$phone' ,'$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>register</title>
</head>
<body>
   <div class="form-container">
    <form action="" method="post">
        <h3>register now</h3>
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <input type="text" name="Name" required placeholder="enter your full name">
        <input type="email" name="EmailId" required placeholder="enter your email">
        <input type="text" Name="MobNo" required placeholder="Phone Number" >
		<input type="text" Name="ID" required placeholder="ID(faculty,last 3 digits of enrolled year,rollNO)Eg.BCA07803" >
        <input type="password" name="Password" required placeholder="enter your password">
        <input type="password" name="cpassword" required placeholder="confirm your password">
        <select name="Category" >
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" name="register" value="register now" class="form-bton">
        <p>already have and account? <a href="login.php">login now</a></p>
    </form>
   </div> 
</body>
</html> -->