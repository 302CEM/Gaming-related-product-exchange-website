<?php
    if(empty($_SESSION['id'])){
        echo "<div class='alert alert-danger'>Login expired, please login again. Refresh in 1 sec...</div>";
        echo '<meta http-equiv="Refresh" content="2, url=../public/login.php">';
    }
    else{
    $userId = $_SESSION['id'];

    if(isset($_POST["add"])){
        $itemname = $_POST["itemname"];
        $mainCat = $_POST["mainCat"];
        $subCat = $_POST["subCat"];
        $type = $_POST["type"];
        $area = $_POST["area"];
        $information = $_POST["information"];
        $status = "available";

        $price = $_POST["price"];
        $deposit = $_POST["deposits"];
        if(empty($price)){$price = "RM0";}
        if(empty($deposit)){$deposit = "RM0";}

        $errors = array();

        
        if (empty($itemname) OR empty($mainCat) OR empty($subCat) OR 
            empty($type) OR empty($price) OR empty($deposit) OR empty($area) 
            OR empty($information)) {
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
                $sql = "INSERT INTO items
                        (itemname,itemPicture, mainCat, subCat, exchange, deposit, 
                            price, area, information, itemStatus, userID)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($preparestmt){
                        mysqli_stmt_bind_param($stmt, "ssssssssssi", 
                            $itemname,$newImageName, $mainCat, $subCat, $type, $deposit, 
                                $price, $area, $information, $status, $userId);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Added Succesfully</div>";
                        echo '<meta http-equiv="Refresh" content="2; url=../public/index.php">';

                    }else{
                        die("Something went wrong.");
                    }
            }
        }
    }
    }
?>