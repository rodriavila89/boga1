<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$partes_obj = new partesModel();
$data = $_POST;
$return = $partes_obj->_delete($data['id']);
echo $return

?>