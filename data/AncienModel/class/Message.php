<?php
require_once('Exceptions.php');
class Message
{
  public $reference;
  public $referenceMembreSource;
  public $referenceMessageDestinataire;
  public $dateEnvoi;
  public $objet;
  public $contenu;


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
    if(!isset($this->referenceMembreDestinateur) || !isset($this->referenceMembreDestinateur) || !isset($this->dateEnvoi) || !isset($this->objet) || !isset($this->contenu))
    {
      throw new ErreurMessageInvalide('Message has required fields undefined.');
    }
    if(!is_integer($this->referenceMembreSource) || !is_integer($this->referenceMembreDestinataire) || !is_string($this->dateEnvoi) || !is_string($this->objet) || is_string($this->contenu))
    {
      throw new ErreurMessageInvalide('Message has wrong data on fields.');
    }
    //On tronque les chaines pour ne pas avoir de pb avec la base de données
    $this->objet = substr($this->objet,0,100);
    $this->contenu = substr($this->contenu,0,500);


  if(isset($this->objet))
  {
    if(!is_string($this->objet))
    {
      throw new ErreurMessageInvalide('Message has wrong data on fields.');
    }
  }
  if(isset($this->contenu))
  {
    if(!is_string($this->contenu))
    {
      throw new ErreurMessageInvalide('Message has wrong data on fields.');
    }
  }
  }
};
?>
