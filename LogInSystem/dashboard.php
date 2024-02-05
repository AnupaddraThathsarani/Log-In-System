<?php
    include('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <!-- Side Bar -->
        <div class="sidebar">
                    <a href="dashboard.php" onclick="loadHome()"><i class="fa fa-fw fa-home"></i> Home</a>

                    <?php 
                        $role=$_SESSION['user_role'];
                    ?>
                    <?php
                        if($role=='admin' || $role=='super admin'){

                    ?>
                    <a href="userList.php"><i class="fa fa-fw fa-wrench"></i> User List</a>

                    <?php } ?>

                    <a href="logout.php"><i class="fa fa-fw fa-user"></i> Log Out</a>

        </div>

        <body>
            <div class="bg-img">
                <div class="content">
                    <header>Welcome</header>
                </div>
            </div>
        </body>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   </body>
</html>