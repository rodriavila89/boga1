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
$config = new configModel();
$config = $config->_get();

        $lenguaje_automatic = $config[0]['lenguaje_automatic'];
        $lenguaje = $config[0]['lenguaje'];
        if ($lenguaje_automatic == 1){
            //nada...    
        }else{  
            $translate->setLocale($lenguaje);
            $translate->setAutomatic(false);    
        }


echo'<form id="f_nuevo" name="f_nuevo">';
echo '<table  class="table"><tr><td colspan=2>';

    echo '<div class="form-group">';
    echo '<label class="control-label" for="concepto_modal">'.ucfirst($translate->_('_nombre')).'</label>';
    echo '<input type="text" class="form-control input-lg" id="concepto_modal" name="concepto_modal">';
    echo '</div>';
         
echo '</td></tr></table>';
echo'</form>';

?>