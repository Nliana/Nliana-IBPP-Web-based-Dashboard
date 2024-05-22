<?php  
if (isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    include ("database.php");
    $sql = "DELETE FROM user_test WHERE user_id = $user_id";
    if(mysqli_query($db, $sql)){
        session_start();
        $_SESSION["delete"] = "User Deleted Successfully";
        header("Location: list_user.php");
    }

}

?>