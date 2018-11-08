<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body>
    <div class="Inscription">
      <h1>Inscription 1/2</h1>

   <form method="post" action="../index.php" enctype="multipart/form-data">

   <fieldset><legend>Identifiants</legend>
   <label for="pseudo"> Pseudo * :</label>  <input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)<br />
   <label for="password"> Mot de Passe * :</label><input type="password" name="password" id="password" /><br />
   <label for="confirm"> Confirmer le mot de passe * :</label><input type="password" name="confirm" id="confirm" />
   </fieldset>

   <fieldset><legend>Contacts</legend>
   <label for="email"> Votre adresse Mail * :</label><input type="text" name="email" id="email" /><br />
   <label for="telephone"> Votre téléphone :</label><input type="text" name="tel" id="tel" /><br />
   </fieldset>
   <p>Les champs suivis d'un * sont obligatoires</p>
    <input type="checkbox" name="conditions" value="0" checked="false" />J'accepte les conditions d'utilisateur *<br>
   <p><input type="submit" value="S'inscrire" /></p></form>

   </div>


  </body>
</html>
