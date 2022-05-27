<?php
session_start();
include "data_config.php";
include "check-login.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}
$recipe_name=$_GET['name'];
$sql2="SELECT * from recipe where recipe_name='$recipe_name'";
$result2=mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result2);
$r_id=$row['recipe_id'];

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
    <form id="createform" onsubmit="event.preventDefault();jscheck();" method="post" action="editrecipe(process).php?id=<?php echo $r_id?>" enctype="multipart/form-data">
    <table>
    <tr>
        <th>Recipe name: </th>
        <th><input type="text" id="r_name"name="recipe_name" placeholder="Enter recipe name" value="<?php echo $row['recipe_name']?>"></th>
    </tr>
    <tr>
        <th>Recipe time: </th>
        <th><input type="text" id="r_time"name="recipe_time" placeholder="" value="<?php echo $row['recipe_time']?>"></th>
    </tr>
    <tr>
        <th>Recipe description: </th>
        <th><input type="text" id="r_description" name="recipe_description" placeholder="" value="<?php echo $row['recipe_description']?>"></th>
    </tr>
    <tr>
        <th>Recipe direction: </th>
        <th><input type="text" id="r_direction" name="recipe_direction" placeholder="" value="<?php echo $row['recipe_direction']?>"></th>
    </tr>
    <tr>
        <th>Recipe search keywords: </th>
        <th><input type="text" id="r_keywords" name="recipe_keywords" placeholder="" value="<?php echo $row['search_keywords']?>"></th>
    </tr>
    <tr>
        <th><button type="submit" value="submit">SAVE</button></th>
        <th>image:<input type="file" name="image"></th>
    </tr> 
    
    </table>
    </form>

    <script>
        function jscheck(){
            
            r_name=document.getElementById('r_name').value;
            r_time=document.getElementById('r_time').value;
            r_description=document.getElementById('r_description').value;
            r_direction=document.getElementById('r_direction').value;
            r_keywords=document.getElementById('r_keywords').value;
            pass=1;
            if(r_name.trim()==''||r_name.length<3){
                alert('Enter recipe name correctly');
                pass=0;
            }
            if(r_time.trim()==''){
                alert('missing time');
                pass=0;
            }
            if(r_time.length>10){
                alert('Enter less than 10 characters');
                pass=0;
            }
            if(r_description.trim()=='' || r_description.length<15){
                alert('Enter descripion of atleast 15 characters');
                pass=0;
            }
            if(r_description.length>500){
                alert('More than 500 characters not allowed on recipe description');
                pass=0;
            }
            if(r_direction.trim()==''||r_direction.length<10){
                alert('Enter recipe direction of atleast 10 characters');
                pass=0;
            }
            if(r_direction.length>1500){
                alert('No more than 1500 characters alowed on recipe direction');
                pass=0;
            }
            if(r_keywords.trim()==''||r_keywords.length<3){
                alert('Enter atleast 3 character of search keyword');
                pass=0;
            }
            if(r_keywords.length>800){
                alert('No more than 800 characters allowed in search keywords');
                pass=0;
            }
            if(pass==1){
                document.getElementById('createform').submit();
            }

        }
    </script>
    <div id="hide" style="display: none;">
    	<?php
          if($_GET['nopostrequest']==true){
          	echo "<script>alert('There was no post request'); </script>";
          }
          if($_GET['imagebig/type']==true){
            echo "<script>alert('Image size is too big or it is not an image'); </script>";
          
          }
          if($_GET['createsuccess']==true){
            echo "<script>alert('Successfully added'); </script>";
          }
          
          
    	?>
    </div>




    </body>
</html>