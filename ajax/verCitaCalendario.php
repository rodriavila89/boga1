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


$html = '<form role="form" id="f_cita_agenda" name="f_cita_agenda" onsubmit=event.preventDefault();>';
$html .= '<div class="form-group">     
            <label for="titulo">'.ucfirst($translate->_('_titulo_de_cita')).'</label>                    
            <input type="text" class="form-control" id="titulo" name="titulo" >
          </div>
          <div class="form-group">     
            <label for="descripcion">'.ucfirst($translate->_('_descripcion_cita')).'</label>                    
            <textarea style="height:100px" class="form-control" id="descripcion_modal" name="descripcion_modal"  /></textarea>
          </div>          
       </form>';  
echo $html;

?>