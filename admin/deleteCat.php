<?php require "../admin/adminHeader.php"; ?>
<main class="col-lg-10">
    <div class="ps">
        <br/><br/><h1>Edit Category</h1>
    </div>
</main>
</div>
    <div class='container-fluid' style='margin-left: 100px;'>
    <?php 
        if (isset($_GET["subID"])){
            $subID = $_GET["subID"];
    
            $sql = "DELETE FROM subcategory WHERE subID = '$subID'";
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>Deleted Succesfully.
                     Redirecting in 2 sec.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../admin/categoryAdd.php">';
            }
        }
    ?>
    </div>
</div>
</body>