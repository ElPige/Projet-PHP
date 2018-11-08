<?php

include_once("../model/DAO.php");
$voiture=$dao->getNObjet();

include("../view/main.view.php");

?>
