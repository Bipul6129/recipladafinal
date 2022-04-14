<?php
session_start();
include "check-login.php";
include "data_config.php";
$user_id=$_SESSION['user_id'];

if(isset($_POST)){
$recipe_id=$_GET['recipeid'];
echo $recipe_id;
$sql="DELETE FROM `user_recipe` WHERE recipe_id='$recipe_id' and user_id='$user_id'";
$result=mysqli_query($conn,$sql);
if($result=true){
    header('location:favoritepage.php?removed=true');
}else{
    echo "failed to retrieve data";
}
}




?>