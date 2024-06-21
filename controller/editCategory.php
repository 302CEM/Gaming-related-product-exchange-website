<?php 
    if(isset($_POST["editSub"])){
        $mainCategory = $_POST["mainCat"];
        $subCategory = $_POST["subCategory"];
        $subid = $_POST["subid"];
    
        $errors = array();

        if(empty($subid)){
            echo '<a href=\"javascript:history.go(-1)\">Error. Please click here to GO BACK</a>';
            die("Sub Category ID is missing...");
        }
        if (empty($mainCategory) OR empty($subCategory)){
                array_push($errors, "All fields are required");
            }
        if (count($errors) > 0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error Redirecting...</div>";
                echo '<meta http-equiv="Refresh" content="2, url=../admin/admin.php">';
            }
        }

        else{
            $userId = $_SESSION['id'];

            $sql1 = "SELECT * FROM users WHERE userID = '$userId'";
            $result = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_array($result);

            $checkAdmin = $row['userrole'];

            if ($checkAdmin == 'admin'){
                $sql2 = "UPDATE subcategory SET catValue = '$mainCategory', subValue = '$subCategory' WHERE subID = '$subid'";
                if (mysqli_query($conn, $sql2)){
                    echo "<div class='alert alert-success'>Edited Succesfully</div>";
                    echo '<meta http-equiv="Refresh" content="2, url=../admin/admin.php">';

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