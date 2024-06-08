<?php
include "database.php";

session_start();

// // Assuming user_id is stored in session after login
// if (!isset($_SESSION['user_id'])) {
//     die("User not logged in");
// }
// $user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["create_device"])){

    //require_once "database.php";
    if (isset($_POST["admin_name"])){
        $admin_name = mysqli_real_escape_string($db,$_POST["admin_name"]);

        $device_type = mysqli_real_escape_string($db, $_POST["device_type"]); //to prevent sql injection
        $device_name = mysqli_real_escape_string($db,$_POST["device_name"]);

        $errors = array();

        if (empty($device_type) OR empty($device_name)){
            array_push($errors, "All fields are required");
        }

        $id_sql = "SELECT user_id FROM user_test WHERE full_name = '$admin_name'"; //no registration of same device name
        $result_id = mysqli_query($db, $id_sql);

        $rowCountID = mysqli_num_rows($result_id); //check if the id already exists in the database
        if ($rowCountID > 0){
            $rowUserID = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
            $user_id = $rowUserID["user_id"];
            
            $sql = "SELECT * FROM devices WHERE device_name = '$device_name'"; //no registration of same device name
            $result = mysqli_query($db, $sql);
            $rowCount = mysqli_num_rows($result); //check if the email already exists in the database
            if ($rowCount > 0){
                array_push($errors, "Name already exists");
        
            }

            if (count($errors) == 0){
                //data will be submitted into the database
                
                $sql = "INSERT INTO devices (device_type, device_name, user_id) VALUES ( ?, ?, ?)"; //placeholder to avoid sql injection
                $stmt = mysqli_stmt_init($db);
                $prep_stmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prep_stmt){
                    mysqli_stmt_bind_param($stmt, "ssi", $device_type, $device_name, $user_id);
                    mysqli_stmt_execute($stmt);
                    //session_start();
                    $_SESSION["create"] = "Device Created Successfully";
                    header("Location: options_admin.php"); //add for user
                } else {
                    die("Sorry, Something went wrong. Please try again later or contact the admin");
                }
            } else { //data will not be submitted into the database
                foreach ($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
        
        }
    }
     
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["start_choice"])) {
    // Initialize an array to hold the commands to be executed
    $commands = [];

    // Check if at least one checkbox is selected
    if (!isset($_POST['check']) || count($_POST['check']) === 0) {
        $_SESSION['error_message'] = 'Please choose at least one testing option.';
        header("Location: options_admin.php");
        exit();
    }

    // Check which commands need to be executed based on the checkbox selections
    if (isset($_POST['executeCommand1']) && $_POST['executeCommand1'] === 'yes') {
        $commands[] = "sudo salt 'raspi_2' cmd.run '/home/liana02/tshark_monitor.sh'";
    }
    if (isset($_POST['executeCommand2']) && $_POST['executeCommand2'] === 'yes') {
        $commands[] = "sudo salt 'raspi_8' cmd.run '/home/liana08/iperf3_client.sh 10.207.161.27 6031'";    
    }
    if (isset($_POST['executeCommand3']) && $_POST['executeCommand3'] === 'yes') {
        $commands[] = "sudo /home/liana03/nmap_to_mariadb.sh avleonov.com"; // Replace with the path to your local script
    }

    // Fetch the latest device_id
    $query = "SELECT device_id FROM devices ORDER BY device_id DESC LIMIT 1";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $latest_device_id = $row['device_id'];

        // Update tests table with the latest device_id and current timestamp
        $query = "INSERT INTO tests (device_id) VALUES (?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $latest_device_id);
        $stmt->execute();
        $stmt->close();
    }

    // Loop through each command and execute it
    foreach ($commands as $command) {
        // Initialize output and status variables for each command
        $output = [];
        $status = null;

        // Execute the command and capture the output and status
        exec($command . ' 2>&1', $output, $status);

        // // Display the output and status for debugging purposes
        // echo "<h3>Command Output:</h3><pre>" . implode("\n", $output) . "</pre>";
        // echo "<h3>Command Status:</h3><pre>$status</pre>";

        // // Check if the command was executed successfully
        // if ($status === 0) {
        //     echo "<p>Command executed successfully.</p>";
        // } else {
        //     echo "<p>Command failed with status: $status</p>";
        // }
    }

    // If no checkboxes were selected for command execution
    if (empty($commands)) {
        echo "No commands were selected for execution.";
    }

    header("Location: index_admin.php");
    exit();
}

?>