<?php 
    require "adminHeader.php";
    echo "<div class='container-fluid' style='margin-left: 100px;'>";

    if (isset($_GET["userID"])){
        $userID = $_GET["userID"];
        include "../database.php";

        $sql = "DELETE FROM users WHERE userID = '$userID'";
        if(mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Delected Successfull. Redirecting in 2 sec.</div>";
            echo '<meta http-equiv="Refresh" content="2; url=admin.php">';
        }
        else{
            echo "<div class='alert alert-danger'>Something's wrong</div>";
            echo '<meta http-equiv="Refresh" content="2; url=admin.php">';
        }
    }
    else{
        echo "<div class='alert alert-danger'>Something's wrong</div>";
        echo '<meta http-equiv="Refresh" content="2; url=admin.php">';
    }

    echo "</div>";

?>