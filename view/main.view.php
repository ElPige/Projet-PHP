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

    // for($i=0;$i<5;$i++){
    //   echo "<div class=\"annonces\" onclick=\"document.location='http://google.com'\">
    //     <a href='http://www.google.com'></a>
    //   </div>";
    // }
//var_dump($voiture);

    // for($i=0;$i<5;$i++){
    //   echo "<div class=\"annonces\" onclick=\"document.location='http://google.com'\">
    //     <a href='http://www.google.com'></a>
    //   </div>";
    // }


         foreach ($voiture as $key => $value) {
             $img = $key+1 . ".jpg";
             echo "<div class=\"annonces\" onclick=\"document.location='http://google.com'\">
                    <div class = 'img'><img src = \"../data/BD/Image/$img\"/></div>
                    <div class = 'text'><h3> $value->nom </h3>
                    <div class = 'text'><h3> $value->marque </h3>
                    <div class = 'text'><h3> $value->modele </h3>
                    <div class = 'text'><h3> $value->annee </h3>
               <a href='http://www.google.com'></a>
             </div>";
         }
  ?>
  </body>
</html>
