<?php
require_once("../model/DAO.php");
if (isset($_SESSION['Membre'])){
  session_destroy();
}

if(count($_POST)==6){
  $pseudo = $_POST['pseudo']
  $mdp = $_POST['password'];
  $nom = $_POST['Nom'];
  $prenom = $_POST['Prénom'];
  $tel = $_POST['tel'];
  $mail = $_POST['email'];

  $dao->ajoutMembre($nom, $prenom, $pseudo, $mdp, $email, $tel)


  header('Location : ../controler/accueil.ctrl.php');
} else {
  include('../view/inscription.view.php');
}

 ?>
