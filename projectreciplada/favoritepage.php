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
  <script src="https://kit.fontawesome.com/f6dcf461c1.js" crossorigin="anonymous"></script>
</head>
<body style="overflow-x: hidden;">
<div class="wrapper">
 <header class="main-header">
    <a href="homepage.php"><div class="brand-logo"></div></a>
    <nav class="main-nav">
      <ul>
        <li><div><input id="searchbar"type="text" class="search-bar" placeholder="Search..." onkeypress="clickpress(event)"></div></li>
        <li><a href="sign-in.html"><div class="sign-in">Profile</div></a>
          <ul>
            <li class="nest"><a href="favoritepage.php">Favorites</a></li>
            <li class="nest"> <a href="logoutprocess.php">Log out</a> </li>
            
          </ul>
        </li>
        <li><a href="searchpage.php"><div class="advance-search" style="margin-top:20px">Advance search</div></a></li>

        
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

                  <form method="post" action="removefavorite(process).php?recipeid=<?php echo($row['recipe_id'])?>">
                   <button onclick="toggle()" id="removefavorite" class="removefavorite" value="add" name="add"><i class="fas fa-heart"></i></button>
                  </form>
                
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($row['recipe_id'])?>">
                 <button class="details" name="viewrecipe">Details</button>
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
          	// echo "<script>alert('You are already logged in'); </script>";
          }
          if($_GET['removed']==true){
            // echo "<script>alert('Removed from favorite'); </script>";
        }
       
          
          
    	?>
    </div>

<script>
       var favorite = document.getElementById('removefavorite');
         function toggle(){
                if (favorite.style.color =="grey") {
                    favorite.style.color = "#ff3252"
                }
                else{
                   favorite.style.color = "grey"
                }
       }

</script>
</body>
</html>