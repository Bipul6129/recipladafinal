<?php
session_start();
include "check-login.php";
include "data_config.php";

if(isset($_POST)){
    $rec_id=$_GET['recipeid'];
    echo $rec_id."<br>";
    $user_id = $_SESSION['user_id'];
    echo $_SESSION['user_id'];

    $sqlcheck="SELECT recipe_id from user_recipe where recipe_id='$rec_id' and user_id='$user_id'";
    $result2=mysqli_query($conn,$sqlcheck);
    $getrow=mysqli_fetch_assoc($result2);

    if($getrow['recipe_id']==$rec_id){
        header('location:homepage.php?notadded=true');
    }else{
    $sql="INSERT INTO `user_recipe`(`user_id`, `recipe_id`) VALUES ('$user_id','$rec_id')";
    $result=mysqli_query($conn,$sql);
    if($result==true){
        header('location:homepage.php?added=true');
    }else{
        header('location:homepage.php?notadded=tue');
    }
    }

}



?>