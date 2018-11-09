<?php
require_once('Exceptions.php');
require_once('Voiture.php');


$dao = new DAO('/users/info/etu-s3/monteile/public_html/ProgWeb/Projet_PHP/DB/CARUSELL.db');

class DAO
{
  private $db;

  //CONSTRUCTEUR
  function __construct($dbPath)
  {
    try
    {
      $this->db = new PDO('sqlite:'. $dbPath);

    }
    catch(PDOException $e)
    {
      die('Erreur de connexion :' . $e->getMessage());
    }
  }
  //METHODES DE GESTION DE LA BDD
  /* Les fonctions d'ajouts d'entrées dans la BDD prennent en paramètre de véritables objets de classes
     Les fonctions de modification dans la BDD  prennent au choix où des objets, ou un tableau associatif avec les modifications,
     nomAttribut => modification
     Les fonctions retournant des données de la BDD vers des objets renvoies systématiquement des arrays */
  //methodes de gestionb des utilisateurs
  // ------------------------------------------------------------------------------------------------------------------------ //
  function ajouterMembre(Membre $membre)
  /*Ajoute un membre dans la BDD
  On vérifie que le membre n'est pas déja la base*/
  {
    //On prépare et execute la requete d'ajout du membre//
    $membre->preparerObjetBDD();
    $referenceActive = FALSE;
    //On vérifie si le membre à une référence, qu'elle n'est pas déja dans la base//
    if(!(is_null($membre->reference)))
    {
      $requete = 'SELECT reference FROM Membre WHERE reference = :reference';
      $stmt->prepare($requete);
      if(!$stmt)
      {
        throw new ErreurPreparationRequeteSql("La requete SQL $requete n\'a pas été preparée.");
      }
      $stmt->bindParam(':reference',$membre->reference);
      $stmt->execute();
      if(!$stmt)
      {
        throw new ErreurExecutionRequeteSql("La requete SQL $requete n\'a pas été executé.");
      }
      $results = $stmt->fetch();
      if(!$stmt)
      {
        throw new ErreurRecuperationRequeteSql("Le resultat de la  requete $requete n\'a pas pu être récupérer.");
      }
      else
      {
        if(isset($results['reference']))
        {
          throw new ErreurMembreExistantBDD("La reference Membre : $membre->reference existe déjé dans la BDD.");
        }
        else
        {
          $referenceActive = TRUE;
        }

      }


    }
    $requeteSql = '';
    if(!$referenceActive)
    {
      $requeteSql = 'INSERT INTO Membres (pseudo,nom,prenom,adresseMail,motDePasse) VALUES(:pseudo,:nom,:prenom,:adresseMail,:motDePasse)';
    }
    else
    {
      $requeteSql = 'INSERT INTO Membres (reference,pseudo,nom,prenom,adresseMail,motDePasse) VALUES(:reference,:pseudo,:nom,:prenom,:adresseMail,:motDePasse)';
    }
    $stmt = $this->db->prepare($requeteSql);
    if($stmt)
    {
      $stmt->bindParam(':pseudo',$membre->pseudo);
      $stmt->bindParam(':nom',$membre->nom);
      $stmt->bindParam(':prenom',$membre->prenom);
      $stmt->bindParam(':adresseMail',$membre->adresseMail);
      $stmt->bindParam(':motDePasse',$membre->motDePasse);
      if($referenceActive)
      {
        $stmt->bindParam(':reference',$membre->reference);
      }
      $stmt->execute();
      if(!$stmt)
      {
        throw new ErreurExecutionRequeteSql("La requete SQL $requeteSql n\'a pas été executé");
      }

    }
    else
    {
      throw new ErreurPreparationRequeteSql("Erreur lors de la préparation de la  requête SQL : $requeteSql");
    }

    //On récupère ensuite l'identifiant que l'on associe à l'objet membre dans le cas ou la reference n'était pas défini
    if(is_null($membre->reference))
    {
      $requeteSql = 'SELECT reference FROM Membres WHERE pseudo = :pseudo AND nom = :nom AND prenom = :prenom AND adresseMail = :adresseMail';
      $stmt = $this->db->prepare($requeteSql);
      if($stmt)
      {
        $stmt->bindParam(':pseudo',$membre->pseudo);
        $stmt->bindParam(':nom',$membre->nom);
        $stmt->bindParam(':prenom',$membre->prenom);
        $stmt->bindParam(':adresseMail',$membre->adresseMail);
        $stmt->execute();
        if(!$stmt)
        {
          throw new ErreurExecutionRequeteSql("La requete SQL $requeteSql n\'a pas été executé");
        }
        $results = $stmt->fetch();
        if(!$stmt)
        {
          throw new ErreurRecuperationRequeteSql("Impossible de mettre à jour la reference de  $membre->pseudo .");
        }
        else
        {
          $membre->reference = $results['reference'];

        }

      }
      else
      {
        throw new ErreurPreparationRequeteSql("Erreur lors de la préparation de la  requête SQL : $requeteSql");
      }

    }
  }

