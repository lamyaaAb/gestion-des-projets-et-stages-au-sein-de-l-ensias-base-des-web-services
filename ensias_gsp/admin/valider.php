<?php

$host="localhost";
$username="root";
$pass="";
$database="gsp";
try{
	$connect=new PDO("mysql:host=$host;dbname=$database",$username,$pass);
}

catch(PDOException $e){
	echo" connexion pas faite";
}

$a=$_GET['id'];
$stmt=$connect->prepare("update etudiant set validite='oui' where id=:id");
$stmt->execute(array('id'=>$a));
header('location:http://localhost/Projet-PFA/ensias_gsp/admin/index.php');





?>



