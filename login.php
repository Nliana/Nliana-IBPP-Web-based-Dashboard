<?php
    session_start();
    // if (isset($_SESSION["users"])){
    //     header("Location: options.php");
    // }

    // Check if user is already logged in
    if (isset($_SESSION["user_name"])) {
        header("Location: options.php");

    } elseif (isset($_SESSION["admin_name"])) {
        header("Location: options_admin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="registration--container">
        <?php
        if (isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php"; //connecting to the database
            $sql = "SELECT * FROM user_test WHERE email = '$email'";
            $result = mysqli_query($db, $sql); //execute the command using query
            $users = mysqli_fetch_array($result, MYSQLI_ASSOC); //fetch the result as an associative array
            if ($users) { //Check whether email exists or match
                if (password_verify($password, $users["password"])) {
                    if ($users["user_type"] == "admin") {
                        session_start();
                        $_SESSION["admin_name"] = $users["full_name"];
                        $_SESSION["users"] = "yes";
                        header("Location: options_admin.php");
                        die();
                    } elseif ($users["user_type"] == "user"){
                        session_start();
                        $_SESSION["user_name"] = $users["full_name"];
                        $_SESSION["users"] = "yes";
                        header("Location: options.php");
                        die();
                    }
                } else {
                    echo "<div class='alert alert-danger'>Password is incorrect</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }

        }

        ?>
        
        <form action="login.php" method="post">
            
            <h3>Login Now</h3>
            <div class="form--group">
                <input type="email" placeholder="Enter your email:" name="email" class="form-control">
            </div>
            <div class="form--group">
                <input type="password" placeholder="Enter your password:" name="password" class="form-control">
            </div>
            <div class="form--btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
          <p>Not registered yet? <a href="registration.php">Register Here</a></p>  
        </div>
    </div>
</body>
</html>