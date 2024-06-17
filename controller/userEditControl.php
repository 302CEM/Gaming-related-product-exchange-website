<?php
$userId = $_SESSION['id'];

if(isset($_POST["editUser"])){
    $username = $_POST["username"];
    $useremail = $_POST["useremail"];

    if(empty($username) OR empty($useremail)){
        echo "<div class='alert alert-danger'>All fields are required</div>";
    }
    if(empty($userId)){
        header("url=login.php");
    }

    $sql1 = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql1);
    $rowCount = mysqli_num_rows($result);
    if($rowCount>0){
        echo "<div class='alert alert-danger'>Username already exists! Please use another username</div>";
    }

    else{
        $sql1 = "UPDATE users SET username = '$username', userEmail = '$useremail' WHERE userID = '$userId' ";
                
        if (mysqli_query($conn, $sql1)){
            echo "<div class='alert alert-success'>Updated Succesfully. Refresh in 3 sec...</div>";
            echo '<meta http-equiv="Refresh" content="2, url=../user/user.php">';

        }
        else{
            die("Something went wrong.");
        }       
    }
}
?>