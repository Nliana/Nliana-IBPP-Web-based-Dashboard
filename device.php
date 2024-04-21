<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add IoT Device</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Add IoT Device</h1>
            <a href="options_1.php" class="btn btn-primary">Back</a>
        </header>

        <form action="device_process.php" method="post">
            <div class="form--group my-4">
                <label>Enter Device Type</label> <!-- Add Device Type !!!!!!!!!! add example like switch, router-->
                <input type="text" class="form-control" name="device_type" placeholder="Example: Switch, Router...">
            </div>
            <div class="form--group my-4">
                <label>Enter Device Name</label> <!-- Add Device Name !!!!!!!!!! add example like cisco, netgear-->
                <input type="text" class="form-control" name="device_name" placeholder="Example: Cisco 9000, HP Switch...">
            </div>
            <div class="form--group">
                <input type="submit" class="btn btn-success" value="Add Device" name="create_device">
            </div>
        </form>
    </div>
</body>
</html>