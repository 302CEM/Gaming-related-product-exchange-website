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
        $requestArr = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount<0){
            echo "<div class='alert alert-danger'>Incorrect user</div>";
            echo '<meta http-equiv="Refresh" content="1; url=../user/requestList.php">';
            die();
        }
    ?>
        <form action="reject.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Reject reason/Remarks:</label>
                <textarea placeholder="Enter any comments you like to tell the requester:" name="ownerRemarks" rows="6" 
                    class="form-control" style="max-width: 800px;"><?php echo $requestArr['ownerRemarks'];?></textarea>
            </div>
            <input type="hidden" name="requestid" value="<?php echo $requestArr['requestID']; ?>">
            <input type="hidden" name="itemID" value="<?php echo $requestArr['itemID']; ?>">
            <div class="form-btn">
                <input type="submit" value="Reject" name="reject" class="btn btn-primary">
            </div>
        </form>
    </div>
    

    <?php
    if (isset($_POST["reject"])){
        $requestid = $_POST["requestid"];
        $ownerRemarks = $_POST["ownerRemarks"];
        $statusRequest = "reject";
        $itemID = $_POST["itemID"];

        $sql = "UPDATE request SET ownerRemarks = '$ownerRemarks', requestStatus = '$statusRequest' WHERE requestID = '$requestid'";

        if(mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Remark added. Redirecting in 2 sec.</div>";
            echo '<meta http-equiv="Refresh" content="2; url=../user/requestList.php">';
        }
        if(mysqli_query($conn, $sql)) {
            $sql2 = "UPDATE items SET itemStatus = 'available' WHERE itemID = '$itemID'";
            if(mysqli_query($conn, $sql2)){
                echo "<div class='alert alert-success'>Remark added. Redirecting in 2 sec.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../user/requestList.php">';
            }else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                echo '<meta http-equiv="Refresh" content="2; url=../user/requestList.php">';
            } 
        }else{
            echo "<div class='alert alert-danger'>Something went wrong.</div>";
            echo '<meta http-equiv="Refresh" content="2; url=../user/requestList.php">';
        }
    }
    echo "</main>";
?>