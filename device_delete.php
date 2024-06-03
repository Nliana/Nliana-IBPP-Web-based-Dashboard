<?php  
if (isset($_GET['device_id'])){
    $device_id = $_GET['device_id'];
    include ("database.php");
    $sql = "DELETE FROM devices WHERE device_id = $device_id";
    if(mysqli_query($db, $sql)){
        session_start();
        $_SESSION["delete_device"] = "Device and Tests Deleted Successfully";
        header("Location: past_test_admin.php");
    }

}

?>