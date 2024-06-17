<?php require "../header.php"; ?>
<body>
    <div class="container-xxl py-5">
        <?php
            if(isset($_POST['login'])) {
                $loginusername = $_POST['username'];
                $loginpassword = $_POST['password'];
                $sql1 = "SELECT * FROM users WHERE username = '$loginusername'";
                $result1 = mysqli_query($conn, $sql1);
                $login = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                if($login){
                    if(password_verify($loginpassword, $login["userPass"])){
                        $_SESSION['username'] = $login["username"];
                        $_SESSION['id'] = $login["userID"];
                        $_SESSION['role'] = $login["userrole"];
                        header("Location: index.php");
                        echo "<div class='alert alert-success'>Login successfull</div>";
                        die();
                    }
                    else{
                        echo "<div class='alert alert-danger'>The password does not match</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>This username does not exists</div>";
                }
            }

        ?>
        <h1>Login</h1><br/>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="Enter username: " name="username" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter password: " name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
            <br/><span id="linkToLoginPage" class="form-text">
                Didn't have an account? Click <a href="register.php">HERE</a> to register.
            </span>
        </form>
    </div>
</body>
</html>