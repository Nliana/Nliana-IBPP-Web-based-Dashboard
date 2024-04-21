<?php
include "database_2.php";
if (isset($_POST["create"])){
    $full_name = mysqli_real_escape_string($db2, $_POST["fullname"]); //to prevent sql injection
    $email = mysqli_real_escape_string($db2,$_POST["email"]);
    $password = mysqli_real_escape_string($db2,$_POST["password"]);
    $password_repeat = mysqli_real_escape_string($db2,$_POST["repeat_password"]);
    $user_type = mysqli_real_escape_string($db2,$_POST["user--type"]);

    $password_hash = password_hash($password, PASSWORD_DEFAULT); //need know the hash algorithm

    $errors = array();

    if (empty($full_name) OR empty($email) OR empty($password) OR empty($password_repeat) OR empty($user_type)){
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
        
        $sql = "INSERT INTO user (full_name, email, password, user_type) VALUES ( ?, ?, ?, ? )"; //placeholder to avoid sql injection
        $stmt = mysqli_stmt_init($db2);
        $prep_stmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prep_stmt){
            mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $password_hash, $user_type);
            mysqli_stmt_execute($stmt);
            session_start();
            $_SESSION["create"] = "User Created Successfully";
            header("Location: list_user.php");
        } else {
            die("Sorry, Something went wrong. Please try again later or contact the admin");
        }
    } else { //data will not be submitted into the database
        foreach ($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}

if (isset($_POST["edit"])){ ////////DOUBLE CHECK FOR THIS PART!!
    $full_name = mysqli_real_escape_string($db2, $_POST["fullname"]); //to prevent sql injection
    $email = mysqli_real_escape_string($db2,$_POST["email"]);
    $password = mysqli_real_escape_string($db2,$_POST["password"]);
    $password_repeat = mysqli_real_escape_string($db2,$_POST["repeat_password"]);
    $user_type = mysqli_real_escape_string($db2,$_POST["user--type"]);
    $user_id = mysqli_real_escape_string($db2,$_POST["user_id"]);

    $password_hash = password_hash($password, PASSWORD_DEFAULT); //need know the hash algorithm

    $errors = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email format is invalid");
    }
    if (strlen($password) < 8){
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password != $password_repeat){
        array_push($errors, "Passwords do not match");
    }

    $sql = "UPDATE user SET full_name = ?, email = ?, password = ?, user_type = ? WHERE user_id = $user_id"; 
    $stmt = mysqli_stmt_init($db2);
    $prep_stmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prep_stmt){
        mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $password_hash, $user_type);
        mysqli_stmt_execute($stmt);
        session_start();
        $_SESSION["edit"] = "User Updated Successfully";
        header("Location: list_user.php");
    } else {
        die("Sorry, Something went wrong. Please try again later or contact the admin");
    }
    
}

?>
