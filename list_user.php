<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <title>User and Admin List</title>
</head>
<body>
<div class="sidebar">
            <div class="logo"></div>
            <ul class="menu">
                <li class>
                    <a href="options_admin.php">
                        <i class="fas fa-shield"></i>
                        <span>IoT Benchmarking and Pentesting Platform</span>
                    </a>
                </li>
                <li>
                    <a href="index_admin.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="benchmark_admin.php">
                        <i class="fas fa-signal"></i>
                        <span>Benchmark
                            Network
                            Throughput</span>
                    </a>
                </li>
                <li>
                    <a href="penetration_admin.php">
                        <i class="fas fa-flask-vial"></i>
                        <span>Penetration
                            Testing</span>
                    </a>
                </li>
                <li>
                    <a href="monitor_admin.php">
                        <i class="fas fa-eye"></i>
                        <span>Monitor 
                            Network
                            Traffic</span>
                    </a>
                </li>
                <li>
                    <a href="past_test_admin.php">
                        <i class="fas fa-book"></i>
                        <span>Past Tests</span>
                    </a>
                </li>
                <li class="active">
                    <a href="list_user.php">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="settings">
                    <a href="faq_admin.php">
                        <i class="fas fa-question-circle"></i>
                        <span>FAQ</span>
                    </a>
                </li>
            </ul>
        </div>

    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>User and Admin List</h1>
            <a href="test_admin.php" class="btn btn-primary">Add New User</a>
        </header>
        <?php
        session_start();
        if (isset($_SESSION["create"])){
            ?>
            <div class="alert alert-success">
            <?php
            echo $_SESSION["create"];
            unset($_SESSION["create"]);
            ?>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($_SESSION["edit"])){
            ?>
            <div class="alert alert-success">
            <?php
            echo $_SESSION["edit"];
            unset($_SESSION["edit"]);
            ?>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($_SESSION["delete"])){
            ?>
            <div class="alert alert-success">
            <?php
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
            ?>
            </div>
            <?php
        }
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
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
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["user_id"]; ?></td>
                        <td><?php echo $row["full_name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["user_type"]; ?></td>
                        <td>
                            <a href="view_admin.php?user_id=<?php echo $row["user_id"]; ?>" class="btn btn-info">More Detail</a>
                            <a href="edit_admin.php?user_id=<?php echo $row["user_id"]; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_admin.php?user_id=<?php echo $row["user_id"]; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>