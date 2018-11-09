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

          function getMember($id) {
            $requete = "SELECT * FROM membre where referenceM = $id";
            $query=($this->db)->query($requete);
            $result =$query->fetchAll(PDO::FETCH_CLASS,"stdClass");
            return $result[0];
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
          return $result[0];
        }

        function getMaxId($from){
          $requete = "SELECT max(reference) FROM $from";
          $query=($this->db)->query($requete);
          $result =$query->fetch();
          return $result['max(reference)'];
        }



        function ajoutAnnonce($titre, $descriptif, $nom, $marque, $modele, $annee, $prix){
          $result2;

          $requete = "Insert into Annonce values($dao->getMaxId('Voiture')+1, '$titre', '$descriptif')";
          $query=($this->db)->query($requete);
          $result =$query->fetch();
          var_dump($result);
          if($result[0]){

            $requete2 = "Insert into Voiture values($dao->getMaxId('Voiture')+1, '$titre', '$nom', '$marque', '$modele', '0','$annee', '$prix')";

            $query=($this->db)->query($requete2);
          $result2 =$query->fetch();

          }

        return $result2[0];
        }

$dao = new DAO();
var_dump($dao->ajoutAnnonce('Membre'));
session_start();

?>
