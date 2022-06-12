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
	<div>
		<form id="signupform" onsubmit="event.preventDefault();jscheck()" method="post" action="signup_process.php">
          <div id="form-top">
	         	<div class="form-input"> 
         		<label class="input-head">Full name</label><br/>
	            	<input type="text" name="fullname1" id="fullname" placeholder="Enter your full name" class="input" />
					<div id=errorname style="display:none">Enter full name corectly</div>
	 			</div>         	
	            <div class="form-input">  
              	<label class="input-head">Email</label><br/>
	           		<input type="text"name="email1" id="email" placeholder="Enter your email address" class="input" />
					<div id=erroremail style="display:none">Enter email correctly</div>
				</div>
			</div>         
          <div id="form-bot"> 
             	<div class="form-input">
              	<label class="input-head">Password</label><br/>           
	              <input type="Password" name="password1" id="password" placeholder="Enter your password" class="input" />
				  <div id=errorpassword style="display:none">Enter password more than 8 length</div>
	        	</div>
	        	<div class="form-input">
	        	<label class="input-head">Confirm Password</label><br/>
	              <input type="password" name="confirmpass1" id="confirm_password" placeholder="Confirm Password" class="input" />
				  <div id=errorconfirm style="display:none">Password doesn't match</div>
	  			</div>
  		</div>
  		<br/>
  		<div id="register">
              <button "type="submit" class="button">Register</button>
			  
		</div>
		</form>
	</div>
	 <script type="text/javascript">
    	

       function jscheck(){
       	pass=1;
       	fullname=document.getElementById('fullname').value;
    	email=document.getElementById('email').value;
    	password=document.getElementById('password').value;
    	confirm_password=document.getElementById('confirm_password').value;

       	if(fullname.trim()==''||fullname.length<4){
       		
			errorname=document.getElementById('errorname');
            errorname.style.display='block';
       		pass=0;
       	}else{
			errorname=document.getElementById('errorname');
            errorname.style.display='none';
		}
		   
		if(email==''){
			erroremail=document.getElementById('erroremail');
            erroremail.style.display='block';
       		pass=0;
       	}else{
			errorname=document.getElementById('erroremail');
            errorname.style.display='none';
		} 
		if(password.length<3){
       		
			errorpassword=document.getElementById('errorpassword');
            errorpassword.style.display='block';
       		pass=0;
       	}else{
			errorname=document.getElementById('errorpassword');
            errorname.style.display='none';
		}
		if(confirm_password!=password){
       		
			errorconfirm=document.getElementById('errorconfirm');
            errorconfirm.style.display='block';
       		pass=0;
       	}else{
			errorname=document.getElementById('errorconfirm');
            errorname.style.display='none';
		}
		 if(pass==1){
       		
			   document.getElementById('signupform').submit();
       	}
       };

    </script>

    <div id="hide" style="display: none;">
    	<?php
          if($_GET['signupsuccess']==true){
          	echo "<script>alert('Successfully registered'); </script>";
          }
          if($_GET['empty']==true){
          	echo "<script>alert('Some fields are still empty'); </script>";
          }
		  if($_GET['same_email']==true){
			echo "<script>alert('Email already exists'); </script>";
		}
          
    	?>
    </div>

</body>
</html>