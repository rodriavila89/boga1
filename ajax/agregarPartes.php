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


echo'<form id="f_nueva_parte" name="f_nueva_parte">';
echo '<table  class="table"><tr><td colspan=2>';

    echo '<div class="form-group">';
    echo '<label class="control-label" for="apellido_modal">'.ucfirst($translate->_('_apellido')).'</label>';
    echo '<input type="text" class="form-control" id="apellido_modal" name="apellido_modal">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label class="control-label" for="nombres_modal">'.ucfirst($translate->_('_nombres')).'</label>';
    echo '<input type="text" class="form-control" id="nombres_modal" name="nombres_modal">';
    echo '</div>';  
    echo '<div class="form-group">';
    echo '<label class="control-label" for="tipo_modal">'.ucfirst($translate->_('_tipo')).'</label>';
    echo '<select name="tipo_modal" id="tipo_modal">';
        echo "<option value='CONTACTO' >".strtoupper($translate->_('_tipo_contacto'))."</option>";
        echo "<option value='CLIENTE' >".strtoupper($translate->_('_tipo_cliente'))."</option>";
    echo '</select>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label class="control-label" for="personeria_modal">'.ucfirst($translate->_('_personeria')).'</label>';
    echo '<select name="personeria_modal" id="personeria_modal">';
        echo "<option value='FISICA' >".strtoupper($translate->_('_personeria_fisica'))."</option>";
        echo "<option value='JURIDICA' >".strtoupper($translate->_('_personeria_juridica'))."</option>";
    echo '</select>';
    echo '</div>';           
echo '</td></tr></table>';
echo'</form>';
echo "
      <script>
        $(\"#personeria_modal\").select2({ width: '100%',height:'55px' });
        $(\"#tipo_modal\").select2({ width: '100%',height:'55px' });
      </script>  

      "
?>