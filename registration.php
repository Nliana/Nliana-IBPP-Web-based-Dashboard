<?php
    session_start();
    if (isset($_SESSION["users"])){
        header("Location: options.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registration--container">
        <?php
        if (isset($_POST["submit"])){
            $full_name = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $password_repeat = $_POST["repeat_password"];

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($full_name) OR empty($email) OR empty($password) OR empty($password_repeat)){
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email format is invalid");
            }
            if (strlen($password) < 8){
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password != $password_repeat){
                array_push($errors, "Passwords do not match");
            }

            require_once "database_2.php";
            $sql = "SELECT * FROM user WHERE email = '$email'"; //no registration of same email address
            $result = mysqli_query($db2, $sql);
            $rowCount = mysqli_num_rows($result); //check if the email already exists in the database
            if ($rowCount > 0){
                array_push($errors, "Email already exists");
            }

            if (count($errors) == 0){
                //data will be submitted into the database
                
                $sql = "INSERT INTO user (full_name, email, password) VALUES ( ?, ?, ? )"; //placeholder to avoid sql injection
                $stmt = mysqli_stmt_init($db2);
                $prep_stmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prep_stmt){
                    mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $password_hash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registration successful</div>";
                } else {
                    die("Sorry, Something went wrong. Please try again later or contact the admin");
                }
            } else { //data will not be submitted into the database
                foreach ($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
        }
        ?>

        <form action="registration.php" method="post">
            <div class="form--group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form--group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form--group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form--group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form--group">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <p>Already Registered? <a href="login.php">Login Here</a></p>  
        </div>
    </div>
</body>
</html>