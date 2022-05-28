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
    <title>Edit Recipe</title>
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

        <tr>
            <th style="text-align: center;">S.No</th>
            <th style="text-align: center;">Recipe Name</th>
            <th style="text-align: center;" colspan="2">Options</th>
        </th>
        <?php
        $sql="SELECT * from recipe";
        $result=mysqli_query($conn,$sql);
        $count=0;
        while($row=mysqli_fetch_assoc($result)){
        $count++;
        ?>
        <tr>
            <td style="text-align: center; padding: 5px; padding-left: 10px;"><?php echo $count;?></td>
            <td style="text-align: center;"><?php echo $row['recipe_name'];?></td>
            <td style="text-align: center;">
                <a href="deleterecipe(process).php?name=<?php echo $row['recipe_name']?>">Delete</a>
        
            </td>
            <td style="text-align: center;">
                 <a href="editrecipe(value).php?name=<?php echo $row['recipe_name']?>">Edit</a>
            </td>
            
        </tr>
        <?php

        }
        ?>
        </table>
        <footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
    </footer>


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