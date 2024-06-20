<?php require "../sidebar.php"; 

?>
<body>
    <main class="col-lg-11 bg-white">
        <h1>Edit Item</h1><br/>
        <h6 style="color: red;">Please re-choose item picture</h6>
        <?php
            require "../controller/editControl.php";
           
            if(empty($_SESSION['id'])){
                echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                echo '<meta http-equiv="Refresh" content="1.5; url=../public/login.php">';
            }
            
            $itemid = $_GET["itemid"];
            $sql = "SELECT * FROM items WHERE itemID = '$itemid'";
            $result = mysqli_query($conn, $sql);
            $editItem = mysqli_fetch_array($result);

        ?>
        <form action="editItem.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Name: </label>
                <input type="text" placeholder="Enter name: " name="itemname" class="form-control" value="<?php echo $editItem["itemname"];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Item picture: </label>
                <input type="file" name="piture" accept=".jpg, .jpeg, .png" class="form-control">
                <span id="fileHelpInline" class="form-text">
                    Only Accepting .jpg .jpeg and .png files
                </span>
            </div>
            <div class="form-group">
                <label class="form-lable">Category: </label>
                <select class="form-select" name="mainCat">
                    <option selected value="<?php echo $editItem["mainCat"];?>"><?php echo $editItem["mainCat"];?></option>
                    <?php 
                        $mainNavs = mysqli_query($conn, "SELECT * FROM maincategory ORDER BY catID ASC");
                        foreach($mainNavs as $row) : ?>
                        <option value="<?php echo $row["catValue"];?>"><?php echo $row["catValue"];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-lable">Sub Category: </label>
                <select class="form-select" name="subCat">
                    <option value="<?php echo $editItem["subCat"];?>"><?php echo $editItem["subCat"];?></option>
                    <?php 
                        $subNavs = mysqli_query($conn, "SELECT * FROM subcategory ORDER BY catValue ASC");
                        foreach($subNavs as $row2) : ?>
                        <option value="<?php echo $row2["subValue"];?>"><?php echo $row2["subValue"];?></option>
                    <?php endforeach; ?>
                        
                </select>
            </div>
            <div class="form-group">
                <label class="form-lable">Rent/Sell/Trade: </label>
                <select class="form-select" name="type">
                    <option value="<?php echo $editItem["exchange"];?>"><?php echo $editItem["exchange"];?></option>
                    <option value="Rent, Sell and Trade">All</option>
                    <option value="Rent and Sell only">Rent and Sell only</option>
                    <option value="Rent and Trade only">Rent and Trade only</option>
                    <option value="Sell and Trade only">Sell and Trade only</option>
                    <option value="Rent only">Rent only</option>
                    <option value="Sell only">Sell only</option>
                    <option value="Trade only">Trade only</option>
                    <option value="Gift">Gift</option>
                </select>
            </div>
            <div class="form-group" id="deposit">
                <label class="form-lable">Deposit: </label>
                <input type="text" placeholder="" name="deposits" class="form-control" value="<?php echo $editItem["deposit"];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Price: </label>
                <input type="text" placeholder="Sell Price or Rent Price" name="price" class="form-control" value="<?php echo $editItem["price"];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Trade area: </label>
                <input type="text" placeholder="Enter the area available for rent/buy 
                    (example: Rent and trade face-to-face in penang island only. Sell anywhere if provide shipping cost etc.)" 
                    name="area" class="form-control" value="<?php echo $editItem["area"];?>">
            </div>
            <div class="form-group">
                <label class="form-lable">Additional information: </label>
                <textarea placeholder="Enter any extra information, like contact details, rent details, how to trade, whishlist etc..." 
                    name="information" rows="6" class="form-control"><?php echo $editItem["information"];?></textarea>
            </div>
            <div class="form-btn">
                <input type="hidden" name="itemID" value="<?php echo $editItem["itemID"]; ?>">
                <input type="submit" value="Edit" name="edit" class="btn btn-primary">
            </div>
    </form>
    </main>
    

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="../scripts.js"></script>
</html>