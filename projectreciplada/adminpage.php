<?php
session_start();
include "check-login.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}

?>

<html>
    <head>
    <title>RECIPEPAGE</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
    </head>
    <body>
    <header class="main-header">
		<a href="adminpage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><a href=""><div class="sign-in">Profile</div></a></li>
				<li><a href="logoutprocess.php"><div class="sign-up">Log out</div></li>
				
			</ul>
		</nav>
    </header>

    <div style="">
        <?php echo "<h1>Welcome ".$_SESSION['user_name']."</h1>" ?>
        <a href="create_recipe.php" style="color:white">Create Recipe</a></br>
        <a href="show_users.php" style="color:white">Show users</a></br>
        <a href="editrecipe.php" style="color:white">Edit Recipe</a></br>
        <a href="add_ingredient.php" style="color:white">Add ingredient</a></br>

    </div>

    <div id="hide" style="display: none;">
    	<?php
          if($_GET['welcome']==true){
          	echo "<script>alert('Welcome admin ".$_SESSION['user_name']."'); </script>";
          }
          if($_GET['imagebig/type']==true){
            echo "<script>alert('Image size is too big or it is not an image'); </script>";
          
          }
          if($_GET['createsuccess']==true){
            echo "<script>alert('Successfully added'); </script>";
          }
          if($_GET['alreadylogin']==true){
            echo "<script>alert('You are already logged in'); </script>";
          }
          
          
    	?>
    </div>



    </body>
</html>