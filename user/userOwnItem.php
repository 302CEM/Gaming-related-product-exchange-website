<?php require "../sidebar.php"; ?>
<main class="col-lg-10">
        <div class="ps-lg-12">
            <br/><br/><h1>Own Item listing </h1>
        </div>
      </main>
    </div>
<div class="container-fluid" style="margin-left: 100px;">
    <table class="table table-striped" style="max-width: 1180px;"  >
        <thead>
            <tr>
                <td>#</td>
                <td><b>Item Picture</b></td>
                <td><b>Item Name</b></td>
                <td><b>Category</b></td>
                <td><b>Status</b></td>
                <td></td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $i = 1;
                if(empty($_SESSION['id'])){
                    echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                    echo '<meta http-equiv="Refresh" content="2, url=../user/user.php">';
                }
                else{
                    $userId = $_SESSION['id'];
                    $status = $_GET['status'];
                    if (empty($status)){
                        $rows = mysqli_query($conn, "SELECT * FROM items WHERE userID = '$userId' ORDER BY userID DESC");
                    }
                    else if ($status == 1){
                        $rows = mysqli_query($conn, "SELECT * FROM items WHERE userID = '$userId' AND itemStatus = 'not' ORDER BY userID DESC");
                    }
                    else if ($status == 2){
                        $rows = mysqli_query($conn, "SELECT * FROM items WHERE userID = '$userId' AND itemStatus = 'accepted' ORDER BY userID DESC");
                    }
                    else{
                        $rows = mysqli_query($conn, "SELECT * FROM items WHERE userID = '$userId' ORDER BY userID DESC");
                    }
                    foreach($rows as $row) :
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><img src="../img/<?php echo $row["itemPicture"]; ?>" width="200" height="200" title="<?php echo $row["itemPicture"]; ?>"></td>
                <td><?php echo $row["itemname"]; ?></td>
                <td><?php echo $row["subCat"]; ?></td>
                <td><?php echo $row["itemStatus"]; ?></td>
                <td>
                    <a href="../public/itemDetails.php?itemid=<?php echo $row['itemID'];?>" class="btn btn-info">View More</a>
                    <a href="../user/edit.php?itemid=<?php echo $row["itemID"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="../user/delete.php?itemid=<?php echo $row["itemID"]; ?>" class="btn btn-danger">Delete</a>
                    <a href="../user/showApplication.php?itemid=<?php echo $row["itemID"]; ?>" class="btn btn-secondary">Application</a>
                </td>
            </tr>
            <?php endforeach; }  ?>
        </tbody>
    </table>
</div>
</div>
</div>
</body>
</html>