<?php
session_start();
    include('connection.php');

    if(isset($_POST['login'])){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $userstatus = "active";


            $sql = "SELECT * FROM `usertable` WHERE `u_username`='$username' AND `u_password`='$password' AND `u_status`='$userstatus'";

            $reult=mysqli_query($conn, $sql);
            $data=mysqli_fetch_array($reult);

            //print_r($data);
            if(!empty($data)){
                $_SESSION['user_role'] = $data['u_type'];
                $_SESSION['user_name'] = $data['u_name'];

                header('location:dashboard.php');
            }
        }
    }
    if(isset($_POST['register'])){
        header('location:register.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    </head>

    <body>
      <div class="bg-img">
         <div class="content">
            <header>LogIn Form</header>
            <form method="POST">
                <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="username" id="username" placeholder="UserName">
               </div>
               <div class="field">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" id="password" class="pass-key" placeholder="Password">
               </div>
               <div class="field space">
                  <input type="submit" name="login" id="login" value="LOG IN">
               </div>
               <div class="field space">
                  <input type="submit" name="register" id="register" value="REGISTER">
               </div>
            </form>
         </div>
      </div>
   </body>
</html>