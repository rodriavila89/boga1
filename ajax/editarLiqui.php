<?php session_start();
error_reporting(0);
if (!isset($_SESSION['__ID_USER'])){
    die();
}

$site_path = realpath(dirname('./../index.php'));
define ('__SITE_PATH', $site_path);
require '../includes/init.php';

$data = $_POST;
$liqui_obj = new liquidacionesModel();
$liqui = $liqui_obj->_get($data['id']);
echo '
    <div>
    <form role="form" action="index.php/casosAdmin/editarliqui/" method=post>
        <input type="hidden" value="'.$liqui[0]['id'].'" name="id" id="id">
        <input type="hidden" value="'.$liqui[0]['id_caso'].'" name="id_caso" id="id_caso">
        <div class="form-group">
            <div style="text-align:right"><a target=_blank href="index.php/casosAdmin/reporteliquidaciontxt/'.$liqui[0]['id'].'/" class="btn btn-info" role="button">Generar reporte</a></div>
        </div>
        <div class="form-group">
            <label for="expediente">Expediente</label>
            <input type="text" class="form-control" id="expediente" name="expediente" value="'.utf8_encode($liqui[0]['expediente']).'" required>
        </div>
        <div class="form-group">
            <label for="autos">Autos</label>
            <input type="text" class="form-control" id="autos" name="autos" value="'.utf8_encode($liqui[0]['caso']).'" >
        </div>
        <div class="form-group">
            <label for="juzgado_liqui">Juzgado</label>
            <input type="text" class="form-control" id="juzgado_liqui" name="juzgado_liqui" value="'.utf8_encode($liqui[0]['juzgado']).'">
        </div>
        <div class="form-group">
            <div class="row">
              <div class="col-xs-4">
                <label for="rubro_cabecera">Rubro</label>
                <input type="text" class="form-control" id="rubro_cabecera" name="rubro_cabecera" value="'.utf8_encode($liqui[0]['rubro_cabecera']).'">
              </div>
              <div class="col-xs-8">
                <label for="titulo_cabecera">Titulo</label>
                <input type="text" class="form-control" id="titulo_cabecera" name="titulo_cabecera" value="'.utf8_encode($liqui[0]['titulo_cabecera']).'">
              </div>
            </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-xs-4">
                <label for="fecha_exibicion">Fecha de exibicion</label>
                <div class="input-group date" id="fecha_liedit1">
                    <input type="text" class="form-control" name ="fecha_exibicion" id ="fecha_exibicion" value="'.mostrar_fecha_esp($liqui[0]['fecha_exibicion']).'"/>
                    <span class="input-group-addon"><span></span>
                    </span>
                </div>
            </div>
            <div class="col-xs-4">
                <label for="titulo_cabecera">Fecha act</label>
                <div class="input-group date" id="fecha_liedit2">
                    <input type="text" class="form-control" name ="fecha_act" id ="fecha_act" value="'.mostrar_fecha_esp($liqui[0]['fecha_act']).'"/>
                    <span class="input-group-addon"><span></span>
                    </span>
                </div>
            </div>
            <div class="col-xs-4">
                <label for="dias">Dias</label>
                <input type="text" class="form-control" readonly=readonly value="'.($liqui[0]['dias']).'">
            </div>
          </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                </div>
                <div class="col-xs-6">
                    <label for="capital_inicial">Capital inicial</label>
                    <input type="text" class="form-control" id="capital_inicial" name="capital_inicial" value="'.($liqui[0]['capital_inicial']).'">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="interes_anual">Interes anual</label>
                    <input type="text" class="form-control" id="interes_anual" name="interes_anual" value="'.($liqui[0]['interes_anual']).'">
                </div>
                <div class="col-xs-6">
                    <label>&nbsp;</label>
                   <input type="text" class="form-control" id="interes_anual_lectura" name="interes_anual_lectura" readonly=readonly  value="$ '.round($liqui[0]['interes_anual_total'],2).'">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="interes_punitorio_anual">Interes punitorio anual</label>
                    <input type="text" class="form-control" id="interes_punitorio_anual" name="interes_punitorio_anual" value="'.($liqui[0]['interes_punitorio_anual']).'">
                </div>
                <div class="col-xs-6">
                    <label>&nbsp;</label>
                   <input type="text" class="form-control" id="interes_punitorio_anual_total" name="interes_punitorio_anual_total" readonly=readonly  value="$ '.round($liqui[0]['interes_punitorio_anual_total'],2).'">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="iva">Iva</label>
                    <input type="text" class="form-control" id="iva" name="iva"  value="'.($liqui[0]['iva']).'">
                </div>
                <div class="col-xs-6">
                    <label>&nbsp;</label>
                   <input type="text" class="form-control" id=iva_lectura" name="iva_lectura" readonly=readonly value="$ '.round($liqui[0]['interes_iva_total'],2).'">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-md-offset-6">
                    <label for="iva">Total parcial</label>
                    <input type="text" class="form-control" id="total_parcial" name="total_parcial" readonly=readonly value="$ '.round($liqui[0]['total_cabecera'],2).'">
                </div>
            </div>
        </div><hr>';
        $aux = $liqui[0]['total_cabecera'];

        echo '<div id="agregar_items"><div class="text-right">
                   <a class="btn btn-info" id="btn_agregar_items"><i class="fa fa-plus"></i>&nbsp;Agregar Items</a>
              </div><br /></div>';


        	echo '<div id="div_agregar_items" style="display:none;background-color:#E6E6E6" >
                    <table class="table-bordered table">
                    <input type="hidden" value='.$liqui[0]['id'].' id ="id_liquidacion_i"/>
                    <tr>
                       <td>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-12">
                                <label>Rubro</label>
                                <input type="text" class="form-control" id="rubro_i" value="Gastos documentados - " required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-12">
                                <label>Capital</label>
                                <input type="text" class="form-control" id="capital_i"   value="" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-6">
                                <label for="fecha_exibicion_items">Fecha de exibicion</label>
                                <div class="input-group date" id="fecha_exibicion_items_a">
                                    <input type="text" class="form-control"  id ="fecha_exibicion_items" />
                                    <span class="input-group-addon"><span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <label for="fecha_act_items">Fecha act</label>
                                <div class="input-group date" id="fecha_act_items_a">
                                    <input type="text" class="form-control"  id ="fecha_act_items"/>
                                    <span class="input-group-addon"><span></span>
                                    </span>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary" id="btn_agregar_items_liqui">Agregar Items</button>
                            <button type="button" class="btn btn-warning" id="btn_cancel_items_liqui">Cancelar</button>
                        </div>
                      </td>
                    </tr>
                   </table>
                  </div>';

        foreach ($liqui[0]['items'] as $key=>$value) {
            $aux = $aux + $value['capital'];
        	echo '<table class="table-bordered table">
                    <tr><td colspan=2></td></tr>
                    <tr>
                        <td colspan=2>
                            <a class="eliminar eliminar_items_liqui manito" id="liqui_items_'.$value['id'].'" ><i class="fa fa-trash-o fa-lg rediconcolor"></i></a>
                            <b>Rubro  '.utf8_encode($value['rubro']).'</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">&nbsp;</td><td><h5><span class="label label-primary"> Capital inicial  $ '.round($value['capital'],2).'</span></h5></td>
                    </tr>
                    <tr>
                        <td style="width:50%">&nbsp;</td><td>D&iacute;as   '.$value['dias'].'</td>
                    </tr>
                    <tr>
                        <td style="width:50%">Fecha de exig: '.mostrar_fecha_esp($value['fecha_exibicion_items']).'</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width:50%">Fecha de act: '.mostrar_fecha_esp($value['fecha_act_items']).'</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width:50%">&nbsp;</td><td><h5><span class="label label-primary"> Total  $ '.round($value['capital'],2).'</span></h5></td>
                    </tr>
                    <tr>
                        <td style="width:50%">&nbsp;</td><td><h5><span class="label label-primary"> Total parcial $ '.round($aux,2).'</span></h5></td>
                    </tr>

                  </table><hr>';
        }
         echo "<h3 style='text-align:right'><span class='label label-danger'> Total $ ".round($aux,2)."</span></h3><br /><br />";

        echo'<div class="form-group text-right">
            <button type="submit" class="btn btn-primary" id="btn_update_liqui">Aceptar</button>
            <button type="button" class="btn btn-warning" id="btn_cancel_liqui">Cancelar</button>
        </div>
    </form>
    <div>';


    echo'</div>
</div>
<script>
    // datepicker de 1 cuota
    $(function () {
        $("#fecha_liedit1").datetimepicker({
            language: "es",
            defaultDate: moment().format("MM/DD/YYYY"),
            pickTime: false
        });
    });
    $(function () {
        $("#fecha_liedit2").datetimepicker({
            language: "es",
            defaultDate: moment().format("MM/DD/YYYY"),
            pickTime: false
        });
    });
    $(function () {
        $("#fecha_exibicion_items_a").datetimepicker({
            language: "es",
            defaultDate: moment().format("MM/DD/YYYY"),
            pickTime: false
        });
    });
    $(function () {
        $("#fecha_act_items_a").datetimepicker({
            language: "es",
            defaultDate: moment().format("MM/DD/YYYY"),
            pickTime: false
        });
    });



</script>
';
