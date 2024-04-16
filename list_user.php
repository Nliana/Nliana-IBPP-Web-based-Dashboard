<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User and Admin List</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>User and Admin List</h1>
            <a href="test.php" class="btn btn-primary">Add New User</a>
        </header>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Privilege Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "database_2.php";
                $sql = "SELECT * FROM user";
                $result = mysqli_query($db2, $sql);
                $row = mysqli_fetch_array($result);
                print_r($row);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>