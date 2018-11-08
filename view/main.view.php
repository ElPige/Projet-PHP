<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Car'Usell</title>
    <link rel="stylesheet" type="text/css" href="../view/css/main.view.css">
  </head>
  <body>
    <?php

    print "<h2> Annonces de voiture </h2>";
    // print '</br>';
    // print "<div class = 'conteneur'>";

<<<<<<< HEAD
    // for($i=0;$i<5;$i++){
    //   echo "<div class=\"annonces\" onclick=\"document.location='http://google.com'\">
    //     <a href='http://www.google.com'></a>
    //   </div>";
    // }
//var_dump($voiture);
=======
    for($i=0;$i<5;$i++){
      echo "<div class=\"annonces\" onclick=\"document.location='http://google.com'\">
        <a href='http://www.google.com'></a>
      </div>";
    }
>>>>>>> 2b9d1d618e753ebf783d79ae756bfc65637a675d

        $i=1;
         foreach ($test as $voiture) {
             //var_dump($value);
             print "<div class = 'img'><img src = \"../data/BD/image/$i\"/></div>";
             // print "<div class = 'text'><h3> $value->nom </h3>";
             // print "<div class = 'text'><h3> $value->marque </h3>";
             // print "<div class = 'text'><h3> $value->modele </h3>";
             // print "<div class = 'text'><h3> $value->annee </h3>";
            $i++;

<<<<<<< HEAD
=======
         foreach ($voiture as $key => $value) {
             $img = $key+1 . ".jpg";
             print "<div class = 'img'><img src = \"../data/BD/Image/$img\"/></div>";
             print "<div class = 'text'><h3> $value->nom </h3>";
             print "<div class = 'text'><h3> $value->marque </h3>";
             print "<div class = 'text'><h3> $value->modele </h3>";
             print "<div class = 'text'><h3> $value->annee </h3>";

>>>>>>> 2b9d1d618e753ebf783d79ae756bfc65637a675d
         }
         print "</div>";
  ?>
  </body>
</html>
