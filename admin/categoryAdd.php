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
            include "../database.php";

            $sql= "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);
            $rows= mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>
        <form action="categoryAdd.php" method="post" enctype="multipart/form-data" style="max-width: 1180px;">
            <div class="form-group">
                <label class="form-lable">Main Category: </label>
                <input type="text" name="mainCategory" placeholder="Type in new main category here" class="form-control"><br/>
                <input type="text" name="subCategory" placeholder="Type in new sub category here" class="form-control">
                <input type="hidden" name="adminid" value="<?php echo $_SESSION["id"]; ?>"><br/>
                <div class="form-btn">
                <input type="submit" value="Add" name="add" class="btn btn-primary">
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
                    require_once "../database.php";
                    if(empty($_SESSION['id'])){
                        echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                        echo '<meta http-equiv="Refresh" content="2; url=../public/login.php">';
                    }
                    else{
                        //$userId = $_SESSION['id'];
                        $rows = mysqli_query($conn, "SELECT * FROM category ORDER BY catValue ASC");
                        foreach($rows as $row) :
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["catID"]; ?></td>
                    <td><?php echo $row["catValue"]; ?></td>
                    <td><?php echo $row["subValue"]; ?></td>
                    <td>
                        <a href="editCat.php?catID=<?php echo $row["catID"]; ?>" class="btn btn-info">Edit</a>
                        <a href="deleteCat.php?catID=<?php echo $row["catID"]; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; }?>
            </tbody>
        </table>
</div>
    
</div>
</body>
</html>