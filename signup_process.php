<?php
include "data_config.php";
if($_POST){
    
    $fullname=$_POST['fullname1'];
    $email=$_POST['email1'];
    $password=$_POST['password1'];
    $confirmpass=$_POST['confirmpass1'];
    $esql="SELECT * from user_detail where user_email='$email'";
    $eresult=mysqli_query($conn,$esql);
    $getrow=mysqli_fetch_assoc($eresult);
    

    if(empty($fullname)||empty($email)||empty($password)){
        header('locaion:sign-up.php?empty=true');
    }else if($email==$getrow['user_email']){
        header('location:sign-up.php?same_email=true');
        
    }
    else{
        $sql="INSERT INTO `user_detail`(`user_id`, `user_name`, `user_email`, `user_password`) VALUES ('NULL','$fullname','$email','$password')";
        $result=mysqli_query($conn,$sql);
        if($result==true){
            header('location:sign-up.php?signupsuccess=true');
        }
        echo "success";
    }

}


?>