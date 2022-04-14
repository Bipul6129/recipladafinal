<?php
session_start();
include "check-login.php";
include "data_config.php";

echo $_SESSION['user_id']."<br>";
$sessionid=$_SESSION['user_id'];
$sql="SELECT recipe_name from user_recipe join recipe on user_recipe.recipe_id=recipe.recipe_id where user_id='$sessionid'";

$result=mysqli_query($conn,$sql);




?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home page</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
</head>
<body style="overflow-x: hidden;">
<div class="wrapper">
    <header class="main-header">
		<a href="homepage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><div><input type="text" class="search-bar" placeholder="Search..."></div></li>
				<li><a href="sign-in.html"><div class="sign-in">Profile</div></a></li>
                <li><a href="searchpage.php"><div class="sign-in" style="margin-top:20px">ADVANCE SEARCH</div></a></li>

				<li><div class="sign-up">
                    <a href="favoritepage.php">FAVORITEPAGE</a>
                    <form action="logoutprocess.php" method="post">
                    <button name="logout">Log out</button>
                    </form>
                </div></li>
				
			</ul>
		</nav>
	</header>
    <div class="cardcontainer">
    <?php
    while($row1=mysqli_fetch_assoc($result)){
        
        $recipe_name=$row1['recipe_name'];
        $sql2="SELECT * from recipe where recipe_name='$recipe_name'";
        $result2=mysqli_query($conn,$sql2);
        $row=mysqli_fetch_assoc($result2);
    ?>
     <div class="cards">
           	   <!--IMAGES -->
                <div class="recipe_image">
                	<?php
               	
                    echo '<img src="data:image/jpeg;base64,'.( $row['recipe_image'] ).'"style="height:290px;width:100%;"/>';
            
               	?>
                </div>

               <!-- HEADINGS -->
               <div class="card_heading">
               	<?php echo ($row['recipe_name'])." /";?>
               	<?php echo ($row['recipe_time']);?>
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($row['recipe_id'])?>">
               <button class="buttons"  style="position: relative; margin-right: 3.5px;" name="viewrecipe">Details</button>
               </form>
               <form method="post" action="removefavorite(process).php?recipeid=<?php echo($row['recipe_id'])?>">
               <button class="buttons" name="remove"  style="position: relative;margin-left: 3.5px;" value="add">Remove favorite</button>
               </form>
               </div>


            </div>   
       <?php
        
        }
       ?>  

    </div>
</div>
<div id="hide" style="display: none;">
    	<?php
          if($_GET['alreadylogin']==true){
          	echo "<script>alert('You are already logged in'); </script>";
          }
          if($_GET['removed']==true){
            echo "<script>alert('Removed from favorite'); </script>";
        }
       
          
          
    	?>
    </div>


</body>
</html>