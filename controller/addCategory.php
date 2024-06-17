<?php 
if(isset($_POST["addMain"])){
    $mainCategory = $_POST["mainCategory"];
    $adminid = $_POST["adminid"];

    $errors = array();

    if (empty($mainCategory) ){
            array_push($errors, "All fields are required");
        }
    if (count($errors) > 0){
        foreach ($errors as $error){
            echo "<div class='alert alert-danger'>$error Redirecting...</div>";
            echo '<meta http-equiv="Refresh" content="2, url=../admin/categoryAdd.php">';
        }
    }

    else{
        $userId = $_SESSION['id'];
        $sql1 = "SELECT * FROM users WHERE userID = '$userId'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_array($result);

        $checkAdmin = $row['userrole'];

        if ($checkAdmin == 'admin'){
            $sql = "INSERT INTO maincategory (catValue) VALUES (?)";
            $stmt = mysqli_stmt_init($conn);
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt){
                mysqli_stmt_bind_param($stmt, "s", $mainCategory);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Added Succesfully</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../admin/categoryAdd.php">';

            }else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                die("Something went wrong.");
            }
        }
        else{
            echo "<div class='alert alert-danger'>Something went wrong.</div>";
            die("Something went wrong.");
        }
        
    }
}
    if(isset($_POST["addSub"])){
        $mainCategory = $_POST["mainCat"];
        $subCategory = $_POST["subCategory"];
        $adminid = $_POST["adminid"];
    
        $errors = array();

        if (empty($mainCategory) OR empty($subCategory)){
                array_push($errors, "All fields are required");
            }
        if (count($errors) > 0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error Redirecting...</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../admin/categoryAdd.php">';
            }
        }

        else{
            $userId = $_SESSION['id'];

            $sql1 = "SELECT * FROM users WHERE userID = '$userId'";
            $result = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_array($result);

            $checkAdmin = $row['userrole'];

            if ($checkAdmin == 'admin'){
                $sql = "INSERT INTO subcategory (catValue, subValue) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                if ($preparestmt){
                    mysqli_stmt_bind_param($stmt, "ss", $mainCategory, $subCategory);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Added Succesfully</div>";
                    echo '<meta http-equiv="Refresh" content="2, url=../admin/categoryAdd.php">';

                }else{
                    echo "<div class='alert alert-danger'>Something went wrong.</div>";
                    die("Something went wrong.");
                }
            }
            else{
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
                die("Something went wrong.");
            }
        }
    }

    
?>