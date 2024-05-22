<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>More Details</title>
    <style>
        .user--details{
            background: #f9f9f9;
            padding: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>More Details</h1>
            <a href="list_user.php" class="btn btn-primary">Back</a>
        </header>
        <div class="user--details my-4">
            <?php
                if(isset($_GET["user_id"])){
                    $user_id = $_GET["user_id"];
                    include ("database.php");
                    $sql = "SELECT * FROM user_test WHERE user_id = $user_id";
                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($result);

                ?>
                    <h2>Full Name</h2>
                    <p><?php echo $row["full_name"]; ?></p>
                    <h2>Email</h2>
                    <p><?php echo $row["email"]; ?></p>
                    <!-- <h2>Password Hash</h2>
                    <p><?php echo $row["password"]; ?></p> -->
                    <h2>Privilege Type</h2>
                    <p><?php echo $row["user_type"]; ?></p>
                <?php
                }
            ?>
        </div>
    </div>
</body>
</html>