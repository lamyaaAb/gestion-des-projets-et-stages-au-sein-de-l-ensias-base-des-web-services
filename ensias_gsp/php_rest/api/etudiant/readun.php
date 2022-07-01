<?php



header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/etudiant.php';




$database=new Database();
$db=$database->connect();


$etudiant=new etudiant($db);


$result=$etudiant->readun($_GET['eml'],$_GET['motdp']);


$num=$result->rowCount();

if($num >0){
 $etudiant_arr=array();
 $etudiant_arr['data']=array();
 while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $etudiant_item=array(
        'id'=>$id,
        'nom'=>$nom,
        'prenom'=>$prenom,
        'email'=>$email,
         'cne'=>$cne,
         'mdp'=>$mdp   
     );
    
     array_push($etudiant_arr['data'],$etudiant_item);
 
    echo json_encode($etudiant_arr);


 }

} else { 

   
  echo json_encode(array('message'=>'NO STUDENT FOUND'));
  
}

?>