<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit User</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit User</h1>
            <a href="list_user.php" class="btn btn-primary">Back</a>
        </header>
        <?php
        if (isset($_GET["user_id"])){
            $user_id = $_GET["user_id"];
            include ("database.php");
            $sql = "SELECT * FROM user_test WHERE user_id = $user_id";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($result);

            ?>

            <form action="process_admin.php" method="post">
            <div class="form--group my-4">
                <label>Full Name</label>
                <input type="text" class="form-control" name="fullname" value="<?php echo $row["full_name"]; ?>" placeholder="Full Name:">
            </div>
            <div class="form--group my-4">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Email:">
            </div>
            <!-- <div class="form--group my-4">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $row["password"]; ?>" placeholder="Password:">
            </div>
            <div class="form--group my-4">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div> -->
            <div class="form--element my-4">
                <select name="user--type" class="form-control"> <!-- remove this user type -->
                    <option value="">Select Privilege Type</option>
                    <option value="user" <?php if($row['user_type']=="user"){echo "selected";} ?>>User</option>
                    <option value="admin"<?php if($row['user_type']=="admin"){echo "selected";} ?>>Admin</option>
                </select>
            </div>
            <input type="hidden" name="user_id" value='<?php echo $row['user_id']; ?>'>
            <div class="form--group">
                <input type="submit" class="btn btn-success" value="Edit User" name="edit">
            </div>
        </form>

        <?php


            
        }

        ?>

        
    </div>
</body>
</html>