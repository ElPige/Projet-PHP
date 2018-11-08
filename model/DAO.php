<?php


$dao = new DAO();

    class DAO {
        private $db;
        function __construct() {
          $database = 'sqlite:../data/donnees.db';
          try {
            $this->db = new PDO($database);
          }
          catch (\Exception $e) {
            die("Impossible de se connecter : ".$e->getMessage());
          }
        }
        
        function db() {
          return $this->db;
        }

        function getVoiture() {
          $requete = "SELECT * FROM Voiture";
          $query=($this->db)->query($requete);
          $result =$query->fetchAll(PDO::FETCH_CLASS,"Voiture");
          return $result;
        }
}
$dao = new DAO();
?>
