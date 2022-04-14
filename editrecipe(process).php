<?php
session_start();
include "check-login.php";
include "data_config.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}

if($_POST){
    $r_id=$_GET['id'];
    $r_name=$_POST['recipe_name'];
    $r_time=$_POST['recipe_time'];
    $r_description=$_POST['recipe_description'];
    $r_direction=$_POST['recipe_direction'];
    $r_keywords=$_POST['recipe_keywords'];


    $image= $_FILES['image']['tmp_name'];
    $imagesize=$_FILES['image']['size'];
    $imagetype=$_FILES['image']['type'];
    $image=base64_encode(file_get_contents(addslashes($image)));
    echo $imagesize;
    echo $imagetype;

    if($imagetype!='image/jpeg'){
        header('location:editecipe(value).php?imagebig/type=true');
    }else{

    if($imagesize>800000){
        header('location:editrecipe(value).php?imagebig/type=true');
    }else{
        
    
    if(empty($r_name)||empty($r_time)||empty($r_description)||empty($r_direction)||empty($r_keywords)){
        header('location:editrecipe(value).php?emptyfield=true');
    }else{
        $sql="UPDATE `recipe` SET `recipe_name`='$r_name',`recipe_time`='$r_time',`recipe_description`='$r_description',`recipe_direction`='$r_direction',`search_keywords`='$r_keywords',`recipe_image`='$image' WHERE recipe_id=$r_id";
        $result=mysqli_query($conn,$sql);
        if($result==true){
            header('location:editrecipe.php?createsuccess=true');
        }
        

    
    }
         }
    }
}else{
    header('location:editrecipe.php?nopostrequest=true');
    
}


?>