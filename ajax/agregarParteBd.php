<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$data = $_POST;
$directorio_obj = new directorioModel();
$data = utf8_array_encode($data);
$directorio = $directorio_obj->_insert($data);
echo $directorio;
?>