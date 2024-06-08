<?php
    @include "database.php";
    session_start();
    if (!isset($_SESSION["admin_name"])){
        header("Location: login.php");
    }

    include 'faqs.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Dashboard Design</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .faq-section {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .faq-item h3 {
            margin: 0;
            padding: 0;
            font-size: 1.2em;
            color: #333;
            cursor: pointer;
            
        }
        .faq-item h3:hover {
            margin: 0;
            padding: 0;
            font-size: 1.2em;
            color: #4691B0;
            cursor: pointer;
            
        }
        .faq-item p {
            display: none;
            padding: 10px 0 0 0;
            margin: 0;
            font-size: 1em;
            color: #666;
        }
         </style>
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
                    <h2>Frequent Ask Questions</h2>
                </div>
                <div class="user--info">
                    <div class="admin--content">
                        <h6><span>Admin, <?php echo $_SESSION["admin_name"]?></span></h6> 
                    </div>
                    <a href="logout.php" class="btn btn-warning">Logout</a>
                </div>
            </div>
        
            <div class="container">
                <h1>Frequently Asked Questions</h1>
                <div class="faq-section">
                    <?php foreach ($faqs as $faq) : ?>
                        <div class="faq-item">
                            <h3><?php echo $faq['question']; ?></h3>
                            <p><?php echo $faq['answer']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <script>
                // JavaScript to toggle the display of FAQ answers
                document.querySelectorAll('.faq-item h3').forEach(item => {
                    item.addEventListener('click', () => {
                        const answer = item.nextElementSibling;
                        answer.style.display = answer.style.display === 'none' || answer.style.display === '' ? 'block' : 'none';
                    });
                });
            </script>

        </div>
    </body>
</html>