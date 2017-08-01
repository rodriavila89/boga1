<?php session_start();
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);
require '../includes/init.php';
$liqui_obj = new liquidacionesModel();
$data = $_POST;
$return = $liqui_obj->_deleteItems($data['id']);
echo $return;

?>