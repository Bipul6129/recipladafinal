<?php
session_start();
include "data_config.php";
if($_POST){
    
    $fullname=$_POST['fullname1'];
    $email=$_POST['email1'];
    $password=$_POST['password1'];
    $confirmpass=$_POST['confirmpass1'];
    $esql="SELECT * from user_detail where user_email='$email'";
    $eresult=mysqli_query($conn,$esql);
    $getrow=mysqli_fetch_assoc($eresult);
    $i=0;

    if(empty($fullname)||empty($email)||empty($password)){
        header('locaion:sign-up.php?empty=true');
    // }else if($email==$getrow['user_email']){
    //     header('location:sign-up.php?same_email=true');
        
    // }
    }else{
        $sql="INSERT INTO `user_detail`(`user_id`, `user_name`, `user_email`, `user_password`,`verify`) VALUES ('NULL','$fullname','$email','$password',1)";
        $result=mysqli_query($conn,$sql);
        if($result==true){
            $_SESSION['notverified_user']=$email;
            $otp_generate=rand(1000,9000);
            $_SESSION['otpnum']=$otp_generate;
            $_SESSION['verified']=1;
            $_SESSION['try']=0;
            $to_email = $email;
            $subject = "OTP Verification";
            $body = "Hi your otp is".$otp_generate;
            $headers = "From: sender email";
            if (mail($to_email, $subject, $body, $headers)) {
                echo "<script>alert('Email sent to " .$to_email."')</script>";
            } else {
                echo "<script>alert('Email not sent')</script>";
            } 

            echo"<script>alert('verify your email with otp')</script>";
            // header('location:sign-up.php?signupsuccess=true');
            header('location:verifyotp.php');
        }
        echo "success";
        }
        

        // $to_email = $email;
        // $subject = "OTP Verification";
        // $body = "Hi your otp is".$otp_generate;
        // $headers = "From: sender email";
        // if (mail($to_email, $subject, $body, $headers)) {
        //     echo "<script>alert('Email sent to " .$to_email."')</script>";
        // } else {
        //     echo "<script>alert('Email not sent')</script>";
        // } 

        // echo"<script>alert('verify your email with otp')</script>";
        // echo "<script>alert(' " .$otp_generate."')</script>";
        
        // echo"
        // <form action='' method='post'>
        // Enter an otp: <input type=number name=optnum id=optnum>
        // <button type=submit>submit</button>
        // </form>
        // ";

     
        
        
        
        

        
        
       
        //    echo "email made";
        
    

}



?>

<!-- 123456789 -->