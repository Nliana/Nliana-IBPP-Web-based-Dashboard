<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Execute Command</title>
</head>
<body>
    <form method="post" action="salt_test_2.php">
        <h3>Select Commands to Execute</h3>
        <label for="executeCommand1">Execute Command 1</label>
        <input type="checkbox" id="executeCommand1" name="executeCommand1" value="yes"><br>

        <label for="executeCommand2">Execute Command 2</label>
        <input type="checkbox" id="executeCommand2" name="executeCommand2" value="yes"><br>

        <label for="executeCommand3">Execute Command 3</label>
        <input type="checkbox" id="executeCommand3" name="executeCommand3" value="yes"><br>

        <input type="submit" value="Submit">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Initialize an array to hold the commands to be executed
        
        $commands = [];

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

        // Loop through each command and execute it
        foreach ($commands as $command) {
            // Initialize output and status variables for each command
            $output = [];
            $status = null;

            // Execute the command and capture the output and status
            exec($command . ' 2>&1', $output, $status);

            // Display the output and status for debugging purposes
            echo "<h3>Command Output:</h3><pre>" . implode("\n", $output) . "</pre>";
            echo "<h3>Command Status:</h3><pre>$status</pre>";

            // Check if the command was executed successfully
            if ($status === 0) {
                echo "<p>Command executed successfully.</p>";
            } else {
                echo "<p>Command failed with status: $status</p>";
            }
        }

        // If no checkboxes were selected
        if (empty($commands)) {
            echo "No commands were selected for execution.";
        }
    }
    ?>
</body>
</html>