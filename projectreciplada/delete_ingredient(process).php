<?php
session_start();
include "data_config.php";
include "check-login.php";

if($_POST){
    $ing_name=$_GET['name'];
    echo $ing_name;
    $sql="DELETE FROM `ingredient` WHERE  ingredient_name='$ing_name'";
    $result=mysqli_query($conn,$sql);
    if($result==true){
        header('location:add_ingredient.php?deleted=true');
    }else{
        header('location:add_ingredient.php?notdeleted=true');
    }

}else{
    header('location:index.php?nopostrequest');
}


?>