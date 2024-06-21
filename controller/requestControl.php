<?php
    $userId = $_SESSION['id'];
    if (empty($userId)){
        echo "<div class='alert alert-danger'>Login details missing. Please login again, redirecing...</div>";
        echo '<meta http-equiv="Refresh" content="1; url=../public/login.php">';
    }
    else {
        if(isset($_POST["request"])){
            $requesterName = $_POST["requesterName"];
            $contact = $_POST["contact"];
            $remarks = $_POST["remarks"];
            $requestType = $_POST["statusType"];
            $itemID = $_POST["itemid"];
            $errors = array();

            if (empty($requesterName) OR empty($contact) OR empty($remarks) OR empty($requestType) ){
                    array_push($errors, "All fields are required");
                    //echo '<script>alert("All fields are required");</script>';
                }
            if (empty($_POST["itemid"])){
                array_push($errors, "Item ID is missing...");
            }
            if (count($errors) > 0){
                foreach ($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                    echo "<a href=\"javascript:history.go(-1)\" style='color:red;'><h3>Error. Please click here to GO BACK</h3></a>";
                    die();
                }
            }

            else{
                $sql1 = "SELECT * FROM items WHERE itemID = '$itemID'";
                $result = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_array($result);
                $ownerID = $row["userID"];

                $sql = "INSERT INTO request
                        (requesterName, contact, remarks, requestType, userId, itemID, ownerID)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($preparestmt){
                        mysqli_stmt_bind_param($stmt, "ssssiii", 
                            $requesterName, $contact, $remarks, $requestType, $userId, $itemID, $ownerID);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Apply Succesfully</div>";
                        echo '<meta http-equiv="Refresh" content="1; url=../public/index.php">';

                    }else{
                        echo "<div class='alert alert-danger'>Something went wrong.</div>";
                        die("Something went wrong.");
                    }
            }
        }
    }
?>