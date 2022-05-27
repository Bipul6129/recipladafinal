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
        <tr>
            <th>s.no</th>
            <th>Recipe name</th>
            <th>buttons</th>
        </th>
        <?php
        $sql="SELECT * from recipe";
        $result=mysqli_query($conn,$sql);
        $count=0;
        while($row=mysqli_fetch_assoc($result)){
        $count++;
        ?>
        <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $row['recipe_name'];?></td>
            <td>
                <a href="deleterecipe(process).php?name=<?php echo $row['recipe_name']?>">Delete</a>
                <a href="editrecipe(value).php?name=<?php echo $row['recipe_name']?>">Edit</a>
        
            </td>
            
        </tr>
        <?php

        }
        ?>
        </table>


        <div id="hide" style="display: none;">
    	<?php
          if($_GET['deleted']==true){
          	echo "<script>alert('Recipe deleted successfully'); </script>";
          }
          if($_GET['createsuccess']==true){
            echo "<script>alert('Recipe edited successfully'); </script>";
        }
          ?>
        </div>

</body>
</html>