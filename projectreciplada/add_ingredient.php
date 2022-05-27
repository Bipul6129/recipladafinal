<?php
session_start();
include "check-login.php";
include "data_config.php";
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
				<li><a href="sign-in.html"><div class="sign-in">Profile</div></a></li>
				<li><div class="sign-up">
                    <form action="logoutprocess.php" method="post">
                    <button name="logout">Log out</button>
                    </form>
                </div></li>
				
			</ul>
		</nav>
    </header>
    <table>
        <tr><th>Ingredient name</th>
            <th>Options</th>
        </tr>
        <?php
        $sql="SELECT * from ingredient";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <th><?php echo $row['ingredient_name']?></th>
                <th>
                    <form action="delete_ingredient(process).php?name=<?php echo $row['ingredient_name']?>" method="post" >
                       <button style="font-size:12px;height:5%;width:50%"name="delete_ingredient">Delete</button>
                    </form>
                </th>
            
            </tr>
            
            <?php
        }
        
        ?>
    </table>

    <form id="add_ingredient" onsubmit="event.preventDefault();jscheck()" method="post" action="add_ingredient(process).php" >
        <input type="text" id="i_name" name="ingredient_add">Ingredient add<br>
        <button type="submit" value="submit">ADD</button>
    </form>
    <script>
        function jscheck(){
            ingredient=document.getElementById('i_name').value;
            pass=1;
            if(ingredient.trim()==''||ingredient.length<3){
                alert('Enter atleast 3 characters');
                pass=0;
            }
            if(pass==1){
                document.getElementById('add_ingredient').submit();
            }

        }
    </script>





    <div id="hide" style="display: none;">
    	<?php
          if($_GET['deleted']==true){
          	echo "<script>alert('Ingredient deleted successfully'); </script>";
          }
		  if($_GET['notdeleted']==true){
			echo "<script>alert('Ingredient failed to delete'); </script>";
		  }
          if($_GET['added']==true){
			echo "<script>alert('Ingredient added successfully'); </script>";
		  }
          if($_GET['notadded']==true){
			echo "<script>alert('Ingredient failed to be added'); </script>";
		  }

          
    	?>
    </div>
    
</body>
</html>