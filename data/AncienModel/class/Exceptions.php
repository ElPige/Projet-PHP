<?php
/*.............................................................*/
//EXECEPTIONS REQUETES SQL
/*.............................................................*/
class ErreurPreparationRequeteSql extends Exception
{

  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};

class ErreurExecutionRequeteSql extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};

class ErreurRecuperationRequeteSql extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};
/*.............................................................*/
//EXCEPTIONS  DONNEES BDD
/*.............................................................*/

//Exceptions données existantes BDD
class ErreurMembreExistantBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};

class ErreurAnnonceExistanteBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};

class ErreurVoitureExistanteBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurMessageExistantBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};


//Exceptions erreurs de modifications BDD
class ErreurModificationMembreBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};

class ErreurModificationAnnonceBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};



class ErreurModificationVoitureBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};

class ErreurModificationMessageBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }

};



//Exceptions erreurs de suppression BDD
class ErreurSuppressionVoitureBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurSuppressionAnnonceBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurSupressionMembreBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurSupressionMessageBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

/*.............................................................*/
//Exceptions de UserManager
/*.............................................................*/


/*.............................................................*/
//Exceptions de AnnounceManager
/*.............................................................*/


/*.............................................................*/
//Exceptions des classes de modèles de données
/*.............................................................*/
class ErreurAnnonceInvalide extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurMembreInvalide extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurMessageInvalide extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurVoitureInvalide extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

//Erreurs uplets introuvables dans la BDD

class ErreurVoitureIntrouvableBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurAnnonceIntrouvableBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurMessageIntrouvableBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

class ErreurMembreIntrouvableBDD extends Exception
{
  public function __construct($message,$code = 0)
  {
    parent::__construct($message,$code);
  }

  public function __toString()
  {
    return $this->message;
  }
};

?>
