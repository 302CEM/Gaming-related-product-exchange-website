<?php require "../sidebar.php"; ?>
<main class="col-lg-12 bg-white">
        <div class="ps-lg-12">
            <br/><br/><h1>Own Wishlist</h1>
        </div>
    </div>

<div class="container-fluid">
        <?php
            require "../controller/wishlistControl.php";
        ?>
        <form action="addWishlist.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Wish item Name: </label>
                <input type="text" placeholder="Enter your wish item name: " name="wishName" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-lable">Remarks: </label>
                <textarea placeholder="You can write anything that you would like to say/clarify." 
                name="wishRemark" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-btn">
                <input type="hidden" value="<?php echo $_SESSION["id"]; ?>" name="userid">
                <input type="submit" value="Add to Wishlist" name="addWish" class="btn btn-primary">
            </div>
    </form>
    <br/><br/>
    <table class="table table-striped" style="max-width: 1180px;">
        <thead>
            <tr>
                <td>#</td>
                <td><b>wishID</b></td>
                <td><b>Wish Item Name</b></td>
                <td><b>Wish Remarks</b></td>
                <td></td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $i = 1;
                $userId = $_SESSION['id'];
                $rows2 = mysqli_query($conn, "SELECT * FROM wishlist WHERE userID = '$userId' ORDER BY wishID ASC");
                    foreach($rows2 as $row) :?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["wishID"]; ?></td>
                <td><?php echo $row["wishName"]; ?></td>
                <td><?php echo $row["wishRemark"]; ?></td>
                <td>
                    <a href="editWish.php?wishID=<?php echo $row["wishID"]; ?>" class="btn btn-info">Edit</a>
                    <a href="deleteWish.php?wishID=<?php echo $row["wishID"]; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>   
</div>
</main>
</body>
</html>