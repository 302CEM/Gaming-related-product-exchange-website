<?php
    if(isset($_POST["addWish"])){
        $wishName = $_POST["wishName"];
        $wishRemark = $_POST["wishRemark"];
        $useridADD = $_POST["userid"];
    
        $errors = array();

        if (empty($wishName) OR empty($wishRemark)){
                array_push($errors, "All fields are required");
            }
        if (count($errors) > 0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error Redirecting...</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../user/addWishlist.php">';
            }
        }

        else{
            $sql = "INSERT INTO wishlist (wishName, wishRemark, userID) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt){
                mysqli_stmt_bind_param($stmt, "ssi", $wishName, $wishRemark, $useridADD);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Added Succesfully</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../user/addWishlist.php">';

            }else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                die("Something went wrong.");
            }
        }
    }

    if(isset($_POST["editWish"])){
        $wishName = $_POST["wishName"];
        $wishRemark = $_POST["wishRemark"];
        $userid = $_POST["userid"];
        $wishid = $_POST["wishid"];
    
        $errors = array();

        if (empty($wishName) OR empty($wishRemark)){
                array_push($errors, "All fields are required");
            }
        if (count($errors) > 0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error Redirecting...</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../admin/addWishlist.php">';
            }
        }

        else{
            $sql = "UPDATE wishlist SET wishName ='$wishName', wishRemark ='$wishRemark' 
                WHERE wishID ='$wishid' AND userID ='$userid'";
            if (mysqli_query($conn, $sql)){
                echo "<div class='alert alert-success'>Edit Succesfully</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../user/addWishlist.php">';

            }else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                die("Something went wrong.");
            }
        }
    }
?>