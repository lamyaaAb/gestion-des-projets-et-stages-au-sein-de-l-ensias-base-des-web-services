<?php

   class administrateur{
       //Db stuff
       private $conn;
       private $table='administrateur';

       //Post properties
       public $id;
       public $nom;
       public $prenom;
       public $email;
       public $mdp;
      



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
   $stmt=$this->conn->prepare('SELECT * FROM administrateur where email=:email and mdp=:mdp');
   //Execute query
   $stmt->execute(array(
      'email' =>$email,
      'mdp' =>$mdp
   ));
   return $stmt;
}



   }


?>