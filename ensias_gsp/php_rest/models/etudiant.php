<?php

   class etudiant{
       //Db stuff
       private $conn;
       private $table='etudiant';

       //Post properties
       public $id;
       public $nom;
       public $prenom;
       public $cne;
       public $email;
       public $mdp;

       //constructor with DB
       public function __construct($db)
       {
          $this->conn=$db;
       }

       //get etudiants
       public function read()
       {
          $query='SELECT  * FROM ' .$this->table ;
          //prepare statement
          $stmt=$this->conn->prepare($query);
          //execute query
          $stmt->execute();

          return $stmt;

       }


//Get un etudiant
public function readun($email,$mdp){
   //Prepare statement
   $stmt=$this->conn->prepare('SELECT * FROM etudiant where email=:email and mdp=:mdp  and validite="oui"');
   //Execute query
   $stmt->execute(array(
      'email' =>$email,
      'mdp' =>$mdp
   ));
   return $stmt;
}




public function create($nom,$prenom,$cne,$email,$mdp,$filiere){
   //Prepare statement
   $stmt=$this->conn->prepare('insert into etudiant(nom,prenom,cne,email,mdp,filiere) values(:nom,:prenom,:cne,:email,:mdp,:filiere)');
   //Execute query
   $stmt->execute(array(
      'nom'=>$nom,
      'prenom'=>$prenom,
      'cne'=>$cne,
      'email' =>$email,
      'mdp' =>$mdp,
      'filiere'=>$filiere
   ));
   return $stmt;
}
  


   }

 




?>
