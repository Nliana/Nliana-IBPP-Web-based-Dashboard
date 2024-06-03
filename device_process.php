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

        $rowCountID = mysqli_num_rows($result_id); //check if the email already exists in the database
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

// // Check if form is submitted and at least one checkbox is selected
// if ($_SERVER['start_choice'] == 'POST' && !empty($_POST['check'])) {
//     $check = $_POST['check'];
    
//     // Prepare and bind
//     $stmt = $conn->prepare("INSERT INTO tests (timestamp) VALUES (?)");
//     $stmt->bind_param("s", $timestamp);
    
//     // Set parameters and execute
//     $timestamp = date('Y-m-d H:i:s');
//     if ($stmt->execute()) {
//         // Close statement and connection
//         $stmt->close();
//         $conn->close();
        
//         // Redirect to the results page
//         header("Location: result.php?status=success");
//         exit();
//     } else {
//         echo "Error: " . $stmt->error;
//     }

//     // Close statement and connection
//     $stmt->close();
// } else {
//     echo "Please select at least one option.";
// }
?>