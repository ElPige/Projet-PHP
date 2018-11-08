<?php

 include_once("../model/DAO.php");
 $voiture=$dao->getVoiture();

include("../view/main.view.php");

?>
