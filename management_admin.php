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
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <li>
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
                <li class="active">
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
                    <h2>User Privileges Management For Admin</h2>
                </div>
                <div class="user--info">
                    <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Search" />
                    </div>
                    <img src="./image/img.jpg" alt=""> <!-- Change Image -->
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addadminprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Admin Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="registration.php" method="post">
                            <div class="modal-body">
    
                                <div class="form--group">
                                    <label>Your Full Name</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
                                </div>
                                <div class="form--group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email:">
                                </div>
                                <div class="form--group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password:">
                                </div>
                                <div class="form--group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
                                </div>
                                <select name="user--type"> <!-- remove this user type -->
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>
                                </select>
                                <div class="form--group">
                                    <input type="submit" class="btn btn-primary" value="Register" name="submit">
                                </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" name="btn register" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>     
                        
                    </div>
                </div>
            </div>
        
        
            <div class="card--container">
                <h3 class="main--title">Admin Management</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add Admin
                    </button>
                <div class="card--wrapper">
                    <div class="tabular--wrapper">
                        <h3 class="main--title">Users and Privileges</h3>
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
                </div>
            </div>
        </div>
    </body>
</html>