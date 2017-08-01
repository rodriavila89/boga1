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
$agenda_obj = new agendaModel();
$agenda = $agenda_obj->_get($_POST['id']);
if($agenda[0]['id_persona'] != null or $agenda[0]['id_persona'] != ''){
    echo "<h4><i class='fa fa-calendar'></i>&nbsp;".ucfirst($translate->_('_cita_de_directorio')).":&nbsp;".$agenda[0]['nombres']." ".$agenda[0]['apellido']."</h4>";
}
if($agenda[0]['id_caso'] != null or $agenda[0]['id_caso'] != ''){
    echo "<h4><i class='fa fa-calendar'></i>&nbsp;".ucfirst($translate->_('_cita_de_caso')).":&nbsp;".$agenda[0]['caso']."</h4>";
}
if(($agenda[0]['id_caso'] == null or $agenda[0]['id_caso'] == '') and ($agenda[0]['id_persona'] == null or $agenda[0]['id_persona'] == '')){
    echo "<h4><i class='fa fa-calendar'></i>&nbsp;".ucfirst($translate->_('_cita_general'))."</h4>";
}

$html = '<form role="form" id="f_cita_agenda" name="f_cita_agenda" onsubmit=event.preventDefault();>
        <input type="hidden" name="id" id="id" value="'.$agenda[0]['id'].'">';
$html .= '<div class="form-group">     
            <label for="titulo">'.ucfirst($translate->_('_titulo_de_cita')).'</label>                    
            <input type="text" class="form-control" id="titulo" name="titulo" value="'.utf8_encode($agenda[0]['titulo']).'">
          </div>
          <div class="form-group">     
            <label for="descripcion">'.ucfirst($translate->_('_descripcion_cita')).'</label>                    
            <textarea style="height:100px" class="form-control" id="descripcion" name="descripcion" >'.utf8_encode($agenda[0]['descripcion']).'</textarea>
          </div>          
       </form>';  
echo $html;

?>