  function modifierProfilMembre($referenceMembre, array $modifs) //POur ajouter des modifications à un profil utilisateur avec un tableau
  //Les attributs doivent coconcordées avec les clées
  {
      //Vérifier les clées du tableaux des arrays
      //On vérifie si le membre existe dans la base

      foreach ($modifs as $key => $value)
      {
        if(strcmp($key,'adresseMail') || strcmp($key,'telephone') || strcmp($key,'motDePasse'))
        {
          $requete = 'UPDATE Membres  SET key = value WHERE reference = referenceMembre';
          switch($key)
          {
            case 'adresseMail' :
              $requeteSql = "UPDATE Membres  SET adresseMail = :value WHERE reference = :referenceMembre";
            break;
            case 'telephone' :
              $requeteSql = 'UPDATE Membres  SET telephone = :value WHERE reference = :referenceMembre';
            break;
            case 'motDePasse' :
              $requeteSql = 'UPDATE Membres  SET motDePasse = :value WHERE reference = :referenceMembre';
            break;
          }
          $stmt = $this->db->prepare($requeteSql);
          if($stmt) //On vérifie que la requête à bien pu être préparé
          {
            $stmt->bindParam(':referenceMembre',$referenceMembre);
            $stmt->bindParam(':value',$value);
            $stmt->execute();
            if(!$stmt)
            {
              throw new ErreurExecutionRequeteSql("La requete SQL $requete n\'a pas été executé");

            }
          }
          else
          {
            throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteSql");
          }

      }
    }
  }

  function supprimerMembre($referenceMembre)        //Supprime un membre, prend en paramètre soit sa reference, ou un membre. pas fini
  {
    //On vérifie que l'entrée est présente dans la BDD
    $requete = 'SELECT reference FROM Membres WHERE reference = :referenceMembre';
     $stmt = $this->db->prepare($requete);
     if(!$stmt)
     {
       throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");
     }
     $stmt->bindParam(':referenceMembre',$referenceMembre);
     $stmt->execute();
     if(!$stmt)
     {
       throw new ErreurExecutionRequeteSql("Impossible d\'executer la requête : $requete");
     }
     $results = $stmt->fetch();
     if(!isset($results['reference']))
     {
       throw new ErreurSupressionMembreBDD("Le membre $referenceMembre n\'existe pas");
     }
     $requete ='DELETE FROM Membres WHERE reference = :referenceMembre'; //On vérifie si le membre à des annonces
     $stmt = $this->db->prepare($requete);
     if(!$stmt)
     {
       throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");
     }
     if($stmt)
     {
       $stmt->bindParam(':referenceMembre',$referenceMembre);
       $stmt->execute();
       if(!$stmt)
       {
         throw new ErreurExecutionRequeteSql("La requete SQL $requete n\'a pas été executé");
       }

     }
     else {
       throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");
     }

  }


