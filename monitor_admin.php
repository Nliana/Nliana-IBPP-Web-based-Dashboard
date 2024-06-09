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
        <title>Communication Monitoring</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        />

        <style>
        @media print {
            /* Hide elements that you don't want to print */
            .sidebar, .header--wrapper .user--info{
                display: none;
            }

            /* Optionally, ensure the main content takes full width */
            .main--content {
                width: 100%;
            }

            .table-container {
              transform: scale(0.75);
              margin-left: -90px;
              margin-top: -50px;
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
                <li class="active">
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

        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <h2>Monitor Network Traffic</h2>
                </div>
                <div class="user--info">
                    <div class="admin--content">
                        <h6><span>Admin, <?php echo $_SESSION["admin_name"]?></span></h6> 
                    </div>
                    <input class="btn btn-primary" type="button" value="Download PDF" onclick="downloadPDF()">
                    
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                </div>
            </div>
        
        
            <div class="card--container">
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
    </body>
</html>