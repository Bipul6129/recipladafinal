<?php
session_start();
include "check-login.php";
include "data_config.php";

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Search Page</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
 <div class="searchpage" style="position: absolute;width: 500px;margin-left: 400px; font-size: 20px;">

	<form method="post" action="searchalgorithm.php">
		<?php
		$sql="SELECT * from ingredient";
		$result=mysqli_query($conn,$sql);
		$sql1="SELECT * from ingredient";
		$result1=mysqli_query($conn,$sql1);

		echo "<h2>Include</h2>";
		while($row=mysqli_fetch_assoc($result)){
			?>
			<div class="check2" style="margin-top: 15px;">
			<input type="checkbox" class="check" name="ingredient[]" value="<?php echo $row['ingredient_name']?>"><?php echo $row['ingredient_name']?><br>
		
			
		</div> <br>
		
			<?php
		}
		?>
		<div style="position: absolute; left:500px; width:fit-content; top:0;">
		<?php
		echo "<h2>Exclude</h2>";
		while($row1=mysqli_fetch_assoc($result1)){
			if($row1['ingredient_name']!="all"){
			?>
			<div style="margin-top:15px;" >
			<input type="checkbox" class="check"  name="excludeingre[]" value="<?php echo $row1['ingredient_name']?>"><?php echo $row1['ingredient_name'] ?><br>
			</div> <br>
			<?php
			}
		}
		
		?>
		
	</div>
		<button name="search" class="search-button" style="width: 125px;
		  height: 50px;
		  border: none;
		  outline: none;
		  background: black;
		  opacity: 80%;
		  color: #fff;
		  font-size: 24px;
		  border-radius: 15px;
		  text-align: center;
		  box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.4);
		  position: absolute;
		  overflow: hidden;
		  cursor: pointer;
		  font-family: inherit;
		  stroke: 1px;">Search
		</button>

    </form>
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