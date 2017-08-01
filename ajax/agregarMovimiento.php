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
$id_caso = $_POST['id'];
$caso_obj = new casosModel();
$caso = $caso_obj->_get($id_caso);

echo "<h4>".utf8_encode($caso[0]['caso'])."</h4>";
echo"<form role='form' id='f_movimiento'>
    <input type='hidden' value='".$id_caso."' id='id_caso' name='id_caso'>
    <div class='form-group'>
        <label for='name'>".ucfirst($translate->_('_fecha_movimiento'))."</label>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' class='form-control' name ='fecha' id ='fecha'/>
            <span class='input-group-addon'><span></span>
            </span>
        </div>
    </div>                                             
    <div class='form-group'>
    	<label for='tipo'>".ucfirst($translate->_('_tipo'))."</label>
        <select name='tipo_estado' id='tipo_estado' required>
            <option value='' ></option> 
                <option value='_procesal' >".ucfirst($translate->_('_procesal'))."</option>
                <option value='_no_procesal'>".ucfirst($translate->_('_no_procesal'))."</option>
                <option value='_otro'>".ucfirst($translate->_('_otro'))."</option>
        </select> 
        <br><br>
        <div id ='div_tipo_estado' style='display:none'>
            <div class='form-group'>
            	 <label for='acto_procesal'>".ucfirst($translate->_('_acto_procesal'))."</label>
                 <input type='text' class='form-control' id='acto_procesal' name='acto_procesal'  />
            </div>                                                 
        </div>
    </div>
    
    <div class='form-group'>
	   <label for='description'>".ucfirst($translate->_('_descripcion'))."</label>
       <textarea style='height:100px' class='form-control' name='descripcion' id='descripcion'  /></textarea>
    </div>                                              
                                                                          
</form>
<script>
    // en el onchange del select de tipo de estado
    $(document).on('change', '#tipo_estado', function(event){
        mostrar_actoprocesal(this.value)
    }); 
        $('#datetimepicker2').datetimepicker({
                        language: 'es',
                        defaultDate: moment().format('MM/DD/YYYY'),
                        pickTime: false
                    }); 
$('#tipo_estado').select2({ width: '100%',height:'55px' });                    
</script>";

?>


