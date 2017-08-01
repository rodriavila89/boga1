<?php session_start(); 
error_reporting(E_ALL);
if (!isset($_SESSION['__ID_USER'])){
    die();
}
$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);  
require '../includes/init.php'; 

        
$convenios_obj = new conveniosModel();
$datos['id_cuota_convenio'] = $_POST['id_cuota_convenio'];
$datos['id_convenio'] = $_POST['convenio_caso_modal'];
$convenios = $convenios_obj->_pago_cuota($datos);

$datos['id_caso'] = $_POST['convenio_modal'];
$datos['id_cuota_convenio'] = $_POST['id_cuota_convenio'];

$datos['fecha'] = $_POST['fecha'];
$datos['monto'] = $_POST['monto'];


$datos['id_concepto'] = 3;
//$datos['id_caso'] = $datos['id'];
//unset($datos['convenios']);
//unset($datos['id']);
$datos['fecha'] = mostrar_fecha_esp($datos['fecha']);
$contabilidad_obj = new contabilidadModel();
$convenios = $contabilidad_obj->_insert($datos);
        //header("location:".__SITIO."index.php/casosAdmin/edit/".$datos['id_caso']."/");

?>