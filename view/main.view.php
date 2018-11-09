<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Car'Usell</title>
    <link rel="stylesheet" type="text/css" href="../view/design/main.view.css">
  </head>
  <body>
    <nav id="header">
      <h2> Annonces de voiture Car'Usell </h2>
      <ul>
        <li><a href="news.asp">Marques</a></li>
          <li><a href="contact.asp">Modèle</a></li>
          <li><a href="contact.asp">Année</a></li>
          <li><a href="contact.asp">Rechercher</a></li>
        <li style="float:right"><a class="active" href="#about">Déposer une annonce</a></li>
      </ul>
    </nav>



    <div class = 'contenaire'>
    <?php


         foreach ($voiture as $key => $value) {
             print '<article id="voitures">';
              print "<div class = 'img'><a href=\"../controler/main.ctrl.php?annonce=$value->reference\"><img src = \"../data/BD/Image/$value->reference.jpg\"/></div>";
              print "<div class = 'text'> <h3> $value->nom </h3>";
              print "<div class = 'text'>      <h3> $value->marque </h3>";
              print "<div class = 'text'>      <h3> $value->modele </h3>";
              print "<div class = 'text'>      <h3> $value->annee </h3>";
              print "<div class = 'text'>      <h3> $value->prix € </h3>";
             print '</article>';
         }

  ?>

  </div>
  </body>
</html>
