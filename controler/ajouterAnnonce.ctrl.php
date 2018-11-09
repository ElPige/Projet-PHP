<?php
require_once("../model/DAO.php");

if (count($_POST)==7){
  var_dump(2);
  $titre = $_POST['Titre'];
  $descriptif = $_POST['Descriptif'];
  $nom = $_POST['Nom'];
  $marque = $_POST['Marque'];
  $modele = $_POST['Modèle'];
  $annee = $_POST['Année'];
  $prix = $_POST['Prix'];

  $dao->ajoutAnnonce($titre, $descriptif, $nom, $marque, $modele, $annee,$_SESSION['Membre']->reference, $prix);
  header('Location:../controler/main.ctrl.php');

} else{
  include('../view/ajouterAnnonce.view.php');
}


 ?>