  function rechercherMembres(array $criteres) : array // Renvoi un tableau de membres correspondant aux critères choisies
  {
    //Vérifier les critères cad les clées du array
    $requete = '';
    $i = 1;
    foreach ($criteres as $attribut=> $valeur)
    {
      $requete .= 'SELECT  *  FROM Membres WHERE :attribut' . $i .  '= :valeur'.$i.  'INTERSECT';
      $i++;
    }
    $requete = substr($requete,0,strripos($requete,'INTERSECT')); // On enleve le intersect de trop...
    $stmt = $this->db->prepare($requete);
    if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");}
    $i = 1;
    foreach ($criteres as $attribut => $valeur)
    {
      $stmt->bindParam(':attribut'.$i,$attribut);
      $stmt->bindParam(':valeur'.$i,$valeur);
      $i++;
    }
    $stmt->execute();
    if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requete n\'a pas été exécuté.");}
    $result = $stmt->fectchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE);
    if(!$stmt){throw new ErreurRecuperationRequeteSql("Impossible de récupérer les résultats de la requête : $requete .");}
    return $results;
  }
  // ------------------------------------------------------------------------------------------------------------------------ //
  //methodes de gestion des annonces                                                                                          //
  // ------------------------------------------------------------------------------------------------------------------------ //
  function ajouterAnnonce(Annonce $annonce,Voiture $voiture) // On ajoute d'abord la voiture puis l'annonce dans la bdd
  {
    $annonce->preparerObjetBDD();
    $voiture->preparerObjetBDD();

    ajouterVoiture($voiture);
    //Vérifier si l'annonce contient un id
    if(isset($annonce->reference))
    {
      $requeteVerificationAnnonce = 'SELECT reference FROM Annonces WHERE reference = :reference';
      $stmt = $this->db->prepare($requeteVerificationAnnonce);
      if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteVerificationAnnonce");}
      $stmt->bindParam(':reference',$annonce->reference);
      $stmt->execute();
      if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteVerificationAnnonce n\'a pas été exécuté.");}
      $results = $stmt->fetch();
      if(!$stmt){throw new ErreurRecuperationRequeteSql("Le résultat de la requête SQL $requete n\'a pas été récupérer.");}
      if(isset($results['reference'])){throw new ErreurAnnonceExistanteBDD("L\'annonce $annonce->reference est déja référencé dans la BDD.");}
    }
    else
    $requeteAjoutAnnonce = 'INSERT INTO Annonces (referenceMembre,typeAnnonce,referenceVoiture,visibilite,prix,image)
    VALUES (:referenceMembre,:typeAnnonce,:referenceVoiture,:visibilite,:prix,:image)';
    $stmt = $this->db->prepare($requeteAjoutAnnonce);
    if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteAjoutAnnonce");}
    $stmt->bindParam(':referenceMembre',$annonce->referenceMembre);
    $stmt->bindParam(':referenceVoiture',$annonce->referenceVoiture);
    $stmt->bindParam(':visibilite',$annonce->visibilite);
    $stmt->bindParam(':prix',$annonce->prix);
    $stmt->bindParam(':image',$annonce->image);
    $stmt->execute();
    if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteAjoutAnnonce n\'a pas été exécuté.");}


  }

  function modifierAnnonce($referenceAnnonce, array $tableauModification) // En paramètre : la reference de l'annonce ,  et tableau associatif attribut=>valeur
  {
    //Vérifier reference des annonces
    $requeteVerificationAnnonce = 'SELECT reference FROM Annonces WHERE reference = :reference';
    $stmt = $this->db->prepare($requeteVerificationAnnonce);
    if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteVerificationAnnonce");}
    $stmt->bindParam(':referenceAnnonce',$referenceAnnonce);
    $stmt->execute();
    if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteVerificationAnnonce n\'a pas été exécuté.");}
    $results = $stmt->fetch();
    if(!$stmt){throw new ErreurRecuperationRequeteSql("La requête SQL $requeteVerificationAnnonce n\'a pas été exécuté.");}
    if(!isset($result['reference'])){throw new ErreurModificationAnnonceBDD("L\'annonce $referenceAnnonce n\'existe pas dans la BDD.");}
    foreach ($tableauModification as $attribut => $valeur)
    {
        $requeteModificationAnnonce = 'UPDATE Annonces SET :attribut = :valeur  WHERE reference = :referenceAnnonce';
        $stmt = $this->db->prepare($requeteModificationAnnonce);
        if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteModificationAnnonce");}
        $stmt->bindParam(':referenceAnnonce',$referenceAnnonce);
        $stmt->bindParam('attribut',$attribut);
        $stmt->bindParam(':valeur',$valeur);
        $stmt->execute();
        if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteModificationAnnonce n\'a pas été exécuté.");}
    }

  }

  function archiverAnnonce($referenceAnnonce)
  {
    $modifs = array( 'etatAnnonce' => 'ARCHIVE', 'visibilite' => 'FALSE');
    modifierAnnonce($referenceAnnonce,$modifs);
  }

  function rechercherAnnonces(array $criteres) : array
  {
        //Verifier les critères
        $requete = '';
        $i = 1;
        foreach ($criteres as $attribut=> $valeur)
        {
          $requete .= 'SELECT  *  FROM Annonces WHERE :attribut' . $i .  '= :valeur'.$i.  'INTERSECT';
          $i++;
        }
        $requete = substr($requete,0,strripos($requete,'INTERSECT')); // On enleve le intersect de trop...
        $stmt = $this->db->prepare($requete);
        if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");}
        $i = 1;
        foreach ($criteres as $attribut => $valeur)
        {
          $stmt->bindParam(':attribut'.$i,$attribut);
          $stmt->bindParam(':valeur'.$i,$valeur);
        }
        $stmt->execute();
        if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requete n\'a pas été exécuté.");}
        $result = $stmt->fectchAll();
        if(!$stmt){throw new ErreurRecuperationRequeteSql("Impossible de récupérer les résultats de la requête : $requete .");}
        return $results;


  }

  function supprimerAnnonce($referenceAnnonce) //La fonction supprimerAnnonce s'occupe de supprimer proprement une annonce, càd la voiture et l'annonce
  {
    $annonce = rechercherAnnonces(array('reference' => $referenceAnnonce));
    if(!isset($annonce)){throw new ErreurSuppressionAnnonceBDD("Impossible de supprimer l\'annonce $referenceAnnonce");}
    $requeteSuppressionAnnonce = 'DELETE * FROM Annonces WHERE reference = :referenceAnnonce';
    //ON supprime pas la voiture associé au trigger ici le trigger s'en charge
    $stmt = $this->db->prepare($requeteSql);
    if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteSuppressionAnnonce");}
    $stmt->bindParam(':referenceAnnonce',$referenceAnnonce);
    //Vérifier ici que la voiture existe avec la méhtode rechercher voitures
    $stmt->execute();
    if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteSuppressionAnnonce n\'a pas été exécuté.");}

  }

  function getAnnonce($referenceAnnonce)
  {
   $requete = 'SELECT  *  FROM Annonces WHERE reference = :reference ';
   $stmt = $this->db->prepare($requete);
   if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");}
   $stmt->bindParam(':reference',$referenceAnnonce);
   $stmt->execute();
   if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeten\'a pas été exécuté.");}
   $result = $stmt->fetch(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE);
   if(!$stmt){throw new ErreurRecuperationRequeteSql("Impossible de récupérer les résultats de la requête : $requete.");}
   return $result;
  }
  // ------------------------------------------------------------------------------------------------------------------------ //
  //Methodes de gestion de la messagerie utilisateurs
  // ------------------------------------------------------------------------------------------------------------------------ //
  function envoyerMessageMembre($referenceMembreSource,$referenceMembreDest,$contenu,$objet)
  {
    $membreSource = rechercherMembres(array('reference' => $referenceMembreSource));
    $membreDest =   rechercherMembres(array('reference' => $referenceMembreDest));
    if(!(isset($membreSource) || isset($membreDest))){throw new ErreurMembreIntrouvableBDD("$membreSource ou $membreDest est introuvable dans la BDD.");}
    $requeteSql = 'INSERT INTO Messages (reference,referenceMembreSource,referenceMembreDestinataire,contenu,objet)
    VALUES(:reference,:referenceMembreSource,:referenceMembreDestinataire,:contenu,:objet)';
    $stmt = $this->db->prepare($requeteSql);
    if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteSql");}
    $stmt->bindParam(':referenceMembreSource',$referenceMembreSource);
    $stmt->bindParam(':referenceMembreDestinataire',$referenceMembreDest);
    $stmt->bindParam(':contenu',$contenu);
    $stmt->bindParam(':objet',$objet);
    $stmt->bindParam(':reference',$reference);
    $stmt->execute();
    if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteSqln\'a pas été exécuté.");}
  }

  function obtenirMessagesMembre($referenceMembre)
  {
    $membre = rechercherMembres(array('reference' => $referenceMembre));
    if(!isset($membre)){throw new ErreurMembreIntrouvableBDD("$referenceMembre introuvable.");}
    $requeteSql = 'SELECT * FROM MesMessage(:referenceMembre)';
    $stmt = $this->db->prepare($requeteSql);
    if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteSql");}
    $stmt->bindParam(':referenceMembre',$referenceMembre);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteSqln\'a pas été exécuté.");}
    return $results;

  }


