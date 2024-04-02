<?php
    @include "database_2.php";
    session_start();
    if (!isset($_SESSION["user_name"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <link rel="stylesheet" href="style.css" />
    
</head>
<body>

<div class="admin--container">

    <div class="admin--content">
        <h3>hi, <span>user</span></h3>
        <h1>welcome <span><?php echo $_SESSION["user_name"]?></span></h1>
        <p>this is an user page</p>
        <a href="options.php" class="btn">Proceed to dashboard</a>


    </div>

</div>
    
</body>
</html>