
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
				<li><div><input id="searchbar"type="text" class="search-bar" placeholder="Search..." onkeypress="clickpress(event)"></div></li>
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
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($row['recipe_id'])?>">
               <button class="buttons"  style="position: relative; margin-right: 3.5px;" name="viewrecipe">Details</button>
               </form>
               <form method="post" action="addfavorite(process).php?recipeid=<?php echo($row['recipe_id'])?>">
               <button class="buttons" name="add"  style="position: relative;margin-left: 3.5px;" value="add">Add to favourite</button>
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

<div id="hide" style="display: none;">
    	<?php
          if($_GET['alreadylogin']==true){
          	echo "<script>alert('You are already logged in'); </script>";
          }
          if($_GET['welcome']==true){
            echo "<script>alert('WELCOME YOU are logged in'); </script>";
        }
        if($_GET['notadmin']==true){
            echo "<script>alert('You are not an admin'); </script>";
        }
        if($_GET['added']==true){
            echo "<script>alert('You have added favorite successfully'); </script>";
        }
        if($_GET['notadded']==true){
            echo "<script>alert('Failed to added favorite recipe'); </script>";
        }
        
          
          
    	?>
    </div>

    <script>
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


</body>
</html>