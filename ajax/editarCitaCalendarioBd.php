<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$data = $_POST;
$agenda_obj = new agendaModel();
$data = utf8_array_encode($data);
$cita = $agenda_obj->_update($data);
echo $cita;
?>