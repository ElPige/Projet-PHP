<?php

 require_once("../model/DAO.php");
 $voiture=$dao->getVoiture();

if (isset($_GET['annonce'])) {
  $annonce = $_GET['annonce'];
} else {
  $annonce = '';
}

if ($annonce != '') {
  $annoncev = $dao->getAnnonce($annonce);
  $id = $annoncev->appartienRef;
  $m = $dao->getMember($id);
  $a = $dao->getAnnonce2($annoncev->reference);
  include('../view/annonce.view.php');
} else {
  include('../view/main.view.php');
}
?>
