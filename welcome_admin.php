<?php
    @include "database_2.php";
    session_start();
    if (!isset($_SESSION["admin_name"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="style.css" />
    
</head>
<body>

<div class="admin--container">

    <div class="admin--content">
        <h3>hi, <span>admin</span></h3>
        <h1>welcome <span><?php echo $_SESSION["admin_name"]?></span></h1>
        <p>this is an admin page</p>
        <a href="options.php" class="btn">Proceed to dashboard</a>


    </div>

</div>
    
</body>
</html>