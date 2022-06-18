<?php
include "data_config.php";
session_start();
$enterotp=$_POST['otpnum'];    
if(!isset($_SESSION['otpnum'])){
    header('location:sign-up.php?nootp=true');
}
if($_SESSION['otpnum']==$enterotp){
    $email=$_SESSION['notverified_user'];
    $sql="UPDATE `user_detail` SET `verify` = '0' WHERE user_email='$email'";
    $result=mysqli_query($conn,$sql);
    if($result==true){
    header('location:index.php?verified=true');
    }else{
        header('location:index.php?notverified=true');
    }
}else{
    $_SESSION['try']++;
    header('location:verifyotp.php?wrongotp=true');
    
}



?>