<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_contabilidad')) ; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-right">
                         <?php 
                            # sie esta seteado el filtro aparece la info
                            echo 'Filtrado del <b>'.mostrar_fecha_esp($primer_dia)."</b> al <b>".mostrar_fecha_esp($ultimo_dia)."</b>";
                         ?>
                         <a id="btn_ver_buscar" class="btn btn-primary manito"><i class="fa fa-search"></i>&nbsp;<?php echo ucfirst($translate->_('_filtrar')) ; ?></a>                    
                         <a id="btn_cobrar_cuota" class="btn btn-primary manito"><i class="fa fa-search"></i>&nbsp;<?php echo ucfirst($translate->_('_cobrar_cuota')) ; ?></a>
                         <a class="btn btn-info" href="index.php/contabilidadAdmin/add/"><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_agregar')) ; ?></a>
                    </div>                  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                
                <div id ="div_buscar" style='display:none'>
                
                        <form role="form" action="index.php/contabilidadAdmin/index/" method=post>
                            
                            <div class="form-group">
                                <label for="name"><?php echo ucfirst($translate->_('_fecha_desde')) ; ?></label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input class="form-control" name="fecha_desde" />
                                    <span class="input-group-addon"><span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo ucfirst($translate->_('_fecha_hasta')) ; ?></label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input class="form-control" name="fecha_hasta" />
                                    <span class="input-group-addon"><span></span>
                                    </span>
                                </div>
                            </div>
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                          </div>

            			</form>
                
                </div>

                
                    <?php
                            echo "<table  class='table table-striped'>";
                                echo "<thead><tr>";
                                echo "<th>".ucfirst($translate->_('_fecha'))."</th>";
                                echo "<th>".ucfirst($translate->_('_tipo_contable'))."</th>";
                                echo "<th style='text-align:center'>".ucfirst($translate->_('_egreso'))."</th>";
                                echo "<th style='text-align:center'>".ucfirst($translate->_('_ingreso'))."</th>";
                                echo "<th style='text-align:center'>".ucfirst($translate->_('eliminar'))."</th>";
                                echo "<th>&nbsp;</th>";
                                echo "</tr></thead>";                             
                                foreach ($contabilidad as $key=>$value){
                                    $eliminar = '';
                                    if($value['id_convenio'] == ''){
                                        $eliminar = "<a class='eliminar' href='index.php/contabilidadAdmin/delete/".$value['id']."/' ><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>";
                                    }    
                                    $debe = "&nbsp;";
                                    if($value['accion']==-1){
                                        $debe = "<span class='label label-danger'>$ ".$value['monto']."</span>";;
                                    }
                                    $haber = "&nbsp;";
                                    if($value['accion']==1){
                                        $haber = "<span class='label label-success'> $ ".$value['monto']."</span>";
                                    }                                    
                                
                                    
                                    echo "<tr>";
                                        echo"<td style='width:10%'>";
                                               echo mostrar_fecha_esp($value['fecha']);                                
                                        echo"</td>";
                                        echo"<td style='width:45%'>";
                                               echo $value['nombre'];
                                               if ($value['convenio'] !=''){
                                                  echo " ( ".$value['convenio']." )";
                                               }
                                               if ($value['caso'] !=''){
                                                  echo " ( ".$value['caso']." )";
                                               }
                                               if ($value['observaciones'] !=''){
                                                  echo nl2br("<br> [<b> ".$value['observaciones']." </b>]");
                                               }
                                        echo"</td>";
                                        echo"<td style='width:20%;text-align:center'>";
                                               echo $debe;                                
                                        echo"</td>";    
                                        echo"<td style='width:20%;text-align:center'>";
                                               echo $haber;                                
                                        echo"</td>";   
                                        echo"<td style='width:5%;text-align:center'>".$eliminar;
                                        echo"</td>";                                                                                                                                                  
                                    echo "</tr>";
                                }
                                // totales
                                    echo "<tr>";
                                        echo"<td>";
                                               echo '&nbsp;';
                                        echo"</td>";
                                        echo"<td >";
                                               echo '&nbsp;';
                                        echo"</td>";
                                        echo"<td style='text-align:center'>";
                                               echo "<h3><span class='label label-primary'> $ ".$egreso[0]['egreso']."<span></h3>";
                                        echo"</td>";
                                        echo"<td style='text-align:center'>";
                                               echo "<h3><span class='label label-primary'> $ ".$ingreso[0]['ingreso']."<span></h3>";
                                        echo"</td>";
                                        echo"<td >";
                                               echo "<h3><span class='label label-primary'> $ ".$total."<span></h3>";
                                        echo"</td>";                                        
                                    echo "</tr>";

                            echo "</table>";    

                    ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">



    $(document).on("click", "#btn_ver_buscar", function(event){
         $('#div_buscar').toggle();
    });    

    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'es',
            defaultDate: moment().format('<?php echo mostrar_fecha_esp_javascript($primer_dia);?>'),
            pickTime: false
        });
    });

    $(function () {
        $('#datetimepicker2').datetimepicker({
            language: 'es',
            defaultDate: moment().format('<?php echo mostrar_fecha_esp_javascript($ultimo_dia);?>'),
            pickTime: false
        });
    });
    
//---------------------    
    $(document).on("click", "#btn_cobrar_cuota", function(event){

        $.post(base+"/ajax/getCasosConvenios.php",
        function(data){  

            BootstrapDialog.show({
                title: '<?php echo ucfirst($translate->_('_pagar_cuota')) ; ?>',
                message: data,
                buttons: [{
                    label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                    action: function(dialogItself) {pagar_cuota(dialogItself)}
                    //action: agregarParteBd(dialogItself)
                }, {
                    label: '<?php echo ucfirst($translate->_('_cancelar')) ; ?>',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });    
        }) 
    });  
    
    
    $(document).on("change", "#convenio_modal", function(event){
        $.post(base+"/ajax/getConveniosCasos.php",{ id : this.value},
                function(data){  
                    $("#div_convenios").html(data);               
                }
        );  
    });  
    
    $(document).on("change", "#convenio_caso_modal", function(event){
        $.post(base+"/ajax/getProximaCuota.php",{ id : this.value},
                function(data){  
                    $("#div_proxima_cuota").html(data);               
                }
        );  
    });
    
    function pagar_cuota(dialogo){

        var datos = $("#f_pago").serialize();
        $.post(base+"/ajax/setCuotaConvenio.php",datos,
                function(data){  
                    //console.log(data);
                    location.reload();           
                }
        );          
        
    }
          
    
     



</script>