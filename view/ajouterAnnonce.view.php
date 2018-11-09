<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="Inscription">
      <h1>Inscription </h1>

   <form method="post" action="../controler/main.ctrl.php" enctype="multipart/form-data">

   <fieldset><legend>Créer une annonce</legend>
   <label for="Titre"> Titre * :</label>  <input name="pseudo" type="text" id="Titre" required/><br />
   <label for="Descriptif"> Descriptif * :</label><textarea name="Descriptif" rows="8" cols="80" required></textarea>
   </fieldset>

   <fieldset><legend>Données voiture</legend>
   <label for="nom"> Nom * :</label><input type="text" name="nom" id="nom" required/><br />
   <label for="marque"> Marque * :</label><input type="text" name="marque" id="marque" required/><br />
   <label for="Modèle"> Modèle * :</label><input type="text" name="Modèle" id="Modèle" required/><br />
   <label for="Année"> Année * :</label><input type="text" name="Année" id="Année" required/><br />
   <label for="Prix"> Prix * :</label><input type="text" name="Prix" id="Prix" required/><br />
   </fieldset>

   <p>Les champs suivis d'un * sont obligatoires</p>
   <p><input type="submit" value="Poster l'annonce" /></p></form>

   </div>
  </body>
</html>
