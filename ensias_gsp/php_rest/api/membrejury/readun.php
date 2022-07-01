<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/membrejury.php';




$database=new Database();
$db=$database->connect();


$membre=new membrejury($db);


$result=$membre->readun($_GET['eml'],$_GET['motdp']);


$num=$result->rowCount();

if($num >0){
 $mj_arr=array();
 $mj_arr['data']=array();
 while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $mj_item=array(
        'idMJ'=>$idMembreJury,
        'nomMJ'=>$nomMembre,
        'prenomMJ'=>$prenomMembre,
        'emailMJ'=>$emailMembre,
        'mdpMJ'=>$mdpMembre,
        'filiereMJ'=>$filiere
     );
    
     array_push($mj_arr['data'],$mj_item);
 
    echo json_encode($mj_arr);


 }

} else { 

   
  echo json_encode(array('message'=>'NO MEMBRE JURY FOUND'));
  
}

?>