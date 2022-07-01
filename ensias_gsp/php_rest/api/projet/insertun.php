
<?php
session_start();
$sujet=$_GET['sjt'];
$description=$_GET['desc'];
$type=$_GET['type'];
$date_fin=$_GET['dte'];



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
$result=$projet->insertun($sujet,$description,$type,$date_fin);

//Get row count
$num=$result->rowCount();

//check if any etudiant
if($num >0){

    echo json_encode(array('message'=>'Projet inséré'));

 }

 else { 
    echo json_encode(array('message'=>'Projet pas inséré'));

}

?>