// ------------------------------------------------------------------------------------------------------------------------ //
//Methodes de gestions concernant les voitures
// ------------------------------------------------------------------------------------------------------------------------ //
function obtenirVoitures(array $criteres)
{
  //Verifier les critères
  $requete = '';
  $i = 1;
  foreach ($criteres as $attribut=> $valeur)
  {
    $requete .= 'SELECT  *  FROM Voitures WHERE :attribut' . $i .  '= :valeur'.$i.  'INTERSECT';
    $i++;
  }
  $requete = substr($requete,0,strripos($requete,'INTERSECT')); // On enleve le intersect de trop...
  $stmt = $this->db->prepare($requete);
  if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requete");}
  $i = 1;
  foreach ($criteres as $attribut => $valeur)
  {
    $stmt->bindParam(':attribut'.$i,$attribut);
    $stmt->bindParam(':valeur'.$i,$valeur);
    $i++;
  }
  $stmt->execute();
  if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requete n\'a pas été exécuté.");}
  $result = $stmt->fectchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE);
  if(!$stmt){throw new ErreurRecuperationRequeteSql("Impossible de récupérer les résultats de la requête : $requete .");}
  return $results;
}

function supprimerVoiture($referenceVoiture)
{
  $requeteSql = 'DELETE * FROM Voiture WHERE reference = :referenceVoiture ';
  $stmt = $this->db->prepare($requeteSql);
  if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteSql");}
  $stmt->bindParam(':referenceVoiture',$referenceVoiture);
  $stmt->execute();
  if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteSql n\'a pas été exécuté.");}

}

