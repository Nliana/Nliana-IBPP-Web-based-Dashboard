<?php
if ($_SERVER["execute_script"] == "POST" && !empty($_POST['minions'])) {
    $minions = $_POST['minions'];

    // Define the bash scripts for each minion
    $bashScripts = [
        'minion1' => 'usr/local/bin/script1.sh', // Replace with the actual path to the script for minion1
        'minion2' => 'usr/local/bin/script2.sh', // Replace with the actual path to the script for minion2
        'minion3' => 'usr/local/bin/script3.sh', // Replace with the actual path to the script for minion3
    ];

    // Loop through selected minions and execute the corresponding salt command
    foreach ($minions as $minion) {
        // Check if a script is defined for the selected minion
        if (isset($bashScripts[$minion])) {
            $bashScript = $bashScripts[$minion];
            
            // Command to run the bash script on the selected minion
            // $command = escapeshellcmd("salt '$minion' cmd.run '$bashScript'");
            
            $command = 
            // Execute the command and capture the output
            $output = shell_exec($command);
            
            // Display the output (for debugging purposes)
            echo "<pre>Executing on $minion: $output</pre>";
        } else {
            echo "<pre>No script defined for $minion</pre>";
        }
    }
} else {
    echo "No minions selected.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salt Stack Command Execution</title>
</head>
<body>
    <form action="execute_salt.php" method="post">
        <h3>Select Minions to Run the Script</h3>
        <label><input type="checkbox" name="minions[]" value="minion1"> Minion 1</label><br>
        <label><input type="checkbox" name="minions[]" value="minion2"> Minion 2</label><br>
        <label><input type="checkbox" name="minions[]" value="minion3"> Minion 3</label><br>
        <input type="submit" value="Execute Script" name=execute_script>
    </form>
</body>
</html>

<!-- WORKINGG -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Execute Command</title>
</head>
<body>
    <form method="post" action="salt_test.php">
        <label for="executeCommand">Execute Command</label>
        <input type="checkbox" id="executeCommand" name="executeCommand" value="yes">
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['executeCommand']) && $_POST['executeCommand'] === 'yes') {
// Execute the SaltStack command
            $command = "sudo salt 'raspi_2' cmd.run '/home/liana02/test_folder/test.sh'";
            //$command = "ping -c 1 8.8.8.8"; // Example alternative command

            // Initialize output and status variables
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
            }        } else {
            echo "Checkbox was not selected.";
        }
    }
    ?>
</body>
</html>


<!-- Added three checkboxes -->
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
            $commands[] = "sudo salt 'raspi_2' cmd.run '/home/liana02/test_folder/test.sh'";
        }
        if (isset($_POST['executeCommand2']) && $_POST['executeCommand2'] === 'yes') {
            $commands[] = "sudo salt 'raspi_2' cmd.run '/home/xx/test_folder/test_2.sh'";
        }
        if (isset($_POST['executeCommand3']) && $_POST['executeCommand3'] === 'yes') {
            $commands[] = "bash /path/to/local_script.sh"; // Replace with the path to your local script
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
