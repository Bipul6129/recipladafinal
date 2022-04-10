<?php
include "data_config.php";
session_start();
if(isset($_POST['logout'])){
    $userid=$_SESSION['user_id'];
    $statsql="UPDATE `user_detail` SET `status`='0' WHERE user_id='$userid'";
    $result=mysqli_query($conn,$statsql);
    unset($_SESSION['user_id']);
    header('location:index.php?logout=true');
    session_destroy();

}


?>