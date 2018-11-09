<?php
require_once('Exceptions.php');
class Annonce
{
  public $reference;
  public $referenceMembre;
  public $typeAnnonce;
  public $datePublicationAnnonce; //YYYY-MM-DD HH:MM:SS Pas compris comment fonctionne les expressions régulières avec php
  public $dateExpirationAnnonce; //YYYY-MM-DD HH:MM:SS
  public $referenceVoiture;
  public $ville;
  public $etatAnnonce;
  public $visibiliteAnnonce;
  public $prix;
  public $image;
  //private $regex = '\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}';

  public function __construct(array $attributs=null)
  {
    if($attributs == null) return;
    if(is_array($attributs) && !empty($attributs))
    {
      foreach ($attributs as $key => $value)
      {
        if(isset($this->$key))	$this->$key = $value;

      }
    }


  }

  function preparerObjetBDD() //Modifier les champs pour qu'ils correspondent aux contraintes de la BDD
  {
    if((!isset($this->ville) ||  !isset($this->typeAnnonce)  || !isset($this->referenceMembre) || !isset($this->prix)))
    {
      throw new ErreurAnnonceInvalide('Annonce have required fields undefined.');
    }

    if(($this->typeAnnonce != 'LOCATION' ||  $this->typeAnnonce != 'VENTE') ||  ($this->etatAnnonce != 'ACTIVE' || $this->etatAnnonce != 'ARCHIVE'))
    {
      throw new ErreurAnnonceInvalide('Wrong fields for Annonce.');
    }
    if($this->etatAnnonce == 'ARCHIVE')
    {
      $this->visibiliteAnnonce == FALSE;
    }
    if(!(is_integer($this->reference) || is_integer($this->referenceMembre)))
    {
      throw new ErreurAnnonceInvalide('references are wrong');
    }
    if(!(is_string($this->typeAnnonce) ||is_string($this->ville) || is_string($this->commentaire)))
    {
      throw new ErreurAnnonceInvalide('Wrong data on field(s).');
    }
    if(!(is_integer(prix))){throw new ErreurAnnonceInvalide('Wrong fields for Annonce');}
    // On tronque les caractères supplémentaires
    $this->typeAnnonce = substr($this->typeAnnonce,0,30);
    $this->ville = substr($this->ville,0,30);

    if(isset($this->image))
    {
      if(!is_string($this->image))
      {
        throw new ErreurAnnonceInvalide('Wrong data on field(s).');
      }
    }

  }



};

?>
