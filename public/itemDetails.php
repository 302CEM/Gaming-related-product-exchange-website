<?php 
    require "../header.php";
    if (isset($_GET["itemid"])){
        $itemid = $_GET["itemid"];

        $sql3 = "SELECT * FROM items WHERE itemID = '$itemid'";
        $result = mysqli_query($conn, $sql3);
        $item = mysqli_fetch_array($result);
    }
?>

    <div class="container-xxl py-5">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <img src="../img/<?php echo $item["itemPicture"]; ?>" alt="" class="card-img-top" 
                height="600" width="100" style="margin: 10px">
        </div>
      </aside>
      <main class="col-lg-6">
        <div class="ps-xl-3">
          <h4 class="title text-dark">
            Name: <?php echo $item["itemname"]; ?>
          </h4>
          <p><?php echo $item["information"]; ?></p>

          <div class="row">
            <dt class="col-3">Category:</dt>
            <dd class="col-9"><?php echo $item["mainCat"]; ?>/<?php echo $item["subCat"]; ?></dd>

            <dt class="col-3">Rent/Sell/Trade</dt>
            <dd class="col-9"><?php echo $item["exchange"]; ?></dd>

            <?php 
              if ($item["deposit"] = "0"){ ?>
                <dt class="col-3">Deposit</dt>
                <dd class="col-9"><?php echo $item["deposit"]; ?></dd>
            <?php
              }
            ?>

            <dt class="col-3">Price</dt>
            <dd class="col-9"><?php echo $item["price"]; ?></dd>

            <dt class="col-3">Available area to trade/sell/rent</dt>
            <dd class="col-9"><?php echo $item["area"]; ?></dd>

            <dt class="col-3">Post Created date</dt>
            <dd class="col-9"><?php echo $item["dateCreated"]; ?></dd>
            </div>

            <hr />
            <nav class="nav">
            <?php if(!empty($_SESSION['id'])){
                if($_SESSION['id'] != $item['userID']){ 
                    if($item["exchange"] == "Rent, Sell and Trade"){?>
                        <a href="../user/rent.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Rent</a>&nbsp;&nbsp;&nbsp;
                        <a href="../user/buy.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Buy</a>&nbsp;&nbsp;&nbsp;
                        <a href="../user/trade.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Trade</a>&nbsp;&nbsp;&nbsp;
                    <?php } elseif($item["exchange"] == "Rent and Sell only"){?>
                        <a href="../user/rent.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Rent</a>&nbsp;&nbsp;&nbsp;
                        <a href="../user/buy.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Buy</a>&nbsp;&nbsp;&nbsp;
                    <?php } elseif($item["exchange"] == "Rent and Trade only"){?>
                        <a href="../user/rent.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Rent</a>&nbsp;&nbsp;&nbsp;
                        <a href="../user/trade.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Trade</a>&nbsp;&nbsp;&nbsp;
                    <?php } elseif($item["exchange"] == "Sell and Trade only"){?>
                        <a href="../user/buy.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Buy</a>&nbsp;&nbsp;&nbsp;
                        <a href="../user/trade.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Trade</a>&nbsp;
                    <?php } elseif($item["exchange"] == "Rent only"){?>
                        <a href="../user/rent.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Rent</a>&nbsp;
                    <?php } elseif($item["exchange"] == "Sell only"){?>
                        <a href="../user/buy.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Buy</a>&nbsp;
                    <?php } elseif($item["exchange"] == "Trade only"){?>
                        <a href="../user/trade.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Trade</a>&nbsp;
                    <?php } elseif($item["exchange"] == "Gift"){?>
                        <a href="../user/gift.php?itemid=<?php echo $item["itemID"];?>" class="btn btn-primary">Request</a>&nbsp;
                    <?php }?>
                    </nav><br/>
                    <a href="../public/viewWishlist.php?userID=<?php echo $item['userID'];?>" class="btn btn-secondary">View Owner Wishlist</a>
            <?php }}?>
            
            </main>
            </div>
        </div>
