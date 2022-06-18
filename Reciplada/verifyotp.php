<?php
session_start();
include "data_config.php";
if(!isset($_SESSION['otpnum'])){
    header('location:sign-up.php?nootp=true');
}
$try=$_SESSION['try'];
    $email=$_SESSION['notverified_user'];
    if($try>5){
        $sql="DELETE FROM `user_detail` WHERE `user_detail`.`user_email` = '$email'";
        $result=mysqli_query($conn,$sql);
        if($result){
            header('location:index.php?failedotp=true');
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
  <script src="https://kit.fontawesome.com/f6dcf461c1.js" crossorigin="anonymous"></script>
</head>
<body style="overflow-x: hidden;">
<div class="wrapper">
    <header class="main-header">
		<a href="homepage.php"><div class="brand-logo"></div></a>
	</header>
    Check your email for OTP<br>
    You only get 6 tries<br>
    Your tries <?php echo $_SESSION['try'];?><br>
    <form action='verifyotp(process).php' method='post'>
    Enter an otp: <input type=number name=otpnum id=otpnum>
    <button type=submit>submit</button>
    </form>

    <div id='hide' style='display: none;'>
     <?php if($_GET['wrongotp']==true){
         echo "<script>alert('Wrong otp'); </script>";
       }
       ?>
    </div>
</body>
</html>



<?php
  
    
    // $try=$_SESSION['try'];
    // $email=$_SESSION['notverified_user'];
    // if($try>5){
    //     $sql="DELETE FROM `user_detail` WHERE `user_detail`.`user_email` = '$email'";
    //     $result=mysqli_query($conn,$sql);
    //     if($result){
    //         header('location:index.php?failedotp=true');
    //     }
    // }else{
    // echo"
    // <form action='verifyotp(process).php' method='post'>
    // Enter an otp: <input type=number name=otpnum id=otpnum>
    // <button type=submit>submit</button>
    // </form>
    // ";
    // }
    // echo"<div id='hide' style='display: none;'>";
    // if($_GET['wrongotp']==true){
    //     echo "<script>alert('Wrong otp'); </script>";
    //   }
    // echo"</div>"
    
    
        
    


?>