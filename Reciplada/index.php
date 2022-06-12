

<!DOCTYPE html>
<html>
<head>
	<title>Reciplada</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
</head>
<body>
	<header class="main-header">
		<a href="#"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
<!-- 				<li><div><input type="text" class="search-bar" placeholder="Search..."></div></li>
 -->				<li><a href="sign-in.php"><div class="sign-in">Sign in</div></a></li>
				<li><a href="sign-up.php"><div class="sign-up">Sign up</div></a></li>
			</ul>
		</nav>
	</header>
	<section class="main-section">
		<div class="left">
			<div class="title">Taste the world</div>
			<div class="intro"><p>Reciplada helps you find all the dishes and food recipes based on your personal taste and ingredients.</p></div>
		</div>
		<div class="right">
			<div class="food-img">
				<img src="images/grid.png" height="425" width="425" onclick="">
			</div>
		</div>
	</section>

	<div id="hide" style="display: none;">
    	<?php
          if($_GET['notlogin']==true){
          	echo "<script>alert('You are not logged in'); </script>";
          }
		  if($_GET['logout']==true){
			echo "<script>alert('You are logged out'); </script>";
		  }
		  if($_GET['failedotp']==true){
			echo "<script>alert('Signup failed....OTP failed'); </script>";
		  }
		  if($_GET['verified']==true){
			echo "<script>alert('Account created successfully'); </script>";
		  }

          
    	?>
    </div>
</body>
</html>