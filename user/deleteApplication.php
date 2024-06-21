<?php require "../sidebar.php"; ?>
<main class="col-lg-12 bg-white">
        <div class="ps-lg-12">
            <br/><br/><h1>Delete Own requst order</h1>
        </div>

    </div>
<div class="container-fluid">
    <?php
        if (isset($_GET["requestID"])){
            $requestID = $_GET["requestID"];
            $userId = $_SESSION['id'];
    
            $sql = "DELETE FROM request WHERE requestID = '$requestID' AND userId ='$userId'";
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>Deleted Succesfully.
                     Redirecting in 2 sec.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../user/userApplication.php">';
            }
            else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../user/userApplication.php">';
            }
        }
        else{
            echo "<div class='alert alert-danger'>Something went wrong.</div>";
            echo '<meta http-equiv="Refresh" content="2; url=../user/userApplication.php">';
        }
    ?>
</div>
</main>
</body>
</html>