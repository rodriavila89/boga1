<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_directorio')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$directorio['nombres']." ".$directorio['apellido'].'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                                                               
                    <div class="text-right">    
                         <a class="btn btn-info" href="index.php/directorioAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                         <a class="btn btn-warning" href="index.php/directorioAdmin/edit/<?php echo $directorio['id'] ?>/"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo ucfirst($translate->_('_editar')) ; ?></a>
                         <a class="btn btn-danger" href="index.php/directorioAdmin/delete/<?php echo $directorio['id'] ?>/"><i class="fa fa-trash-o"></i>&nbsp;<?php echo ucfirst($translate->_('_eliminar')) ; ?></a>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php             
                            echo "<p class='lead'><i class='fa fa-angle-double-right'></i>&nbsp;".$directorio['nombres']." ".$directorio['apellido']."</p>";

                            echo "<table class='table table-striped table-bordered table-hover'>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_apellido'))."</td>";
                                echo "<td>".$directorio['apellido']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_nombres'))."</td>";
                                echo "<td>".$directorio['nombres']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_cuit'))."</td>";
                                echo "<td>".$directorio['cuit']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_cuil'))."</td>";
                                echo "<td>".$directorio['cuil']."</td>";
                            echo "</tr>"; 
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_dni'))."</td>";
                                echo "<td>".$directorio['dni']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_fecha_nacimiento'))."</td>";
                                echo "<td>".mostrar_fecha_esp($directorio['fecha_nacimiento'])."</td>";
                            echo "</tr>";   
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_claveingreso'))."</td>";
                                echo "<td>".nl2br($directorio['clave'])."</td>";
                            echo "</tr>";                                                                                      
                            echo "<tr>";
                                echo "<td style='width:20%'>".ucfirst($translate->_('_notas'))."</td>";
                                echo "<td>".nl2br($directorio['observaciones'])."</td>";
                            echo "</tr>";   
                            echo "</table>";
                            
                            # casos
                            if (empty($casos)){
                               // echo "<h4>".ucfirst($translate->_('_no_partes_asignadas'))."</h4>";
                            }else{
                                echo "<h4><i class='fa fa-angle-double-right'></i>&nbsp;".ucfirst($translate->_('_casos'))."</h4>";
                                echo "<table class='table table-hover'>";
                                foreach ($casos as $key=>$value) {
                                    echo "<tr>";
                                    echo "<td><a href='".__SITIO."index.php/casosAdmin/view/".$value['id']."/'>".$value['caso']."</a></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";                                
                            }

                            # partes
                            if (empty($radicaciones)){
                                //echo "<h4>".ucfirst($translate->_('_no_radicaciones_anteriores'))."</h4>";
                            }else{                            
                                echo "<h4><i class='fa fa-angle-double-right'></i>&nbsp;".ucfirst($translate->_('_radicaciones_anteriores'))."</h4>";
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

                    ?>
                </div>
            </div>
        </div>
    </div>            
</div>