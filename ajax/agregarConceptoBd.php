<?php session_start();
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);
require '../includes/init.php';

$data = $_POST;
$data = utf8_array_encode($data);
$conceptos_obj = new conceptosModel();
$padre = $conceptos_obj->_get($data['id_padre']);
$data['accion'] = $padre[0]['accion'];
$concepto = $conceptos_obj->_insert($data);
echo $concepto;
?>