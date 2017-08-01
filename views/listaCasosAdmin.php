<?php
    
    $a = "<a class='manito order' id='order_id'>".ucfirst($translate->_('_fecha_carga'))."</a>";
    $b = "<a class='manito order' id='order_caso'>".ucfirst($translate->_('_alfabeticamente'))."</a>";
    $pos = strpos($order_list_caso, 'desc');
    if ($pos === false){
        if ($order_list_caso == 'id'){ $a = '<i class="fa fa-arrow-down blueiconcolor">&nbsp;'.$a.'</i>';}   
        if ($order_list_caso == 'caso'){ $b = '<i class="fa fa-arrow-down blueiconcolor" >&nbsp;'.$b.'</i>' ;} 
    }else{
        $aux_list = str_replace(" desc","",$order_list_caso);
        if (trim($aux_list) == 'id'){ $a = '<i class="fa fa-arrow-up blueiconcolor">&nbsp;'.$a.'</i>';}   
        if (trim($aux_list) == 'caso'){ $b = '<i class="fa fa-arrow-up blueiconcolor" >&nbsp;'.$b.'</i>' ;} 
    }
    $tiempo_menos_3_meses = mktime(0, 0, 0, date("m")-3 , date("d"), date("Y"));
    $fecha_tres_meses =  date("m/d/Y", $tiempo_menos_3_meses);


