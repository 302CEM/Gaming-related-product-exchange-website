<?php require "../admin/adminHeader.php"; ?>
<main class="col-lg-10">
    <div class="ps">
        <br/><br/><h1>Admin Page</h1>
    </div>
</main>
</div>
<div class="container-fluid" style="margin-left: 100px;">
    <table class="table table-striped" style="max-width: 1180px;">
        <thead>
            <tr>
                <td>#</td>
                <td><b>UserID</b></td>
                <td><b>Username</b></td>
                <td><b>Email</b></td>
                <td><b>True Name</b></td>
                <td><b>Role</b></td>
                <td><b>Created Date</b></td>
                <td></td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $i = 1;
                require_once "../database.php";
                if(empty($_SESSION['id'])){
                    echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                    echo '<meta http-equiv="Refresh" content="2; url=../login.php">';
                }
                else{
                    //$userId = $_SESSION['id'];
                    $rows = mysqli_query($conn, "SELECT * FROM users ORDER BY userrole ASC");
                    foreach($rows as $row) :
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["userID"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["userEmail"]; ?></td>
                <td><?php echo $row["truename"]; ?></td>
                <td><?php echo $row["userrole"]; ?></td>
                <td>
                    <a href="promote.php?userID=<?php echo $row["userID"]; ?>" class="btn btn-info">Promote to admin</a>
                    <a href="changeRole.php?userID=<?php echo $row["userID"]; ?>" class="btn btn-warning">Change role to user</a>
                    <a href="deleteUsers.php?userID=<?php echo $row["userID"]; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach; }?>
        </tbody>
    </table>
</div>


</div>
</body>
</html>