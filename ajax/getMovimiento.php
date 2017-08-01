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

$id = $_REQUEST['id'];
$movimiento_obj = new movimientosModel();
$return = $movimiento_obj->_get($id);
//$return[0]['fecha'] = mostrar_fecha_esp($return[0]['fecha'] );
echo (json_encode($return));

?>