<?php require "../header.php"; ?>
<body>
    <div class="container">
        <h1>Request</h1><br/>
        <?php
            require "../controller/requestControl.php";
            if(empty($_GET["itemid"])){
                echo '<a href=\"javascript:history.go(-1)\">Error. Please click here to GO BACK</a>';
                die("Item ID is missing...");
            }
            $itemid = $_GET["itemid"];
        ?>
        <form action="rent.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Name: </label>
                <input type="text" placeholder="Enter your name: " name="requesterName" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-lable">Contact: </label>
                <input type="text" placeholder="Enter your phone number or email: " name="contact" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-lable">Remarks: </label>
                <textarea placeholder="You can write anything that you would like to say/clarify." 
                    name="remarks" rows="6" class="form-control"></textarea>
            </div>
            <div class="form-btn">
                <input type="hidden" name="statusType" value="rent"><br/>
                <input type="hidden" name="itemid" value="<?php echo $itemid;?>"><br/>
                <input type="submit" value="Request" name="request" class="btn btn-primary">
            </div>
    </form>
    </div>
    

</body>
</html>