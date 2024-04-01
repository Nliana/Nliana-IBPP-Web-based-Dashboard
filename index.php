<?php
    session_start();
    if (!isset($_SESSION["users"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Design</title>
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

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
                    <a href="faq.php">
                        <i class="fas fa-question-circle"></i>
                        <span>FAQ</span>
                    </a>
                </li>
                <li class="settings">
                    <a href="settings.php">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main--content" id="mainReport">
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Primary</span>
                    <h2>Dashboard</h2>
                </div>
                <div class="user--info">

                   <!-- <input type="button" value="Download PDF" onclick="printReport()"> --><!-- Button to download page as pdf-->
                    <button>Download Report</button>
                    
                    <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Search" />
                    </div>
                    <img src="./image/img.jpg" alt=""> <!-- Change Image -->
                </div>
            </div>
        
        
            <div class="card--container">
                <h3 class="main--title">Today's data</h3>
                <div class="card--wrapper">
                    <div class="payment--card light-red">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Network Throughput
                                </span>
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

    </body>
</html>