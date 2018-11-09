<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $retour = 'http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/M3104/TP/tp02/sujet/img/Actions-arrow-left-icon.png';
    echo '<a href="../controler/main.ctrl.php"><img src='.$retour.'></a>';
    foreach ($annoncev as $key => $value) {
      print "<div class = 'img'><img src = \"../data/BD/Image/$value->reference.jpg\"/></div>";
      print "<div class = 'text'> <h3> Nom : $value->nom </h3>";
      print "<div class = 'text'>      <h3> Marque : $value->marque </h3>";
      print "<div class = 'text'>      <h3> Modele : $value->modele </h3>";
      print "<div class = 'text'>      <h3> Annee de sortie : $value->annee </h3>";
      print "<div class = 'text'>      <h3> Prix : $value->prix € </h3>";
    }

     ?>



  </body>
</html>
