<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/encadrant.php';




$database=new Database();
$db=$database->connect();


$encadrant =new encadrant($db);


$result=$encadrant->create($_GET['nom'],$_GET['prenom'],$_GET['email'],$_GET['mdp'],$_GET['etablissement'],$_GET['filiere']);


$num=$result->rowCount();

if($num >0){

 
    echo json_encode(array('message1'=>'INSCRIPTION FAITE'));


 }
 else { 

   
  echo json_encode(array('message2'=>'ERREUR D\'INSCRIPTION '));
  
}

?>