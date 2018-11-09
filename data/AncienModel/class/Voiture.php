<?php
require_once('Exceptions.php');
class Voiture
{
  public $reference;
  public $marque;
  public $modele;
  public $annee;
  public $kilometrage;
  public $puissance;
  public $typeVoiture;
  public $typeCarburant;
  public $datePremiereImmatriculation;
  public $commentaire;
  public $image;

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

  function preparerObjetBDD()
  {
    //On teste les attriubts nécéssaire pour la création de l'objet
    //On vérifie que chacun des attributs soient définies
    if(!(isset($this->marque) || !isset($this->modele) || !isset($this->annee) || !isset($this->kilometrage) || !isset($this->typeVoiture) ||
    !isset($this->typeCarburant)))
    {
      throw new ErreurVoitureInvalide('Voiture : Required fields are undefined');
    }
    //On vérifie que chacun des attributs aient le bon type
    if(!is_string($this->marque) || !is_string($this->modele) || !is_string($this->typeCarburant) || !is_string($this->typeVoiture) || !is_integer($this->kilometrage) ||
    !is_integer($this->annee))
    {
      throw new ErreurVoitureInvalide('Voiture : Wrong data on fields.');
    }
    //On vérifie un à un les paramètres optionnelles
    if(isset($this->reference))
    {
      if(!is_integer($this->reference))
      {
        throw new ErreurVoitureInvalide('Voiture : Wrong data on field :  reference');
      }
    }
    if(isset($this->referenceAnnonce))
    {
      if(!is_integer($this->referenceAnnonce))
      {
        throw new ErreurVoitureInvalide('Voiture : Wrong data on field : referenceAnnonce');
      }
    }
    if(isset($this->commentaire))
    {
      if(!is_string($this->commentaire))
      {
        throw new ErreurVoitureInvalide('Voiture : Wrong data on field : commentaire');
      }
    }
    if(isset($this->image))
    {
      if(!is_string($this->image))
      {throw new ErreurVoitureInvalide('Voiture : Wrong data on field :image');}
    }
    if(isset($this->datePremiereImmatriculation))
    {
      if(!is_string($this->datePremiereImmatriculation)){throw new ErreurVoitureInvalide('Voiture : Wrong data on field :image');}
    }

  }
};
?>
