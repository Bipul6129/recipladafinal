<?php
session_start();
include "data_config.php";?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Details</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
</head>
<body>
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
	<div class="divine" style="backdrop-filter:blur(4px);">

		<?php
		if(isset($_POST)){
			$id=$_GET['id'];
			$recsql="select * from recipe where recipe_id=$id";
			$res=mysqli_query($conn,$recsql);
			while($row=mysqli_fetch_assoc($res)){
				echo "<br><h1>".'<p style="position: relative; text-align: center;">'.$row['recipe_name']."</p></h1><br>";
				echo '<img src="data:image/jpeg;base64,'.( $row['recipe_image'] ).'" align="middle" style="position: relative; display: block; margin-left: auto; margin-right: auto; width: 50%; border-radius: 10px;"/>';
				
				echo '<p style="position: relative; text-align: center; margin-left:80px; margin-right:80px; line-height:50px; margin-top:30px;">'.$row['recipe_description']."</p><br>";
				echo '<p style="position: relative; text-align: left; margin-left:80px; margin-right:80px; line-height:50px; margin-block-end:40px;">'.$row['recipe_direction']."</p>";
			}

		}



		?>
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
</body>
</html>