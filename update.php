<?php

include_once("model/Template.class.php");
include_once("model/DB.class.php");
include_once("model/Pasien.class.php");
include_once("model/TabelPasien.class.php");
require_once('view/formPasien.php');

$view = new FormPasien();
$view->index();