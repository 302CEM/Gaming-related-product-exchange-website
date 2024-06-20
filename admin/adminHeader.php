<?php
    session_start();
    include "../database.php";
    $mainNavs = mysqli_query($conn, "SELECT * FROM maincategory ORDER BY catID ASC");

    if(empty($_SESSION['id'])){
      echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
      echo '<meta http-equiv="Refresh" content="1.5; url=../public/login.php">';
    }
    elseif ($_SESSION['role'] != 'admin'){
      echo "<div class='alert alert-danger'>Non-admin is not allowed. Redirect in 1 sec...</div>";
      echo '<meta http-equiv="Refresh" content="1.5; url=../public/index.php">';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="margin-bottom: 20px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="../public/index.php"><img src="../logo/Hobby_Logo.png" width="160" height="70"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../public/index.php">Home</a>
        </li>
        <?php foreach($mainNavs as $row) :?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $row["catValue"];?></a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
              <?php
                $mainNav = $row["catValue"];
                $subNavs = mysqli_query($conn, "SELECT * FROM subcategory WHERE catValue = '$mainNav'");
                foreach($subNavs as $sub) :?>
                <li><a class="dropdown-item" href="../public/cateIndex.php?cate=<?php echo $sub["subValue"];?>">
                  <?php echo $sub["subValue"];?></a></li>
              <?php endforeach;  ?>
            </ul>
        </li>
        <?php endforeach; 
        ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../public/search.php">Search</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='../user/addItem.php'>Add item</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a class='nav-link' href='admin.php' style='margin-left: 20px'>Admin Portal</a></span>
        <span class='navbar-text'><a class='nav-link' href='../user/user.php' style='margin-left: 20px'>User</a> 
      </span>
      <span class="navbar-text" style ="margin: 0 10px 0 30px; padding-right: 50px;">
        <a class='nav-link' href='../public/logout.php'>Logout</a>
      </span>
    </div>
  </div>
</nav>

</header>

<body>
<div class="container" style="margin-top: 50;">
    <div class="row gx-10">
      <aside class="col">
        <nav id="sidebarMenu" class="d-lg-block sidebar bg-white" style="max-width: 200px; margin-top: 30px;">
        <div class="list-group list-group-flush mx-0.5 mt-3">
          <a class="list-group-item list-group-item-action py-2 ripple" href="admin.php">
                <i class="fas fa-chart-area fa-fw me-3"></i><span>Admin Page</span>
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple" href="categoryAdd.php">
                <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Category</span>
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple" href="allList.php">
              <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>All Item Listing</span>
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple" href="allOrder.php">
              <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>All Order Listing</span>
          </a>
        </div>
        </nav>
      </aside>
      <!--<main class="col-lg-10">
        <div class="ps-lg-12">
            <br/><br/><h1>User Page</h1>
        </div>
      </main>
    </div>
    start of any other code
</div>
</body> -->