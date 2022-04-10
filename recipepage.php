<?php
session_start();
include "data_config.php";?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>RECIPEPAGE</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
</head>
<body>
<header class="main-header">
		<a href="homepage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><div><input type="text" class="search-bar" placeholder="Search..."></div></li>
				<li><a href="sign-in.html"><div class="sign-in">Profile</div></a></li>
                <li><a href="searchpage.php"><div class="sign-in" style="margin-top:20px">ADVANCE SEARCH</div></a></li>

				<li><div class="sign-up">
                    <form action="logoutprocess.php" method="post">
                    <button name="logout">Log out</button>
                    </form>
                </div></li>
				
			</ul>
		</nav>
</header>

<?php
if(isset($_POST)){
	$id=$_GET['id'];
	$recsql="select * from recipe where recipe_id=$id";
	$res=mysqli_query($conn,$recsql);
	while($row=mysqli_fetch_assoc($res)){
		echo '<img src="data:image/jpeg;base64,'.( $row['recipe_image'] ).'"style="position:relative;width:390px;height:300px"/>';
		echo "<br><h1>".$row['recipe_name']."</h1><br>";
		echo $row['recipe_description']."<br><br>";
		echo $row['recipe_direction'];
	}
}



?>

</body>
</html>