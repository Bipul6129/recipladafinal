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
    <title>Add Ingredients</title>
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
        #i_name{
            border: 1px solid white ;
            border-radius: 5px;
            background-color:  #0000009c;
            resize: none;
            outline: none;
            left:85px;
            position: relative;
            height: 30px;
            width: 400px;
            color: white;
            font-family: inherit;
            transition: transform 0.5s;

        }
        #i_name:hover,#i_name:focus{
            transform: scale(1.05);
        }
        #btn-add{
            resize: none;
            outline: none;
            background-color:  #0000009c;
            border: 1px solid white ;
            border-radius: 5px;
            color: white;
            padding: 5px;
            width: 50%;
            height: 5%;
            margin-left:23px;
            transition: transform 0.25s;
        }
        #btn-add:hover{
            transform: scale(1.05);
        }
        #btn-delete{
            resize: none;
            outline: none;
            background-color:  #0000009c;
            border: 1px solid white ;
            border-radius: 5px;
            color: white;
            padding:5px;
            transition: transform 0.25s;
        }
        #btn-delete:hover{
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
    <table style=" position: relative; left: 380px; top: 65px; background: #00000061;backdrop-filter: blur(4px);" border="1" width="700px">

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
                       <button style="font-size:12px;height:5%;width:50%" id="btn-delete" name="delete_ingredient">Delete</button>
                    </form>
                </th>
            
            </tr>
            
            <?php
        }
        
        ?>
    
<tr>
    <form id="add_ingredient" onsubmit="event.preventDefault();jscheck()" method="post" action="add_ingredient(process).php" >
        <td><input type="text" id="i_name" name="ingredient_add"></td>
        <td><button type="submit" value="submit" id="btn-add">Add</button></td>
    </form>
    <tr>
</table>
<footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
</footer>
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