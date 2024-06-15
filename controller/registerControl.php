<?php
        //print_r($_POST);
            if(isset($_POST["submit"])){
                $username = $_POST["username"];
                $email = $_POST["email"];
                $userrole = "user";
                $password = $_POST["password"];
                $confPassword = $_POST["conf_password"];

                $passworHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();

                if (empty($username) OR empty($email) OR 
                    empty($password) OR empty($confPassword) ) {
                    array_push($errors, "All fields are required");
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Email is not valid");
                }
                if(strlen($password)< 8){
                    array_push($errors, "Password must be at least 8 characters long");
                }
                if($password !== $confPassword){
                    array_push($errors, "Password does not match");
                }

                require_once "../database.php";
                $sql1 = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql1);
                $rowCount = mysqli_num_rows($result);
                if($rowCount>0){
                    array_push($errors, "Username already exists! Please use another username");
                }

                $sql2 = "SELECT * FROM users WHERE userEmail = '$email'";
                $result2 = mysqli_query($conn, $sql2);
                $rowCount = mysqli_num_rows($result2);
                if($rowCount>0){
                    array_push($errors, "Email already exists! Please use another email");
                }

                if (count($errors) > 0){
                    foreach ($errors as $error){
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }else{
                    // insert data into database
                    

                    //echo "<div class='alert alert-danger'>Database connected</div>";
                    $sql = "INSERT INTO users(username, userEmail, userrole, userPass) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($preparestmt){
                        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $userrole, $passworHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Registered Succesfully</div>";
                        header("refresh:2, url=login.php");

                    }else{
                        die("Something went wrong.");
                    }
                } 
            }
        ?>