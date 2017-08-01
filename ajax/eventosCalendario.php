<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php'; 
$ruta_modal['ruta_modal'] = __SITE_PATH;
$translate = new Translate($ruta_modal);
$config = new configModel();
$config = $config->_get();

$lenguaje_automatic = $config[0]['lenguaje_automatic'];
$lenguaje = $config[0]['lenguaje'];
if ($lenguaje_automatic == 1){
    //nada...    
}else{  
    $translate->setLocale($lenguaje);
    $translate->setAutomatic(false);    
}


?>