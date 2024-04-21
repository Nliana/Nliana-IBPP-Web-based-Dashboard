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
        <title>Dashboard Design</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <!-- Font Awesome Cdn Link-->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        />
    </head>
    <body>
        <div class="sidebar">
            <div class="logo"></div>
            <ul class="menu">
                <li class="active">
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

        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <h2>IoT Benchmarking and Pentesting Platform</h2>
                </div>
                <div class="user--info">
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                    <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Search" />
                    </div>
                    <img src="./image/img.jpg" alt=""> <!-- Change Image -->
                </div>
            </div>
        
        
            <div class="card--container">
                <div class="main--title">
                    <h2>Welcome</h2>
                    <h4>You can conduct tests or go to the dashboard to view past tests</h4>
                </div>
                <div class="card--wrapper">   
                <a href="device.php">
                    <div class="payment--card light-red">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    IoT Device Testing
                                </span>
                                <span class="amount--value">
                                    <i class="fas fa-signal"></i>   
                                </span>   
                            </div> 
                        </div>
                </div>
            
                <div class="payment--card light-blue">
                <a href="past_test.php">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                    Past Tests
                            </span>
                            <span class="amount--value">
                                <i class="fas fa-sheet-plastic"></i>   
                            </span>
                        </div> 
                    </div>      
                </div>
                </div>
            </div>
        </div>
    </body>
</html>