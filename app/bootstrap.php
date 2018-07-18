<?php
//Load config
require_once "config/config.php";
//Chargement des librairies
require_once 'libraries/core.php';
require_once 'libraries/controller.php';
require_once 'libraries/database.php';

//Load helpers
require_once 'helpers/url_helper.php'; 
require_once 'helpers/session_helper.php';
require_once 'helpers/datimeformatter.php';


//Il se peut que le framwork evolue et qu'il y ait plusieurs librairies a charger
//Et donc,pour eviter de faire plusieurs inclusions,on peut creer un auto load
//Autoload Core Libraries
//Pour que ceci marcche,le nom du fichier doit etre pareil que le nom de la classe
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
});
