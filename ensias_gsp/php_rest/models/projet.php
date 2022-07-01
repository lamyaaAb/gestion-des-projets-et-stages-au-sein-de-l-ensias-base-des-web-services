<?php

   class projet{
       //Db stuff
       private $conn;
       private $table='projet';

       //Post properties
       public $idProjet;
       public $sujet;
       public $description;
       public $type;
       public $date_fin;
       public $annee;

       //constructor with DB
       public function __construct($db)
       {
          $this->conn=$db;
       }


//Get un etudiant
public function readun($id_etd){
   //Prepare statement
   $stmt=$this->conn->prepare('SELECT * FROM projet where type="PFA" and annee=YEAR(CURDATE()) and idProjet in(select idProjet from projetetudiant where id = (select id from etudiant where id=:id ))');
   //Execute query
   $stmt->execute(array(
      'id'=>$id_etd));
   return $stmt;
}

public function readun_stage($id_etd){
   //Prepare statement
   $stmt=$this->conn->prepare('SELECT * FROM projet where type="STAGE" and annee=YEAR(CURDATE()) and idProjet in(select idProjet from projetetudiant where id =(select id from etudiant where id=:id ))');
   //Execute query
   $stmt->execute(array(
      'id'=>$id_etd));
   return $stmt;
}

//inserer un projet
public function insertun($sujet,$description,$type,$date_fin){
   //Prepare statement
   $stmt=$this->conn->prepare('insert into projet(sujet,description,type,date_fin,annee,note) values (:sjt,:dsc,:type,:date_fin,YEAR(CURDATE()),0)');
   //Execute query
   $stmt->execute(array(
       'sjt'=>$sujet,
       'dsc'=>$description,
       'type'=>$type,
       'date_fin'=>$date_fin 
     ));
   return $stmt;
}

  


   }

 




?>
