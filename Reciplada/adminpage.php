<?php
session_start();
include "check-login.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}

?>

<html>
    <head>
    <title>Home</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
  <style type="text/css">
    .option{
      color: white;
      font-size: 24px;
      font-weight: 100;
      transition: transform 0.25s;
    }
    .option:hover{
      transform: scale(1.05);
    }
  </style>
    </head>
    <body>
    <header class="main-header">
		<a href="adminpage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><a href=""><div class="sign-in">Profile</div></a></li>
				<li><a href="logoutprocess.php"><div class="sign-up">Log out</div></a></li>
				
			</ul>
		</nav>
    </header>

    <div style="left: 555px; top: 175px; text-align: center; position: absolute; width: 390px; height: 300px; backdrop-filter: blur(1.5px);border-radius: 10px; background-color: #00000042;">
    
        <?php echo "<h1 style='font-weight: 100;'>Welcome ".$_SESSION['user_name']."</h1>" ?>
        <hr><br>
        <a class="option" href="create_recipe.php">Create Recipe</a><br><br>
        <a class="option" href="show_users.php" >Show users</a><br><br>
        <a class="option" href="editrecipe.php">Edit Recipe</a><br><br>
        <a class="option" href="add_ingredient.php">Add ingredient</a>

    </div>

    <div id="hide" style="display: none;">
    	<?php
          // if($_GET['welcome']==true){
          // 	echo "<script>alert('Welcome ".$_SESSION['user_name']."'); </script>";
          // }
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