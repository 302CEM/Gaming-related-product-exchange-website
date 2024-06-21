<?php
    if(empty($_SESSION['id'])){
        echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
        echo '<meta http-equiv="Refresh" content="2, url=../public/login.php">';
    }
    else{
    $userId = $_SESSION['id'];

    if(isset($_POST["edit"])){
        $itemid = $_POST["itemID"];
        $itemname = $_POST["itemname"];
        $mainCat = $_POST["mainCat"];
        $subCat = $_POST["subCat"];
        $type = $_POST["type"];
        $area = $_POST["area"];
        $information = $_POST["information"];

        if(empty($itemid)){
            echo '<a href=\"javascript:history.go(-1)\">Error. Please click here to GO BACK</a>';
            die("Item ID is missing...");
        }
        $price = $_POST["price"];
        $deposit = $_POST["deposits"];
        if(empty($price)){$price = "RM0";}
        if(empty($deposit)){$deposit = "RM0";}
        $errors = array();

        
        if (empty($itemname) OR empty($mainCat) OR empty($subCat) OR 
            empty($type) OR empty($price) OR empty($area) OR
            empty($information)) {
                array_push($errors, "All fields are required");
        }
        if (empty($userId)){
            array_push($errors, "Please login first");
        }
        if ($_FILES['piture']['error'] === 4){
            array_push($errors, "Images does not exists");
        }
        if (count($errors) > 0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
                echo "<a href=\"javascript:history.go(-1)\" style='color:red;'><h3>Error. Please click here to GO BACK</h3></a>";
                die();
            }
        }
        else{

            $filename = $_FILES["piture"]["name"];
            $filesize = $_FILES["piture"]["size"];
            $tmpname = $_FILES["piture"]["tmp_name"];

            $validImageExtention = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $filename);
            $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension, $validImageExtention)){
                echo "<div class='alert alert-danger'>Invalid Image Extention</div>";
            }
            elseif($filesize > 1000000000){
                echo "<div class='alert alert-danger'>Image size is too large</div>";
            }
            else{
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpname, '../img/'. $newImageName);
                $sql2 = "UPDATE items SET itemname = '$itemname',itemPicture = '$newImageName', mainCat = '$mainCat', 
                        subCat = '$subCat', exchange = '$type', deposit = '$deposit', price = '$price', area = '$area', 
                        information = '$information' WHERE userID ='$userId' AND itemID ='$itemid' ";
                    if (mysqli_query($conn, $sql2)){
                        echo "<div class='alert alert-success'>Edited Succesfully</div>";
                        echo '<meta http-equiv="Refresh" content="2; url=../user/userOwnItem.php">';

                    }else{
                        die("Something went wrong.");
                    }
            }
        }
    }
    }
?>