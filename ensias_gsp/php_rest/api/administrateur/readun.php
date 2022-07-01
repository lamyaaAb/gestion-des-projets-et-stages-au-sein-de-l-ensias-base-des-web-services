<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/administrateur.php';




$database=new Database();
$db=$database->connect();


$administrateur=new administrateur($db);


$result=$administrateur->readun($_GET['eml'],$_GET['motdp']);


$num=$result->rowCount();

if($num >0){
 $administrateur_arr=array();
 $administrateur_arr['data']=array();
 while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $administrateur_item=array(
        'id'=>$id,
        'nom'=>$nom,
        'prenom'=>$prenom,
        'email'=>$email,
        'mdp'=>$mdp,
        
     );
    
     array_push($administrateur_arr['data'],$administrateur_item);
 
    echo json_encode($administrateur_arr);


 }

} else { 

   
  echo json_encode(array('message'=>'NO ADMIN FOUND'));
  
}

?>