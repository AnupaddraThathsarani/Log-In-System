<?php
include('connection.php');
session_start();

$recordsPerPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

$sql = "SELECT `u_id`, `u_username`, `u_name`, `u_email`, `u_type` FROM `usertable` WHERE `u_status`='active' LIMIT $offset, $recordsPerPage";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        <div class="tableContainer">
            <header>Users List</header>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Preview</th>
                        <th>Deactivate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = $offset + 1;

                    while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data['u_username']; ?></td>
                            <td><?php echo $data['u_name']; ?></td>
                            <td><?php echo $data['u_email']; ?></td>
                            <td><?php echo $data['u_type']; ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="openPopup(
                                    '<?php echo $data['u_id']; ?>',
                                    '<?php echo $data['u_username']; ?>',
                                    '<?php echo $data['u_name']; ?>',
                                    '<?php echo $data['u_email']; ?>',
                                    '<?php echo $data['u_type']; ?>'
                                )">Preview</button>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="deactivate.php?uid=<?php echo $data['u_id']; ?>">Deactivate</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            
            <!-- Pagination links -->
            <ul class="pagination">
                <?php
                $totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `usertable` WHERE `u_status`='active'"));
                $totalPages = ceil($totalRecords / $recordsPerPage);

                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<li><a href="userlist.php?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Popup Form -->
    <dialog id="popupForm" class="popupForm">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>User Preview</h2>
            <p id="userIdDisplay"></p>
            <p>User Name: <span id="userNameDisplay"></span></p>
            <p>Name: <span id="nameDisplay"></span></p>
            <p>Email: <span id="emailDisplay"></span></p>
            <p>User Type: <span id="userTypeDisplay"></span></p>
            <a class="btn btn-primary" href="#" id="updateLink">Update</a>
        </div>
    </dialog>

    <script>
        function openPopup(userId, userName, name, email, userType) {
            var popup = document.getElementById('popupForm');
            var userIdDisplay = document.getElementById('userIdDisplay');
            var userNameDisplay = document.getElementById('userNameDisplay');
            var nameDisplay = document.getElementById('nameDisplay');
            var emailDisplay = document.getElementById('emailDisplay');
            var userTypeDisplay = document.getElementById('userTypeDisplay');
            var updateLink = document.getElementById('updateLink');

            userIdDisplay.textContent = 'User ID: ' + userId;
            userNameDisplay.textContent = 'User Name: ' + userName;
            nameDisplay.textContent = 'Name: ' + name;
            emailDisplay.textContent = 'Email: ' + email;
            userTypeDisplay.textContent = 'User Type: ' + userType;

            updateLink.href = 'edit.php?uid=' + userId;

            popup.showModal();
        }

        function closePopup() {
            var popup = document.getElementById('popupForm');
            popup.close();
        }
    </script>

</body>
</html>
