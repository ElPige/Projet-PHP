<?php
require_once('Exceptions.php');
  class Membre //Faut regarder comment se comporte les BDD avec les refenrences
  {
    public $reference =NULL;
    public $pseudo = '';
    public $nom = '';
    public $prenom = '';
    public $adresseMail ='';
    public $telephone;
    public $dateInscription;
    public $motDePasse = '';

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

    public function preparerObjetBDD() //Modifier les champs pour qu'ils correspondent aux contraintes de la BDD
    {

      if(!(isset($this->pseudo)  || isset($this->nom)  || isset($this->prenom) || isset($this->adresseMail) || isset($this->motDePasse)))
      {
        throw new ErreurMembreInvalide('Member has required fields undefined.');
      }

      if(!(is_string($this->pseudo) || is_string($this->nom) || is_string($this->prenom) || is_string($this->adresseMail) ||  is_string($this->motDePasse)))
      {
        throw new ErreurMembreInvalide('Member has wrong data fields.');
      }

      if(strlen($this->pseudo) > 30) $this->pseudo = substr($this->pseudo,0,30);
      if(strlen($this->nom) > 30) $this->reference = substr($this->nom,0,30);
      if(strlen($this->prenom) >30) $this->prenom = substr($this->prenom,0,30);
      if(strlen($this->adresseMail) > 30) $this->adresseMail = substr($this->adresseMail,0,30);


    if(isset($this->reference))
    {
      if(!is_integer($this->reference))
      {
        throw new ErreurMembreInvalide('Member has wrong data fields.');
      }
    }
    if(isset($this->telephone))
    {
      if(!is_string($this->telephone))
      {
        throw new ErreurMembreInvalide('Member has wrong data fields.');
      }
    }
  }

  };

 ?>
