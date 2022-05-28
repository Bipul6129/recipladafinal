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
    <title>Users</title>
	<link rel="stylesheet" type="text/css" href="reciplada.css">
	<link rel="stylesheet" type="text/css" href="mainpage.css">
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
    </style>
    </head>
    <body>
    <header class="main-header">
        <a href="adminpage.php"><div class="brand-logo"></div></a>
        <nav class="main-nav">
            <ul>
                <li><a href=""><div class="sign-in">Profile</div></a></li>
                <li><a href="logoutprocess.php"><div class="sign-up">Log out</div></a></li>
                
            </ul>
        </nav>
    </header>
        <table style=" position: relative; left: 380px; top: 65px; background: #00000061;backdrop-filter: blur(4px);" border="1" width="700px">

        <tr padding="5px">
            <th>Name</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Status</th>
        </tr>
    <?php
    $sql="SELECT * from user_detail";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if($row['is_admin']==0){
            $admin= "False";
        }else if($row['is_admin']==1){
            $admin="True";
        }

        if($row['status']==0){
            $status="Offline <span style='background-color:#d80000f0; border-radius:50%; height:10px; width:10px; display:inline-block;'></span>";
        }else if($row['status']==1){
            $status="Online <span style='background-color:#04ff04bd; border-radius:50%; height:10px; width:10px; display:inline-block;'></span>";
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
    <footer style="height: 60px; padding-top: 25px;position: absolute;bottom: -120px;background-color: transparent;width: 98vw;left: 0;right: 0;">   
</footer>

</body>
</html>