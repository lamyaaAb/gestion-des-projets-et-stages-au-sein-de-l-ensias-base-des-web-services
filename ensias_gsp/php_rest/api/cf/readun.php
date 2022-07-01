<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/cf.php';




$database=new Database();
$db=$database->connect();


$cf=new cf($db);


$result=$cf->readun($_GET['eml'],$_GET['motdp']);


$num=$result->rowCount();

if($num >0){
 $cf_arr=array();
 $cf_arr['data']=array();
 while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $cf_item=array(
        'idCF'=>$idCF,
        'nomCF'=>$nomCF,
        'prenomCF'=>$prenomCF,
        'emailCF'=>$emailCF,
        'mdpCF'=>$mdpCF,
        'filiereCF'=>$filiere
     );
    
     array_push($cf_arr['data'],$cf_item);
 
    echo json_encode($cf_arr);


 }

} else { 

   
  echo json_encode(array('message'=>'NO STUDENT FOUND'));
  
}

?>