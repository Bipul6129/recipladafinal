<?php
session_start();
include "data_config.php";
echo"You get only 5 tries<br>";    
    echo "Your tries".$_SESSION['try'];
    $try=$_SESSION['try'];
    $email=$_SESSION['notverified_user'];
    if($try>5){
        $sql="DELETE FROM `user_detail` WHERE `user_detail`.`user_email` = '$email'";
        $result=mysqli_query($conn,$sql);
        if($result){
            header('location:index.php?failedotp=true');
        }
    }else{
    echo"
    <form action='verifyotp(process).php' method='post'>
    Enter an otp: <input type=number name=otpnum id=otpnum>
    <button type=submit>submit</button>
    </form>
    ";
    }
    echo"<div id='hide' style='display: none;'>";
    if($_GET['wrongotp']==true){
        echo "<script>alert('Wrong otp'); </script>";
      }
    echo"</div>"
    
    
        
    


?>