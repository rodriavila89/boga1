        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><?php echo ucfirst($translate->_('_panel')) ; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           <div class="row">  
               <div class="col-lg-4"> 
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-6">
                        <i class="fa fa-book fa-5x"></i>
                      </div>
                      <div class="col-xs-6 text-right">
                        <p class="announcement-text"><?php echo ucfirst($translate->_('_casos')) ; ?></p>
                        <p class="announcement-heading"><?php echo $cantidad_casos;?></p>
                      </div>
                    </div>
                  </div>
                  <a href="index.php/casosAdmin/">
                    <div class="panel-footer announcement-bottom">
                      <div class="row">
                        <div class="col-xs-6">
                          <?php echo ucfirst($translate->_('_ver_todos')) ; ?>
                        </div>
                        <div class="col-xs-6 text-right">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>  
                </div>
               <div class="col-lg-4"> 
                <div class="panel panel-warning">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-6">
                        <i class="fa fa-male fa-5x"></i>
                      </div>
                      <div class="col-xs-6 text-right">
                        <p class="announcement-text"><?php echo ucfirst($translate->_('_directorio')) ; ?></p>
                        <p class="announcement-heading"><?php echo $cantidad_directorio;?></p>
                      </div>
                    </div>
                  </div>
                  <a href="index.php/directorioAdmin/">
                    <div class="panel-footer announcement-bottom">
                      <div class="row">
                        <div class="col-xs-6">
                          <?php echo ucfirst($translate->_('_ver_todos')) ; ?>
                        </div>
                        <div class="col-xs-6 text-right">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>  
                </div> 
               <div class="col-lg-4"> 
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-6">
                        <i class="fa fa-calendar fa-5x"></i>
                      </div>
                      <div class="col-xs-6 text-right">
                        <p class="announcement-text"><?php echo ucfirst($translate->_('_agenda_citas_hoy')) ; ?></p>
                        <p class="announcement-heading"><?php echo $cantidad_agenda;?></p>
                      </div>
                    </div>
                  </div>
                  <a href="index.php/agendaAdmin/">
                    <div class="panel-footer announcement-bottom">
                      <div class="row">
                        <div class="col-xs-6">
                          <?php echo ucfirst($translate->_('_ver_todos')) ; ?>
                        </div>
                        <div class="col-xs-6 text-right">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>  
                </div> 
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>
                            Casos sin movimientos en los &uacute;ltimos 15 d&iacute;as
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php

                            if (sizeof($casos_movimientos)>0){
                                echo "<table class='table'>";
                                foreach ($casos_movimientos as $key=>$value) {
                                    echo "<tr>";
                                    echo "<td><i class='fa fa-angle-double-right blueiconcolor'></i> <a href='index.php/casosAdmin/view/".$value['id']."/'>".$value['caso']."</a></td>";
                                    //echo "<td>".$value['CASO']."</td>";
                                    //echo "<td>".$value['CASO']."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }else{
                                echo "<h3>No hay casos sin movimientos</h3>";
                            }
                            ?>
                        </div>
                    </div>


                </div>
            </div>


            <?php


            ?>
            
            <div class="row">
                <div class="col-lg-6">
                
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>
                            &nbsp;<?php echo ucfirst($translate->_('_actividad_semanal')) ; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <?php
                             
                             foreach ($semana as $key=>$value) {
                                switch ($key) {
                                    case 0:
                                        $dia = "<i>Lunes</i>";
                                        break;
                                    case 1:
                                        $dia = "<i>Martes</i>";
                                        break;
                                    case 2:
                                        $dia = "<i>Miercoles</i>";
                                        break;
                                    case 3:
                                        $dia = "<i>Jueves</i>";
                                        break;
                                    case 4:
                                        $dia = "<i>Viernes</i>";
                                        break;
                                    case 5:
                                        $dia = "<i>S&aacute;bado</i>";
                                        break;
                                    case 6:
                                        $dia = "<i>Domingo</i>";
                                        break;                                                                                                                                                                
                                } 
                                if (empty($semana[$key]['citas'])){
                                    echo "<p><i class='fa fa-angle-double-right blueiconcolor'></i> Sin citas de agenda para el d&iacute;a ".$dia." ".mostrar_fecha_esp($semana[$key]['dia'])."</p>";
                                }else{
                                    echo "<p><i class='fa fa-angle-double-right rediconcolor'></i> Citas de agenda para el d&iacute;a ".$dia." ".mostrar_fecha_esp($semana[$key]['dia'])."</p>";
                                    foreach ($semana[$key]['citas'] as $k=>$v) {
                                        $hora = explode(' ',$v['start']);
                                        $hora = "&nbsp;<b>".$hora[1]."</b>&nbsp;";
                                        echo "<div style='padding-left:50px'>";
                                        if($v['id_persona'] != null or $v['id_persona'] != ''){
                                            echo "<p><i class='fa fa-calendar rediconcolor'></i>&nbsp;".$hora."&nbsp;".ucfirst($translate->_('_cita_de_directorio')).":&nbsp;".$v['nombres']." ".$v['apellido']."</p>";
                                        }
                                        if($v['id_caso'] != null or $v['id_caso'] != ''){
                                            echo "<p><i class='fa fa-calendar blueiconcolor'></i>&nbsp;".$hora."&nbsp;".ucfirst($translate->_('_cita_de_caso')).":&nbsp;".$v['caso']."</p>";
                                        }
                                        if(($v['id_caso'] == null or $v['id_caso'] == '') and ($v['id_persona'] == null or $v['id_persona'] == '')){
                                            echo "<p><i class='fa fa-calendar greeniconcolor'></i>&nbsp;".$hora."&nbsp;".ucfirst($translate->_('_cita_general'))."</p>";
                                        } 
                                        //echo "<p>".$v['titulo']."</p>";
                                        //echo "<p>".nl2br($v['descripcion'])."</p>";
                                        echo "</div>";
                                    }
                                }
                                echo "<hr>";
                             	
                             }
                             
                             ?>
                        </div>
                    </div>                    
                
            
                </div>
                
                <div class="col-lg-6">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>&nbsp;<?php echo ucfirst($translate->_('_casos_por_tribunal')) ; ?>
                        </div>
                        <div class="panel-body">
                            <div id="tribunales"></div>
                        </div>
                    </div>
                </div>                
            </div>

        </div>
        

<script type="text/javascript">

 $(function() {
    Morris.Donut({
        element:'tribunales',
        data: <?php echo $tribunales_casos ?>,
        resize: true
    }); 
    




});

</script>    