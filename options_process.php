<?php
include "database.php";
if (isset($_POST["submit_choice"])){
    
    foreach ($_POST["check"] as $value){
        foreach ($_POST["check"] as $value){
            $stmt = $db->prepare("INSERT INTO options (option_name) VALUES (?)");
        }


    }
    
}
?>