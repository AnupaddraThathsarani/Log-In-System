<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];

    // Update user data in the database
    $updateSql = "UPDATE `usertable` SET `u_username`='$username', `u_name`='$name', `u_email`='$email', `u_type`='$usertype' WHERE `u_id`='$userId'";
    $updateQuery = mysqli_query($conn, $updateSql);

    if ($updateQuery) {
        header('Location: userList.php');
        exit();
    } else {
        echo 'Error updating user: ' . mysqli_error($conn);
    }
}
?>
