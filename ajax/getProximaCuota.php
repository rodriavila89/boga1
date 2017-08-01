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
//  echo ucfirst($translate->_('_egreso')) ;
$id_convenio =  $_REQUEST['id'];
$convenio_obj = new conveniosModel();
$cuota = $convenio_obj->_siguiente_cuota($id_convenio);
$convenio = $convenio_obj->_get($id_convenio);


echo "<input type='hidden' value='".$cuota[0]['id']."' name='id_cuota_convenio'>";
echo "<input type='hidden' value='".$cuota[0]['id_convenio']."' name='id_convenio'>";
echo "<input type='hidden' value='".$cuota[0]['monto_cuota']."' name='monto'>";
echo "<input type='hidden' value='".$cuota[0]['fecha']."' name='fecha'>";
$cuota_numero = $convenio[0]['total_cuotas_pagadas'] + 1;
echo "<h4><span class='label label-primary'>".ucfirst($translate->_('_monto_a_cobrar')).": $ ".$cuota[0]['monto_cuota']."</span></h4>";
echo "<h4><span class='label label-primary'>".ucfirst($translate->_('_cuota_numero'))." ".$cuota_numero."</span></h4>";
echo "<h4><span class='label label-primary'>".ucfirst($translate->_('_fecha'))." ".mostrar_fecha_esp($cuota[0]['fecha'])."</span></h4>";

/*
echo'<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">'. ucfirst($translate->_('_aceptar')).'</button>
    <button type="button" class="btn btn-warning btn_lista_contable" id="btn_cancel_movimiento_contable">'. ucfirst($translate->_('_cancelar')).'</button>
    </div>
</form>';
*/

echo "<hr><h3>Datos del convenio</h3>";
echo "<h4>Nombre: ".$convenio[0]['nombre']."</h4>";
echo "<h4>Monto financiado: <span class='label label-primary'>$ ".$convenio[0]['monto']."</span></h4>";
echo "<h4>Cuotas: <span class='label label-primary'>".$convenio[0]['total_cuotas_pagadas']."/".$convenio[0]['total_cuotas']."</span></h3>";
echo "<table class='table'>";
foreach ($convenio[0]['cuotas_convenio'] as $key=>$value) {
    echo "<tr>";
    echo "<td> ".mostrar_fecha_esp($value['fecha'])."</td>";
    echo "<td> $ ".$value['monto_cuota']."</td>";
    if ($value['pagado']==0){
        $pagado =  ucfirst($translate->_('_no_abonado'));
    }
    if ($value['pagado']==1){
        $pagado = ucfirst($translate->_('_abonado'));
    }
    echo "<td>  ".$pagado."</td>";
    echo "</tr>";
}
echo "</table>";
?>