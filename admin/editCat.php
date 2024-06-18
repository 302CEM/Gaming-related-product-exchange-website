<?php require "../admin/adminHeader.php"; ?>
<main class="col-lg-10">
    <div class="ps">
        <br/><br/><h1>Edit Category</h1>
    </div>
</main>
</div>
    <div class='container-fluid' style='margin-left: 100px;'>
        <?php
            require "../controller/editCategory.php";
            $subID = $_GET["subID"];
            $mainCatSql = "SELECT * FROM maincategory ORDER BY catValue ASC";
            $mainCatRows = mysqli_query($conn, $mainCatSql);
            //$mainCatRows = mysqli_fetch_array($result1);

            $subCatSql = "SELECT * FROM subcategory WHERE subID = '$subID'";
            $result2 = mysqli_query($conn, $subCatSql);
            $subCatRows = mysqli_fetch_array($result2);

        ?>
        <form action="editCat.php" method="post" enctype="multipart/form-data" style="max-width: 1180px;">
            <div class="form-group">
                <label class="form-lable">Category: </label>
                <select class="form-select" name="mainCat">
                    <option selected value="<?php echo $subCatRows["catValue"];?>"><?php echo $subCatRows["catValue"];?></option>
                    <?php foreach($mainCatRows as $mainCatRow) : ?>
                        <option value="<?php echo $mainCatRow["catValue"];?>"><?php echo $mainCatRow["catValue"];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" id="newSubCategory">
                <input type="text" name="subCategory" class="form-control" value="<?php echo $subCatRows["subValue"];?>">
                <input type="hidden" name="subid" value="<?php echo $subCatRows["subID"]; ?>"><br/>
                <div class="form-btn">
                <input type="submit" value="Edit" name="editSub" class="btn btn-primary">
                </div>
            </div>
        </form>
</div>
    
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="../scripts.js"></script>
</html>