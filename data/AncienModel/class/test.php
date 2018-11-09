<?php
require_once('Membre.php');
$config = parse_ini_file('../../config/config.ini',true);
require_once('DAO.php');
$membre = new Membre(array('pseudo' => 'arklash', 'prenom' => 'Thierry',
'nom' => 'Feuilley', 'adresseMail' => 't.feuilley@gmail.com' , 'motDePasse' => 'thierry11'));

 ?>
