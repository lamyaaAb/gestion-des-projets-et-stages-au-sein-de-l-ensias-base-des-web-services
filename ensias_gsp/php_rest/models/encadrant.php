<?php

   class encadrant{
       //Db stuff
       private $conn;
       private $table='encadrant';

       //Post properties
       public $id;
       public $nom;
       public $prenom;
       public $email;
       public $mdp;
       public $type;
       public $etablissement;



       //constructor with DB
       public function __construct($db)
       {
          $this->conn=$db;
       }

       //get les encadrants
       public function read()
       {
          $query='SELECT  * FROM ' .$this->table ;
          //prepare statement
          $stmt=$this->conn->prepare($query);
          //execute query
          $stmt->execute();

          return $stmt;

       }


//Get un encadrant
public function readun($email,$mdp){
   //Prepare statement
   $stmt=$this->conn->prepare('SELECT * FROM encadrant where email=:email and mdp=:mdp  and validite="oui"');
   //Execute query
   $stmt->execute(array(
      'email' =>$email,
      'mdp' =>$mdp
   ));
   return $stmt;
}

public function create($nom,$prenom,$email,$mdp,$etablissement,$filiere){
   //Prepare statement
   $stmt=$this->conn->prepare('insert into encadrant(nom,prenom,email,mdp,type,etablissement,filiere) values(:nom,:prenom,:email,:mdp,:type,:etablissement,:filiere)');
   //Execute query
   $stmt->execute(array(
      'nom'=>$nom,
      'prenom'=>$prenom,
      'email' =>$email,
      'mdp' =>$mdp,
      'type'=>'interne',
      'etablissement'=>$etablissement,
      'filiere'=>$filiere
   ));
   return $stmt;
}
  
public function create_externe($nom,$prenom,$email,$mdp,$etablissement,$filiere){
   //Prepare statement
   $stmt=$this->conn->prepare('insert into encadrant(nom,prenom,email,mdp,type,etablissement,filiere) values(:nom,:prenom,:email,:mdp,:type,:etablissement,:filiere)');
   //Execute query
   $stmt->execute(array(
      'nom'=>$nom,
      'prenom'=>$prenom,
      'email' =>$email,
      'mdp' =>$mdp,
      'type'=>'externe',
      'etablissement'=>$etablissement,
      'filiere'=>$filiere
   ));
   return $stmt;
}

   }


  




 




?>
