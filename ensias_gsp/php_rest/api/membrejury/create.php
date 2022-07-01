<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/membrejury.php';




$database=new Database();
$db=$database->connect();


$membrejury =new membrejury($db);


$result=$membrejury->create($_GET['nomMembre'],$_GET['prenomMembre'],$_GET['emailMembre'],$_GET['mdpMembre'],$_GET['filiere']);


$num=$result->rowCount();

if($num >0){

 
    echo json_encode(array('message1'=>'INSCRIPTION FAITE'));


 }
 else { 

   
  echo json_encode(array('message2'=>'ERREUR D\'INSCRIPTION '));
  
}

?>