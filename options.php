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
    <title>Register Device and Run Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector('form[action="test_process_user.php"]');
            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            const submitButton = form.querySelector('input[name="start_choice"]');

            form.addEventListener('submit', function(event) {
                if (event.submitter === submitButton) {
                    let checked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                    if (!checked) {
                        alert('Please choose at least one testing option.');
                        event.preventDefault(); // Prevent form submission
                    }
                }
            });
        });
    </script>
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
                    <span>Benchmark Network Throughput</span>
                </a>
            </li>
            <li>
                <a href="penetration.php">
                    <i class="fas fa-flask-vial"></i>
                    <span>Penetration Testing</span>
                </a>
            </li>
            <li>
                <a href="monitor.php">
                    <i class="fas fa-eye"></i>
                    <span>Monitor Network Traffic</span>
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
                <h2>IoT Benchmarking and Pentesting Platform</h2>
            </div>
            <div class="user--info">
                <div class="admin--content">
                    <h6><span>User, <?php echo $_SESSION["user_name"]?></span></h6> 
                </div>
                <a href="logout.php" class="btn btn-warning">Logout</a>
            </div>
        </div>
    
        <div class="card--container">
            <div class="main--title">
                <h2>Welcome</h2>
            </div>

            <div class="container">
                <header class="d-flex justify-content-between my-4">
                    <h3><span>Add IoT Device</span></h3>
                </header>

                <form action="device_process_user.php" method="POST">
                    <div class="form--group my-4">
                        <label>Enter Device Type</label>
                        <input type="text" class="form-control" name="device_type" placeholder="Example: Switch, Router...">
                    </div>
                    <div class="form--group my-4">
                        <label>Enter Device Name</label>
                        <input type="text" class="form-control" name="device_name" placeholder="Example: Cisco 9000, HP Switch...">
                    </div>
                    <div class="form--group"> 
                        <input type="hidden" name="user_name" value="<?php echo $_SESSION['user_name']; ?>">
                    </div>
                    <div class="form--group"> 
                        <input type="submit" class="btn btn-success" value="Add Device" name="create_device">
                    </div>
                </form>

                <form action="test_process_user.php" method="POST">
                    <header class="d-flex justify-content-between my-4">
                        <h3><span>Please choose one or more testings to be done or go to the dashboard to view past tests</span></h3>
                    </header> 

                    <div class="row">             
                        <div class="form--group my-4">
                            <div class="payment--card light-red">
                                <div class="card--header">
                                    <div class="amount">
                                        <span class="title">Monitor Network Traffic</span>
                                        <span class="amount--value"><i class="fas fa-eye"></i></span>
                                    </div>
                                    <label for="executeCommand1" class="check--container">
                                        <input type="checkbox" id="executeCommand1" name="executeCommand1" value="yes">
                                        <span class="checkmark"></span>
                                    </label>  
                                </div>
                            </div>
                        </div>

                        <div class="form--group my-4">
                            <div class="payment--card light-purple">
                                <div class="card--header">
                                    <div class="amount">
                                        <span class="title">Benchmark Network Throughput</span>
                                        <span class="amount--value"><i class="fas fa-signal"></i></span>
                                    </div>
                                    <label for="executeCommand2" class="check--container">
                                        <input type="checkbox" id="executeCommand2" name="executeCommand2" value="yes">
                                        <span class="checkmark"></span>
                                    </label> 
                                </div>      
                            </div>
                        </div>

                        <div class="form--group my-4">
                            <div class="payment--card light-green">
                                <div class="card--header">
                                    <div class="amount">
                                        <span class="title">Penetration Testing</span>
                                        <span class="amount--value"><i class="fas fa-flask-vial"></i></span>
                                    </div>
                                    <label for="executeCommand3" class="check--container">
                                        <input type="checkbox" id="executeCommand3" name="executeCommand3" value="yes">
                                        <span class="checkmark"></span>
                                    </label> 
                                </div>      
                            </div>
                        </div>

                        <div class="form--group">
                            <input type="submit" class="btn btn-success" value="Submit Choice" name="start_choice">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
