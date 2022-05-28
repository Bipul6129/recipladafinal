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
    <title>Edit</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
     <style>
        table,th,td{
                border: 1px solid white;
                border-collapse: collapse;
            }
        th,td{
            padding: 10px;
            font-weight: 1;
        }
        tr:nth-child(even) {
          background-color: #0000009c;
        }
        #btn-submit{
            resize: none;
            outline: none;
            background-color:  #0000009c;
            border: 1px solid white ;
            border-radius: 10px;
            color: white;
            padding: 5px;
            width: 20%;
            height: 35px;
            transition: transform 0.25s;
        }
        #btn-submit:hover{
            transform: scale(1.05);
            }   
        .i-name{
            border: 1px solid white ;
            border-radius: 5px;
            background-color:transparent;
            resize: none;
            outline: none;
            position: relative;
            height:50px;
            width: 400px;
            color: white;
            font-family: inherit;
            transition: transform 0.5s;

        }
        .i-name::placeholder{
            color: #c5c5c5;
        }
        .i-name:hover,.i-name:focus{
            transform: scale(1.05);
        }     
    </style>
    </head>
    <body>
    <header class="main-header">
        <a href="adminpage.php"><div class="brand-logo"></div></a>
        <nav class="main-nav">
            <ul>
                <li><a href=""><div class="sign-in">Profile</div></a></li>
                <li><a href="logoutprocess.php"><div class="sign-up">Log out</div></a></li>
                
            </ul>
        </nav>
    </header>   
    <form id="createform" onsubmit="event.preventDefault();jscheck();" method="post" action="editrecipe(process).php?id=<?php echo $r_id?>" enctype="multipart/form-data">
    <table style=" position: relative; left: 380px; top: 65px; background: #00000061;backdrop-filter: blur(4px);" border="1" width="700px">

    <tr>
        <th>Recipe name: </th>
        <th><input type="text" class="i-name" id="r_name"name="recipe_name" placeholder="Enter recipe name" value="<?php echo $row['recipe_name']?>"></th>
    </tr>
    <tr>
        <th>Recipe time: </th>
        <th><input type="text" class="i-name" id="r_time"name="recipe_time" placeholder="" value="<?php echo $row['recipe_time']?>"></th>
    </tr>
    <tr>
        <th>Recipe description: </th>
        <th><textarea type="text" class="i-name" id="r_description" name="recipe_description" placeholder="" style="height: 100px;"value="<?php echo $row['recipe_description']?>"></textarea></th>
    </tr>
    <tr>
        <th>Recipe direction: </th>
        <th><textarea type="text" class="i-name" id="r_direction" name="recipe_direction" placeholder="" style="height: 250px;" value="<?php echo $row['recipe_direction']?>"></textarea></th>
    </tr>
    <tr>
        <th>Recipe search keywords: </th>
        <th><textarea type="text" class="i-name" id="r_keywords" name="recipe_keywords" placeholder="" value="<?php echo $row['search_keywords']?>">
        </textarea></th>
    </tr>
    <tr>
        <th>Image:</th>
        <th><input type="file" name="image"></th>
    </tr> 
    <tr>
        <th colspan="2"><button id="btn-submit" type="submit" value="submit">Save</button></th>
    </tr>
    
    </table>
    </form>
    <footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
</footer>

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