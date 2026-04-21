<!-- 
<?php

@include 'dbconn.php';

if(isset($_POST['login'])||isset($email)){

    
    $email = mysqli_real_escape_string($conn, $_POST['EmailId']);   
   
   
    $select = " SELECT * FROM lms.user WHERE EmailId = '$email' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['Type'] == 'admin'||$row['Type'] == 'Admin'){

         $_SESSION['admin_name'] = $row['Name'];
         header("location:admin/dashboard");

      }elseif($row['Type'] == 'user'||$row['Type'] == 'Student'){

         $_SESSION['user_name'] = $row['Name'];
         header("location:user/dashboard");

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>login</title>
</head>
<body>
   <div class="form-container">
    <form action="" method="post">
        <h3>login now</h3>
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <input type="email" name="EmailId" required placeholder="enter your email">
        <input type="password" name="password" required placeholder="enter your password">        
        <input type="submit" name="login" value="login now" class="form-bton">
        <p>don't have an account? <a href="register.php">register now</a></p>
    </form>
   </div> 
</body>
</html>
   --> -->