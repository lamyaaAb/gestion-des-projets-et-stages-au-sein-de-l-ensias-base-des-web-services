<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/cf.php';




$database=new Database();
$db=$database->connect();


$cheffiliere =new cf($db);


$result=$cheffiliere->create($_GET['nom'],$_GET['prenom'],$_GET['email'],$_GET['mdp'],$_GET['filiere']);


$num=$result->rowCount();

if($num >0){

 
    echo json_encode(array('message1'=>'INSCRIPTION FAITE'));


 }
 else { 

   
  echo json_encode(array('message2'=>'ERREUR D\'INSCRIPTION '));
  
}

?>