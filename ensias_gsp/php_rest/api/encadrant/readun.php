<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/encadrant.php';




$database=new Database();
$db=$database->connect();


$encadrant=new encadrant($db);


$result=$encadrant->readun($_GET['eml'],$_GET['motdp']);


$num=$result->rowCount();

if($num >0){
 $encadrant_arr=array();
 $encadrant_arr['data']=array();
 while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $encadrant_item=array(
        'id'=>$idEncadrant,
        'nom'=>$nom,
        'prenom'=>$prenom,
        'email'=>$email,
        'mdp'=>$mdp,
        'type'=>$type,
        'etablissement'=>$etablissement  
     );
    
     array_push($encadrant_arr['data'],$encadrant_item);
 
    echo json_encode($encadrant_arr);


 }

} else { 

   
  echo json_encode(array('message'=>'NO STUDENT FOUND'));
  
}

?>