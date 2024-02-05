<?php
    include('connection.php');

    if(isset($_POST['submit'])){
        if(isset($_POST['username']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['usertype']) && isset($_POST['password'])){
            $username =  $_POST['username'];
            $name =  $_POST['name'];
            $email =  $_POST['email'];
            $usertype =  $_POST['usertype'];
            $userstatus = "active";
            $password =  $_POST['password'];

            // Check if the username or email already exists
            $checkQuery = "SELECT * FROM `usertable` WHERE `u_username` = '$username' OR `u_email` = '$email'";
            $checkStmt = mysqli_prepare($conn, $checkQuery);

            $reult=mysqli_query($conn, $checkQuery);
            $data=mysqli_fetch_array($reult);

            if(!empty($data)){
                echo "Check Username or email again";
            }
    
            else{
                $sql = "INSERT INTO `usertable` (`u_username`, `u_name`, `u_email`, `u_type`, `u_status`, `u_password`) VALUES ('$username', '$name', '$email', '$usertype', '$userstatus', '$password')";
                $query = mysqli_query($conn, $sql);
        
                if($query){
                    header('location:index.php');
                }
                else{
                    echo 'Error in Registration';
                }
            }
            
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registeration Form</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    </head>

    <body>
      <div class="bg-img">
         <div class="content">
            <header>Register Form</header>
            <form method="POST">
                <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="username" id="username" required placeholder="UserName">
               </div>
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="name" id="name" required placeholder="Name">
               </div>
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="email" id="email" required placeholder="Email">
               </div>
               <div class="field">
                  <span class="fa fa-user"></span>
                  <select class="select" name="usertype" id="usertype">
                    <option value="select_role">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="super admin">Super Admin</option>
                    <option value="guest">Guest</option>
                  </select>
               </div>
               <div class="field">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" id="password" class="pass-key" required placeholder="Password">
               </div>
               
               <div class="field space">
                  <input type="submit" name="submit" id="submit" value="REGISTER">
               </div>
            </form>
         </div>
      </div>
   </body>
</html>