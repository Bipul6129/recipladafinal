<?php
include "data_config.php";

function exclude(){

                        while($row2=mysqli_fetch_assoc($result1)){
                        $exx=$row2['recipe_name'];
                        echo "<U>".$exx."</U><br> EXCLUDEE<BR>";
                     
                        while($row=mysqli_fetch_assoc($result)){
                        // $var = $row['recipe_name'];
                        if($row['recipe_name']== $exx){
                            echo "same<BR>";
                        }else{
                            echo "<B>".$row['recipe_name']."</B><BR>";
                        }
                        
                           

                    // echo $row['recipe_name']."<br>";
                    
                    }
                    }





	                }



?>