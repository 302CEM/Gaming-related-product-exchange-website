<?php 
    require "../header.php";
    if (isset($_GET["userID"])){
        $userID = $_GET["userID"];

        $sql1 = "SELECT * FROM users WHERE userID = '$userID'";
        $result = mysqli_query($conn, $sql1);
        $item = mysqli_fetch_array($result);
    }
?>
<main class="col-lg-10">
    <div class="ps">
        <br/><br/><h1><?php echo $item["username"]; ?>'s Wishlist</h1>
    </div>
</main>
<div class="container-xxl py-5">
    <table class="table table-striped" style="max-width: 1180px;">
        <thead><tr>
            <td>#</td>
            <td><b>wishID</b></td>
            <td><b>Wish Item Name</b></td>
            <td><b>Wish Remarks</b></td>
        </tr></thead>

        <tbody class="table-group-divider">
            <?php
                $i = 1;
                $rows2 = mysqli_query($conn, "SELECT * FROM wishlist WHERE userID = '$userID' ORDER BY wishID ASC");
                    foreach($rows2 as $row) :?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["wishID"]; ?></td>
                <td><?php echo $row["wishName"]; ?></td>
                <td><?php echo $row["wishRemark"]; ?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>   
</div>