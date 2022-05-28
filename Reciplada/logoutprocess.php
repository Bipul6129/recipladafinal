<?php
// include "data_config.php";
// session_start();
// if(isset($_POST['logout'])){
//     $userid=$_SESSION['user_id'];
//     $statsql="UPDATE `user_detail` SET `status`='0' WHERE user_id='$userid'";
//     $result=mysqli_query($conn,$statsql);
//     unset($_SESSION['user_id']);
//     header('location:index.php?logout=true');
//     session_destroy();
// }
    session_start();
    session_unset();
    session_destroy();
    // unset($_SESSION[ 'full_name' ]);
    // unset($_SESSION['admin_id']);
    // unset($_SESSION['admin-logged-in']);
    header("location:sign-in.php");
?>