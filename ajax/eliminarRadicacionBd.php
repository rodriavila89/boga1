<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$radicacion_obj = new radicacionModel();
$data = $_POST;
$return = $radicacion_obj->_delete($data['id']);
echo $return

?>