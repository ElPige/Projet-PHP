<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Car'Usell</title>
    <link rel="stylesheet" type="text/css" href="../view/design/main.view.css">
  </head>
  <body>
    <?php

    print "<h2> Annonces de voiture </h2>";

         print "<div class = 'contenair'>";

         foreach ($voiture as $key => $value) {
             print '<article id="voitures">';
              print "<div class = 'img'><a href=\"../controler/main.ctrl.php?annonce=$value->reference\"><img src = \"../data/BD/Image/$value->reference.jpg\"/></div>";
              print "<div class = 'text'> <h3> $value->nom </h3>";
              print "<div class = 'text'>      <h3> $value->marque </h3>";
              print "<div class = 'text'>      <h3> $value->modele </h3>";
              print "<div class = 'text'>      <h3> $value->annee </h3>";
             print '</article>';
         }
         print "</div>";
  ?>
  </body>
</html>