function ajouterVoiture( Voiture $voiture)
{

  $voiture->preparerObjetBDD();
  $referenceActive = is_null($voiture->reference);
  //CHECKER SI LA REF EST DANS LA BDD
  $requeteAjoutVoiture = '';
  if(!$referenceActive)
  {
    $requeteAjoutVoiture = 'INSERT INTO Voitures (marque,modele,annee,kilometrage,typeVoiture,typeCarburant,datePremiereImmatriculation)
    VALUES (:marque,:modele,:annee,:kilometrage,:typeVoiture,:typeCarburant,:datePremiereImmatriculation)';

  }
  else
  {
    $requeteAjoutVoiture = 'INSERT INTO Voitures (reference,marque,modele,annee,kilometrage,typeVoiture,typeCarburant,datePremiereImmatriculation)
    VALUES (:reference,:marque,:modele,:annee,:kilometrage,:typeVoiture,:typeCarburant,:datePremiereImmatriculation)';
  }

  $stmt = $this->db->prepare($requeteAjoutVoiture);
  if($stmt)
  {
    $stmt->bindParam(':marque',$voiture->marque);
    $stmt->bindParam(':modele',$voiture->modele);
    $stmt->bindParam(':annee',$voiture->annee);
    $stmt->bindParam(':kilometrage',$voiture->kilometrage);
    $stmt->bindParam(':typeVoiture',$voiture->typeVoiture);
    $stmt->bindParam(':typeCarburant',$voiture->typeCarburant);
    $stmt->bindParam(':datePremiereImmatriculation',$voiture->datePremiereImmatriculation);
    if($referenceActive)
    {
      $stmt->bindParam(':reference',$voiture->reference);
    }
    $stmt->execute();
    if(!$stmt)
    {
       throw new ErreurExecutionRequeteSql("La requete SQL $requeteSql n\'a pas été exécuté.");
    }

  }
  else
  {
    throw new ErreurPreparationRequeteSql("La requete SQL $requeteSql n\'a pas été préparé.");
  }

  if(is_null($voiture->reference))
  {
    $requeteSql = 'SELECT reference FROM Voiture WHERE reference = :reference';
    $stmt = $this->db->prepare($requeteSql);
    if($stmt)
    {
      $stmt->bindParam(':reference',$voiture->reference);
      $stmt->execute();
      if(!$stmt)
      {
        throw new ErreurExecutionRequeteSql("La requete SQL $requeteSql n\'a pas été executé");
      }
      $results = $stmt->fetch();
      if(!$stmt)
      {
        throw new ErreurRecuperationRequeteSql("Impossible de mettre à jour la reference de  $voiture->marque $voiture->modele $voiture->annee .");
      }
      else
      {
        $voiture->reference = $results['reference'];

      }

    }
    else
    {
      throw new ErreurPreparationRequeteSql("Erreur lors de la préparation de la  requête SQL : $requeteSql");
    }

  }
}


