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
    foreach ($acoustique as $key => $value) {
      print '<article id="guitares">';
      // si l'utilisateur est connecté alors il a la possibilité d'ajouter des produits à ses favoris en cliquant sur l'image
      if (isset($_SESSION['pseudo'])){
          print "<div class = 'img'><a href=\"../controler/ajoutProduit.ctrl.php?categorie=acoustique&id=$value->id\"><img src = \"../data/BD/$value->img\"/></a></div>";
      }
      else{
          print "<div class = 'img'><img src = \"../data/BD/$value->img\"/></div>";
      }
        print "<div class = 'text'><h3> $value->nom </h3>";
        if($value->electroacoustique =='oui'){
          print "<p> Electro-Acoustique <p>";
        }
        print "<p> • Prix : $value->prix  </p></div>";
      print '</article>';
    }
    print "</div>";
  ?>
  </body>
</html>
