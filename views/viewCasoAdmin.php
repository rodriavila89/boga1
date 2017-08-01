<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_caso')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$caso['caso'].'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                                                               
                    <div class="text-right">
                         <?php
                            if ($recorrida == 0) {
                                echo '<a class="btn btn-info" id="btnAgregarRecorrida"><i class="fa fa-plus-circle"></i>&nbsp;Agregar a Recorrida</a>';
                            }else{
                                echo '<a class="btn btn-info" id="btneliminarrecorrida"><i class="fa fa-plus-circle"></i>&nbsp;Eliminar de Recorrida</a>';
                            }
                         ?>

                         <a class="btn btn-info" href="index.php/casosAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                         <a class="btn btn-warning" href="index.php/casosAdmin/edit/<?php echo $caso['id'] ?>/"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo ucfirst($translate->_('_editar')) ; ?></a>
                         <a class="btn btn-danger" href="index.php/casosAdmin/delete/<?php echo $caso['id'] ?>/"><i class="fa fa-trash-o"></i>&nbsp;<?php echo ucfirst($translate->_('_eliminar')) ; ?></a>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php

                            $archivado = '';
                            if($caso['archivado']== 1){
                                $archivado = '&nbsp;<span class="label label-warning">('.ucfirst($translate->_('_caso_archivado')).')</span>';
                            }                    
                             
                            echo "<p class='lead'><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;".$caso['caso'].$archivado."</p>";

                            echo "<table class='table table-striped table-bordered table-hover'>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_naturaleza'))."</td>";
                                echo "<td>".$caso['naturaleza']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_nro_expediente'))."</td>";
                                echo "<td>".$caso['nro_expediente']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_nro_carpeta'))."</td>";
                                echo "<td>".$caso['nro_carpeta']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_estado'))."</td>";
                                echo "<td>".ucfirst(str_replace('_',' ',($caso['estado'])))."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_radicacion_actual'))."</td>";
                                echo "<td>".$caso['nominacion']."</td>";
                            echo "</tr>"; 
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_fecha_ingreso'))."</td>";
                                echo "<td>".mostrar_fecha_esp($caso['fecha_ingreso'])."</td>";
                            echo "</tr>";                             
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_requerimiento_cliente'))."</td>";
                                echo "<td>".nl2br($caso['requerimientos_cliente'])."</td>";
                            echo "</tr>";   
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_opinion_profesional'))."</td>";
                                echo "<td>".nl2br($caso['opinion_profesional'])."</td>";
                            echo "</tr>";                                                          

                            echo "</table>";
                            
                            # movimientos
                            $nuevo_movimiento = "&nbsp;&nbsp;<a class='btn btn-primary' id='btn_nuevo_movimiento'><i class='fa fa-plus'></i>&nbsp;".ucfirst($translate->_('_agregar_movimiento'))."</a>";
                            if (empty($movimientos)){
                               // echo "<h4>".ucfirst($translate->_('_'))."</h4>";
                               echo $nuevo_movimiento;
                            }else{
                                echo "<br /><h4><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;".ucfirst($translate->_('_movimientos')).$nuevo_movimiento."</h4>";
                                echo "<table class='table table-hover'>";
                                    echo "<thead><tr>";                   
                                    echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                    echo "<th>".ucfirst($translate->_('_fecha_movimiento'))."</th>";
                                    echo "<th>".ucfirst($translate->_('_descripcion'))."</th>";
                                    echo "</tr></thead>";                                        
                                foreach ($movimientos as $key=>$value) {
                                    echo "<tr>";
                                    echo "<td>".
                                                ucfirst($translate->_($value['tipo_estado']));
                                                if ($value['acto_procesal']!= ''){
                                                    echo " (".$value['acto_procesal'].") ";    
                                                }
                                    echo "</td>";
                                    echo "<td>".mostrar_fecha_esp($value['fecha'])."</td>";
                                    echo "<td>".nl2br($value['descripcion'])."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";                                
                            }                            
                            
                            # partes
                            if (empty($partes)){
                               // echo "<h4>".ucfirst($translate->_('_no_partes_asignadas'))."</h4>";
                            }else{
                                echo "<br /><hr><h4><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;".ucfirst($translate->_('_partes'))."</h4>";
                                echo "<table class='table table-hover'>";
                                    echo "<thead><tr>";
                                    echo "<th>".ucfirst($translate->_('_nombres'))."</th>";
                                    echo "<th>".ucfirst($translate->_('_rol'))."</th>";
                                    echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                    echo "</tr></thead>";                                        
                                foreach ($partes as $key=>$value) {
                                    echo "<tr>";
                                    echo "<td>".$value['nombres'].' '.$value['apellido']."</td>";
                                    echo "<td>".$value['rol']."</td>";
                                    echo "<td>".ucfirst($translate->_($value['tipo']))."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";                                
                            }

                            if (!empty($contabilidad)){
                            echo "<br /><br /><h4><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;".ucfirst($translate->_('_contabilidad'))."</h4>";
                            echo "<table  class='table table-striped'>";
                                echo "<thead><tr>";
                                echo "<th>".ucfirst($translate->_('_fecha'))."</th>";
                                echo "<th>".ucfirst($translate->_('_tipo_contable'))."</th>";
                                echo "<th style='width:20%;text-align:center'>".ucfirst($translate->_('_egreso'))."</th>";
                                echo "<th style='width:20%;text-align:center'>".ucfirst($translate->_('_ingreso'))."</th>";
                                echo "<th>&nbsp;</th>";
                                echo "</tr></thead>";
                                foreach ($contabilidad as $key=>$value){
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
                                        echo"<td style='width:50%'>";
                                               echo $value['nombre'];
                                               if ($value['convenio'] !=''){
                                                  echo " ( ".$value['convenio']." )";
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
                                    echo "</tr>";

                            echo "</table>";
                           }

                            # radicaciones
                            if (empty($radicaciones)){
                                //echo "<h4>".ucfirst($translate->_('_no_radicaciones_anteriores'))."</h4>";
                            }else{                            
                                echo "<br /><hr><h4><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;".ucfirst($translate->_('_radicaciones_anteriores'))."</h4>";
                                echo "<table class='table table-striped table-bordered table-hover'>";
                                echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>".ucfirst($translate->_('_tribunal'))."</th>";
                                        echo "<th>".ucfirst($translate->_('_nro_expediente'))."</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo " <tbody>";
                                        foreach ($radicaciones as $key=>$value){
                                            echo "<tr class='odd gradeX'>";
                                            echo "<td style='width:80%'>".$value['nominacion']."</td>";
                                            echo "<td style='width:20%'>".$value['nro_expediente']."</td>";
                                            echo "</tr>";
                                        }
                                    
                                    echo "</tbody>";
                                echo "</table>";                                                       
                            }


                            # radicaciones
                            if (empty($liquidaciones)){

                            }else{
                                echo "<br /><hr><h4><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;Liquidaciones</h4>";
                                        echo "<table class='table table-hover'>";
                                            echo "<thead><tr>";
                                            echo "<th>".ucfirst($translate->_('_expedientes_liquidacion'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_total_liquidacion'))."</th>";
                                            echo "</tr></thead>";
                                        foreach ($liquidaciones as $key=>$value) {
                                            echo "<tr>";
                                            echo "<td>".$value['expediente']."</td>";
                                            echo "<td> $ ".round($value['total_cabecera'],2)."</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                            }

                    ?>
                </div>
            </div>
        </div>
    </div>            
</div>

<script type="text/javascript">
 
    // nuevo movimiento
    $(document).on("click", "#btn_nuevo_movimiento", function(event){
            $.post(base+"/ajax/agregarMovimiento.php",{id:<?php echo $caso['id'];?>},
                function(data){  

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_agregar_movimiento')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) {agregarMovimientoBd(dialogItself)}
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


    $(document).on("click", "#btneliminarrecorrida", function(event){
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_caso_recorrida')) ; ?>', function(result){
                if(result) {
                    eliminarcasorecorrida();
                }
            });
    });

    function eliminarcasorecorrida(id_param){

        $.post(base+"/ajax/eliminarCasoRecorridaBd.php",{id_caso:{id:<?php echo $caso['id'];?>}},
            function(data){
                //dialogItself.close();
                //console.log(data);
                location.reload(true);
            }
        );

    }

    // boton para agregar a recorrida
    $(document).on("click", "#btnAgregarRecorrida", function(event){
            $.post(base+"/ajax/agregarCasoRecorrida.php",{id_caso:<?php echo $caso['id'];?>},
                function(data){
                    location.reload(true);
                })
    });


    
    // 
    //---------------------      
    function mostrar_actoprocesal(valor){
    
        if (valor =='_procesal'){
            $("#div_tipo_estado").show();
        }else{
            $("#div_tipo_estado").hide();
        }
    }  
    
    // funcion de retorno del dialogo para agregar movimientos
    //---------------------    
    function agregarMovimientoBd(dialogItself){
    
        var formData = $("#f_movimiento").serialize();
        $.post(base+"/ajax/agregarMovimientoBd.php",formData,
            function(data){ 
                dialogItself.close();
                location.reload(); 
            }
        );    
    }         
    
     
 
 
</script>