function modifierVoiture($referenceVoiture,array $tableauModification)
{
  //Vérifier reference des annonces
  $requeteVerificationVoiture = 'SELECT reference FROM Voiture WHERE reference = :reference';
  $stmt = $this->db->prepare($requeteVerificationVoiture);
  if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteVerificationVoiture");}
  $stmt->bindParam(':referenceAnnonce',$referenceVoiture);
  $stmt->execute();
  if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteVerificationVoiture n\'a pas été exécuté.");}
  $results = $stmt->fetch();
  if(!$stmt){throw new ErreurRecuperationRequeteSql("La requête SQL $requeteVerificationVoiture n\'a pas été exécuté.");}
  if(!isset($result['reference'])){throw new ErreurModificationAnnonceBDD("L\'annonce $referenceVoiture n\'existe pas dans la BDD.");}
  foreach ($tableauModification as $attribut => $valeur)
  {
      $requeteModificationVoiture = 'UPDATE Voiture SET :attribut = :valeur  WHERE reference = :referenceAnnonce';
      $stmt = $this->db->prepare($requeteModificationVoiture);
      if(!$stmt){throw new ErreurPreparationRequeteSql("Impossible de préparer la requête : $requeteModificationVoiture");}
      $stmt->bindParam(':referenceAnnonce',$referenceVoiture);
      $stmt->bindParam('attribut',$attribut);
      $stmt->bindParam(':valeur',$valeur);
      $stmt->execute();
      if(!$stmt){throw new ErreurExecutionRequeteSql("La requête SQL $requeteModificationVoiture n\'a pas été exécuté.");}
  }
}


function getVoiture() {
         $requete = "SELECT * FROM Voiture";
         $query=($this->db)->query($requete);
         $result =$query->fetchAll(PDO::FETCH_CLASS,"Voiture");
         return $result;
       }


};
?>
