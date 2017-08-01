<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$delete_obj = new agendaModel();
$data = $_POST;
$return = $delete_obj->_delete($data['id']);
echo $return

?>