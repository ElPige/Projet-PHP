<?php
$config = parse_ini_file('../../config/config.ini',true);
require('DAO.php');
require_once('../../model/class/Membre.php');
require_once('../../model/class/Annonce.php');
require_once('../../model/class/Message.php');
require_once('../../model/class/Voiture.php');
$dao = new DAO($config['controler']['DB_PATH']);
class testDao
{
  private $log = null;
  private $dao = null;
   function __construct($dbPath)
  {
    $dao = new DAO($dbPath);
  }

  function writeEvent($event)
  {
    if(!isset($log))
    {
      $log = fopen('log.txt','w+');
      fseek($log, 0);
    }
    fprintf($log,$event);

  }



  function testBDDMembres()
  {
    $membre = new Membre(array('pseudo' => 'arklash', 'prenom' => 'Thierry',
    'nom' => 'Feuilley', 'adresseMail' => 't.feuilley@gmail.com' , 'motDePasse' => 'thierry11'));
    $this->writeEvent('ajout d\'un membre : ');
    $membre_log = print_r($membre, true);
    $this->writeEvent($membre_log);
    $this->writeEvent('\n');
    try
    {
      $dao->ajouterMembre($membre);

    }
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurMembreExistantBDD $e){$this->writeEvent($e->getMessage().'\n');}
    $this->writeEvent('Etat final de l\'objet :');
    $membre_log = print_r($membre, true);
    $this->writeEvent($membre_log);
    $this->writeEvent('\n');
    $this->writeEvent('Modification profil membre : ');
    $this->writeEvent($membre_log);
    $this->writeEvent($modificationMembre);
    $modificationMembre= array('motDePasse' => '11111111', 'adresseMail' => 'mail@mail.fr', 'telephone' => '0606060606');
    try
    {
      $dao->modifierProfilMembre($modificationMembre);
    }
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurMembreExistantBDD $e){$this->writeEvent($e->getMessage().'\n');}
    $this->writeEvent('recherche du membre : ' );
    $this->writeEvent($this->writeEvent($membre_log).' dans la BDD avec sa reference.');
    try
    {$membreRecupererBDD = $dao->rechercherMembres(array('reference' => $membre->reference));}
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurRecuperationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    $this->writeEvent('\nResulatRecherche : ');
    $resultats_log = print_r($membreRecupererBDD,true);
    $this->writeEvent($resultats_log);
    $this->writeEvent('Premiere tentative suppression membre : ');
    $membre_log = print_r($membre, true);
    $this->writeEvent($membre_log.'\n');
    try{$dao->supprimerMembre($membre->reference);}
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurSupressionMembreBDD $e){$this->writeEvent($e->getMessage().'\n');}
    $this->writeEvent('Seconde Tentative suppression membre : ');
    try{$dao->supprimerMembre($membre->reference);}
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurSupressionMembreBDD $e){$this->writeEvent($e->getMessage().'\n');}

  }

  function testBDDAnnonces()
  {
    $this->writeEvent('Creation d\'un membre et d\'une annonce: ');
    $membre = new Membre(array('pseudo' => 'azerty123', 'nom' => 'Roach' , 'prenom' => 'Bernard' , 'motDePasse' => 'wxcvbn123' , 'reference' => 2560));
    $membre_log = print_r($membre, true);
    $this->writeEvent($membre_log);
    $this->writeEvent('Creation Membre : ');
    $this->writeEvent($membre_log.'\n');

    $voiture = new Voiture(array('reference' => 999, 'marque' => 'Renault' , 'modele' => 'Clio' , 'annee' => 2018 ,
     'kilometrage' => 100000 , 'typeVoiture' => 'Familiale', 'typeCarburant' => 'DIESEL'));
    $voiture_log = print_r($voiture,true);
    $this->writeEvent('Creation d\'une voiture :');
    $this->writeEvent($voiture_log.'\n');
    $annonce = new Annonce(array('reference' => 222, 'referenceMembre' => 2560, 'typeAnnonce' => 'VENTE', 'ville' => 'Toulouse', 'referenceVoiture' => 999 , 'prix' => 7000));
    $annonce_log = print_r($annonce,true);
    $this->writeEvent('Creation d\'une annonce : ');
    $this->writeEvent($annonce_log.'\n');
    $this->writeEvent('Tentative d\'ajout du membre cree : ');
    try{$dao->ajouterMembre($membre);}
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurMembreExistantBDD $e){$this->writeEvent($e->getMessage().'\n');}
    $this->writeEvent('Tentative d\'ajout de l\'annonce 222 \n');
    try{$dao->ajouterAnnonce($annonce);}
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurMembreExistantBDD $e){$this->writeEvent($e->getMessage().'\n');}
    $this->writeEvent('Tentative de modification de la voiture 999.\n');
    try{$dao->modifierVoiture(999,array('referenceAnnonce' => 222 ));}
    catch(ErreurPreparationRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurExecutionRequeteSql $e){$this->writeEvent($e->getMessage().'\n');}
    catch(ErreurMembreExistantBDD $e){$this->writeEvent($e->getMessage().'\n');}

  }






};


?>
