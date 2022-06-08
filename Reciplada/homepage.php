
<?php
session_start();
include "data_config.php";
include "check-login.php";?>
<div id="hide" style="display: none;">
<?php
if($_GET['searchbar']==true){
    $keyword=$_GET['searchbar'];
    echo $keyword;
    $query="SELECT * from recipe where search_keywords like '%$keyword%'or recipe_name like '%$keyword%' or recipe_time='$keyword'";
    $result=mysqli_query($conn,$query);
    
  


}else{
$query="SELECT * from recipe ";
$result=mysqli_query($conn,$query);
}

?>
</div>

    <div id="hide" style="display: none;">
      <?php
          if($_GET['alreadylogin']==true){
            echo "<script>alert('You are already logged in'); </script>";
          }
          if($_GET['welcome']==true){
            // echo "<script>alert('You are logged in'); </script>";
        }
        if($_GET['notadmin']==true){
            echo "<script>alert('You are not an admin'); </script>";
        }
        if($_GET['added']==true){
            echo "<script>alert('Added to favorites'); </script>";
        }
        if($_GET['notadded']==true){
            echo "<script>alert('Recipe is already on favorite'); </script>";
        }
        
          
          
      ?>
    </div>
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
		<nav class="main-nav">
			<ul>
				<li><div><input id="searchbar"type="text" class="search-bar" placeholder="Search..." onkeypress="clickpress(event)"></div></li>
				<li><a href="profile.php"><div class="sign-in">Profile</div></a>
          <ul>
            <li class="nest"><a href="favoritepage.php">Favorites</a></li>
    				<li class="nest"> <a href="logoutprocess.php">Log out</a> </li>
            
          </ul>
        </li>
        <li><a href="searchpage.php"><div class="advance-search" style="margin-top:20px">Advanced search</div></a></li>

				
			</ul>
		</nav>
	</header>

    <div class="cardcontainer">
      <h1 style="font-style: inherit; text-align: center; font-weight: normal;">Recipes</h1>
       <?php
       $count=0;

       while($row=mysqli_fetch_assoc($result)){
           $count=1;
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

                  <form method="post" action="addfavorite(process).php?recipeid=<?php echo($row['recipe_id'])?>">
                  <button onclick="toggle()" id="favorite" class="favorite" value="add" name="add"><i class="fas fa-heart"></i></button>
               </form>
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($row['recipe_id'])?>">
                 <button class="details" name="viewrecipe" style="height: 50px;">Details</button>
               </form>
               </div>
          </div>   
       <?php
        }
        if($count==0){
            echo "nothing found";
        }
       ?>  

    </div>
</div>

    <script>
      var favorite = document.getElementById('favorite');
         function toggle(){
                if (favorite.style.color =="#ff3252") {
                    favorite.style.color = "grey"
                }
                else{
                   favorite.style.color = "#ff3252"
                }
       }

        function clickpress(event) {
    if (event.keyCode == 13) {
        vari=document.getElementById('searchbar').value;
        if(vari.length<3){
            alert('type more than 3 length of characters');
        }else{

        window.location.replace("homepage.php?searchbar="+vari);
        }
    }
}

    </script>
<footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
</footer>

</body>
</html>