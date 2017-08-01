<?php session_start(); 

if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php'; 
$ruta_modal['ruta_modal'] = __SITE_PATH;
$translate = new Translate($ruta_modal);

$padre = utf8_encode($_REQUEST['z']);
$data = utf8_encode($_REQUEST['q']);
$conceptos_obj = new conceptosModel();
$return = $conceptos_obj->_buscar($padre,$data);
$return = utf8_array_decode($return);
echo (json_encode($return));

?>