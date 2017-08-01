<?php
    
    $hidden = '<input type="hidden" value="'.$caso['id'].'" name="id" id="id_caso">';
    $hidden_movimiento = '<input type="hidden" value="'.$caso['id'].'" name="id_caso">';

?>
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
                         <a class="btn btn-success" href="index.php/casosAdmin/view/<?php echo $caso['id'] ?>/"><i class="fa fa-eye"></i>&nbsp;<?php echo ucfirst($translate->_('_ver')) ; ?></a>
                         <a class="btn btn-danger" href="index.php/casosAdmin/delete/<?php echo $caso['id'] ?>/"><i class="fa fa-trash-o"></i>&nbsp;<?php echo ucfirst($translate->_('_eliminar')) ; ?></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        
                        
                        
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li>
                                <a href="#movimientos" data-toggle="tab" id='tab_mov'><?php echo ucfirst($translate->_('_movimientos')) ; ?></a>
                                </li>                             
                                <li>
                                <a href="#home" data-toggle="tab" id='tab_home'><?php echo ucfirst($translate->_('_datos')) ; ?></a>
                                </li>
                                <li>
                                <a href="#contabilidad" data-toggle="tab" id='tab_home'><?php echo ucfirst($translate->_('_contabilidad')) ; ?></a>
                                </li>
                                <li>
                                <a href="#ejecucion" data-toggle="tab" id='tab_ejecucion'><?php echo ucfirst($translate->_('_ejecucion')) ; ?></a>
                                </li>                                
                                <li><a href="#objeto" data-toggle="tab"><?php echo ucfirst($translate->_('_objeto')) ; ?></a>
                                </li>
                                <li><a href="#parte" data-toggle="tab"><?php echo ucfirst($translate->_('_partes')) ; ?></a>
                                </li>
                                <li><a href="#juzgado" data-toggle="tab"><?php echo ucfirst($translate->_('_tribunal')) ; ?></a>
                                </li class="active">
                                    <li><a href="#agenda" data-toggle="tab"><?php echo ucfirst($translate->_('_agenda')) ; ?></a>
                                </li>                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade " id="movimientos">
                                


                                    <br />
                                    <div id='div_movimientos'>
                                    <div class="text-right">
                                         <a class="btn btn-primary" id='btn_nuevo_movimiento'><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_agregar_movimiento')) ; ?></a>
                                    </div>                                     
                                    <?php
                                    
                                        echo "<table class='table'>";
                                            echo "<thead><tr>";
                                            echo "<th>".ucfirst($translate->_('_fecha_movimiento'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_publico'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_descripcion'))."</th>";
                                            echo "<th>&nbsp;</th>";
                                            echo "</tr></thead>";                                        
                                        foreach ($movimientos as $key=>$value) {

                                            echo "<tr>";
                                            echo "<td>".mostrar_fecha_esp($value['fecha'])."</td>";
                                            echo "<td>".ucfirst($translate->_($value['tipo_estado']));
                                                        ucfirst($translate->_($value['movimiento']['tipo_estado']));
                                                        if ($value['tipo_estado']== '_procesal'){
                                                            echo "(".$value['acto_procesal'].") ";    
                                                        }                                            
                                            echo "</td><td>";
                                                    if ($value['publico']== 1)
                                                        echo "<b>SI</b>";
                                                    else
                                                        echo "<b>NO</b>";
                                            echo "</td>";
                                            echo "</td><td>".$value['descripcion']."</td>";
                                            echo "<td style='width:10%'>
                                                    <a class='editar_movimiento editar manito' id='mov_".$value['id']."'><i class='fa fa-pencil-square-o fa-lg blueiconcolor'></i></a></span>&nbsp;
                                                    <a class='eliminar_movimiento eliminar manito' id='mov_".$value['id']."'><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>";
                                            echo "</tr>";
                                            
                                            echo "<tr><td colspan=5 style='border-top:0px'>
                                                <span id='span_file_".$value['id']."' class='subir_archivo label label-success manito'>".ucfirst($translate->_('_subir_archivo'))."</span>
                                                
                                                <div style='display:none' id='div_file_".$value['id']."'><br /> 
                                                <form class='file' enctype='multipart/form-data' method='post' id='f_".$value['id']."'>

                                                        <input type='hidden' id='id_movimiento' name='id_movimiento' value=".$value['id'].">
                                                        <a class='btn btn-info'>&nbsp;Seleccione el archivo
                                                        <span class='btn btn-default btn-file'>
                                                           <i class='fa fa-search fa-lg blueiconcolor'></i><input type='file' name='file_mov'>
                                                        </span>                                                        
                                                        </a>                                                		
                                                        <input class='btn btn-info' type='submit' name='submit' value='Subir archivo'>
                                                		
                                                
                                                </form>
                                                </div>";
                                            
                                            echo "</td></tr>";                                            

                                            if( (!empty($value['archivos'])) and ($value['archivos']!='-1')){
                                                echo "<tr><th colspan=5>".ucfirst($translate->_('_archivos_del_movimiento'))."</th></tr>";
                                                foreach ($value['archivos'] as $k) {
                                                    echo "<tr>"; //<a href="RUTA_CASO.$id_caso.'/movimientos/'.$id_movimiento.'/'" download>Click here to download</a>
                                                    echo "<td colspan=3><a download href='".__SITIO."files/casos/".$caso['id']."/movimientos/".$value['id']."/".$k."'>".$k."</a></td>";
                                                    echo "<td style='width:10%'>
                                                            <a class='eliminar_file_movimiento eliminar manito' id='".$k."' name='".$value['id']."'><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>";
                                                    echo "</tr>";                                            
                                                }
                                            }
                                            echo "<tr><td colspan=5 style='border-top:0px;border-bottom:1px solid'>&nbsp;</td></tr>";
                                        }
                                        echo "</table>";
                                    ?>

                                    </div>
                                    <div id='div_nuevo_movimiento'> <br><br>
                                        <form role="form" action="index.php/casosAdmin/editmovimiento/" method=post>
                                            <?php echo $hidden_movimiento; ?>
                                            <input type='hidden' value='-1' id='id_movimiento_edit' name='id'>
                                            <div class="form-group">
                                                <label for="name"><?php echo ucfirst($translate->_('_fecha_movimiento')) ; ?></label>
                                                <div class='input-group date' id='datetimepicker2'>
                                                    <input type='text' class="form-control" name ="fecha" id ="fecha"/>
                                                    <span class="input-group-addon"><span></span>
                                                    </span>
                                                </div>
                                            </div>                                             
                                            <div class="form-group">
                                            	<label for="tipo"><?php echo ucfirst($translate->_('_tipo')) ; ?></label>
                                                <select name="tipo_estado" id="tipo_estado" required>
                                                    <option value='' ></option> 
                                                    <?php
                                                        echo "<option value='_procesal' >".ucfirst($translate->_('_procesal'))."</option>"; 
                                                        echo "<option value='_no_procesal'>".ucfirst($translate->_('_no_procesal'))."</option>";
                                                        echo "<option value='_otro'>".ucfirst($translate->_('_otro'))."</option>";
                                                    ?>
                                                </select> 
                                                <br><br>
                                                <div id ='div_tipo_estado'>
                                                    <div class="form-group">
                                                    	 <label for="acto_procesal"><?php echo ucfirst($translate->_('_acto_procesal')) ; ?></label>
                                                         <input type="text" class="form-control" id="acto_procesal" name="acto_procesal"  />
                                                    </div>                                                 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                        	   <label for="description"><?php echo ucfirst($translate->_('_descripcion')) ; ?></label>
                                               <textarea style="height:100px" class="form-control" name="descripcion" id="descripcion"  /></textarea>
                                            </div>

                                        <div class="form-group">
                                        	 <label for="publico"><?php echo ucfirst($translate->_('_publico')) ; ?></label>
                                             <input type="checkbox" name="publico" id="publico" >
                                        </div>
     
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                                <button type="button" class="btn btn-warning" id="btn_cancel_nuevo_movimiento"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                            </div>                                                                           
                                        </form>
                                    
                                    </div>





                                    
                                </div>                            
                            
                                <div class="tab-pane fade" id="home">
                                    <form role="form" action="index.php/casosAdmin/edit_bd/" method=post>
                                        <?php echo $hidden; ?>
                                        <br>
                                        <div class="form-group">
                                        	 <label for="caso"><?php echo ucfirst($translate->_('_caso')) ; ?></label><textarea style="height:100px" class="form-control" id="caso" name="caso"  /><?php echo sanitize($caso['caso']) ;?></textarea>
                                        </div>  
                                        <div class="form-group">
                                        	 <label for="name"><?php echo ucfirst($translate->_('_naturaleza')) ; ?></label>
                                            <select name="id_naturaleza" id="id_naturaleza" required>
                                                <option></option>
                                                <?php
                                                    foreach ($naturalezas as $key=>$value) {
                                                        $sel = '';
                                                        if ($value['id'] == $caso['id_naturaleza']){
                                                            $sel = " selected = selected";
                                                        }                                                      
                                                        echo "<option value=".$value['id']." ".$sel.">".$value['nombre']."</option>";                                	
                                                    }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="name"><?php echo ucfirst($translate->_('_fecha_ingreso')) ; ?></label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" name ="fecha_ingreso" value="<?php echo mostrar_fecha_esp($caso['fecha_ingreso']) ;?>" />
                                                <span class="input-group-addon"><span></span>
                                                </span>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                        	 <label for="nro_carpeta"><?php echo ucfirst($translate->_('_nro_carpeta')) ; ?></label>
                                             <input value="<?php echo sanitize($caso['nro_carpeta']) ;?>" type="text" class="form-control" id="nro_carpeta" name="nro_carpeta"  />
                                        </div>   
                                        <div class="form-group">
                                        	 <label for="nro_expediente"><?php echo ucfirst($translate->_('_nro_expediente')) ; ?></label>
                                             <input value="<?php echo sanitize($caso['nro_expediente']) ;?>" type="text" class="form-control" id="nro_expediente" name="nro_expediente"  />
                                        </div> 
                                        <div class="form-group">
                                        	 <label for="estado"><?php echo ucfirst($translate->_('_estado')) ; ?></label>
                                             <select name='estado' id='estado'>
                                                <option value='inicio' <?php if ($caso['estado']=='inicio'){ echo " selected=selected ";}  ?> ><?php echo ucfirst($translate->_('_estado_inicio')) ; ?></option>
                                                <option value='verificacion' <?php if ($caso['estado']=='verificacion'){ echo " selected=selected ";}  ?> ><?php echo ucfirst($translate->_('_estado_verificacion')) ; ?></option>
                                                <option value='computos' <?php if ($caso['estado']=='computos'){ echo " selected=selected ";}  ?>><?php echo ucfirst($translate->_('_estado_computos')) ; ?></option>
                                                <option value='area_legal' <?php if ($caso['estado']=='area_legal'){ echo " selected=selected ";}  ?>><?php echo ucfirst($translate->_('_estado_area_legal')) ; ?></option>
                                                <option value='fevorable' <?php if ($caso['estado']=='fevorable'){ echo " selected=selected ";}  ?>><?php echo ucfirst($translate->_('_estado_favorable')) ; ?></option>
                                                <option value='desfavorable' <?php if ($caso['estado']=='desfavorable'){ echo " selected=selected ";}  ?>><?php echo ucfirst($translate->_('_estado_desfavorable')) ; ?></option>
                                                <option value='a_la_espera_de_dictamen_medico' <?php if ($caso['estado']=='a_la_espera_de_dictamen_medico'){ echo " selected=selected ";}  ?>><?php echo ucfirst($translate->_('_estado_espera_medico')) ; ?></option>
                                             </select>
                                        </div>
                                        <div class="form-group">
                                        	 <label for="archivado"><?php echo ucfirst($translate->_('_archivado')) ; ?></label>
                                            <input type="checkbox" name="archivado" <?php if ($caso['archivado']==1) {echo 'checked';}   ?>>
                                        </div>                                                                                                                              
                                      <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                        <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                      </div>
                        			</form>
                                </div>



                                <!-- tab de contabilidad -->
                                <div class="tab-pane " id="contabilidad">

                                    <br />


                                    <?php

                                        echo "<div id='lista_movimientos_contables' class='contable'>
                                                <div class='text-right'>
                                                    <a class='btn btn-primary' id='btn_nuevo_movimiento_contable'><i class='fa fa-plus'></i>&nbsp;". ucfirst($translate->_('_nuevo_movimiento_contable'))."</a>
                                                    <a class='btn btn-primary' id='btn_cobrar_cuota_contable'><i class='fa fa-plus'></i>&nbsp;". ucfirst($translate->_('_cobrar_cuota'))."</a>
                                                    <a class='btn btn-primary' id='btn_nuevo_convenio_contable'><i class='fa fa-plus'></i>&nbsp;". ucfirst($translate->_('_nuevo_convenio'))."</a>
                                                </div>";


                            echo "<table  class='table table-striped'>";
                                echo "<thead><tr>";
                                echo "<th>".ucfirst($translate->_('_fecha'))."</th>";
                                echo "<th>".ucfirst($translate->_('_tipo_contable'))."</th>";
                                echo "<th style='width:20%;text-align:center'>".ucfirst($translate->_('_egreso'))."</th>";
                                echo "<th style='width:20%;text-align:center'>".ucfirst($translate->_('_ingreso'))."</th>";
                                echo "<th>&nbsp;</th>";
                                echo "</tr></thead>";                             
                                foreach ($contables as $key=>$value){
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


                                        
                                        
                                        echo "</div>"; // fin div lista de movimientos

                                        echo "<div id='nuevo_movimiento_contable' class='contable' style='display:none'>";
                                            echo' <form role="form" action="index.php/contabilidadAdmin/edit_bd/" method=post>';
                                             echo $hidden_movimiento;
                                            echo'  <div class="form-group">
                                                    	 <label for="name">'.ucfirst($translate->_('_asentar')).'</label>
                                                        <select name="padre" id="padre" required class="form-control">
                                                            <option value=2>'. ucfirst($translate->_('_egreso')).'</option>
                                                            <option value=1>'. ucfirst($translate->_('_ingreso')).'</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>'.ucfirst($translate->_('_concepto')).'</label>
                                                        <span id="btn_nuevo_concepto" class="label label-primary manito">'. ucfirst($translate->_('_crear_nuevo')).'</span>
                                                        <br />
                                                        <input type="hidden" id="id_concepto" class="bigdrop" name="id_concepto" style="width:100%" required/>
                                                    </div>

                                                    <div class="form-group">
                                                    	 <label for="name">'. ucfirst($translate->_('_monto')).'</label>
                                                         <input class="form-control " id="monto"  name="monto" type="text" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="name">'. ucfirst($translate->_('_fecha')).'</label>
                                                        <div class="input-group date" id="datetimepickercontable">
                                                            <input class="form-control" name="fecha" />
                                                            <span class="input-group-addon"><span></span>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                    	 <label for="name">'.ucfirst($translate->_('_observaciones')).'</label>
                                                         <textarea class="form-control " id="observaciones"  name="observaciones" style="height:150px"></textarea>
                                                    </div>

                                                  <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-primary">'. ucfirst($translate->_('_aceptar')).'</button>
                                                    <button type="button" class="btn btn-warning btn_lista_contable" id="btn_cancel_movimiento_contable">'. ucfirst($translate->_('_cancelar')).'</button>
                                                  </div>
                                    			</form>';

                                        echo "</div>"; // fin div nuevo_movimiento_contable

                                        echo "<div id='cuota_movimiento_contable' class='contable' style='display:none'>";

                                            echo' <form role="form" action="index.php/casosAdmin/cobrarcuota/" method=post>';
                                                    echo $hidden;
                                            echo'  <div class="form-group">
                                                    	 <label for="name">'.ucfirst($translate->_('_convenios')).'</label>
                                                        <select name="convenios" id="convenios" class="form-control">';
                                                            foreach ($convenios_abiertos as $key=>$value) {
                                                                echo "<option value=".$value['id'].">".$value['nombre']."</option>";
                                                            }
                                                        echo'</select>
                                                    </div>
                                                    <div id="proxima_cuota"></div>
                                                    <div class="form-group text-right">
                                                        <button type="submit" class="btn btn-primary">'. ucfirst($translate->_('_aceptar')).'</button>
                                                        <button type="button" class="btn btn-warning btn_lista_contable" id="btn_cancel_movimiento_contable">'. ucfirst($translate->_('_cancelar')).'</button>
                                                    </div>
                                            </form>';
                                        



                                        echo "</div>"; // fin div nuevo_movimiento_contable

                                        echo "<div id='nuevo_convenios_contables' class='contable' style='display:none'>";

                                            echo' <form role="form" action="index.php/casosAdmin/addconvenio/" method=post>';
                                            echo $hidden;
                                            echo'  <div class="form-group">
                                                    	 <label for="name">'. ucfirst($translate->_('_nombre_convenio')).'</label>
                                                         <input class="form-control " id="nombre"  name="nombre" type="text" required>
                                                    </div>

                                                    <div class="form-group">
                                                    	 <label for="name">'. ucfirst($translate->_('_monto')).'</label>
                                                         <input class="form-control " id="monto"  name="monto" type="text" required>
                                                    </div>

                                                    <div class="form-group">
                                                    	 <label for="name">'. ucfirst($translate->_('_cantidad_cuotas')).'</label>
                                                         <input class="form-control " id="cantidad_cuotas"  name="cantidad_cuotas" type="text" required>
                                                    </div>

                                                    <div class="form-group">
                                                    	 <label for="name">'. ucfirst($translate->_('_porcentaje_interes_anual')).'</label>
                                                         <input class="form-control " id="porcentaje_anual"  name="porcentaje_anual" type="text" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">'. ucfirst($translate->_('_fecha_ra_cuota')).'</label>
                                                        <div class="input-group date" id="datetime_ra_cuota">
                                                            <input class="form-control" name="dia_primera_cuota"  name="dia_primera_cuota" />
                                                            <span class="input-group-addon"><span></span>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                    	 <label for="observaciones">'.ucfirst($translate->_('_observaciones_contable')).'</label><textarea style="height:100px" class="form-control" id="observaciones" name="observaciones"  /></textarea>
                                                    </div>

                                                  <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-primary">'. ucfirst($translate->_('_aceptar')).'</button>
                                                    <button type="button" class="btn btn-warning btn_lista_contable" id="btn_cancel_movimiento_contable">'. ucfirst($translate->_('_cancelar')).'</button>
                                                  </div>
                                    			</form>';

                                        echo "</div>"; // fin div nuevo_movimiento_contable

                                        echo "<div id='convenios_contables' class='contable' style='display:none'>";
                                            echo "lista convenios contables";
                                        echo "</div>"; // fin div nuevo_movimiento_contable

                                      ?>


                                </div>
                                
                               
                               <!-- tab de liquidaciones-->
                                <div class="tab-pane fade" id="ejecucion">

                                    <br />
                                    <div id='div_liquidaciones'>
                                    <div class="text-right">
                                         <a class="btn btn-primary" id='btn_nueva_liquidacion'><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_agregar_liquidacion')) ; ?></a>
                                    </div>                                     
                                    <?php
                                        echo "<table class='table table-hover'>";
                                            echo "<thead><tr>";
                                            echo "<th>".ucfirst($translate->_('_expedientes_liquidacion'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_total_liquidacion'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_eliminar'))."</th>";
                                            echo "</tr></thead>";                                        
                                        foreach ($liquidaciones as $key=>$value) {
                                            echo "<tr>";
                                            echo "<td>".$value['expediente']."</td>";
                                            echo "<td> $ ".round($value['total_cabecera'],2)."</td>";
                                            echo "<td style='width:10%'>
                                                <a class='editar_liqui editar manito' id='liqui_".$value['id']."'><i class='fa fa-pencil-square-o fa-lg blueiconcolor'></i></a>
                                                <a class='eliminar eliminar_liqui manito' id='liqui_".$value['id']."'><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>";
                                            echo "</td></tr>";
                                        }
                                        echo "</table>";
                                    ?>
                                    </div>
                                    
                                    <div id='div_editar_liquidacion' style='display:none'>Editar</div>



                                    <div id='div_nueva_liquidacion'> <br><br>
                                        <form role="form" action="index.php/casosAdmin/nuevaliqui/" method=post>
                                            <?php echo $hidden; ?>
                                            <div class="form-group">
                                                <label for="expediente">Expediente</label>
                                                <input required type="text" class="form-control" id="expediente" name="expediente">
                                            </div>
                                            <div class="form-group">
                                                <label for="autos">Autos</label>
                                                <input type="text" class="form-control" id="autos" name="autos" value="<?php echo sanitize($caso['caso']) ;?>" >
                                            </div>  
                                            <div class="form-group">
                                                <label for="juzgado_liqui">Juzgado</label>
                                                <input type="text" class="form-control" id="juzgado_liqui" name="juzgado_liqui" value="<?php echo sanitize($caso['nominacion']) ;?>">
                                            </div>     
                                            <div class="form-group">
                                                <div class="row">
                                                  <div class="col-xs-4">
                                                    <label for="rubro_cabecera">Rubro</label>
                                                    <input type="text" class="form-control" id="rubro_cabecera" name="rubro_cabecera">
                                                  </div>
                                                  <div class="col-xs-8">
                                                    <label for="titulo_cabecera">Titulo</label>
                                                    <input type="text" class="form-control" id="titulo_cabecera" name="titulo_cabecera">
                                                  </div>
                                                </div>                                             
                                            </div> 
                                            <div class="form-group">
                                              <div class="row">
                                                <div class="col-xs-6">
                                                <label for="fecha_exibicion">Fecha de exibicion</label>
                                                <div class='input-group date' id='fecha_li1'>
                                                    <input type='text' class="form-control" name ="fecha_exibicion" id ="fecha_exibicion"/>
                                                    <span class="input-group-addon"><span></span>
                                                    </span>
                                                </div>
                                                </div>
                                                <div class="col-xs-6">
                                                <label for="titulo_cabecera">Fecha act</label>
                                                <div class='input-group date' id='fecha_li2'>
                                                    <input type='text' class="form-control" name ="fecha_act" id ="fecha_act"/>
                                                    <span class="input-group-addon"><span></span>
                                                    </span>
                                                </div>
                                                </div>
                                               </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                     &nbsp;
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="capital_inicial"><?php echo ucfirst($translate->_('_capital_inicial')) ; ?></label>
                                                        <input type="text" class="form-control" id="capital_inicial" name="capital_inicial">
                                                    </div>
                                                </div>    
                                            </div>                                             
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-6">                                            
                                                        <label for="interes_anual"><?php echo ucfirst($translate->_('_interes_anual')) ; ?></label>
                                                        <input type="text" class="form-control" id="interes_anual" name="interes_anual">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label>&nbsp;</label>
                                                       <input type="text" value="" class="form-control" id="interes_anual_lectura" name="interes_anual_lectura" readonly=readonly>
                                                    </div>
                                                </div>        
                                            </div>                                                                                                                                                                                                                                
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-6">                                             
                                                        <label for="interes_punitorio_anual"><?php echo ucfirst($translate->_('_interes_punitorio_anual')) ; ?></label>
                                                        <input type="text" class="form-control" id="interes_punitorio_anual" name="interes_punitorio_anual">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label>&nbsp;</label>
                                                       <input type="text" value="" class="form-control" id="interes_punitorio_anual_lectura" name="interes_anual_lectura" readonly=readonly>
                                                    </div>                                                    
                                                </div>        
                                            </div>  
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-6">                                             
                                                        <label for="iva"><?php echo ucfirst($translate->_('_iva')) ; ?></label>
                                                        <input type="text" class="form-control" id="iva" name="iva">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label>&nbsp;</label>
                                                       <input type="text" value="" class="form-control" id=iva_lectura" name="iva_lectura" readonly=readonly>
                                                    </div>                                                    
                                                </div>        
                                            </div>      
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6 col-md-offset-6">                                             
                                                        <label for="iva"><?php echo ucfirst($translate->_('_total')) ; ?></label>
                                                        <input type="text" class="form-control" id="total_parcial" name="total_parcial" readonly=readonly>
                                                    </div>
                                                </div>        
                                            </div>                                                                                 
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                                <button type="button" class="btn btn-warning" id="btn_cancel_liqui"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                            </div>                                                                           
                                        </form>                                      
                                    </div>
                                </div> 
                                <!-- fin tab de liquidaciones -->




                                <!-- tab de objeto -->
                                <div class="tab-pane fade" id="objeto">
                                    <form role="form" action="index.php/casosAdmin/edit_bd/" method=post>
                                        <?php echo $hidden; ?>
                                        <br>
                                        <div class="form-group">
                                        	 <label for="description"><?php echo ucfirst($translate->_('_requerimiento_cliente')) ; ?></label><textarea style="height:100px" class="form-control" id="requerimientos_cliente" name="requerimientos_cliente"  /><?php echo sanitize($caso['requerimientos_cliente']) ;?></textarea>
                                        </div>
                                        <div class="form-group">
                                        	 <label for="description"><?php echo ucfirst($translate->_('_opinion_profesional')) ; ?></label><textarea style="height:100px" class="form-control" id="opinion_profesional" name="opinion_profesional"  /><?php echo sanitize($caso['opinion_profesional']) ;?></textarea>
                                        </div>                                              
                                      <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                        <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                      </div>
                        			</form>
                                </div>
                                <!-- fin tab de objeto -->
                                <!-- tab de partes -->
                                <div class="tab-pane fade" id="parte">
                                    <br />
                                    <div id='div_partes'>
                                    <div class="text-right">
                                         <a class="btn btn-primary" id='btn_nueva_parte'><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_agregar_parte')) ; ?></a>
                                    </div>                                     
                                    <?php
                                        echo "<table class='table table-hover'>";
                                            echo "<thead><tr>";
                                            echo "<th>".ucfirst($translate->_('_nombres'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_rol'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                            echo "<th>".ucfirst($translate->_('_eliminar'))."</th>";
                                            echo "</tr></thead>";                                        
                                        foreach ($partes as $key=>$value) {
                                            echo "<tr>";
                                            echo "<td>".$value['nombres'].' '.$value['apellido']."</td>";
                                            echo "<td>".$value['rol']."</td>";
                                            echo "<td>".ucfirst($translate->_($value['tipo']))."</td>";
                                            echo "<td style='width:10%'><a class='eliminar eliminar_parte manito' id='part_".$value['id_parte']."'><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>";
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                    ?>
                                    </div>
                                    <div id='div_nueva_parte'> <br><br>
                                        <form role="form" action="index.php/casosAdmin/editparte/" method=post>
                                            <?php echo $hidden; ?>
                                            <div class="form-group">
                                                <label><?php echo ucfirst($translate->_('_buscar_parte_existente')) ; ?></label>
                                                <span id="btn_nueva_parte_modal" class="label label-primary manito"><?php echo ucfirst($translate->_('_crear_nueva_parte')) ; ?></span>
                                                <br />
                                                <input type="hidden" id="select_nueva_parte" class="bigdrop" name="select_nueva_parte" style="width:100%" />
                                            </div>

                                        <div class="form-group">
                                        	<label for="tipo"><?php echo ucfirst($translate->_('_tipo')) ; ?></label>
                                            <select name="tipo" id="tipo" required>
                                                <?php
                                                    echo "<option value='_parte' >".ucfirst($translate->_('_parte'))."</option>"; 
                                                    echo "<option value='_contraparte'>".ucfirst($translate->_('_contraparte'))."</option>";
                                                    echo "<option value='_tercero'>".ucfirst($translate->_('_tercero'))."</option>";
                                                ?>
                                            </select> 
                                        </div>
                                        
                                        <div class="form-group">
                                        	 <label for="id_rol"><?php echo ucfirst($translate->_('_rol')) ; ?></label>
                                            <select name="id_rol" id="id_rol" required>
                                                <?php
                                                    $sel = '';
                                                    foreach ($roles as $key=>$value) {
                                                        echo "<option value=".$value['id']." ".$sel.">".$value['nombre']."</option>";                                	
                                                    }
                                                ?>
                                            </select> 
                                        </div>     
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                                <button type="button" class="btn btn-warning" id="btn_cancel_parte"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                            </div>                                                                           
                                        </form>
                                    
                                    </div>
                                </div>
                                <!-- fin tab de partes -->
                                
                                <!-- tab de tribunal -->
                                <div class="tab-pane fade" id="juzgado">
                                    <div id='div_nueva_radicacion' >
                                    <br><br><br>
                                         <form role="form" action="index.php/casosAdmin/editradicacion/" method=post>
                                            <? echo $hidden;?>
                                            <div class="form-group">
                                                <label><?php echo ucfirst($translate->_('_buscar_juzgado_existente')) ; ?></label>
                                                <span id="btn_modal_juzgado"  class="label label-primary manito "><?php echo ucfirst($translate->_('_crear_nuevo_juzgado')) ; ?></span>
                                                <br />
                                                <input type="hidden" class="bigdrop" id="select_nuevo_juzgado" name="select_nuevo_juzgado" style="width:100%" />
                                            </div>  
                                            <div class="form-group">
                                            	 <label for="nro_carpeta"><?php echo ucfirst($translate->_('_nro_expediente')) ; ?></label>
                                                 <input type="text" class="form-control" id="nro_expediente" name="nro_expediente"  />
                                            </div>                                                                                                                      
                                             
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                                <button type="button" class="btn btn-warning" id="btn_cancel_nueva_radicacion"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                            </div>                                                                           
                                        </form>                                        
                                    </div>
                                    <!-- div de nueva radicacion -->
                                    <div id='div_radicaciones'>
                                    <br>
                                    <div class="text-right">
                                         <a class="btn btn-primary" id='btn_nueva_radicacion'><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_nueva_radicacion')) ; ?></a>
                                    </div>                                     
                                        <h4><?php echo ucfirst($translate->_('_radicacion_actual')) ; ?></h4>
                                        <?php echo 'Juzgado:&nbsp;'.$caso['nominacion'].'<br>'; ?>
                                        <?php echo 'Expediente:&nbsp;'.$caso['nro_expediente']; ?>
                                        <?php 
                                            // si hay radicaciones anteriores 
                                            if (!empty($radicaciones)){
                                        ?>
                                        <hr>
                                        <h4><?php echo ucfirst($translate->_('_radicaciones_anteriores')) ; ?></h4>
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th><?php echo ucfirst($translate->_('_tribunal')) ; ?></th>
                                                    <th><?php echo ucfirst($translate->_('_nro_expediente')) ; ?></th>
                                                    <th><?php echo ucfirst($translate->_('_acciones')) ; ?></th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                            <?php
                                                foreach ($radicaciones as $key=>$value){
                                                    echo "<tr class='odd gradeX'>";
                                                    echo "<td style='width:70%'>".$value['nominacion']."</td>";
                                                    echo "<td style='width:15%'>".$value['nro_expediente']."</td>";
                                                    echo "<td style='width:15%;' class='text-center'>
                                                            <a class='ver' href='index.php/tribunalesAdmin/listcasos/".$value['id_juzgado']."/'><i class='fa fa-info-circle fa-lg greeniconcolor'></i></a>&nbsp;
                                                            <a class='eliminar eliminar_tribunal manito' id='rad_".$value['id']."'><i class='fa fa-trash-o fa-lg rediconcolor'></i></a>
                                                         </td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        <?php
                                            } // fin radicaciones anteriores
                                        ?>
                                    </div>
                                    <!-- fin div de nueva radicacion -->
                                </div>
                                <!-- fin tab de tribunal -->
                                <!-- tab de agenda -->
                                <div class="tab-pane fade active" id="agenda">
                                    <br><br>
                                    <div id='calendar'></div>
                                </div>                                
                            </div>


                            </div>         
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>

<?php

    $file =  "english.txt";
    if ($lenguaje_automatic == 1){
        $file =  "english.txt";
    }else{
        if ($lenguaje =='es'){
            $file =  "spanish.txt";    
        }
        if ($lenguaje =='fr'){
            $file =  "french.txt";    
        } 
        if ($lenguaje =='it'){
            $file =  "italian.txt";    
        } 
        if ($lenguaje =='pt'){
            $file =  "portuguese_brasil.txt";    
        }  
        if ($lenguaje =='en'){
            $file =  "english.txt";    
        }                             
    }
    
?>        
   


<script type="text/javascript">

    $('#mytabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show')
    })
    
    $(document).ready(function() {
    
        //naturaleza del caso
        $("#tipo_estado").select2({ width: '100%',height:'55px' });
        //naturaleza del caso
        $("#id_naturaleza").select2({ width: '100%',height:'55px' });
        // tipo dle caso
        $("#tipo").select2({ width: '100%',height:'55px' });
        // rol del caso
        $("#id_rol").select2({ width: '100%',height:'55px' });
        //estado del caso
        $("#estado").select2({ width: '100%',height:'55px' });
        
        $("[name='archivado']").bootstrapSwitch({onText:'<?php echo ucfirst($translate->_('_si')) ; ?>',offText:'<?php echo ucfirst($translate->_('_no')) ; ?>',size:'large'});
        $("[name='publico']").bootstrapSwitch({onText:'<?php echo ucfirst($translate->_('_si')) ; ?>',offText:'<?php echo ucfirst($translate->_('_no')) ; ?>',size:'large'});
        
        //autocompletador para seleccionar una nueva parte
        $('#select_nueva_parte').select2({
            placeholder : " <?php echo ucfirst($translate->_('_seleccione')) ; ?>",
            minimumInputLength: 2,
            ajax: {
                url: base+"/ajax/getPartes.php",
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term,
                        page_limit: 10
                    };
                },
                results: function (data, page) { 
                    return { results: data };
                }
            },
            allowClear: true,
            formatSelection: function(data) { 
                return data.text; 
            }   
        });
        // aucompletador para una nueva radicacion
        $('#select_nuevo_juzgado').select2({
            placeholder : " <?php echo ucfirst($translate->_('_seleccione')) ; ?>",
            minimumInputLength: 2,
            ajax: {
                url: base+"/ajax/getJuzgados.php",
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term,
                        page_limit: 10
                    };
                },
                results: function (data, page) { 
                    return { results: data };
                }
            },
            allowClear: true,
            formatSelection: function(data) { console.log(data);
                return data.text; 
            }   
        });        
    });
    // boton en el form1 del caso
    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/casosAdmin/');
    });
    // boton para cancelar una nueva radicacion
    $(document).on("click", "#btn_cancel_nueva_radicacion", function(event){
        $("#div_nueva_radicacion").hide();
        $("#div_radicaciones").show();  
    });  
    // para eliminar radicacion anterior
    $(document).on("click", ".eliminar_tribunal", function(event){
        eliminar_tribunal(this.id)
    });
    // para eliminar radicacion anterior
    $(document).on("click", ".eliminar_items_liqui", function(event){
        eliminar_items_liqui(this.id);
    });

    // para eliminar parte
    $(document).on("click", ".eliminar_parte", function(event){
        eliminar_parte(this.id)
    });  
    // para eliminar movimiento
    $(document).on("click", ".eliminar_movimiento ", function(event){
        eliminar_movimiento(this.id)
    });       
    // en el onchange del select de tipo de estado
    $(document).on("change", "#tipo_estado", function(event){
        mostrar_actoprocesal(this.value)
    }); 
    // boton para mostrar el form de nuevo movimiento
    $(document).on("click", "#btn_nuevo_movimiento", function(event){
        $("#div_movimientos ").hide();
        $("#div_nuevo_movimiento").show(); 
                        $("#fecha").val( moment().format('DD/MM/YYYY'));
                        $("#descripcion").val('');
                        $("#acto_procesal").val('');
                        $("#tipo_estado").select2("val",'');
                        mostrar_actoprocesal('_no_procesal');
                        $("#id_movimiento_edit").val('-1');         
    }); 
    // boton para cancelar el form de nuevo movimiento
    $(document).on("click", "#btn_cancel_nuevo_movimiento", function(event){
        $("#div_movimientos ").show();
        $("#div_nuevo_movimiento").hide();  
    });  
    // boton para mostrar el form de nuevo movimiento
    $(document).on("click", ".editar_movimiento", function(event){
        $("#div_movimientos ").hide();
        $("#div_nuevo_movimiento").show();
        editar_movimiento(this.id);  
    });
    // boton para mostrar el file para subir un archivo al movimiento
    $(document).on("click", ".subir_archivo", function(event){
        var id_param = this.id.replace("span_file_","div_file_");
        $("#"+id_param).toggle();
    });     
    $(document).on("click", ".eliminar_file_movimiento", function(event){
        eliminar_file_movimiento(this.name,this.id)
    }); 
    $(document).on("click", ".eliminar_liqui", function(event){
        eliminar_liqui(this.id)
    });

    // boton para crear una nueva liquidacion
    $(document).on("click", "#btn_nueva_liquidacion", function(event){
        $("#div_liquidaciones").hide();
        $("#div_nueva_liquidacion").show();  
        $("#div_editar_liquidacion").hide();
    });   
    // boton para crear una nueva liquidacion
    $(document).on("click", "#btn_cancel_liqui", function(event){
        $("#div_liquidaciones").show();
        $("#div_nueva_liquidacion").hide();
        $("#div_editar_liquidacion").hide();
    });
    // boton para editar una liquidacion
    $(document).on("click", ".editar_liqui", function(event){
        $("#div_liquidaciones").hide();
        $("#div_nueva_liquidacion").hide();
        $("#div_editar_liquidacion").show();
        editar_liqui(this.id);
    });

    // cuando se inicia se esconde este div de nueva liquidacion 
    $("#div_nueva_liquidacion").hide(); 
    // cuando se inicia se esconde este div de nueva parte 
    $("#div_nueva_parte").hide(); 
    // cuando se inica se esconde este div de nueva radicacion
    $("#div_nueva_radicacion").hide();
    // cuando se inica se esconde este div de acto procesal 
    $("#div_tipo_estado").hide();
    // cuando se inica se esconde este div del form acto procesal 
    $("#div_nuevo_movimiento").hide();    
    

     
    $("#btn_nueva_parte").click(function(){
        $("#div_partes").hide();
        $("#div_nueva_parte").show();
    }); 
    // boton para cancelar una nueva radicacion
    $(document).on("click", "#btn_cancel_parte", function(event){
        $("#div_partes").show();
        $("#div_nueva_parte").hide();  
    }); 

    // boton para mostrar el modal para crear una nueva parte
    $(document).on("click", "#btn_nueva_parte_modal", function(event){
            $.post(base+"/ajax/agregarPartes.php",
                function(data){  

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_nueva_parte')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) {agregarParteBd(dialogItself)}
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
    // boton para mostrar el modal para crear una nuevo juzgado
    $(document).on("click", "#btn_modal_juzgado", function(event){
            $.post(base+"/ajax/agregarJuzgado.php",
                function(data){  

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_nuevo_tribunal')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) {agregartribunalBd(dialogItself)}
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
                 
    
    $("#btn_nueva_radicacion").click(function(){
        $("#div_nueva_radicacion").show();
        $("#div_radicaciones").hide();
    });          
    // datepicker de la fecha de ingreso del caso 
    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    }); 
    // datepicker de la fecha de movimiento
    $(function () {
        $('#datetimepicker2').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    });    
    
    // datepicker 
    $(function () {
        $('#fecha_li1').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    }); 
    
    // datepicker 
    $(function () {
        $('#fecha_li2').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    });    
         
    //tabla de radicaciones
    $(document).ready(function() {
        $("#dataTables-example").dataTable( {
            "oLanguage": {
                "sUrl": "<?php echo __SITIO.'includes/js/dataTables/'.$file;?>",
            } ,"iDisplayLength": 50
        } );
        $('.editar').tooltip({
            'show': true,
                'placement': 'bottom',
                'title': "<?php echo ucfirst($translate->_('_editar_tool')) ; ?>"
        });    
        $('.ver').tooltip({
            'show': true,
                'placement': 'bottom',
                'title': "<?php echo ucfirst($translate->_('_ver_tool')) ; ?>"
        });
        $('.eliminar').tooltip({
            'show': true,
                'placement': 'bottom',
                'title': "<?php echo ucfirst($translate->_('_eliminar_tool')) ; ?>"
        });     
    } );
    // funcion de retorno del dialogo para agregar partes
    //---------------------    
    function agregarParteBd(dialogItself){

        var param_apellido = $("#apellido_modal").val();
        var param_nombres = $("#nombres_modal").val();
        var param_tipo = $("#tipo_modal").val();
        var param_personeria =$("#personeria_modal").val() ;
        $.post(base+"/ajax/agregarParteBd.php",{apellido:param_apellido,nombres:param_nombres,tipo:param_tipo,personeria:param_personeria},
            function(data){ 
                dialogItself.close();
                $("#select_nueva_parte").select2("data", {id: data, text: param_apellido+', '+param_nombres});
            }
        );    
    }
    // funcion de retorno para editar una liquidacion
    //---------------------
    function editar_liqui(id_param){
        var id_param = id_param.replace("liqui_","");
        $.post(base+"/ajax/editarLiqui.php",{id:id_param},
            function(data){
                $("#div_editar_liquidacion").html(data);
            }
        );
    }
    // funcion de retorno del dialogo para agregar partes
    //---------------------    
    function agregartribunalBd(dialogItself){

        var param_nombre = $("#nombre_modal").val();
        $.post(base+"/ajax/agregarTribunalBd.php",{nominacion:param_nombre},
            function(data){ 
                dialogItself.close();
                $("#select_nuevo_juzgado").select2("data", {id: data, text:param_nombre});
            }
        );    
    }
    // modal para preguntar si se borra una liquidacion
    //---------------------
    function eliminar_liqui(id_param){

        var id_param = id_param.replace("liqui_","");
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_liquidacion')) ; ?>', function(result){
                if(result) {
                    eliminar_liquiBd(id_param);
                }
            });
    }
    // modal para preguntar si se borra un items de liquidacion
    //---------------------
    function eliminar_items_liqui(id_param){

        var id_param = id_param.replace("liqui_items_","");
          BootstrapDialog.confirm('<?php echo "<h3>".ucfirst($translate->_('_eliminar_items_liquidacion'))."</h3>" ; ?>', function(result){
                if(result) {
                    eliminar_itemsliquiBd(id_param);
                }
            });
    }
    // borrar la radicacion anterior
    //---------------------
    function  eliminar_itemsliquiBd(id_param){

        $.post(base+"/ajax/eliminarItemsLiquiBd.php",{ id : id_param},
                function(data){
                    editar_liqui ('liqui_'+data);
                }
        );
    }
    // modal para preguntar si se borra la radicacion anterior
    //---------------------      
    function eliminar_tribunal(id_param){
    
        var id_param = id_param.replace("rad_","");
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_radicacion_anterior')) ; ?>', function(result){
                if(result) {
                    eliminar_tribunalBd(id_param);
                }
            });
    }  
    // borrar la radicacion anterior
    //---------------------      
    function  eliminar_tribunalBd(id_param){
        
        $.post(base+"/ajax/eliminarRadicacionBd.php",{ id : id_param},
                function(data){  
                    location.reload();                 
                }
        );    
    }
    // modal para preguntar si se borra la radicacion anterior
    //---------------------      
    function eliminar_parte(id_param){
    
        var id_param = id_param.replace("part_","");
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_parte')) ; ?>', function(result){
                if(result) {
                    eliminar_parteBd(id_param);
                }
            });
    }  
    // borrar la radicacion anterior
    //---------------------      
    function  eliminar_liquiBd(id_param){
                                             
        $.post(base+"/ajax/eliminarLiquiBd.php",{ id : id_param},
                function(data){  
                    location.reload();
                }
        );    
    } 
    // borrar la radicacion anterior
    //---------------------
    function  eliminar_parteBd(id_param){

        $.post(base+"/ajax/eliminarParteBd.php",{ id : id_param},
                function(data){
                    location.reload();
                }
        );
    }
    // 
    //---------------------      
    function mostrar_actoprocesal(valor){
    
        if (valor =='_procesal'){
            $("#div_tipo_estado").show();
        }else{
            $("#div_tipo_estado").hide();
        }
    }
    
    // modal para preguntar si se borra la radicacion anterior
    //---------------------      
    function eliminar_movimiento(id_param){
    
        var id_param = id_param.replace("mov_","");
          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_movimiento')) ; ?>', function(result){
                if(result) {
                    eliminar_movimientoBd(id_param);
                }
            });
    }  
    // borrar la radicacion anterior
    //---------------------      
    function  eliminar_movimientoBd(id_param){
                                           
        $.post(base+"/ajax/eliminarMovimientoBd.php",{ id : id_param},
                function(data){     
                    location.reload();                 
                }
        );    
    }     

    // borrar la radicacion anterior
    //---------------------      
    function  editar_movimiento(id_param){
        
        var id_param = id_param.replace("mov_","");                                   
        $.post(base+"/ajax/getMovimiento.php",{ id : id_param},
                function(data){
                    var items = process(data);
                    for (var idx in items){
                        item = items[idx];

                        $("#fecha").val( moment(item.fecha).format('DD/MM/YYYY'));
                        $("#descripcion").val( item.descripcion);
                        $("#acto_procesal").val( item.acto_procesal);
                        $("#tipo_estado").select2("val", item.tipo_estado);
                        mostrar_actoprocesal(item.tipo_estado);
                        $("#id_movimiento_edit").val(id_param);
                        if (item.publico == 1){
                            $("[name='publico']").bootstrapSwitch('state', true);
                        }else{
                            $("[name='publico']").bootstrapSwitch('state', false);
                        }
                    }
                }
        );    
    }     


    // click en el tab HOME
    //---------------------  
    function ver_home(){
    
        $("#tab_mov").click();
    }   
    
    $(document).ready(function() {

        setTimeout ('ver_home()', 10);
        calendario();

    });
    
    
    function calendario(){  //alert(1);

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar').fullCalendar({
        firstDay: 1,
        defaultView: 'agendaWeek',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		buttonText: {
			prev: '&nbsp;&#9668;&nbsp;',
			next: '&nbsp;&#9658;&nbsp;',
			prevYear: '&nbsp;&lt;&lt;&nbsp;',
			nextYear: '&nbsp;&gt;&gt;&nbsp;', 
			today: 'hoy',
			month: 'mes',
			week: 'semana',
			day: 'dia'
		},		
		titleFormat: {
			month: 'MMMM yyyy',
			week: "d [ yyyy]{ '&#8212;'[ MMM] d MMM yyyy}",
			day: 'dddd, d MMM, yyyy'
		},
		columnFormat: {
			month: 'ddd',
			week: 'ddd d/M',
			day: 'dddd d/M'
		},
		allDayText: 'Todo el dia',
		axisFormat: 'H:mm',
		timeFormat: {
			'': 'H(:mm)',
			agenda: 'H:mm{ - H:mm}'
		},
        
    editable: true,
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
    events: <?php echo $agenda; ?>,
    // Convert the allDay from string to boolean
    eventRender: function(event, element, view) { 
        if (event.allDay === 'true' || event.allDay === true) {
            event.allDay = true;
        }else {
            event.allDay = false;
        }
    },
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDay) { 

        var start_param = start;
        var end_param = end;
        var allDay_param = allDay;
        $.post(base+"/ajax/verCitaCalendario.php",
                function(data){  

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_agregar_cita_agenda')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) { 
                                var titulo_param = $('#titulo').val();
                                var descrip_param = $('#descripcion_modal').val();
                                var start = $.fullCalendar.formatDate(start_param, "yyyy-MM-dd HH:mm:ss");
                                var end = $.fullCalendar.formatDate(end_param, "yyyy-MM-dd HH:mm:ss");
                                var id_caso_param = $("#id_caso").val();      console.log(descrip_param);                       
                                $.post(base+"/ajax/agregarCitaCalendarioBd.php",{id_caso:id_caso_param,titulo:titulo_param,descripcion:descrip_param,hora_inicio:start,hora_fin:end },
                                    function(data){
                                        dialogItself.close();
                                        var id_retorno = data;
                                        
                                        calendar.fullCalendar('renderEvent',{
                                            title: titulo_param,
                                            id: id_retorno,
                                            start: start_param,
                                            end: end_param,
                                            allDay: allDay_param
                                        },
                                        true // make the event "stick"
                                       );                                         
                                        
                                    })
                                       
                                     
                                       //calendar.fullCalendar('unselect');                                     
                            }
                        }, {
                            label: '<?php echo ucfirst($translate->_('_cancelar')) ; ?>',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    }); 
            
                }
        );     
       calendar.fullCalendar('unselect');
    },
    editable: true,
    eventDrop: function(event, delta) {
        var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
        $.ajax({
            url: base+"/ajax/editarCitaCalendarioBd.php",
            data: 'titulo='+ event.title+'&hora_inicio='+ start +'&hora_fin='+ end +'&id='+ event.id ,
            type: "POST",
            success: function(json) {
                //alert("Updated Successfully");
            }
        });
    },
    eventResize: function(event) {
        var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
        $.ajax({
            url: base+"/ajax/editarCitaCalendarioBd.php",
            data: 'titulo='+ event.title+'&hora_inicio='+ start +'&hora_fin='+ end +'&id='+ event.id ,
            type: "POST",
            success: function(json) {
                //alert("Updated Successfully");
            }
        });
    },
    // click en el evento
    eventClick: function(calEvent, jsEvent, view) {
    
    
        var start_param = calEvent.start;
        var end_param = calEvent.end;
        var allDay_param = calEvent.allDay;
        var id_param  = calEvent.id;
        $.post(base+"/ajax/geteventosCalendario.php",{ id : calEvent.id},
            function(data){ 

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_editar_cita_agenda')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_eliminar')) ; ?>',
                            action: function(dialogItself){

                                 $.post(base+"/ajax/eliminarCitaCalendarioBd.php",{id:id_param },
                                    function(data){
                                        dialogItself.close();
                                    })
                                        calendar.fullCalendar("removeEvents", id_param);
                            },cssClass: 'btn-danger'
                        },{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) { 
                                var titulo_param = $('#titulo').val();
                                var descrip_param = $('#descripcion_modal').val();
                       
                                $.post(base+"/ajax/editarCitaCalendarioBd.php",{titulo:titulo_param,descripcion:descrip_param,id:id_param },
                                    function(data){
                                        dialogItself.close();
                                    })
                                        calendar.fullCalendar("removeEvents", id_param);
                                        
                                        calendar.fullCalendar('renderEvent',{
                                            title: titulo_param,
                                            start: start_param,
                                            id: id_param,
                                            end: end_param,
                                            allDay: allDay_param
                                        },
                                        true // make the event "stick"
                                       );                                      
                            }
                        }, {
                            label: '<?php echo ucfirst($translate->_('_cancelar')) ; ?>',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
             
        });          
    	// change the border color just for fun
    	//$(this).css('border-color', 'red');
    }    
  }); //calendar
  }
  

