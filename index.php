<?php
    session_start();
    if (!isset($_SESSION["user_name"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Design</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <!-- <script src=
    "https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js">
        </script> -->
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
                <li class="active">
                    <a href="index.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
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

        <div class="main--content" >
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Primary</span>
                    <h2>Dashboard</h2>
                </div>
                <div class="user--info">
                    <div class="admin--content">
                        <h6><span>User, <?php echo $_SESSION["user_name"]?></span></h6> 
                    </div>
                    <input type="button" value="Download PDF" onclick="printDiv()"> <!--Button to download page as pdf-->
                    <!-- <button id="btn">Download Report</button> -->
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                </div>
            </div>
        
        
            <div class="card--container" id="mainReport">
                <h3 class="main--title">Today's data</h3>
                <div class="card--wrapper">
                    <div class="payment--card light-red">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Network Throughput
                                </span>
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
                    </div>

                    <div class="payment--card light-purple">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Issues Detected by Type
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="payment--card light-green">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Most Countries Detected (Stealth Communication)
                                </span>
                            </div>
                        </div>
                    </div>
<!--
                    <div class="payment--card light-blue">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    
                                </span>
                                <span class="amount--value">
                                    $150.00
                                </span>
                            </div>
                            <i class="fa-solid fa-check icon dark-blue"></i>
                        </div>
                        <span class="card-detail">
                            **** **** **** 5000
                        </span>
                    </div>
                </div>
            </div>
-->
            <div class="tabular--wrapper">
                <h3 class="main--title">The network traffic detected</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Source IP Address</th>
                                <th>Destination IP Address</th>
                                <th>Source Port</th>
                                <th>Destination Port</th>
                                <th>Protocol Field</th>
                                <th>Domain Name</th>
                                <th>Country</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td>
                                        2023-05-01
                                    </td>
                                    <td>192.168.1.2</td>
                                    <td>192.168.10.55</td>
                                    <td>33790</td>
                                    <td>80</td>
                                    <td>null</td>
                                    <td>example.com</td>
                                    <td>Indonesia</td>
                                </tr>

                                <tr>
                                    <td>
                                        2023-05-01
                                    </td>
                                    <td>192.168.9.2</td>
                                    <td>192.168.10.55</td>
                                    <td>33792</td>
                                    <td>80</td>
                                    <td>null</td>
                                    <td>example.com</td>
                                    <td>Malaysia</td>
                                </tr>

                                <tr>
                                    <td>
                                        2023-05-01
                                    </td>
                                    <td>192.168.7.2</td>
                                    <td>192.168.10.55</td>
                                    <td>33793</td>
                                    <td>80</td>
                                    <td>null</td>
                                    <td>example.com</td>
                                    <td>China</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8"></td>
                                </tr>
                            </tfoot>
                        </thead>
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