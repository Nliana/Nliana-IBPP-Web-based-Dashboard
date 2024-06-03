<?php
    @include "database.php";
    session_start();
    if (!isset($_SESSION["admin_name"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Dashboard Design</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        />
        <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this device and its tests?");
        }
        </script>
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
                <li class="active">
                    <a href="past_test_admin.php">
                        <i class="fas fa-book"></i>
                        <span>Past Tests</span>
                    </a>
                </li>
                <li>
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
      
        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <h2>Past Test Results</h2>
                </div>
                <div class="user--info">
                    <div class="admin--content">
                        <h6><span>Admin, <?php echo $_SESSION["admin_name"]?></span></h6> 
                    </div>
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                </div>
            </div>

            <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Past Test List</h1>
        </header>

        <?php
        if (isset($_SESSION["delete_device"])){
            ?>
            <div class="alert alert-success">
            <?php
            echo $_SESSION["delete_device"];
            unset($_SESSION["delete_device"]);
            ?>
            </div>
            <?php
        }
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Device ID</th>
                    <th>User ID</th>
                    <th>Device Type</th>
                    <th>Device Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "database.php";
                // $sql = "SELECT * FROM devices";
                $sql = "SELECT devices.device_id, devices.user_id, devices.device_type, devices.device_name, tests.test_id
                FROM devices LEFT JOIN tests ON devices.device_id = tests.device_id";
                $result = mysqli_query($db, $sql);
                // $row = mysqli_fetch_array($result);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["device_id"]; ?></td>
                        <td><?php echo $row["user_id"]; ?></td>
                        <td><?php echo $row["device_type"]; ?></td>
                        <td><?php echo $row["device_name"]; ?></td>
                        <td>
                            <a href="device_detail.php?user_id=<?php echo $row["user_id"]; ?>&device_id=<?php echo $row["device_id"]; ?>&test_id=<?php echo $row["test_id"]; ?>" class="btn btn-info">More Detail</a>
                            <a href="device_delete.php?device_id=<?php echo $row["device_id"]; ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
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