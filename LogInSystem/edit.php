<?php
include('connection.php');
session_start();

// Check if the user ID is provided in the URL
if (isset($_GET['uid'])) {
    $userId = $_GET['uid'];

    // Fetch user data based on the user ID
    $sql = "SELECT * FROM `usertable` WHERE `u_id` = '$userId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        // Display the edit form with pre-filled data
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit User</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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

            <div class="bg-img">
                <div class="content">
                    <header>Edit User</header>
                    <form method="POST" action="updateUser.php">
                        <!-- Include a hidden input field for user ID -->
                        <input type="hidden" name="userId" value="<?php echo $userData['u_id']; ?>">

                        <div class="field">
                            <span class="fa fa-user"></span>
                            <input type="text" name="username" required placeholder="UserName" value="<?php echo $userData['u_username']; ?>">
                        </div>
                        <div class="field">
                            <span class="fa fa-user"></span>
                            <input type="text" name="name" required placeholder="Name" value="<?php echo $userData['u_name']; ?>">
                        </div>
                        <div class="field">
                            <span class="fa fa-user"></span>
                            <input type="text" name="email" required placeholder="Email" value="<?php echo $userData['u_email']; ?>">
                        </div>
                        <div class="field">
                            <span class="fa fa-user"></span>
                            <select class="select" name="usertype" required>
                                <option value="select_role">Select Role</option>
                                <option value="admin" <?php echo ($userData['u_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="super admin" <?php echo ($userData['u_type'] == 'super admin') ? 'selected' : ''; ?>>Super Admin</option>
                                <option value="guest" <?php echo ($userData['u_type'] == 'guest') ? 'selected' : ''; ?>>Guest</option>
                            </select>
                        </div>
                        <div class="field space">
                            <input type="submit" name="update" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "User ID not provided.";
}
?>
