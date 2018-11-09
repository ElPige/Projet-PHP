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
            $requete = "SELECT * FROM membre where reference = $id";
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

        function getAnnonce2($id) {
          $requete = "SELECT * FROM annonce where reference = $id";
          $query=($this->db)->query($requete);
          $result =$query->fetchAll(PDO::FETCH_CLASS,"stdClass");
          return $result[0];
        }

        function getMaxId($from):int  {
          $requete = "SELECT max(reference) FROM $from";
          $query=($this->db)->query($requete);
          $result =$query->fetch();
          return $result['max(reference)'];
        }



        function ajoutAnnonce($titre, $descriptif, $nom, $marque, $modele, $annee, $utilisateurCourrant, $prix){
          $result2;
          $id=$this->getMaxId('Annonce')+1;
          var_dump($id);
          $requete = "Insert into Annonce values($id, '$titre', '$descriptif')";
          var_dump($requete);
          $result=($this->db)->query($requete);

          var_dump($result);
          if($result){
            $id=$this->getMaxId('Voiture')+1;
            var_dump($id);
            $requete2 = "Insert into Voiture values($id, '$nom', '$marque', '$modele', '0','$annee', $utilisateurCourrant,$prix)";
            var_dump($requete2);
            $result2=($this->db)->query($requete2);

          }

        return $result2;
        }

        function ajoutMembre($nom, $prenom, $pseudo, $mdp, $email, $telephone){
          $result;
          $id=$this->getMaxId('Membre')+1;
          var_dump($id);
          $requete = "Insert into Membre values($id, '$nom', '$prenom', '$pseudo' , '$mdp', '$email', '$telephone')";
          var_dump($requete);
          $result=($this->db)->query($requete);
            return $result;
          }


      }

$dao = new DAO();
session_start();

?>
