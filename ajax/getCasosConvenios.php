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
        
$convenios_obj = new conveniosModel();
$convenios = $convenios_obj->_casosConConvenios(); 


echo'<form id="f_pago" name="f_pago">';
echo '<table  class="table"><tr><td colspan=2>';

    echo '<div class="form-group">';
    echo '<label class="control-label" for="tipo_modal">'.ucfirst($translate->_('_tipo')).'</label>';
    echo '<select name="convenio_modal" id="convenio_modal" class="form-control">';
        echo "<option value='-1'>Seleccione...</option>";
        foreach ($convenios as $key=>$value) {
            echo "<option value='".$value['id']."'>".$value['caso']."</option>";	
        }
    echo '</select>';
    echo '</div>';
    echo '<div id="div_convenios">';

    echo '</div>';           
echo '</td></tr></table>';
echo'</form>';

?>