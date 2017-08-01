<?php session_start();
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);
require '../includes/init.php';

$recorrida_obj = new recorridaModel();
$data = $_POST;
               echo'<pre>';
               print_r($data);
               echo'</pre>';
if (isset($data['id_caso'])){
    $data['id'] = $recorrida_obj->_getByCaso($_POST['id_caso']['id']);
    unset($data['id_caso']);
}

$return = $recorrida_obj->_delete($data['id']);
echo $return;

?>