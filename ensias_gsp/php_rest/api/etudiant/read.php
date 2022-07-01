<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/etudiant.php';


//Instanciate DB & connect
$database=new Database();
$db=$database->connect();

//Instanciate GSP etudiant object

$etd=new etudiant($db);

//GSP etudiant query
$result =$etd->read();

//Get row count
$num=$result->rowCount();

//check if any etudiants found
if($num>0)
{
   $etds_arr=array();
   $etds_arr['data']=array();

   while($row=$result->fetch(PDO::FETCH_ASSOC))
   {
       extract($row);
       $etd_item=array(
           'id'=> $id,
           'nom'=>$nom,
           'prenom'=>$prenom,
           'cne'=>$cne,
           'email'=>$email,
           'mdp'=>$mdp
       );

       //push  to data
       array_push($etds_arr['data'],$etd_item);
   }

   //convert to json and output
    echo json_encode($etds_arr);



}
else{
  echo json_encode(array('message'=>'pas des etudiants'));

}





?>