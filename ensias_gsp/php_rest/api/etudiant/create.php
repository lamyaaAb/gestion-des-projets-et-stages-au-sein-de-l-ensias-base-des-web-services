<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/etudiant.php';




$database=new Database();
$db=$database->connect();


$etudiant=new etudiant($db);


$result=$etudiant->create($_GET['nom'],$_GET['prenom'],$_GET['cne'],$_GET['email'],$_GET['mdp'],$_GET['filiere']);


$num=$result->rowCount();

if($num >0){

 
    echo json_encode(array('message1'=>'INSCRIPTION FAITE'));


 }
 else { 

   
  echo json_encode(array('message2'=>'ERREUR D\'INSCRIPTION '));
  
}

?>