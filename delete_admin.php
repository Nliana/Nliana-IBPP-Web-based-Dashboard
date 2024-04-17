<?php  
if (isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    include ("database_2.php");
    $sql = "DELETE FROM user WHERE user_id = $user_id";
    if(mysqli_query($db2, $sql)){
        session_start();
        $_SESSION["delete"] = "User Deleted Successfully";
        header("Location: list_user.php");
    }

}

?>