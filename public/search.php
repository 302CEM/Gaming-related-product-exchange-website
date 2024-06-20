<?php require "../header.php"; ?>
<body>
    <div class="container-xxl py-5">
        <h1>Search</h1><br/>
        <form action="search.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-lable">Search: </label>
                <input type="text" placeholder="" name="searchInput" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Search" name="search" class="btn btn-primary">
            </div>
        </form>
        <div class="row pb-5 mb-4">
        
        <?php 
            $i = 1;
            if(isset($_POST["search"])){
                if (empty($_POST["searchInput"])){
                    echo "<h3 style='margin: 20px; color:red;'>Please key in a keyword</h3>";
                }
                else{
                $seachInput = $_POST["searchInput"];

                $rows = mysqli_query($conn, "SELECT * FROM items WHERE (itemStatus = 'available') AND
                    MATCH (itemname, mainCat, subCat, exchange, area, information)
                    AGAINST ('$seachInput' IN NATURAL LANGUAGE MODE)");

                /* Previous search sql 
                $rows = mysqli_query($conn, "SELECT * FROM items WHERE (itemname LIKE '%$seachInput%' OR mainCat LIKE '%$seachInput%'
                    OR subCat LIKE '%$seachInput%' OR exchange LIKE '%$seachInput%' OR area LIKE '%$seachInput%'OR information LIKE '%$seachInput%') 
                    AND (itemStatus = 'available') ORDER BY dateCreated DESC"); */

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
                <p class="small text-muted">Type: <?php echo $row["mainCat"]; ?>/<?php echo $row["subCat"]; ?></p>
                <a href="itemDetails.php?itemid=<?php echo $row['itemID'];?>" class="btn btn-info">View More</a>
            </div>
            </div>
            
        </div>
        </div>
        <?php $i++; ?>
        <?php endforeach; 
        }
        else{
            echo "<h3 style='margin: 20px; color:red;'>No data found</h3>";
        }
    
        }}?>
        </div>
    </div>
</body>