<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Car'Usell</title>
  </head>
  <body>
    <?php
    print "<h2> Annonces de voiture </h2>";
    print '</br>';
    print "<div class = 'conteneur'>";
        foreach ($voiture as $key => $value) {
            print "<div class = 'img'><img src = \"../data/BD/$value->image\"/></div>";
            print "<div class = 'text'><h3> $value->nom </h3>";
            print "<div class = 'text'><h3> $value->marque </h3>";
            print "<div class = 'text'><h3> $value->modele </h3>";
            print "<div class = 'text'><h3> $value->annee </h3>";

        }
        print "</div>";
  ?>
  </body>
</html>