<?php require "../sidebar.php";  ?>
<body>
    <main class="col-lg-11 bg-white">
        <h1>Request Edit</h1><br/>
        <?php
            require "../controller/editRequestControl.php";
            $requestID = $_GET["requestID"];
            $requestSql = "SELECT * FROM request WHERE requestID = '$requestID'";
            $result = mysqli_query($conn, $requestSql);
            $requestItem = mysqli_fetch_array($result);
        ?>
        <form action="editApplication.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Name: </label>
                <input type="text" placeholder="Enter your name: " name="requesterName" class="form-control" 
                    value="<?php echo $requestItem["requesterName"];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Contact: </label>
                <input type="text" placeholder="Enter your phone number or email: " name="contact" class="form-control"
                    value="<?php echo $requestItem["contact"];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Remarks: </label>
                <textarea placeholder="You can write anything that you would like to say/clarify." 
                name="remarks" rows="6" class="form-control"><?php echo $requestItem["remarks"];?></textarea>
            </div>
            <div class="form-group">
                <label class="form-lable">Request Type: </label>
                <select class="form-lable" name="statusType">
                    <option selected value="<?php echo $requestItem["requestType"];?>"><?php echo $requestItem["requestType"];?></option>
                    <option value="rent">Rent</option>
                    <option value="but">Buy</option>
                    <option value="trade">Trade</option>
                </select>
            </div>
            <div class="form-btn">
                <input type="hidden" name="requestid" value="<?php echo $requestItem["requestID"];?>">
                <input type="submit" value="Edit Request" name="editRequest" class="btn btn-primary">
            </div>
    </form>

    
    </main>
</body>
</html>