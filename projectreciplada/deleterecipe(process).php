<?php
session_start();
include "check-login.php";
include "data_config.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}


$r_name=$_GET['name'];
echo $r_name;

$sql1="select * from recipe where recipe_name='$r_name'";
$result1=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result1);
$r_id=$row['recipe_id'];

$sql2="DELETE FROM user_recipe where recipe_id='$r_id'";
$result2=mysqli_query($conn,$sql2);



$sql3="DELETE FROM recipe where recipe_name='$r_name'";
$result3=mysqli_query($conn,$sql3);

header('location:editrecipe.php?deleted=true');






?>