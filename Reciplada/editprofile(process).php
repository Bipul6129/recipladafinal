<?php
session_start();
include "check-login.php";
include "data_config.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}

if($_POST){
    $user_name=$_POST['new_username'];
    $new_pass=$_POST['new_password'];
    echo $user_name;
    $user_id=$_SESSION['user_id'];
    if(empty($user_name)||empty($new_pass)){
        header('location:editprofile.php');
    }else{
        $sql="UPDATE user_detail SET user_name='$user_name',user_password='$new_pass' WHERE user_id='$user_id'";
        $result=mysqli_query($conn,$sql);
        if($result==true){
            header('location:profile.php?edit=success');
        }
    }
}else{
    header('location:homepage.php');
}




?>