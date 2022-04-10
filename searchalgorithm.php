<?php
session_start();
include "check-login.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reciplada</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
    <link rel="stylesheet" type="text/css" href="mainpage.css">
</head>
<body style="overflow-x: hidden">
<div class="wrapper">
<header class="main-header">
		<a href="homepage.php"><div class="brand-logo"></div></a>
        <h1 style="margin-top:7%;">SEARCH RESULTS</h1>
		<nav class="main-nav">
			<ul>
                
				<li><div><input type="text" class="search-bar" placeholder="Search..."></div></li>
				<li><a href="sign-in.html"><div class="sign-in">Profile</div></a></li>
                <li><a href="searchpage.php"><div class="sign-in" style="margin-top:20px">ADVANCE SEARCH</div></a></li>
				<li><div class="sign-up">
                    <form action="logoutprocess.php" method="post">
                    <button name="logout">Log out</button>
                    </form>
                </div></li>
                
				
			</ul>
		</nav>
</header>




     


<?php
include "data_config.php";




 if(isset($_POST['search'])){

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
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
               <button class="buttons"  style="position: relative; margin-right: 3.5px;" name="viewrecipe">Details</button>
               </form>
               <form method="post" action="homepage.php?name=<?php echo($value['recipe_name'])?>">
               <button class="buttons" name="add"  style="position: relative;margin-left: 3.5px;" value="add">Add to favourite</button>
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
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
               <button class="buttons"  style="position: relative; margin-right: 3.5px;" name="viewrecipe">Details</button>
               </form>
               <form method="post" action="homepage.php?name=<?php echo($value['recipe_name'])?>">
               <button class="buttons" name="add"  style="position: relative;margin-left: 3.5px;" value="add">Add to favourite</button>
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
        <div class="cardscontainer">

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
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
               <button class="buttons"  style="position: relative; margin-right: 3.5px;" name="viewrecipe">Details</button>
               </form>
               <form method="post" action="homepage.php?name=<?php echo($value['recipe_name'])?>">
               <button class="buttons" name="add"  style="position: relative;margin-left: 3.5px;" value="add">Add to favourite</button>
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
            <div class="cardscontainer">

            <?php
            foreach($selectedrecipe as $key => $value){?>
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
               </div>

               <!-- BUTTONS -->
               <div class="buttons_container">
               <form method="post"  action="recipepage.php?id=<?php echo($value['recipe_id'])?>">
               <button class="buttons"  style="position: relative; margin-right: 3.5px;" name="viewrecipe">Details</button>
               </form>
               <form method="post" action="homepage.php?name=<?php echo($value['recipe_name'])?>">
               <button class="buttons" name="add"  style="position: relative;margin-left: 3.5px;" value="add">Add to favourite</button>
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
    echo "nothing selected";
 }
 }




?>


</div>
</body>
</html>