<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$data = addfileMovimiento($_REQUEST['id_caso'],$_REQUEST['id_movimiento'],$_FILES );
echo json_encode($data);
?>