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

$id_caso = $_REQUEST['id']; 
$convenios_obj = new conveniosModel();
$convenios = $convenios_obj->_list_por_caso_abiertos($id_caso);         
        
echo '<div class="form-group">';
echo '<label class="control-label" for="tipo_modal">Convenio</label>';
echo '<select name="convenio_caso_modal" id="convenio_caso_modal" class="form-control">';
    echo "<option value='-1'>Seleccione...</option>";
    foreach ($convenios as $key=>$value) {
        echo "<option value='".$value['id']."'>".$value['nombre']."</option>";	
    }
echo '</select>';
echo '</div>';
echo '<div id="div_proxima_cuota"></div>';        
        
?>