<?php
session_start();
include "data_config.php";
include "check-login.php";?>
<div id="hide" style="display: none;">
<?php
if($_GET['searchbar']==true){
    $keyword=$_GET['searchbar'];
    echo $keyword;
    $query="SELECT * from recipe where search_keywords like '%$keyword%'or recipe_name like '%$keyword%' or recipe_time='$keyword'";
    $result=mysqli_query($conn,$query);
    
  


}else{
$query="SELECT * from recipe ";
$result=mysqli_query($conn,$query);
}

?>
</div>

    <div id="hide" style="display: none;">
      <?php
          if($_GET['alreadylogin']==true){
            echo "<script>alert('You are already logged in'); </script>";
          }
          if($_GET['welcome']==true){
            // echo "<script>alert('You are logged in'); </script>";
        }
        if($_GET['notadmin']==true){
            echo "<script>alert('You are not an admin'); </script>";
        }
        if($_GET['added']==true){
            // echo "<script>alert('Added to favorites'); </script>";
        }
        if($_GET['notadded']==true){
            echo "<script>alert('Failed to add'); </script>";
        }
        
          
          
      ?>
    </div>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
  <script src="https://kit.fontawesome.com/f6dcf461c1.js" crossorigin="anonymous"></script>
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
        #btn-create{
            resize: none;
            outline: none;
            background-color:  #0000009c;
            border: 1px solid white ;
            border-radius: 10px;
            color: white;
            padding: 5px;
            width: 20%;
            height: 40px;
            transition: transform 0.25s;
        }
        #btn-create:hover{
            transform: scale(1.05);
            }   
        .i_name{
            border: 1px solid white ;
            border-radius: 5px;
            background-color:transparent;
            resize: none;
            outline: none;
            position: relative;
            height:50px;
            width: 400px;
            color: white;
            font-family: inherit;
            transition: transform 0.5s;

        }
        .i_name::placeholder{
            color: #c5c5c5;
        }
        .i_name:hover,.i_name:focus{
            transform: scale(1.05);
        }     
    </style>
</head>
<body style="overflow-x: hidden;">
<div class="wrapper">
    <header class="main-header">
		<a href="adminpage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><div><input id="searchbar"type="text" class="search-bar" placeholder="Search..." onkeypress="clickpress(event)"></div></li>
				<li><a href="profile.php"><div class="sign-in">Profile</div></a>
          <ul>
                <li class="nest"><a href="editprofile.php">Edit</a></li>
            
          </ul>
        </li>
            <li>
                <li><a href="logoutprocess.php"><div class="sign-up">Log out</div></a></li>

            </li>	
		</ul>
		</nav>
	</header>




<script>
      var favorite = document.getElementById('favorite');
         function toggle(){
                if (favorite.style.color =="#ff3252") {
                    favorite.style.color = "grey"
                }
                else{
                   favorite.style.color = "#ff3252"
                }
       }

        function clickpress(event) {
    if (event.keyCode == 13) {
        vari=document.getElementById('searchbar').value;
        if(vari.length<3){
            alert('type more than 3 length of characters');
        }else{

        window.location.replace("homepage.php?searchbar="+vari);
        }
    }
}

</script>


<?php
$user_id=$_SESSION['user_id'];
$sqluser="select * from user_detail where user_id='$user_id'";
$resultuser=mysqli_query($conn,$sqluser);
while($row=mysqli_fetch_assoc($resultuser)){
?>
<table style=" position: relative; left: 380px; top:-35px; background: #00000061;backdrop-filter: blur(4px);" border="1" width="700px">
<tr>
  <th colspan="2">Profile</th>
</tr>
<tr>
  <td>Name:</td>
  <td><?php echo $row['user_name'] ?></td>
<tr>
  <td>Email:</td>
  <td><?php echo $row['user_email'] ?></td>
</tr>
<?php
if($row['is_admin']==1){
    $status="admin";
}else{
    $status="notadmin";
}
?>
<tr>
<td>Status:</td>
<td><?php echo $status ?></td>
</tr>
</table>

<?php
}
?>

<footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
</footer>

</body>
</html>