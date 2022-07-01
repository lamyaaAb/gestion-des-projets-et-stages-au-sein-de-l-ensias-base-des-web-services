<?php

   class cf{
       //Db stuff
       private $conn;
       private $table='cheffiliere';

       //cf properties
       public $idcf;
       public $nom;
       public $prenom;
       public $email;
       public $mdp;
       public $filiere;



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
   $stmt=$this->conn->prepare('SELECT * FROM cheffiliere where emailCF=:email and mdpCF=:mdp and validite="oui"');
   //Execute query
   $stmt->execute(array(
      'email' =>$email,
      'mdp' =>$mdp
   ));
   return $stmt;
}



  


public function create($nomCF,$prenomCF,$emailCF,$mdpCF,$filiere){
   //Prepare statement
   $stmt=$this->conn->prepare('insert into cheffiliere(nomCF,prenomCF,emailCF,mdpCF,filiere) values(:nom,:prenom,:email,:mdp,:filiere)');
   //Execute query
   $stmt->execute(array(
      'nom'=>$nomCF,
      'prenom'=>$prenomCF,
      'email' =>$emailCF,
      'mdp' =>$mdpCF,
      'filiere'=>$filiere
   ));
   return $stmt;
   }


}

 




?>
