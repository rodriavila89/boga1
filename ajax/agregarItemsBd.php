<?php session_start();
error_reporting(E_ALL);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);
require '../includes/init.php';

$data = $_POST;
$liquidaciones_obj = new liquidacionesModel();

$data = utf8_array_encode($data);
$data['fecha_exibicion_items'] = validar_fecha_insert($data['fecha_exibicion_items']);
$data['fecha_act_items'] = validar_fecha_insert($data['fecha_act_items']);
$dias = dias_transcurridos($data['fecha_exibicion_items'],$data['fecha_act_items']);
$dias = intval($dias) + 1;
$data['dias'] = $dias;
$items = $liquidaciones_obj->_insertItems($data);
echo $data['id_liquidacion'];
?>