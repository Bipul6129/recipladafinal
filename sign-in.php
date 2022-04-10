<?php
session_start();
if(isset($_SESSION['user_id'])){
    if(isset($_SESSION['is_admin'])){
        header('location:adminpage.php?alreadylogin=true');
    }else{
    header('location:homepage.php?alreadylogin=true');}
}else{?>




<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
</head>
<body>
    <form id="loginform" onsubmit="event.preventDefault();jscheck();" method="post" action="login_process.php">
    <input type=email id="email" name="email1" placeholder="Enter your email">
    <div id="emailerror" style="display:none">Incorrect email</div><br>
    <input type=password name="password1" id="password"placeholder="Enter your password">
    <div id="passerror" style="display:none">Incorrect password</div><br>
    <button type="submit" class="button" value="submit">Login</button>
    </form>

    <script>
        function jscheck(){
        
        email=document.getElementById('email').value;
        password=document.getElementById('password').value;
        pass=1;
        if(email.trim()==''||email.length<4){
            erroremail=document.getElementById('emailerror');
            erroremail.style.display="block";
            pass=0;
        }else{
            erroremail=document.getElementById('emailerror');
            erroremail.style.display='none';
        }
        if(password.trim()==''||password.length<3){
            errorpass=document.getElementById('passerror');
            errorpass.style.display="block";
            pass=0;
        }else{
            errorpass=document.getElementById('passerror');
            errorpass.style.display='none';
        }
        if(pass==1){
            document.getElementById('loginform').submit();
        }
    }
    </script>

    <div id="hide" style="display: none;">
    	<?php
          if($_GET['error']==true){
          	echo "<script>alert('Invalid email or password'); </script>";
          }
          if($_GET['empty']==true){
          	echo "<script>alert('Some fields are still empty'); </script>";
          }
          
    	?>
    </div>

</body>
</html>

<?php
}
?>