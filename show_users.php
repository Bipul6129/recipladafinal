<?php
session_start();
include "check-login.php";
include "data_config.php";
if($_SESSION['is_admin']!=1){
    header('location:homepage.php?notadmin=true');
}

?>

<html>
    <head>
    <title>RECIPEPAGE</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
    </head>
    <body>
    <header class="main-header">
		<a href="adminpage.php"><div class="brand-logo"></div></a>
		<nav class="main-nav">
			<ul>
				<li><a href="sign-in.html"><div class="sign-in">Profile</div></a></li>
				<li><div class="sign-up">
                    <form action="logoutprocess.php" method="post">
                    <button name="logout">Log out</button>
                    </form>
                </div></li>
				
			</ul>
		</nav>
    </header>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>IsAdmin</th>
            <th>Status</th>
        </tr>
    <?php
    $sql="SELECT * from user_detail";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if($row['is_admin']==0){
            $admin= "not admin";
        }else if($row['is_admin']==1){
            $admin="admin";
        }

        if($row['status']==0){
            $status="offline";
        }else if($row['status']==1){
            $status="online";
        }
        
        ?>
        
            <tr>
                <th><?php echo $row['user_name']?></th>
                <th><?php echo $row['user_email']?></th>
                <th><?php echo $admin?></th>
                <th><?php echo $status?></th>
            </tr>
        
        
        
        <?php
    }
    ?>
    </table>

</body>
</html>