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
    <header class="main-header">
        <a href="index.php"><div class="brand-logo"></div></a>
        <nav class="main-nav">
            <ul>
                <li><a href="sign-up.php"><div class="sign-up">Sign up</div></a></li>
                <li><a href="sign-in.php"><div class="sign-in">Sign in</div></a></li>
            </ul>
        </nav>
    </header>

    <form id="loginform" onsubmit="event.preventDefault();jscheck();" method="post" action="login_process.php">
        <div class="log-in">
        <label class="input-head">Email</label><br>
        <input type=email id="email" name="email1" class="input" placeholder="Enter your email"><br>
        <div id="emailerror" style="display:none">Incorrect email</div><br>
        <label class="input-head">Password</label><br>
        <input type=password name="password1" class="input" id="password"placeholder="Enter your password">
        <div id="passerror" style="display:none">Incorrect password</div><br><br>
        <button type="submit" class="button" id="login" value="submit">Login</button>
    </div>
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