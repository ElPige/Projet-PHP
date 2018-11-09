<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page d'accueil</title>
    <link rel="stylesheet" type="text/css" href="../view/design/accueil.view.css">
  </head>
  <body>
    <header>


      <link rel="stylesheet" type="text/css" href="css/accueil.css">
    </header>
    <div class="Descriptif">
      <h1>CAR'USELL</h1>
      <p>Bonjour nous sommes un site de partage de vente de voitures. Merci de nous faire confiance et de poster des annonces sur notre site.</p>
    </div>

    <div class="Connection/Inscription">
      <h2>CONNNECTEZ VOUS</h2>
      <fieldset>
      <legend align="left"><div id="fieldtitre"> Connexion</div></legend>
        <form class="" action="accueil.ctrl.php" method="post">
            Adresse email <input name="mail" type="text" size=25 > <br>
            Mot de passe <input name="mdp" type="password" size=25> <br>
            <input type="submit" value="Connexion"/>
        </form>
        </p>


      </fieldset>

      <a href="../controler/inscription.ctrl.php"> S'inscrire</a>
    </div>


    <footer>

      <a href="https://www.google.com/intl/fr_fr/about/?utm_source=google.com&utm_medium=referral&utm_campaign=hp-footer&fg=1">Contactez nous</a>
      <a href="https://www.google.com">Qui sommes-nous ?</a>
    </footer>
  </body>
</html>
