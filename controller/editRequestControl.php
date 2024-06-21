<?php
    $userId = $_SESSION['id'];
    if (empty($userId)){
        echo "<div class='alert alert-danger'>Login details missing. Please login again, redirecing...</div>";
        echo '<meta http-equiv="Refresh" content="1; url=../public/login.php">';}
    else {
        if(isset($_POST["editRequest"])){
            $requestID = $_POST["requestid"];
            $requesterName = $_POST["requesterName"];
            $contact = $_POST["contact"];
            $remarks = $_POST["remarks"];
            $requestType = $_POST["statusType"];
            $errors = array();

            if(empty($requestID)){
                echo '<a href=\"javascript:history.go(-1)\">Error. Please click here to GO BACK</a>';
                die("Request ID is missing...");}
            if (empty($requesterName) OR empty($contact) OR empty($remarks) OR empty($requestType) ){
                    array_push($errors, "All fields are required");}
            if (count($errors) > 0){
                foreach ($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                    echo "<a href=\"javascript:history.go(-1)\" style='color:red;'><h3>Error. Please click here to GO BACK</h3></a>";
                    die();}
            }
            else{
                $sql1 = "UPDATE request SET requesterName = '$requesterName', contact = '$contact', remarks ='$remarks',
                        requestType = '$requestType' WHERE requestID = '$requestID'";
                    if (mysqli_query($conn, $sql1)){
                        echo "<div class='alert alert-success'>Edit Succesfully</div>";
                        echo '<meta http-equiv="Refresh" content="1; url=../user/userApplication.php">';
                    }else{
                        echo "<div class='alert alert-danger'>Something went wrong.</div>";
                        die("Something went wrong.");}
            }
        }
    }
?>