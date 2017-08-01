<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Clientes</h1>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo "<h3> ".htmlentities($cliente[0]['text'])."</h3>"; ?>
                        </div>
                        <div class="panel-body">

                            <?php

                                foreach ($movimientos as $key=>$value){
                                	echo "<p class='lead'><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;".$value['caso']."</p>";
                                    echo mostrar_fecha_esp($value['fecha_ingreso']);
                                    echo "<br /><br /><br /><p class='lead'><i class='fa fa-angle-double-right blueiconcolor'></i>&nbsp;Movimientos</p>";
                                    echo "<table class='table table-hover'>";
                                        echo "<thead><tr>";
                                        echo "<th>".ucfirst($translate->_('_tipo'))."</th>";
                                        echo "<th>".ucfirst($translate->_('_fecha_movimiento'))."</th>";
                                        echo "<th>".ucfirst($translate->_('_descripcion'))."</th>";
                                        echo "</tr></thead>";
                                        foreach ($value['MOVIMIENTOS'] as $k=>$v) {
                                            echo "<tr>";
                                            echo "<td>".
                                                        ucfirst($translate->_($v['tipo_estado']));
                                                        if ($v['acto_procesal']!= ''){
                                                            echo " (".$v['acto_procesal'].") ";
                                                        }
                                            echo "</td>";
                                            echo "<td>".mostrar_fecha_esp($v['fecha'])."</td>";
                                            echo "<td>".nl2br(htmlentities($v['descripcion']))."</td>";
                                            echo "</tr>";
                                        }
                                    echo "</table>";

                                } 

                            ?>
                              <div class="form-group text-right">
                                <a href="index.php" class="btn btn-info" role="button"><?php echo ucfirst($translate->_('_cerrar')) ; ?></a>
                              </div>                             

                        </div>
                        <div class="panel-footer">
                            <p class="text-right">
                                --
                            </p>
                        </div>
                    </div>

                 
          </div><!-- /.row -->
     </div> 
</div>