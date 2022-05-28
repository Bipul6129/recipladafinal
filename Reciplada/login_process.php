<?php
session_start();
include "data_config.php";

if($_POST){
    $email=$_POST['email1'];
    $password=$_POST['password1'];

    if(empty($email)||empty($password)){
        header("location:sign-in.php?empty=true");
    }else{
        $sql="select * from user_detail where user_email='$email' and user_password='$password'";
        $result=mysqli_query($conn,$sql);
        if($row=mysqli_fetch_assoc($result)){
            
            if($row['is_admin']==1){
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['is_admin']=$row['is_admin'];
                $_SESSION['user_name']=$row['user_name'];
                $userid=$row['user_id'];
                $statsql="UPDATE `user_detail` SET `status`='1' WHERE user_id='$userid'";
                $result=mysqli_query($conn,$statsql);
                header('location:adminpage.php?welcome=true');
                

            }else{
                $userid=$row['user_id'];
                $statsql="UPDATE `user_detail` SET `status`='1' WHERE user_id='$userid'";
                $result=mysqli_query($conn,$statsql); 


            $_SESSION['user_id']=$row['user_id'];
            echo $_SESSION['user_id'];
            header('location:homepage.php?welcome=true');
            }
        }else{
            header('location:sign-in.php?error=true');
        }


    }
}


?>