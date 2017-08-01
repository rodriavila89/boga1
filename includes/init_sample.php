<?php
#
$host = $_SERVER['HTTP_HOST'];
#
$carpeta='litigar';
$baseUrl =  'http://' . $host.'/'.$carpeta.'/';
#conexion a base de datos
define ('__HOST','localhost');
define ('__DB_USER','root');
define ('__DB_PASS','root');
define ('__BASE_DATOS','litigar'); 

define ('__TITULO',':: Prueba ::');
define ('__SITIO',$baseUrl);
define('__SIN_DATOS',   "( Sin informar )");

define('__VERSION',  __SITIO."/version.php");
define('__VERSION_FILE',  __SITE_PATH."/version.php");
define('__SERVER_UPGRADE', "http://www.litigaronline.com/versiones/upgrade.php");
define('__SERVER_UPGRADE_DIR', "http://www.litigaronline.com/versiones/");


define('RUTA_DIRECTORIO', __SITE_PATH . '/files/directorio/');
define('RUTA_CASO', __SITE_PATH . '/files/casos/');

/*** include the controller class ***/
include __SITE_PATH . '/application/' . 'controller_base.class.php';
/*** include the registry class ***/
include __SITE_PATH . '/application/' . 'registry.class.php';
/*** include the router class ***/
include __SITE_PATH . '/application/' . 'router.class.php';
/*** include the template class ***/
include __SITE_PATH . '/application/' . 'template.class.php';
include __SITE_PATH . '/application/' . 'upload_class.php';
include __SITE_PATH . '/application/' . 'imageresizer.class.php';

include __SITE_PATH . '/model/db.class.php';
include __SITE_PATH . '/model/class.pdohelper.php';
include __SITE_PATH . '/model/class.pdowrapper.php';
include __SITE_PATH . '/application/translate.php';
include __SITE_PATH . '/application/functions.php';

/*** auto load model classes ***/
function __autoload($class_name){   
    $filename = ($class_name) . '.php';
    $file = __SITE_PATH . '/model/' . $filename;  
    if (file_exists($file) == false){
        return false;
    } 
    include ($file);
}

/*** a new registry object ***/
$registry = new registry;

?>