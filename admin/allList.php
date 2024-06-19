<?php require "adminHeader.php"; ?>
<main class="col-lg-10 bg-white">
    <div class="ps">
        <br/><br/><h1>ALL Item listing </h1>
    </div>
</main>
</div>
<div class="container-fluid" style="margin-left: 100px;">
    <table class="table table-striped" style="max-width: 1180px;"  >
        <thead>
            <tr>
                <td>#</td>
                <td><b>Item Picture</b></td>
                <td><b>Item Name</b></td>
                <td><b>Category</b></td>
                <td><b>Status</b></td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $i = 1;
                $rows = mysqli_query($conn, "SELECT * FROM items ORDER BY itemID ASC");
                foreach($rows as $row) :?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><img src="../img/<?php echo $row["itemPicture"]; ?>" width="200" height="200" title="<?php echo $row["itemPicture"]; ?>"></td>
                <td><?php echo $row["itemname"]; ?></td>
                <td><?php echo $row["subCat"]; ?></td>
                <td><?php echo $row["itemStatus"]; ?></td>
            </tr>
            <?php endforeach;  ?>
        </tbody>
    </table>
</div>
</main>
</body>
</html>