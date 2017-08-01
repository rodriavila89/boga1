<?php session_start(); 
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php';

$data = $_POST;
$config_obj = new configModel();
$config = $config_obj->_get();
$existe_desc = strpos('desc', $config[0]['order_list_directorio']);
$existe_asc = strpos('asc', $config[0]['order_list_directorio']);

if ($existe_desc !== false) {
    $actual = str_replace('desc','',$config[0]['order_list_directorio']);  
    if ($actual == $data['order_list_directorio']){
        $data['order_list_directorio'] = $data['order_list_directorio'].' asc';
    }
}elseif ($existe_asc !== false) {
    $actual = str_replace('asc','',$config[0]['order_list_directorio']);  
    if ($actual == $data['order_list_directorio']){
        $data['order_list_directorio'] = $data['order_list_directorio'].' desc';
    }
}else{
    if ($config[0]['order_list_directorio'] == $data['order_list_directorio']){
        $data['order_list_directorio'] = $data['order_list_directorio'].' desc ';
    }
}

$r = $config_obj->_update($data);

?>