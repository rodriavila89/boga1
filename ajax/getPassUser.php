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

$data = $_POST;
$users_obj = new usersModel();
$user = $users_obj->_get();


if(md5($data['password_old'])==$user[0]['password']){
    echo 'true';
} else echo 'false';

//echo json_encode($user);

?>
