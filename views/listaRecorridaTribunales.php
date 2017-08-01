<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'>Recorrida de Tribunales</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>-</small>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                                                               
                    <div class="text-right">    
                         <a class="btn btn-danger" href="index.php/recorridaAdmin/limpiar/"><i class="fa fa-trash-o"></i>&nbsp;Limpiar lista</a>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                
                        <div class="panel-body">
                            <!-- Nav tabs -->



                                <?php
                                
                                    echo'<form role="form" action="index.php/recorridaAdmin/resultadobuscar/" method=post>
                                        
                                        <div class="form-group">
                                              <input type="hidden" value=1 name="id_busqueda">';  
                                                echo "<select class='select' name='busqueda'>";
                                                echo "<option value='0'>Todos</option>"; 
                                                foreach ($juzgados as $key=>$value){
                                                    $sel = "";
                                                    if ($_SESSION['DATA_RECORRIDA_ADMIN']==$value['id']){
                                                        $sel = " selected=selected";
                                                    }
                                                    echo "<option ".$sel." value=".$value['id'].">".$value['nominacion']."</option>";	
                                                }
                                                echo "</select></div>";
                                    echo'<div class="form-group"><button class="btn btn-default" type="submit">Buscar</button></div>
                                			</form> ';                               
                                

            
            
                                    foreach ($recorrida as $key=>$value){
                                    
                                        $caso = $value['caso'][0];
            
                                        $archivado = '';
                                        if($caso['archivado']== 1){
                                            $archivado = '&nbsp;<span class="label label-warning">('.ucfirst($translate->_('_caso_archivado')).')</span>';
                                        }
                                        echo '<div class="media">';
                                                echo "<div class='text-right'>";
            
                                                echo "&nbsp;&nbsp;<a class='manito eliminar' id='".$value['id']."'>&nbsp;Eliminar de Recorrida</a>&nbsp;&nbsp;";
                                                echo "|&nbsp;&nbsp;<a class='manito btn_nuevo_movimiento' id='".$caso['id']."'>&nbsp;".ucfirst($translate->_('_agregar_movimiento'))."</a>&nbsp;&nbsp;";      
            
                                                echo" <a title='Editar' href='index.php/casosAdmin/edit/".$caso['id']."/'><i class='fa fa-pencil-square-o fa-lg'></i></a>&nbsp;
                                                      <a title='Ver' href='index.php/casosAdmin/view/".$caso['id']."/'><i class='fa fa-camera-retro fa-lg'></i></a>
                                                      </div>";                            
                                            echo '<div class="media-body" style="border-bottom:1px solid">';//
                                                echo '<p class="lead text-primary"><a href="index.php/casosAdmin/view/'.$caso['id'].'/" >'.$caso['caso'].$archivado.'</a></p>';
                                                echo '<div>'.nl2br($caso['description']).'</div>';
                                                echo '<ul class="list-inline">
                                                       <li><b><span>'.ucfirst($translate->_('_naturaleza')).":</span></b> ".$caso['naturaleza'].'</li>
                                                       <li><b><span>'.ucfirst($translate->_('_nro_carpeta')).":</span></b> ".$caso['nro_carpeta'].'</li>
                                                       <li><b><span>'.ucfirst($translate->_('_nro_expediente')).":</span></b> ".$caso['nro_expediente'].'</li>
                                                       <li><b><span>'.ucfirst($translate->_('_estado')).":</span></b> ".ucfirst(str_replace('_',' ',($caso['estado']))).'</li>
                                                      </ul>';
                                                echo '<p><b>Juzgado</b>: '.$value['nominacion'].'</p>';      
                                                if (!empty($caso['movimiento'])){          
                                                    echo "<div style='padding:20px'><table class='table table-hover'>";
                                                        echo "<thead><tr>";                   
                                                        echo "<th>".ucfirst($translate->_('_fecha_movimiento'))."</th>";
                                                        echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                                        echo "<th>".ucfirst($translate->_('_publico'))."</th>";
                                                        echo "<th>".ucfirst($translate->_('_descripcion'))."</th>";
                                                        echo "</tr></thead>";                                        
                                                        echo "<tr>";
                                                        echo "<td>".mostrar_fecha_esp($caso['movimiento']['fecha'])."</td>";
                                                        echo "<td>".ucfirst($translate->_($caso['movimiento']['tipo_estado']));
                                                                    ucfirst($translate->_($caso['movimiento']['tipo_estado']));
                                                                    if ($caso['movimiento']['tipo_estado']== '_procesal'){
                                                                        echo " (".$caso['movimiento']['acto_procesal'].") ";    
                                                                    }                                            
                                                        echo "</td><td>";
                                                                if ($caso['publico']== 1)
                                                                    echo "<b>SI</b>";
                                                                else
                                                                    echo "<b>NO</b>";
                                                        echo "</td>";
                                                        echo "<td>".nl2br($caso['movimiento']['descripcion'])."</td>";
                                                        echo "</tr>";
                                                    
                                                    echo "</table></div>";
                                                }                                          
            
                                            echo '</div>';
                                        echo '</div>';
                                    	
                                    }
                                
                                ?>
                                                           

                </div>
            </div>
        </div>
    </div>            
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $(".select").select2({ width: '100%',height:'55px' });
    })    

    $(document).on("click", ".eliminar", function(event){
        var id_param =  this.id;
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_caso_recorrida')) ; ?>', function(result){
                if(result) {
                    eliminarcaso(id_param);
                }
            });
    });

    function eliminarcaso(id_param){

        $.post(base+"/ajax/eliminarCasoRecorridaBd.php",{id:id_param},
            function(data){
                //dialogItself.close(); console.log(data);
                location.reload(true);
            }
        );
    }
    
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