<?php
session_start();
include "check-login.php";
include "data_config.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}

if($_POST){
    $i_name=$_POST['ingredient_add'];
    echo $i_name;
    $sql="INSERT INTO `ingredient`(`ingredient_id`, `ingredient_name`) VALUES ('NULL','$i_name')";
    $result=mysqli_query($conn,$sql);
    if($result==true){
        header('location:add_ingredient.php?added=true');
    }else{
        header('location:add_ingredient.php?notadded=true');
    }
}


?>