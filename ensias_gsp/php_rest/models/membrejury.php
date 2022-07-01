<?php

   class membrejury{
       //Db stuff
       private $conn;
       private $table='membrejury';

       //cf properties
       public $idMembreJury;
       public $nomMembre;
       public $prenomMembre;
       public $emailMembre;
       public $mdpMembre;
       public $filiere;



       //constructor with DB
       public function __construct($db)
       {
          $this->conn=$db;
       }

       //get les jurés
       public function read()
       {
          $query='SELECT  * FROM ' .$this->table ;
          //prepare statement
          $stmt=$this->conn->prepare($query);
          //execute query
          $stmt->execute();

          return $stmt;

       }


//Get un membre jury
public function readun($email,$mdp){
   //Prepare statement
   $stmt=$this->conn->prepare('SELECT * FROM membrejury where emailMembre=:emailmj and mdpMembre=:mdpmj  and validite="oui"');
   //Execute query
   $stmt->execute(array(
      'emailmj' =>$email,
      'mdpmj' =>$mdp
   ));
   return $stmt;
}
  


public function create($nomMembre,$prenomMembre,$emailMembre,$mdpMembre,$filiere){
   //Prepare statement
   $stmt=$this->conn->prepare('insert into membrejury(nomMembre,prenomMembre,emailMembre,mdpMembre,filiere) values(:nom,:prenom,:email,:mdp,:filiere)');
   //Execute query
   $stmt->execute(array(
      'nom'=>$nomMembre,
      'prenom'=>$prenomMembre,
      'email' =>$emailMembre,
      'mdp' =>$mdpMembre,
      'filiere'=>$filiere
   ));
   return $stmt;
}




   }

 




?>
