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

      print "<div class = 'img'><img src = \"../data/BD/Image/$annoncev->reference.jpg\"/></div>";
      print "<div class = 'text'> <h3> Nom : $annoncev->nom </h3>";
      print "<div class = 'text'>      <h3> Marque : $annoncev->marque </h3>";
      print "<div class = 'text'>      <h3> Modele : $annoncev->modele </h3>";
      print "<div class = 'text'>      <h3> Annee de sortie : $annoncev->annee </h3>";
      print "<div class = 'text'>      <h3> Prix : $annoncev->prix € </h3>";

      print "<div class = 'text'> <h3> Nom annonceur : $m->nom </h3>";
      print "<div class = 'text'>      <h3> Prenom annonceur : $m->prenom </h3>";
      print "<div class = 'text'>      <h3> Contact : </h3>";
      print "<div class = 'text'>      <h3> Mail : $m->email </h3>";
      print "<div class = 'text'>      <h3> Telephone : $m->telephone </h3>";

     ?>



  </body>
</html>