$(document).ready(function() {  
    upload();
})    

function upload() {

	// Variable to store your files
	var files;

	// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('.file').on('submit', uploadFiles);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // START A LOADING SPINNER HERE

        // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
        var id_movimiento = this.id.replace("f_","");
        data.append('id_movimiento', id_movimiento);
        data.append('id_caso', $("#id_caso").val());
        $.ajax({
            url: base+"/ajax/uploadFileMovimiento.php",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		submitForm(event, data);
            	}
            	else
            	{
            		// Handle errors here
            	//	console.log('ERRORS: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	//console.log('ERRORS: ' + textStatus);
            	// STOP LOADING SPINNER
            }
        });
    }

    function submitForm(event, data)
	{
		// Create a jQuery object from the form
		$form = $(event.target);

		// Serialize the form data
		var formData = $form.serialize();
         
		// You should sterilise the file names
		/*$.each(data.files, function(key, value)
		{
			formData = formData + '&filenames[]=' + value;
		});  */                                                 
        
		$.ajax({
			url: base+"/ajax/uploadFileMovimiento.php",
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		console.log('SUCCESS: ' + data);
            	}
            	else
            	{
            		// Handle errors here
            		console.log('ERRORS: ' + data);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	console.log('ERRORS: ');
            },
            complete: function()
            {
            	// STOP LOADING SPINNER
                location.reload();
            }
		});
	}
}  

    // modal para preguntar si se borra el archivo
    //---------------------      
    function eliminar_file_movimiento(id,archivo){

          BootstrapDialog.confirm('<?php echo ucfirst($translate->_('_eliminar_archivo')) ; ?>', function(result){
                if(result) {
                    eliminar_file_movimientoBD(id,archivo);
                }
            });
    } 
    // borra el archivo
    //---------------------      
    function eliminar_file_movimientoBD(id_movimiento,archivo_param){
                                                
        $.post(base+"/ajax/eliminarFileMovimiento.php",{
                        id_caso : $("#id_caso").val(),
                        id : id_movimiento,
                        archivo:archivo_param},
                function(data){     
                    location.reload();
                }
        );
    }     

    // contabilidad
    //------------------

    $(document).ready(function() {
        //autocompletador para seleccionar una nueva parte
        $('#id_concepto').select2({
            placeholder : " <?php echo ucfirst($translate->_('_seleccione')) ; ?>",
            minimumInputLength: 2,
            ajax: {
                url: base+"/ajax/getConceptos.php",
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term,
                        z: $("#padre").val(),
                        page_limit: 10
                    };
                },
                results: function (data, page) { console.log(data);
                    return { results: data };
                }
            },
            allowClear: true,
            formatSelection: function(data) {
                return data.text;
            }
        });
    })


    $(document).on("click", "#btn_nuevo_movimiento_contable", function(event){
        $(".contable").hide();
        $("#nuevo_movimiento_contable").show();
    });
    
    $(document).on("click", "#btn_cobrar_cuota_contable", function(event){
        $(".contable").hide();
        $("#cuota_movimiento_contable").show();
        proximacuota();
    });

    $(document).on("click", "#btn_nuevo_convenio_contable", function(event){
        $(".contable").hide();
        $("#nuevo_convenios_contables").show();
    });

    $(document).on("click", ".btn_lista_contable", function(event){
        $(".contable").hide();
        $("#lista_movimientos_contables").show();
    });

    // datepicker de movimiento contable
    $(function () {
        $('#datetimepickercontable').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    });
    
    // datepicker de 1 cuota 
    $(function () {
        $('#datetime_ra_cuota').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    });

    $(document).on("click", "#btn_agregar_items", function(event){
        $("#agregar_items").hide();
        $("#div_agregar_items").show();
    });

    $(document).on("click", "#btn_cancel_items_liqui", function(event){
        $("#agregar_items").show();
        $("#div_agregar_items").hide();
    });


    $(document).on("click", "#btn_agregar_items_liqui", function(event){
        //$("#agregar_items").show();
        var param_rubro = $("#rubro_i").val();
        var param_capital = $("#capital_i").val();
        var param_fecha_e = $("#fecha_exibicion_items").val();
        var param_fecha_a = $("#fecha_act_items").val();
        var param_id_liqui = $("#id_liquidacion_i").val();

        $.post(base+"/ajax/agregarItemsBd.php",{id_liquidacion:param_id_liqui,rubro:param_rubro,capital:param_capital,fecha_exibicion_items:param_fecha_e,fecha_act_items:param_fecha_a},
            function(data){
                console.log(data);
                editar_liqui ('liqui_'+data);
            }
        );

    });



    //div_agregar_items
    
    


    function proximacuota(){

        var convenio = $("#convenios").val();
        if (convenio == 'null' || convenio == '' || convenio == null){
            $("#cuota_movimiento_contable").html('<h1>No hay convenios abiertos</h1><button type="button" class="btn btn-warning btn_lista_contable" id="btn_cancel_movimiento_contable"><?php echo ucfirst($translate->_('_cancelar')); ?></button>');
            return false;
        }
        $.post(base+"/ajax/getProximaCuota.php",{ id : convenio},
                function(data){
                    $("#proxima_cuota").html(data);
                }
        );
    }

    // en el onchange del select de tipo de estado
    $(document).on("change", "#convenios", function(event){
        proximacuota();
    });

    // boton para mostrar el modal para crear una nueva parte
    $(document).on("click", "#btn_nuevo_concepto", function(event){
            $.post(base+"/ajax/agregarConcepto.php",
                function(data){

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_nuevo_concepto')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) {agregarConceptoBd(dialogItself)}
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

    // funcion de retorno del dialogo para concepto
    //---------------------
    function agregarConceptoBd(dialogItself){

        var param_nombre = $("#concepto_modal").val();
        var param_padre = $("#padre").val();
        $.post(base+"/ajax/agregarConceptoBd.php",{nombre:param_nombre,id_padre:param_padre},
            function(data){
                dialogItself.close(); console.log(data);
                $("#id_concepto").select2("data", {id: data, text:param_nombre});
            }
        );
    }

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

/*
Botones contables
btn_nuevo_movimiento_contable
btn_cobrar_cuota_contable
btn_nuevo_convenio_contable


Divs contables
lista_movimientos_contables
nuevo_movimiento_contable
cuota_movimiento_contable
nuevo_convenios_contables
convenios_contables






*/

</script>