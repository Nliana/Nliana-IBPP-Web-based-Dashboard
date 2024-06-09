<?php
include "database.php";

session_start();

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