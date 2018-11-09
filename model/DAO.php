<?php


$dao = new DAO();

    class DAO {
        private $db;
        function __construct() {
          $database = 'sqlite:../data/voit.db';
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
          $requete = "SELECT * FROM voiture";
          $query=($this->db)->query($requete);
          $result =$query->fetchAll(PDO::FETCH_CLASS,"stdClass");
          return $result;
        }

        function getMembre($mail){
            $requete = "SELECT * FROM Membre WHERE email = '$mail' ";
            $query = ($this->db)->query($requete);
            $result = $query->fetchAll(PDO::FETCH_CLASS, "stdClass");
            if (isset($result[0])){

              $_SESSION['Membre']=$result[0];
              return $result[0];
            }else{
              return null;
            }
          }


        function getVoitureMembre($appartientRef) {
          $requete = "SELECT * FROM Membre WHERE $appartientRef = reference";
          $query = ($this->db)->query($requete);
          $result = $query->fetchAll(PDO::FETCH_CLASS, "stdClass");
          return $result[0];
        }

        function getAnnonce($id) {
          $requete = "SELECT * FROM voiture where reference = $id";
          $query=($this->db)->query($requete);
          $result =$query->fetchAll(PDO::FETCH_CLASS,"stdClass");
          return $result;
        }
}
$dao = new DAO();
session_start();

?>
