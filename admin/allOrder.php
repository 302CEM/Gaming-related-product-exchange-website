<?php require "adminHeader.php"; ?>
<main class="col-lg-10 bg-white">
    <div class="ps">
        <br/><br/><h1>All request order listing</h1>
    </div>
</main>
</div>
<div class="container-fluid" style="margin-left: 100px;">
    <table class="table table-striped" style="max-width: 1180px">
        <thead>
            <tr>
                <td>#</td>
                <td><b>Item Picture</b></td>
                <td><b>Item Name</b></td>
                <td><b>Item Type</b></td>
                <td><b>Request Type</b></td>
                <td><b>Request Status</b></td>
                <td><b>Requester Comments</b></td>
                <td><b>Owner Comments</b></td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $i = 1;
                if(empty($_SESSION['id'])){
                    echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
                    echo '<meta http-equiv="Refresh" content="2; url=../login.php">';
                }
                else{
                    $userId = $_SESSION['id'];
                    $rows = mysqli_query($conn, "SELECT * FROM request ORDER BY requestID DESC");
                    foreach($rows as $row) :
                        $itemIDs = $row["itemID"];
                        $sql5 = "SELECT * FROM items WHERE itemID = '$itemIDs'";
                        $result = mysqli_query($conn, $sql5);
                        $ItemCheck = mysqli_fetch_array($result);
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><img src="../img/<?php echo $ItemCheck["itemPicture"]; ?>" width="200" height="200" title="<?php echo $ItemCheck["itemPicture"]; ?>"></td>
                <td><?php echo $ItemCheck["itemname"]; ?></td>
                <td><?php echo $ItemCheck["mainCat"]; ?>/<?php echo $ItemCheck["subCat"]; ?></td>
                <td><?php echo $row["requestType"]; ?></td>
                <td><?php echo $row["requestStatus"]; ?></td>
                <td><?php echo $row["remarks"]; ?></td>
                <td><?php echo $row["ownerRemarks"]; ?></td>
            </tr>
            <?php endforeach; }?>
        </tbody>
    </table>
</div>
</main>
</body>
</html>