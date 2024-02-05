<?php
include('connection.php');

if(isset($_GET['uid'])){
    $user_id = $_GET['uid'];

    $updateSql = "UPDATE `usertable` SET `u_status`='deactive' WHERE `u_id`='$user_id'";
    $updateresult = mysqli_query($conn, $updateSql);
}
header('Location: dashboard.php');
?>