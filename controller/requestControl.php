<?php
    $userId = $_SESSION['id'];
    if (empty($userId)){
        echo "<div class='alert alert-danger'>Login details missing. Please login again, redirecing...</div>";
        header("refresh:1, url=../public/login.php");
    }
    else {
        if(isset($_POST["request"])){
            $requesterName = $_POST["requesterName"];
            $contact = $_POST["contact"];
            $remarks = $_POST["remarks"];
            $statusType = $_POST["statusType"];
            $itemID = $_POST["itemid"];

            $errors = array();

            if (empty($requesterName) OR empty($contact) OR empty($remarks) OR empty($statusType) ){
                    array_push($errors, "All fields are required");
                    //echo '<script>alert("All fields are required");</script>';
                }
            if (count($errors) > 0){
                foreach ($errors as $error){
                    echo "<div class='alert alert-danger'>$error Redirecting...</div>";
                    header("Location:".$_SERVER['HTTP_REFERER']);
                }
            }

            else{
                $sql1 = "SELECT * FROM users WHERE userID = '$userId'";
                $result = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_array($result);

                $sql = "INSERT INTO request
                        (requesterName, contact, remarks, statusType, userId, itemID)
                        VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($preparestmt){
                        mysqli_stmt_bind_param($stmt, "ssssii", 
                            $requesterName, $contact, $remarks, $statusType, $userId, $itemID);
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