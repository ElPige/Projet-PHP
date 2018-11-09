<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body>
    <div class="Inscription">
      <h1>Inscription </h1>

   <form method="post" action="../controler/inscription.ctrl.php" enctype="multipart/form-data">

   <fieldset><legend>Identifiants</legend>
   <label for="pseudo"> Pseudo * :</label>  <input name="pseudo" type="text" id="pseudo" required/> (le pseudo doit contenir entre 3 et 15 caractères)<br />
   <label for="password"> Mot de passe * :</label><input type="password" name="password" id="password" required/>
   </fieldset>

   <fieldset><legend>Données personnelles</legend>
   <label for="Nom"> Nom * :</label><input type="text" name="Nom" id="Nom" required/><br />
   <label for="Prénom"> Prénom :</label><input type="text" name="Prénom" id="Prénom" required/><br />
   </fieldset>


   <fieldset><legend>Contacts</legend>
   <label for="email"> Votre adresse Mail * :</label><input type="text" name="email" id="email" required/><br />
   <label for="tel"> Votre téléphone * :</label><input type="text" name="tel" id="tel" required/><br />
   </fieldset>

   <p>Les champs suivis d'un * sont obligatoires</p>
    <input type="checkbox" name="conditions" value="0" checked="false" />J'accepte les conditions d'utilisateur *<br>
   <p><input type="submit" value="S'inscrire" /></p></form>

   </div>


  </body>
</html>
