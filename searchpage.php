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
</head>
<body>
	
	
	<!-- <form method="post" action="searchalgorithm.php">
	<input type="checkbox" name="ingredient[]" value="apple">apple<br>
	<input type="checkbox" name="ingredient[]" value="salt">salt<br>
	<input type="checkbox" name="ingredient[]" value="flour">flour<br>
	<input type="checkbox" name="ingredient[]" value="milk">milk<br>
	<input type="checkbox" name="ingredient[]" value="banana">banana<br>
	<input type="checkbox" name="ingredient[]" value="all">all<br>
	exclude<br>
	<input type="checkbox" name="excludeingre[]" value="apple">apple<br>
	<input type="checkbox" name="excludeingre[]" value="salt">salt<br>
	<input type="checkbox" name="excludeingre[]" value="flour">flour<br>
	<input type="checkbox" name="excludeingre[]" value="milk">milk<br>
	<input type="checkbox" name="excludeingre[]" value="banana">banana<br>

	
	<button name='search'>SEARCH</button>
    </form> -->

	<form method="post" action="searchalgorithm.php">
		<?php
		$sql="SELECT * from ingredient";
		$result=mysqli_query($conn,$sql);
		$sql1="SELECT * from ingredient";
		$result1=mysqli_query($conn,$sql1);
		while($row=mysqli_fetch_assoc($result)){
			?>
			<input type="checkbox" name="ingredient[]" value="<?php echo $row['ingredient_name']?>"><?php echo $row['ingredient_name'] ?><br>
			
			<?php
		}
		echo "exclude<br>";
		while($row1=mysqli_fetch_assoc($result1)){
			if($row1['ingredient_name']!="all"){
			?>

			<input type="checkbox" name="excludeingre[]" value="<?php echo $row1['ingredient_name']?>"><?php echo $row1['ingredient_name'] ?><br>
			
			<?php
			}
		}
		
		?>

		<button name='search'>SEARCH</button>

    </form>


</body>
</html>