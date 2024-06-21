<?php require "../sidebar.php"; ?>
<main class="col-lg-12 bg-white">
        <div class="ps-lg-12">
            <br/><br/><h1>Delete Own Item</h1>
        </div>

    </div>
<div class="container-fluid">
    <?php
        if (isset($_GET["itemid"])){
            $itemid = $_GET["itemid"];
            $userId = $_SESSION['id'];
    
            $sql = "DELETE FROM items WHERE itemID = '$itemid' AND userID ='$userId'";
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>Deleted Succesfully.
                     Redirecting in 2 sec.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../user/userOwnItem.php">';
            }
            else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../user/userOwnItem.php">';
            }
        }
        else{
            echo "<div class='alert alert-danger'>Something went wrong.</div>";
            echo '<meta http-equiv="Refresh" content="2; url=../user/userOwnItem.php">';
        }
    ?>
</div>
</main>
</body>
</html>