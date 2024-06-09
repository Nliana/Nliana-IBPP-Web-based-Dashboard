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

        @media print {
            /* Hide elements that don't want to print */
            .user--info {
                display: none;
            }

            /* Ensure the main content takes full width */
            .container {
                width: 100%;
            }

            .user--details {
              break-inside: avoid;
              transform: scale(0.75);
              margin-left: -90px;
              margin-top: -50px !important; 
            }
        }
    </style>
</head>
<body>
    <script> 
        function downloadPDF() { 
            window.print();
        } 
    </script>

    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <div class="header--title">
                <h1>More Details</h1>
            </div>
            <div class="user--info">
                <input class="btn btn-info" type="button" value="Download PDF" onclick="downloadPDF()">
                <a href="past_test.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <!-- Show the user_test table -->
        <div class="user--details my-4">
            <?php
                if(isset($_GET["user_id"])){
                    $user_id = $_GET["user_id"];
                    include ("database.php");
                    $sql = "SELECT * FROM user_test WHERE user_id = $user_id";
                    $result = mysqli_query($db, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                    ?>
                        <h2>Full Name</h2>
                        <p><?php echo $row["full_name"]; ?></p>
                        <h2>Email</h2>
                        <p><?php echo $row["email"]; ?></p>
                    <?php
                    } else {
                        echo "<p>No user details found for user ID $user_id.</p>";
                    }
                }
            ?>
        </div>
        
        <!-- Show the devices table -->
        <div class="user--details my-4">
            <?php
                if(isset($_GET["user_id"])){
                    $sql = "SELECT * FROM devices WHERE user_id = $user_id";
                    $result = mysqli_query($db, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                    ?>
                        <h2>Device Name</h2>
                        <p><?php echo $row["device_name"]; ?></p>
                        <h2>Device Type</h2>
                        <p><?php echo $row["device_type"]; ?></p>
                    <?php
                    } else {
                        echo "<p>No devices found for user ID $user_id.</p>";
                    }
                }
            ?>
        </div>
        
        <!-- Show the tests table -->
        <div class="user--details my-4">
            <?php
                if(isset($_GET["device_id"])){
                    $device_id = $_GET["device_id"];
                    $sql = "SELECT * FROM tests WHERE device_id = $device_id";
                    $result = mysqli_query($db, $sql);

                if ($result && mysqli_num_rows($result) > 0) {?>
                    <h2>Tests</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Test ID</th>
                                <th>Test Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row["test_id"]; ?></td>
                                <td><?php echo $row["test_date"]; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>No tests found for device ID $device_id.</p>";
                }
            }
            ?>
        </div>
        
        <!-- Show the iperf_results table -->
        <div class="user--details my-4">
            <?php
                if(isset($_GET["test_id"])){
                    $test_id = $_GET["test_id"];
                    $sql = "SELECT * FROM iperf_results WHERE test_id = $test_id";
                    $result = mysqli_query($db, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                ?>
                    <h2>Network Throughput Benchmarking Results</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Timestamp</th>
                                <th>Server IP</th>
                                <th>Port</th>
                                <th>Bandwidth</th>
                                <th>Packet Loss</th>
                                <th>Packets Sent</th>
                                <th>Packets Received</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row["iperf_id"]; ?></td>
                                <td><?php echo $row["timestamp"]; ?></td>
                                <td><?php echo $row["server_ip"]; ?></td>
                                <td><?php echo $row["port"]; ?></td>
                                <td><?php echo $row["bandwidth"]; ?></td>
                                <td><?php echo $row["packet_loss"]; ?></td>
                                <td><?php echo $row["packets_sent"]; ?></td>
                                <td><?php echo $row["packets_received"]; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>No iperf results found for test ID $test_id.</p>";
                }
            }
            ?>
        </div>
        
        <!-- Show the open_ports table -->
        <div class="user--details my-4">
            <?php
                if(isset($_GET["test_id"])){
                    $test_id = $_GET["test_id"];
                    include ("database.php");
                    $sql = "SELECT * FROM open_ports WHERE test_id = $test_id";
                    $result = mysqli_query($db, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                ?>
                    <h2>Pentesting Results</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Open Port</th>
                                <th>Customer Premises Equipment (CPE)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row["port_id"]; ?></td>
                                <td><?php echo $row["port"]; ?></td>
                                <td><?php echo $row["cpe"]; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>No pentesting results found for test ID $test_id.</p>";
                }
            }
            ?>
        </div>
        
        <!-- Show the packet_info table -->
        <div class="user--details my-4">
            <?php
                if(isset($_GET["test_id"])){
                    $test_id = $_GET["test_id"];
                    include ("database.php");
                    $sql = "SELECT * FROM packet_info WHERE test_id = $test_id";
                    $result = mysqli_query($db, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                ?>
                    <h2>Communication Monitoring Results</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Frame Interface Name</th>
                                <th>Frame Time</th>
                                <th>Frame Protocols</th>
                                <th>Ethernet Source</th>
                                <th>Ethernet Destination</th>
                                <th>Ethernet Source Resolved</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row["packet_id"]; ?></td>
                                <td><?php echo $row["frame_interface_name"]; ?></td>
                                <td><?php echo $row["frame_time"]; ?></td>
                                <td><?php echo $row["frame_protocols"]; ?></td>
                                <td><?php echo $row["eth_src"]; ?></td>
                                <td><?php echo $row["eth_dst"]; ?></td>
                                <td><?php echo $row["eth_src_resolved"]; ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>No communication monitoring results found for test ID $test_id.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>