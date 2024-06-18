<?php 
    require "../sidebar.php"; ?>
<main class="col-lg-11 bg-white">
        <div class="ps">
            <br/><br/><h1>User Page</h1>
        </div>
        <?php 
        require "../controller/userEditControl.php";
    if (empty($_SESSION['id'])){
        echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
        echo '<meta http-equiv="Refresh" content="2, url=../public/login.php">';
    }else{
        $userID = $_SESSION['id'];

        $sql = "SELECT * FROM users WHERE userID = '$userID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

    
?>
<form action="user.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="form-lable">Username: </label>
        <input type="text" placeholder="Username" name="username" class="form-control" value="<?php echo $row["username"];?>">
    </div>
    <div class="form-group">
        <label class="form-lable">Email: </label>
        <input type="text" placeholder="Email" name="useremail" class="form-control" value="<?php echo $row["userEmail"];?>">
    </div>
    <div class="form-btn">
        <input type="submit" value="Edit" name="editUser" class="btn btn-primary">
    </div>
</form>
<?php } ?>
</main>

</div>
    
</div>
</body>