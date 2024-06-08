<?php
    session_start();
    if (!isset($_SESSION["user_name"])){
        header("Location: login.php");
    }

    
	/* Database connection settings */
	include_once 'database.php';

	$data1 = '';
	$data2 = '';
    $data3 = '';
    $data4 = '';
	$timestamp = '';

	$query = "SELECT iperf_results.timestamp, iperf_results.bandwidth, iperf_results.packet_loss, iperf_results.packets_sent, iperf_results.packets_received FROM iperf_results ORDER BY iperf_results.timestamp ASC";
	
    $runQuery = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($runQuery)) {

		$data1 = $data1 . '"'. $row['bandwidth'].'",';
		$data2 = $data2 . '"'. $row['packet_loss'] .'",';
        $data3 = $data3 . '"'. $row['packets_sent'] .'",';
        $data4 = $data4 . '"'. $row['packets_received'] .'",';
		$timestamp = $timestamp . '"'. ucwords($row['timestamp']) .'",';
	}

	$data1 = trim($data1,",");
	$data2 = trim($data2,",");
    $data3 = trim($data3,",");
    $data4 = trim($data4,",");
	$timestamp = trim($timestamp,",");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Benchmark Network Throughput</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        />
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
        
    </head>
    <body>
        <div class="sidebar">
            <div class="logo"></div>
            <ul class="menu">
                <li class>
                    <a href="options.php">
                        <i class="fas fa-shield"></i>
                        <span>IoT Benchmarking and Pentesting Platform</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="active">
                    <a href="benchmark.php">
                        <i class="fas fa-signal"></i>
                        <span>Benchmark
                            Network
                            Throughput</span>
                    </a>
                </li>
                <li>
                    <a href="penetration.php">
                        <i class="fas fa-flask-vial"></i>
                        <span>Penetration
                            Testing</span>
                    </a>
                </li>
                <li>
                    <a href="monitor.php">
                        <i class="fas fa-eye"></i>
                        <span>Monitor 
                            Network
                            Traffic</span>
                    </a>
                </li>
                <li>
                    <a href="past_test.php">
                        <i class="fas fa-book"></i>
                        <span>Past Tests</span>
                    </a>
                </li>
                <li class="settings">
                    <a href="faq.php">
                        <i class="fas fa-question-circle"></i>
                        <span>FAQ</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <h2>Benchmark Network Throughput</h2>
                </div>
                <div class="user--info">
                    <div class="admin--content">
                        <h6><span>User, <?php echo $_SESSION["user_name"]?></span></h6> 
                    </div>
                    <input type="button" value="Download PDF" onclick="printDiv()"> <!--Button to download page as pdf-->
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                </div>
            </div>
        
        
            <div class="card--container">
                <h3 class="main--title">The Bandwidth</h3>
                <div class="card--wrapper">
                <canvas id="iperfChart_1" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

                    <script>

                        // Get canvas element
                        var ctx1 = document.getElementById('iperfChart_1').getContext('2d');

                        // Create chart
                           
                        var myChart = new Chart(ctx1, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $timestamp; ?>],
                                    datasets: 
                                    [{
                                        label: 'Bandwidth (Mbps)',
                                        data: [<?php echo $data1; ?>],
                                        backgroundColor: 'rgba(0, 0, 255, 0.2)',
                                        borderColor:'rgba(255,99,132,1)',
                                        borderWidth: 3
                                    }

                                    ]
                                },
                            
                                options: {
                                    scales: {scales:{yAxes: [{beginAtZero: true}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                                    tooltips:{mode: 'index'},
                                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                                }
                            });
                    </script>
                </div>
            </div>

            <div class="tabular--wrapper">
                <h3 class="main--title">The packet loss</h3>
                <div class="table-container">
                        <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

                            <script>
                                var ctx2 = document.getElementById("chart").getContext('2d');
                                var myChart = new Chart(ctx2, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $timestamp; ?>],
                                    datasets: 
                                    [{
                                        label: 'Packet Loss (Bytes)',
                                        data: [<?php echo $data2; ?>],
                                        backgroundColor: 'transparent',
                                        borderColor:'rgba(255,99,132,1)',
                                        borderWidth: 3
                                    }

                                    ]
                                },
                            
                                options: {
                                    scales: {scales:{yAxes: [{beginAtZero: true}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                                    tooltips:{mode: 'index'},
                                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                                }
                            });
                            </script>
                </div>
                </div>
                <div class="tabular--wrapper">
                <h3 class="main--title">The packet send</h3>
                <div class="table-container">
                        <canvas id="chart_2" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

                            <script>
                                var ctx3 = document.getElementById("chart_2").getContext('2d');
                                var myChart = new Chart(ctx3, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $timestamp; ?>],
                                    datasets: 
                                    [{
                                        label: 'Packet Send (Bytes)',
                                        data: [<?php echo $data3; ?>],
                                        backgroundColor: 'transparent',
                                        borderColor:'rgba(255,99,132,1)',
                                        borderWidth: 3
                                    }]
                                },
                            
                                options: {
                                    scales: {scales:{yAxes: [{beginAtZero: true}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                                    tooltips:{mode: 'index'},
                                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                                }
                            });
                            </script>
                </div>
                </div>
                <div class="tabular--wrapper">
                <h3 class="main--title">The packet received</h3>
                <div class="table-container">
                        <canvas id="chart_3" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

                            <script>
                                var ctx4 = document.getElementById("chart_3").getContext('2d');
                                var myChart = new Chart(ctx4, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $timestamp; ?>],
                                    datasets: 
                                    [{
                                        label: 'Packet Received (bytes)',
                                        data: [<?php echo $data4; ?>],
                                        backgroundColor: 'transparent',
                                        borderColor:'rgba(255,99,132,1)',
                                        borderWidth: 3
                                    }]
                                },
                            
                                options: {
                                    scales: {scales:{yAxes: [{beginAtZero: true}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                                    tooltips:{mode: 'index'},
                                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                                }
                            });
                            </script>
                        </div>
                </div>
            
    </body>
</html>