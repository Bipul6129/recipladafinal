<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];
//database connection
$conn= new mysqli('localhost','root','','form');
if ($conn -> connect_error ) {
	die('The connection has failed')
}else{
	$stmt =$conn->prepare("insert into registration (firstName,lastName, gender, email, password, number)values(?,?,?,?,?,?)");
	$stmt -> bind_param("sssssi",$firstName,$lastName,$gender,$email,$password,$number);
	$stmt ->execute();
	echo "Connection successful";
	$stmt -> close();
	$conn -> close(); 

}
?>