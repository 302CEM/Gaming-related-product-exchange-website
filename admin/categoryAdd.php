<?php require "../admin/adminHeader.php"; ?>
<main class="col-lg-10">
    <div class="ps">
        <br/><br/><h1>Category</h1>
    </div>
</main>
</div>
    <div class='container-fluid' style='margin-left: 100px;'>
        <?php
            require "../controller/addCategory.php";
            $rows = mysqli_query($conn, "SELECT * FROM maincategory ORDER BY catValue ASC");
        ?>
        <form action="categoryAdd.php" method="post" enctype="multipart/form-data" style="max-width: 1180px;">
            <div class="form-group">
                <label class="form-lable">Category: </label>
                <select class="form-select" name="mainCat" id="mainCat">
                    <option selected disabled>Select main category</option>
                    <?php foreach($rows as $row) : ?>
                        <option value="<?php echo $row["catValue"];?>"><?php echo $row["catValue"];?></option>
                    <?php endforeach; ?>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group" id="newMainCategory">
                <input type="text" name="mainCategory" id="mainCategory" placeholder="Type in new main category here" class="form-control">
                <input type="hidden" name="adminid" value="<?php echo $_SESSION["id"]; ?>"><br/>
                <div class="form-btn">
                <input type="submit" value="Add" name="addMain" class="btn btn-primary">
                </div>
            </div>
            <div class="form-group" id="newSubCategory">
                <input type="text" name="subCategory" id="subCategory" placeholder="Type in new sub category here" class="form-control">
                <input type="hidden" name="adminid" value="<?php echo $_SESSION["id"]; ?>"><br/>
                <div class="form-btn">
                <input type="submit" value="Add" name="addSub" class="btn btn-primary">
                </div>
            </div>
        </form>

        <table class="table table-striped" style="max-width: 1180px;">
            <thead>
                <tr>
                    <td>#</td>
                    <td><b>CategoryID</b></td>
                    <td><b>Main Category</b></td>
                    <td><b>Sub Category</b></td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    $i = 1;
                    if(empty($_SESSION['id'])){
                        echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                        echo '<meta http-equiv="Refresh" content="2; url=../public/login.php">';
                    }
                    else{
                        //$userId = $_SESSION['id'];
                        $rows2 = mysqli_query($conn, "SELECT * FROM subcategory ORDER BY catValue ASC");
                        foreach($rows2 as $row) :
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["subID"]; ?></td>
                    <td><?php echo $row["catValue"]; ?></td>
                    <td><?php echo $row["subValue"]; ?></td>
                    <td>
                        <a href="editCat.php?subID=<?php echo $row["subID"]; ?>" class="btn btn-info">Edit</a>
                        <a href="deleteCat.php?subID=<?php echo $row["subID"]; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; }
                ?>
            </tbody>
        </table>
</div>
    
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="../scripts.js"></script>
</html>