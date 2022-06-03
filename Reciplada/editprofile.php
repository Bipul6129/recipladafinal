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
            width: 65px;
            height: 35px;
            transition: transform 0.25s;
            position: relative;
            top: 80px;
            left:380px;

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
    $oldpassword=$row['user_password'];
?>
<form id="update_userdetail" action="editprofile(process).php" onsubmit="event.preventDefault();jscheck();" method="post">
    <table style=" position: relative; left: 380px; top: 65px; background: #00000061;backdrop-filter: blur(4px);" border="1" width="700px">

    <tr>
        <td>Name</td>
        <td><input id="new_name" class="i_name" name="new_username" type="text" value="<?php echo $row['user_name']?>"></td>
    </tr>
    <tr>
        <td>New Password</td>
        <td><input id="new_passw" class="i_name" name="new_password" type="password"></td>
    </tr>
    <tr>
        <td>Confirm Password</td>
        <td><input id="confirm_pass" class="i_name" name="confirm_password" type="password"> </td>
    </tr>

</table>
<button id="btn-create" type="submit">Save</button></td>
</form>

<?php
}
?>
<script>
    function jscheck(){
        u_name=document.getElementById('new_name').value;
        u_pass=document.getElementById('new_passw').value;
        u_confirm=document.getElementById('confirm_pass').value;
        pass=1;
        if(u_name.trim()==''||u_name.length<3){
            alert('Enter full name correctly');
            pass=0;
        }
        if(u_pass.trim()==''||u_pass.length<6){
            alert('Enter password of atleast 6 characters');
            pass=0;
        }
        if(u_confirm!=u_pass){
            alert('Passwords dont match');
            pass=0;
        }
        if(pass==1){
            oldpass=prompt('Enter old password');
            if(oldpass!=<?php echo "'".$oldpassword."'" ?>){
                alert('wrong password');
            }else{
                document.getElementById('update_userdetail').submit();
            }
        
        }
    }



</script>
<footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
</footer>

</body>
</html>