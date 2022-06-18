<?php
session_start();
include "check-login.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
  <script src="https://kit.fontawesome.com/f6dcf461c1.js" crossorigin="anonymous"></script>
</head>
<body style="overflow-x: hidden;">
<div class="wrapper">
    <header class="main-header">
		<a href="homepage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><div><input id="searchbar"type="text" class="search-bar" placeholder="Search..." onkeypress="clickpress(event)"></div></li>
				<li><a href="profile.php"><div class="sign-in">Profile</div></a>
          <ul>
            <li class="nest"><a href="favoritepage.php">Favorites</a></li>
    				<li class="nest"> <a href="logoutprocess.php">Log out</a> </li>
            
          </ul>
        </li>
        <li><a href="searchpage.php"><div class="advance-search" style="margin-top:20px">Advanced search</div></a></li>

				
			</ul>
		</nav>
	</header>




     


<?php
include "data_config.php";




 if(isset($_POST['search'])){
    
    if(!empty($_POST['ingredient'])){
    $ingredient_test=$_POST['ingredient'];
    if(!empty($_POST['excludeingre'])){
    $excludeingre_test=$_POST['excludeingre'];
    foreach($ingredient_test as $value_inc){
        foreach($excludeingre_test as $value_exc){
            if($value_inc==$value_exc){
                // echo "<script>alert('".$value_exc." selected on include and exclude')</script>";
                header('location:searchpage.php?samevalue='.$value_inc);
            }

        }

    }
    }
    }

    //IF INGREDIENT ARE SELECTED CHECKBOX//
 	if(!empty($_POST['ingredient'])){
 	$ingredient=$_POST['ingredient'];
	$icount=count($ingredient);
 	

    ////////EXCLUDE INGREDIENT QUERIES/////    PART1
        if(!empty($_POST['excludeingre'])){
        $excludeingre=$_POST['excludeingre'];

        $findsqlex="select recipe_name from recipe where";
        $count=0;
        foreach($excludeingre as $value){
                 if($count!=0){
                 $additemquery = " or search_keywords like '%$value%'";
                 $findsqlex= $findsqlex.$additemquery;
                 $count++;
             }else{
                 $additemquery = " search_keywords like '%$value%'";
                 $findsqlex= $findsqlex.$additemquery;
                 $count++;
              }
        }
        $findsqlex=$findsqlex.";";
        
       //// //FIRE SQL////////
         $result2=mysqli_query($conn,$findsqlex);
            
            while($row=mysqli_fetch_assoc($result2)){
                $excluderecipe[]=$row;
            }
        }



    ///////DISPLAY ALLLL INGREDIENT RECIPES/////   PART 2
    if(in_array('all', $ingredient)){

        // echo "all is selected<br><br>";
        $sql="SELECT * from recipe";
        $result=mysqli_query($conn,$sql);
        
        //FIRE SQL//////
        while($row=mysqli_fetch_assoc($result)){
                    $selectall[]=$row;
                    }

    //IF EXCLUDE INGREDIENT IS NOT EMPTY
        if(!empty($_POST['excludeingre'])){

            foreach($excluderecipe as $key=>$value){

            $compar=$value['recipe_name'];

            foreach($selectall as $key =>$value){

                if($value['recipe_name']==$compar){

                                unset($selectall[$key]);
                            }
            }

        }
        ?>
        <div class="cardcontainer">
        
        
        <?php
           //PRINT AFTER FILTER///
           foreach($selectall as $key=>$value){?>
           <div class="cards" >
           	   <!--IMAGES -->
                <div class="recipe_image">
                	<?php
               	
                    echo '<img src="data:image/jpeg;base64,'.( $value['recipe_image'] ).'"style="height:290px;width:100%;"/>';
            
               	?>
                </div>

               <!-- HEADINGS -->
               <div class="card_heading">
               	<?php echo ($value['recipe_name'])." /";?>
               	<?php echo ($value['recipe_time']);?>

                <!-- //COLOR CHANGE CODEEE -->
                 <?php
                  $userid=$_SESSION['user_id'];
                  $recipeid=$value['recipe_id'];
                  // echo "<script>alert('".$recipeid."')</script>";
                  $sql1="select * from user_recipe where user_id='$userid' and recipe_id='$recipeid'";
                  $result1=mysqli_query($conn,$sql1);
                  $rowcount=mysqli_num_rows($result1); 
                  if($rowcount>0){
                    // echo "<script>alert('red')</script>";
                    $color='red';
                  }else{
                    // echo "<script>alert('grey')</script>";
                    $color='grey';
                  }
                  
                  ?>
                  <form method="post" action="addfavorite(process).php?recipeid=<?php echo($value['recipe_id'])?>">
                  <!-- //EDITED HERE TOOO -->
                  <button  id="favorite" class="favorite" value="add" name="add" style="color:<?php echo $color;?>"><i class="fas fa-heart"></i></button>
               </form>
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
                 <button class="details" name="viewrecipe" style="height: 50px;">Details</button>
               </form>
               </div>
          </div>   





            <?php 
            // echo "<b>".$value['recipe_name']."</b><br>";
           }
           ?>
           </div>
           
           
           <?php

        }
           //PRINT IF THERES NO EXCLUDE INGREDIENT//
        else{
            ?>
            
            <div class="cardcontainer">
            <?php
            foreach($selectall as $key=>$value){
                ?>
            
            
            <div class="cards">
           	   <!--IMAGES -->
                <div class="recipe_image">
                	<?php
               	
                    echo '<img src="data:image/jpeg;base64,'.( $value['recipe_image'] ).'"style="height:290px;width:100%;"/>';
            
               	?>
                </div>

               <!-- HEADINGS -->
               <div class="card_heading">
               	<?php echo ($value['recipe_name'])." /";?>
               	<?php echo ($value['recipe_time']);?>

                <!-- //COLOR CHANGE CODEEE -->
                 <?php
                  $userid=$_SESSION['user_id'];
                  $recipeid=$value['recipe_id'];
                  // echo "<script>alert('".$recipeid."')</script>";
                  $sql1="select * from user_recipe where user_id='$userid' and recipe_id='$recipeid'";
                  $result1=mysqli_query($conn,$sql1);
                  $rowcount=mysqli_num_rows($result1); 
                  if($rowcount>0){
                    // echo "<script>alert('red')</script>";
                    $color='red';
                  }else{
                    // echo "<script>alert('grey')</script>";
                    $color='grey';
                  }
                  
                  ?>
                  <form method="post" action="addfavorite(process).php?recipeid=<?php echo($value['recipe_id'])?>">
                  <!-- //EDITED HERE TOOO -->
                  <button  id="favorite" class="favorite" value="add" name="add" style="color:<?php echo $color;?>"><i class="fas fa-heart"></i></button>
               </form>
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
                 <button class="details" name="viewrecipe" style="height: 50px;">Details</button>
               </form>
               </div>
          </div>   
            
            


            <?php
                // echo "<a href='recipepage.php?id=".$value['recipe_id']."'>".$value['recipe_name']."</b></a><br>";        
               }?>
            </div>

            
            <?php
            
        }


    }else{

        /////SEARCH FILTER IF NOT SELECT ALL////////    PART3
        $findsql="select * from recipe where";
        $count=0;
        foreach ($ingredient as $value) {
            
            if($count!=0){
                 $additemquery = " or search_keywords like '%$value%'";
                 $findsql= $findsql.$additemquery;
                 $count++;
             }else{
                 $additemquery = " search_keywords like '%$value%'";
                 $findsql= $findsql.$additemquery;
                 $count++;
              }

        }         
              $findsql=$findsql.";";
              
        //FIRE SQL //////
        $result=mysqli_query($conn,$findsql);

        while($row=mysqli_fetch_assoc($result)){
            $selectedrecipe[]=$row;
        }




       //IF THERE IS AN EXCLUDED INGREDIENT/////
        if(!empty($_POST['excludeingre'])){
        
        
        
        foreach($excluderecipe as $key=>$value){

            $compare=$value['recipe_name'];

            foreach($selectedrecipe as $key =>$value){

                if($value['recipe_name']==$compare){

                                unset($selectedrecipe[$key]);
                            }
            }
        }?>
        <div class="cardscontainer" style="grid-row: 2/3;
  max-width: 95%;
  margin-left: 23px;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(10px);
  border-radius: 11px;">

        <?php
        //PRINT AFTER FILTER/////
         foreach($selectedrecipe as $key => $value){?>
         <div class="cards" >
           	   <!--IMAGES -->
                <div class="recipe_image">
                	<?php
               	
                    echo '<img src="data:image/jpeg;base64,'.( $value['recipe_image'] ).'"style="height:290px;width:100%;"/>';
            
               	?>
                </div>

               <!-- HEADINGS -->
               <div class="card_heading">
               	<?php echo ($value['recipe_name'])." /";?>
               	<?php echo ($value['recipe_time']);?>

                <!-- //COLOR CHANGE CODEEE -->
                 <?php
                  $userid=$_SESSION['user_id'];
                  $recipeid=$value['recipe_id'];
                  // echo "<script>alert('".$recipeid."')</script>";
                  $sql1="select * from user_recipe where user_id='$userid' and recipe_id='$recipeid'";
                  $result1=mysqli_query($conn,$sql1);
                  $rowcount=mysqli_num_rows($result1); 
                  if($rowcount>0){
                    // echo "<script>alert('red')</script>";
                    $color='red';
                  }else{
                    // echo "<script>alert('grey')</script>";
                    $color='grey';
                  }
                  
                  ?>
                  <form method="post" action="addfavorite(process).php?recipeid=<?php echo($value['recipe_id'])?>">
                  <!-- //EDITED HERE TOOO -->
                  <button  id="favorite" class="favorite" value="add" name="add" style="color:<?php echo $color;?>"><i class="fas fa-heart"></i></button>
               </form>
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
                 <button class="details" name="viewrecipe" style="height: 50px;">Details</button>
               </form>
               </div>
          </div>   


         <?php 
         }?>
         </div>
         
         <?php

         

        }
        //PRINT IF THERES NO EXCLUDE INGREDIENT///
        else{
            ?>
        <div class="cardscontainer" style="grid-row: 2/3;
        max-width: 95%;
        margin-left: 23px;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        border-radius: 11px;">

        <?php
        //PRINT AFTER FILTER/////
         foreach($selectedrecipe as $key => $value){?>
         <div class="cards" >
           	   <!--IMAGES -->
                <div class="recipe_image">
                	<?php
               	
                    echo '<img src="data:image/jpeg;base64,'.( $value['recipe_image'] ).'"style="height:290px;width:100%;"/>';
            
               	?>
                </div>

               <!-- HEADINGS -->
               <div class="card_heading">
               	<?php echo ($value['recipe_name'])." /";?>
               	<?php echo ($value['recipe_time']);?>

                <!-- //COLOR CHANGE CODEEE -->
                 <?php
                  $userid=$_SESSION['user_id'];
                  $recipeid=$value['recipe_id'];
                  // echo "<script>alert('".$recipeid."')</script>";
                  $sql1="select * from user_recipe where user_id='$userid' and recipe_id='$recipeid'";
                  $result1=mysqli_query($conn,$sql1);
                  $rowcount=mysqli_num_rows($result1); 
                  if($rowcount>0){
                    // echo "<script>alert('red')</script>";
                    $color='red';
                  }else{
                    // echo "<script>alert('grey')</script>";
                    $color='grey';
                  }
                  
                  ?>
                  <form method="post" action="addfavorite(process).php?recipeid=<?php echo($value['recipe_id'])?>">
                  <!-- //EDITED HERE TOOO -->
                  <button  id="favorite" class="favorite" value="add" name="add" style="color:<?php echo $color;?>"><i class="fas fa-heart"></i></button>
               </form>
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
                 <button class="details" name="viewrecipe" style="height: 50px;">Details</button>
               </form>
               </div>
          </div>   


            <?php
                // echo $value['recipe_name']."<br>";
             }
             ?>
        </div>
             <?php
        }
    }


         

}else{
    echo "<h1>Nothing selected on include recipe</h1>";
 }
 }else{
     header('location:searchpage.php?notselected=true');
 }




?>


</div>
</body>
</html>