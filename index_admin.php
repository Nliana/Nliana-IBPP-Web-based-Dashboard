<?php
    session_start();
    if (!isset($_SESSION["admin_name"])){
        header("Location: login.php");
    }

    /* Database connection settings */
	include_once 'database.php';

	$data1 = '';
	$data2 = '';
    $data3 = '';
    $data4 = '';
	$timestamp = '';

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = mysqli_query($db, $sql_latest_test);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to fetch data for the latest test_id
        $query = "SELECT timestamp, bandwidth, packet_loss, packets_sent, packets_received 
                FROM iperf_results 
                WHERE test_id = ?
                ORDER BY timestamp ASC";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $data1 .= '"' . $row['bandwidth'] . '",';
            $data2 .= '"' . $row['packet_loss'] . '",';
            $data3 .= '"' . $row['packets_sent'] . '",';
            $data4 .= '"' . $row['packets_received'] . '",';
            $timestamp .= '"' . $row['timestamp'] . '",';
        }

        $stmt->close();
    } else {
        // Handle the case where there is no test_id found
        $data1 = $data2 = $data3 = $data4 = $timestamp = '"N/A",';
    }

    $data1 = trim($data1, ",");
    $data2 = trim($data2, ",");
    $data3 = trim($data3, ",");
    $data4 = trim($data4, ",");
    $timestamp = trim($timestamp, ",");

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = $db->query($sql_latest_test);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to count ports for the latest test_id
        $sql_count_ports = "SELECT COUNT(*) AS port_count FROM open_ports WHERE test_id = ?";
        $stmt = $db->prepare($sql_count_ports);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $stmt->bind_result($port_count);
        $stmt->fetch();
        $stmt->close();
    } else {
        $port_count = 0; // Default value if no test_id is found
    }

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = $db->query($sql_latest_test);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to fetch one port from iperf_results for the latest test_id
        $sql_fetch_port = "SELECT port FROM iperf_results WHERE test_id = ? LIMIT 1";
        $stmt = $db->prepare($sql_fetch_port);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $stmt->bind_result($port);
        $stmt->fetch();
        $stmt->close();
    } else {
        $port = 'N/A'; // Default value if no test_id is found or no port is found
    }

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = $db->query($sql_latest_test);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to fetch the test_date for the latest test_id
        $sql_fetch_date = "SELECT test_date FROM tests WHERE test_id = ?";
        $stmt = $db->prepare($sql_fetch_date);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $stmt->bind_result($test_date);
        $stmt->fetch();
        $stmt->close();
    } else {
        $test_date = 'N/A'; // Default value if no test_id is found
    }
    
    $portData = [];

    // Fetch the cpe and port data from the open_ports table
    // Initialize arrays to store port and cpe data
    $ports = [];
    $cpe = [];

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = mysqli_query($db, $sql_latest_test);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to fetch data for the latest test_id
        $query = "SELECT port, cpe FROM open_ports WHERE test_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $ports[] = $row['port'];
            $cpe[] = $row['cpe'];
        }

        $stmt->close();
    }

    // Initialize arrays to store eth_src_resolved data
    $eth_src_resolved = [];

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = mysqli_query($db, $sql_latest_test);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to fetch data for the latest test_id
        $query = "SELECT eth_src_resolved FROM packet_info WHERE test_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $eth_src_resolved[] = $row['eth_src_resolved'];
        }

        $stmt->close();
    }

    // Initialize array to store frame_protocols data
    $frame_protocols = [];

    // Fetch the latest test_id
    $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    $result = mysqli_query($db, $sql_latest_test);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $latest_test_id = $row['test_id'];

        // Prepare and execute the query to fetch data for the latest test_id
        $query = "SELECT frame_protocols FROM packet_info WHERE test_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $latest_test_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $frame_protocols[] = $row['frame_protocols'];
        }

        $stmt->close();
    }

    // // Initialize array for table of packet_info data
    // $packet_info = [];

    // // Fetch the latest test_id
    // $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
    // $result = mysqli_query($db, $sql_latest_test);

    // if ($result && mysqli_num_rows($result) > 0) {
    //     $row = mysqli_fetch_assoc($result);
    //     $latest_test_id = $row['test_id'];

    //     // Prepare and execute the query to fetch data for the latest test_id
    //     $query = "SELECT * FROM packet_info WHERE test_id = ?";
    //     $stmt = $db->prepare($query);
    //     $stmt->bind_param("i", $latest_test_id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     while ($row = $result->fetch_assoc()) {
    //         $frame_protocols[] = $row['frame_protocols'];
    //     }

    //     $stmt->close();
    // }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Design</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
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
                <li class="active">
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

        <div class="main--content" >
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Primary</span>
                    <h2>Dashboard</h2>
                </div>
                <div class="user--info">
                    <div class="admin--content">
                        <h6><span>Admin, <?php echo $_SESSION["admin_name"]?></span></h6> 
                    </div>
                    <input type="button" value="Download PDF" onclick="printDiv()"> <!--Button to download page as pdf-->
                    <!-- <button id="btn">Download Report</button> -->
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                </div>
            </div>
        
            <div class="card--container container" id="mainReport">
            <div class="row">
                <div class="card-wrapper col">
                    <div class="payment--card light-red">
                            <div class="icon--wrapper">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="info--wrapper">
                                <h3>Open Ports:</h3>
                                <h4><?php echo $port_count; ?> Ports</h4>
                                
                            </div>
                        </div>
                        </div>
                <div class="card-wrapper col">
                    <div class="payment--card light-purple">
                        <div class="icon--wrapper">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="info--wrapper">
                            <h3>Port Used (iPerf3)</h3>
                            <h4><?php echo $port; ?></h4>
                        </div>
                    </div>
                    </div>
                <div class="card-wrapper col">
                    <div class="payment--card light-green">
                        <div class="icon--wrapper">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="info--wrapper">
                            <h3>Date of Test</h3>
                            <h4><?php echo $test_date; ?></h4>
                        </div>
                    </div>
                </div>
                </div>

                <!-- <h3 class="main--title">Today's data</h3> -->
                <div class="row">
                        <div class="card--wrapper col">
                        <h5 class="text-center">Packets Data</h5>
                            <!-- Line Chart -->
                            <div style="width: 550px;"><canvas id="myChart"></canvas></div>
                            <!-- <canvas id="myChart"></canvas> -->
                            <script>
                            // Chart.js initialization
                            const ctx = document.getElementById('myChart').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $timestamp; ?>],
                                    datasets: [
                                        
                                        {
                                            label: 'Packet Loss',
                                            data: [<?php echo $data2; ?>],
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            borderWidth: 1,
                                            fill: false
                                        },
                                        {
                                            label: 'Packets Sent',
                                            data: [<?php echo $data3; ?>],
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1,
                                            fill: false
                                        },
                                        {
                                            label: 'Packets Received',
                                            data: [<?php echo $data4; ?>],
                                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                            borderColor: 'rgba(153, 102, 255, 1)',
                                            borderWidth: 1,
                                            fill: false
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        x: {
                                            type: 'time',
                                            time: {
                                                unit: 'day'
                                            },
                                            title: {
                                                display: true,
                                                text: 'Timestamp'
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Value'
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                        </div>

                        <div class="card--wrapper col">
                        <h5 class="text-center">Bandwidth</h5>
                            <!-- Line Chart -->
                            <div style="width: 550px;"><canvas id="myChart_2"></canvas></div>
                            <!-- <canvas id="myChart"></canvas> -->
                            <script>
                                        // Chart.js initialization
                                const ctx_2 = document.getElementById('myChart_2').getContext('2d');
                                const myChart_2 = new Chart(ctx_2, {
                                    type: 'line',
                                    data: {
                                        labels: [<?php echo $timestamp; ?>],
                                        datasets: [{
                                            label: 'Bandwidth',
                                            data: [<?php echo $data1; ?>],
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 1,
                                            fill: false
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            x: {
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                },
                                                title: {
                                                    display: true,
                                                    text: 'Timestamp'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Bandwidth'
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        <!-- </div> -->
                        </div>

                        <div class="card--wrapper col">
                            <h5 class="text-center">Ports and CPE Distribution for the Latest Test</h5>
                            <!-- Line Chart -->
                            <div style="width: 550px;"><canvas id="myChart_3"></canvas></div>
                            <!-- <canvas id="myChart"></canvas> -->
                            <script>
                                // Prepare data for the chart
                                var ports = <?php echo json_encode($ports); ?>;
                                var cpe = <?php echo json_encode($cpe); ?>;

                                // Count occurrences of each cpe
                                var cpeCounts = {};
                                cpe.forEach(function(c) {
                                    cpeCounts[c] = (cpeCounts[c] || 0) + 1;
                                });

                                // Prepare data for the pie chart
                                var labels = Object.keys(cpeCounts);
                                var data = Object.values(cpeCounts);

                                // Create the pie chart
                                var ctx_3 = document.getElementById('myChart_3').getContext('2d');
                                var myChart_3 = new Chart(ctx_3, {
                                    type: 'pie',
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Ports and CPE Distribution for the Latest Test'
                                            }
                                        }
                                    },
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            data: data,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    }
                                    
                                });
                            </script>
                        </div>

                        <div class="card--wrapper col">
                            <h5 class="text-center">Ethernet Source Resolved Distribution for the Latest Test</h5>
                            <!-- Line Chart -->
                            <div style="width: 550px;"><canvas id="myChart_4"></canvas></div>
                            <!-- <canvas id="myChart"></canvas> -->
                            <script>
                                // Prepare data for the chart
                                var ethSrcResolved = <?php echo json_encode($eth_src_resolved); ?>;

                                // Count occurrences of each eth_src_resolved
                                var ethSrcCounts = {};
                                ethSrcResolved.forEach(function(src) {
                                    ethSrcCounts[src] = (ethSrcCounts[src] || 0) + 1;
                                });

                                // Prepare data for the bar chart
                                var labels = Object.keys(ethSrcCounts);
                                var data = Object.values(ethSrcCounts);

                                // Create the bar chart
                                var ctx_4 = document.getElementById('myChart_4').getContext('2d');
                                var myChart_4 = new Chart(ctx_4, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Ethernet Source Resolved Count',
                                            data: data,
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            },
                                            title: {
                                                display: true,
                                                text: 'Ethernet Source Resolved Distribution for the Latest Test'
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>

                        <div class="card--wrapper col">
                            <h5 class="text-center">Frame Protocols Distribution for the Latest Test</h5>
                            <!-- Line Chart -->
                            <div style="width: 550px;"><canvas id="myChart_5"></canvas></div>
                            <!-- <canvas id="myChart"></canvas> -->
                            <script>
                                // Prepare data for the chart
                                var frameProtocols = <?php echo json_encode($frame_protocols); ?>;

                                // Count occurrences of each frame_protocol
                                var protocolCounts = {};
                                frameProtocols.forEach(function(protocol) {
                                    var protocols = protocol.split(','); // Split multiple protocols in a single record
                                    protocols.forEach(function(proto) {
                                        protocolCounts[proto.trim()] = (protocolCounts[proto.trim()] || 0) + 1;
                                    });
                                });

                                // Prepare data for the doughnut chart
                                var labels = Object.keys(protocolCounts);
                                var data = Object.values(protocolCounts);

                                // Create the doughnut chart
                                var ctx_5 = document.getElementById('myChart_5').getContext('2d');
                                var myChart_5 = new Chart(ctx_5, {
                                    type: 'doughnut',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            data: data,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)',
                                                'rgba(199, 199, 199, 0.2)',
                                                'rgba(83, 102, 255, 0.2)',
                                                'rgba(255, 144, 64, 0.2)',
                                                'rgba(144, 255, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)',
                                                'rgba(199, 199, 199, 1)',
                                                'rgba(83, 102, 255, 1)',
                                                'rgba(255, 144, 64, 1)',
                                                'rgba(144, 255, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Frame Protocols Distribution for the Latest Test'
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>

                </div>

            <div class="tabular--wrapper">
                <h3 class="main--title">The network traffic detected</h3>
                <div class="table-container">
                    <table>
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
                            // Database connection and data fetching
                            include 'database.php';

                            // Initialize array for table of packet_info data
                            $packet_info = [];

                            // Fetch the latest test_id
                            $sql_latest_test = "SELECT test_id FROM tests ORDER BY test_date DESC LIMIT 1";
                            $result = mysqli_query($db, $sql_latest_test);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $latest_test_id = $row['test_id'];

                                // Prepare and execute the query to fetch data for the latest test_id
                                $query = "SELECT * FROM packet_info WHERE test_id = ?";
                                $stmt = $db->prepare($query);
                                $stmt->bind_param("i", $latest_test_id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['packet_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['frame_interface_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['frame_time']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['frame_protocols']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['eth_src']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['eth_dst']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['eth_src_resolved']) . "</td>";
                                    echo "</tr>";
                                }

                                $stmt->close();
                            } else {
                                echo "<tr><td colspan='7'>No communication monitoring results found for the latest test.</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

        <script> 
            function printDiv() { 
                var divContents = document.getElementById("mainReport").innerHTML; 
                var originalContents = document.body.innerHTML;
                //var originalContents = document.body.innerHTML; // Save original body content

                // Replace body content with divContents
                document.body.innerHTML = '<html><head><title>Print</title></head><body>' + divContents + '</body></html>';

                // Print the page
                window.print();

                // Restore original body content
                document.body.innerHTML = originalContents;
            } 
        </script>

    </body>
</html>