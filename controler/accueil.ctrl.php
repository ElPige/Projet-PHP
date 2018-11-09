<?php
require_once("../model/DAO.php");

if(isset($_GET['deco'])&& $_GET['deco']){
  session_destroy();
}

if(count($_POST)==2){
  if (isset($_POST['mail']) && isset($_POST['mdp'])) {
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    if ($dao->getMembre($mail)){
      $membre = $dao->getMembre($mail);
      var_dump($membre->mdp , $mdp);
      if ($membre->mdp == $mdp){
        var_dump(1);
        header('Location:../controler/main.ctrl.php');
      }else{
        include("../view/accueil.view.php");
      }
    }else{
      var_dump("mdp incorrecte");
      include("../view/accueil.view.php");
    }
  }  else {
      var_dump("E-mail incorrecte");
      include("../view/accueil.view.php");
    }

}else{
  include("../view/accueil.view.php");
}


?>
