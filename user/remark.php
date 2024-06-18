<?php 
    require "../sidebar.php";
    ?>

    <main class="col-lg-10 bg-white">
    
    <div class='-fluid' style='margin-left: 100px;'>
    <?php
        $ownerID = $_SESSION['id'];
        $requestID = $_GET['requestID'];
        $sqlremark = "SELECT * FROM request WHERE requestID = '$requestID' AND ownerID = '$ownerID'";
        $result = mysqli_query($conn, $sqlremark);
        $requestArr = mysqli_fetch_array($result);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount<0){
            echo "<div class='alert alert-danger'>Incorrect user</div>";
            echo '<meta http-equiv="Refresh" content="1; url=../user/requestList.php">';
            die();
        }
    ?>
        <form action="remark.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Remarks:</label>
                <textarea placeholder="Enter any comments you like to tell the requester:" name="ownerRemarks" rows="6" 
                    class="form-control" style="max-width: 800px;"><?php echo $requestArr['ownerRemarks'];?></textarea>
            </div>
            <input type="hidden" name="requestid" value="<?php echo $requestArr['requestID']; ?>">
            <div class="form-btn">
                <input type="submit" value="Add remarks" name="add" class="btn btn-primary">
            </div>
        </form>
    </div>
    

    <?php
    if (isset($_POST["add"])){
        $requestid = $_POST["requestid"];
        $ownerRemarks = $_POST["ownerRemarks"];

        $sql = "UPDATE request SET ownerRemarks = '$ownerRemarks' WHERE requestID = '$requestid'";

        if(mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Remark added. Redirecting in 2 sec.</div>";
            echo '<meta http-equiv="Refresh" content="2; url=../user/requestList.php">';
        }
    }
    echo "</main>";
?>