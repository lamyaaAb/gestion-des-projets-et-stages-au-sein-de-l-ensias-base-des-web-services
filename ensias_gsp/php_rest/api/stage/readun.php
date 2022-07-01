
<?php
session_start();
$id_etd=$_GET['id_etd'];



//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/etudiant.php';
include_once '../../models/projet.php';



//Instantiate DS & connect
$database=new Database();
$db=$database->connect();

//Instantiate GSP etudiant object
$projet=new projet($db);

//GSP etudiant query
$result=$projet->readun_stage($id_etd);

//Get row count
$num=$result->rowCount();

//check if any etudiant
if($num >0){
 $projet_arr=array();
 $projet_arr['data']=array();
 while($row=$result->fetch(PDO::FETCH_ASSOC)){
     extract($row);
     $projet_item=array(
        'idProjet'=>$idProjet,
        'sujet'=>$sujet,
        'description'=>$description,
        'date_fin'=>$date_fin,
         'type'=>$type,
         'annee'=>$annee   
     );
    //push to "data"
     array_push($projet_arr['data'],$projet_item);
    //turn to json & output

     echo json_encode($projet_arr);

 }

} //else { 

    // no project pas besoin de traitement
    //echo json_encode(array('message'=>'NO STUDENT FOUND'));

//}

?>
