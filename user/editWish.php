<?php require "../sidebar.php"; ?>
<main class="col-lg-12 bg-white">
        <div class="ps-lg-12">
            <br/><br/><h1>Edit Wishlist Item</h1>
        </div>
    </div>

<div class="container-fluid">
        <?php
            require "../controller/wishlistControl.php";
            $userID = $_SESSION["id"];
            $wishID = $_GET["wishID"];
            $wishSql = "SELECT * FROM wishlist WHERE wishID = '$wishID' AND userID ='$userID'";
            $result2 = mysqli_query($conn, $wishSql);
            $wishRows = mysqli_fetch_array($result2);
        ?>
        <form action="addWishlist.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Wish item Name: </label>
                <input type="text" placeholder="Enter your wish item name: " 
                    name="wishName" class="form-control" value="<?php echo $wishRows['wishName'];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Remarks: </label>
                <textarea placeholder="You can write anything that you would like to say/clarify." 
                name="wishRemark" rows="3" class="form-control"><?php echo $wishRows['wishRemark'];?></textarea>
            </div>
            <div class="form-btn">
                <input type="hidden" value="<?php echo $_GET["wishID"]; ?>" name="wishid">
                <input type="hidden" value="<?php echo $_SESSION["id"]; ?>" name="userid">
                <input type="submit" value="Edit" name="editWish" class="btn btn-primary">
            </div>
    </form>