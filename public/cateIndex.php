<?php require "../header.php"; ?>
<body>
    <div class="container-xxl py-5">
    <div class="row pb-5 mb-4">
        <?php 
            $i = 1;
            $category = $_GET['cate'];
            $rows = mysqli_query($conn, "SELECT * FROM items 
                WHERE subCat = '$category' AND itemStatus = 'not' 
                ORDER BY dateCreated DESC");
            $result = mysqli_fetch_array($rows, MYSQLI_ASSOC);
            if($result){
                foreach($rows as $row) :
        ?>
        <!-- Card-->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
        <div class="card shadow-sm border-0 rounded">
            <div class="card-body p-0"><img src="../img/<?php echo $row["itemPicture"]; ?>" alt="" class="card-img-top" 
                height="300" width="100" style="margin: 10px">
            <div class="p-4">
                <h5 class="mb-0"><?php echo $row["itemname"]; ?></h5>
                <p class="small text-muted">Rent/Sell/Trade: <?php echo $row["exchange"]; ?></p>
                <p class="small text-muted">Price: <?php echo $row["price"]; ?></p>
                <a href="../public/itemDetails.php?itemid=<?php echo $row['itemID'];?>" class="btn btn-info">View More</a>
            </div>
            </div>
            
        </div>
        </div>
        <?php $i++; ?>
        <?php endforeach; }
        else{
            echo "<h3 style='margin: 20px; color:red;'>No data found</h3>";
        }
        ?>
    </div>
    </div>
</body>