?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_casos')) ; ?></h1>
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
                            if ( (isset($_SESSION['DATA_BUSQUEDA_ADMIN'])) or (isset($_SESSION['DATA_BUSQUEDA_ADMIN_FECHA']) )){
                                echo '<a id="btn_quitar_busqueda" class="btn btn-danger" href="index.php/casosAdmin/quitarfiltro/"><i class="fa fa-times"></i>&nbsp;'.ucfirst($translate->_('_quitar_filtro')).'</a>';
                            } 
                         ?>
                         <a id="btn_ver_filtro_fecha" class="btn btn-primary manito"><i class="fa fa-search"></i>&nbsp;Filtrar por fechas de movimientos</a>
                         <a id="btn_ver_buscar" class="btn btn-primary manito"><i class="fa fa-search"></i>&nbsp;<?php echo ucfirst($translate->_('_buscar')) ; ?></a>
                         <a class="btn btn-info" href="index.php/casosAdmin/add/"><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_agregar')) ; ?></a>
                    </div>                  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                
                <div id ="div_buscar" style='display:none'>
                
                        <form role="form" action="index.php/casosAdmin/resultadobuscar/" method=post>
                            
                            <div class="form-group">
                                <div class="input-group">
                                  <input type="hidden" value=1 name="id_busqueda">  
                                  <input type="text" name="busqueda" class="form-control">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                                  </span>
                                </div><!-- /input-group -->
                            </div>  
            			</form>
                
                </div>

                <div id ="div_buscar_fecha" style='display:none'>

                        <form role="form" action="index.php/casosAdmin/resultadobuscar/" method=post>

                            <div class="form-group">
                              <div class="row">
                                  <div class="col-xs-3">
                                    <label for="name">Fecha hasta</label>
                                    <div class='input-group date' id='d1'>
                                        <input type='text' class="form-control" name ="fecha_desde" value="<?php echo mostrar_fecha_esp($caso['fecha_ingreso']) ;?>" />
                                        <span class="input-group-addon"><span></span>
                                        </span>
                                    </div>
                                  </div>
                                  <div class="col-xs-3">
                                    <label for="name">Fecha hasta</label>
                                    <div class='input-group date' id='d2'>
                                        <input type='text' class="form-control" name ="fecha_hasta" value="<?php echo mostrar_fecha_esp($caso['fecha_ingreso']) ;?>" />
                                        <span class="input-group-addon"><span></span>
                                        </span>
                                    </div>
                                  </div>
                                  <div class="col-xs-3">
                                    <label for="name">Movimientos</label>
                                    <div class='input-group ' >
                                        <select class="form-control" name ="con_mov" id ="con_mov">
                                          <option value= 0>Sin movimientos</option>
                                          <optgroup label="Con movimientos">
                                            <option value= 2>Procesal</option>
                                            <option value= 1>No procesal</option>
                                            <option value= 3>Otro</option>
                                            <option value= 4>Todos</option>
                                          </optgroup>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-xs-3">
                                    <label for="name">&nbsp;</label>
                                    <div class='input-group '>
                                    <input type="hidden" value=2 name="id_busqueda">
                                    <button class="btn btn-default" type="submit">Filtrar</button>
                                    </div>
                                  </div>
                              </div>
                            </div>

            			</form>

                </div>
                
            <?php
                echo "<div class='text-right'><b>".ucfirst($translate->_('_total_de_registros')).": ".$cantidad."</b></div>";
                echo "<div class='text-center'><ul class='pagination'><li>".$paginacion[0]."</li><li>".$paginacion[1]."</li><li>" .$paginacion[2]."</li><li>".$paginacion[3]."</li><li>".$paginacion[4]."</li></ul></div>";
            ?>          
            
                      <div class='text-right' style='padding-right:30px'>
                        <!-- Split button -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary"><?php echo ucfirst($translate->_('_ordenar')) ; ?></button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only"><?php echo ucfirst($translate->_('_ordenar')) ; ?></span>
                          </button>
                          <ul class="dropdown-menu" role="menu" >
                            <li class='text-left'><?php echo $a?></li>
                            <li class='text-left'><?php echo $b?></li>
                            <li class='text-left'><?php echo $c?></li>
                          </ul>
                        </div>            
                      </div>
                
                    <?php

                        foreach ($casos as $key=>$value){

                            $archivado = '';
                            if($value['archivado']== 1){
                                $archivado = '&nbsp;<span class="label label-warning">('.ucfirst($translate->_('_caso_archivado')).')</span>';
                            }
                            echo '<div class="media">';
                                    echo "<div class='text-right'>";

                                          if ($value['recorrida']==0){
                                            echo "<a class='manito recorrida' id=".$value['id'].">Agregar a Recorrida</a>&nbsp;";
                                          }else{
                                            echo "<a class='manito eliminarecorrida' id=".$value['id'].">Eliminar de Recorrida</a>&nbsp;";
                                          }
                                    echo "&nbsp;&nbsp;||&nbsp;&nbsp;<a class='manito btn_nuevo_movimiento' id='".$value['id']."'>&nbsp;".ucfirst($translate->_('_agregar_movimiento'))."</a>";      

                                    echo" <a title='Editar' href='index.php/casosAdmin/edit/".$value['id']."/'><i class='fa fa-pencil-square-o fa-lg'></i></a>&nbsp;
                                          <a title='Ver' href='index.php/casosAdmin/view/".$value['id']."/'><i class='fa fa-camera-retro fa-lg'></i></a>
                                          <a title='Eliminar' href='index.php/casosAdmin/delete/".$value['id']."/'><i class='fa fa-trash-o fa-lg'></i></a>&nbsp;
                                          </div>";                            
                                echo '<div class="media-body" style="border-bottom:1px solid">';//
                                    echo '<p class="lead text-primary"><a href="index.php/casosAdmin/view/'.$value['id'].'/" >'.$value['caso'].$archivado.'</a></p>';
                                    echo '<div>'.nl2br($value['description']).'</div>';
                                    echo '<ul class="list-inline">
                                           <li><b><span>'.ucfirst($translate->_('_naturaleza')).":</span></b> ".$value['naturaleza'].'</li>
                                           <li><b><span>'.ucfirst($translate->_('_nro_carpeta')).":</span></b> ".$value['nro_carpeta'].'</li>
                                           <li><b><span>'.ucfirst($translate->_('_nro_expediente')).":</span></b> ".$value['nro_expediente'].'</li>
                                           <li><b><span>'.ucfirst($translate->_('_estado')).":</span></b> ".ucfirst(str_replace('_',' ',($value['estado']))).'</li>
                                          </ul>';
                                    if (!empty($value['movimiento'])){          
                                        echo "<div style='padding:20px'><table class='table table-hover'>";
                                            echo "<thead><tr>";                   
                                            echo "<th>".ucfirst($translate->_('_fecha_movimiento'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_publico'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_descripcion'))."</th>";
                                            echo "</tr></thead>";                                        
                                            echo "<tr>";
                                            echo "<td>".mostrar_fecha_esp($value['movimiento']['fecha'])."</td>";
                                            echo "<td>".ucfirst($translate->_($value['movimiento']['tipo_estado']));
                                                        ucfirst($translate->_($value['movimiento']['tipo_estado']));
                                                        if ($value['movimiento']['tipo_estado']== '_procesal'){
                                                            echo " (".$value['movimiento']['acto_procesal'].") ";    
                                                        }                                            
                                            echo "</td><td>";
                                                    if ($value['publico']== 1)
                                                        echo "<b>SI</b>";
                                                    else
                                                        echo "<b>NO</b>";
                                            echo "</td>";
                                            echo "<td>".nl2br($value['movimiento']['descripcion'])."</td>";
                                            echo "</tr>";
                                        
                                        echo "</table></div>";
                                    }                                          

                                echo '</div>';
                            echo '</div>';
                        	
                        }
                    
                    ?>

                <?php
                    echo "<div class='text-center'><ul class='pagination'><li>".$paginacion[0]."</li><li>".$paginacion[1]."</li><li>" .$paginacion[2]."</li><li>".$paginacion[3]."</li><li>".$paginacion[4]."</li></ul></div>";
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

    $(document).ready(function() {
        $('#btn_quitar_busqueda').tooltip({
            'show': true,
                'placement': 'top',
                'title': "<?php echo ucfirst($translate->_('_filtrado_por')).": ".$_SESSION['DATA_BUSQUEDA_ADMIN'] ; ?>"
        }); 
    })
    
    $(document).on("click", ".order", function(event){
        ordenar(this.id);
    });
    
    $(document).on("click", "#btn_ver_buscar", function(event){
         $('#div_buscar').toggle();
    });

    $(document).on("click", "#btn_ver_filtro_fecha", function(event){
         $('#div_buscar_fecha').toggle();
    });

    // datepicker de la fecha desde
    $(function () {
        $('#d1').datetimepicker({
            language: 'es',
            defaultDate:'<?php echo $fecha_tres_meses; ?>',
            pickTime: false
        });
    });
    // datepicker de la fecha hasta
    $(function () {
        $('#d2').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    });

    $("#div_buscar").hide();

    $("#div_buscar_fecha").hide();
    
//---------------------    
    function ordenar(id_param){
        
        var id_param = id_param.replace("order_","");                                           
        $.post(base+"/ajax/setOrderCasoBd.php",{ order_list_caso : id_param},
                function(data){
                     window.location.replace('index.php/casosAdmin/');
                }
        );        
    }
//-------------------
    $(document).on("click", ".eliminarecorrida", function(event){
          var id_param = this.id;
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_caso_recorrida')) ; ?>', function(result){
                if(result) {
                    eliminarcasorecorrida(id_param);
                }
            });
    });

    function eliminarcasorecorrida(id_param){
        $.post(base+"/ajax/eliminarCasoRecorridaBd.php",{id_caso:id_param},
            function(data){   //console.log(data);
                location.reload(true);
            }
        );

    }

    $(document).on("click", ".recorrida", function(event){
            var id_param = this.id;
            $.post(base+"/ajax/agregarCasoRecorrida.php",{id_caso:id_param},
                function(data){
                    location.reload(true);
                })
    });
    
    // nuevo movimiento
    $(document).on("click", ".btn_nuevo_movimiento", function(event){
            var id_param = this.id;
            $.post(base+"/ajax/agregarMovimiento.php",{id:id_param},
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
    

        
