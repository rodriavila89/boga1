<?php
                        $estilo = "alert-success";
                        $mensaje = "";
                        if (isset($nueva_version)){
                            if ($nueva_version !=$version){
                                $estilo = "alert-warning";
                                $mensaje = "<h3>".ucfirst($translate->_('_nueva_version_disponible')).": <b>".$nueva_version."</b></h3>";
                                $mensaje .= "<a  href='index.php/upgradeAdmin/actualizar/'>".ucfirst($translate->_('_actualizar'))."</a>";          
                            }else{
                                $mensaje = "<h3>".ucfirst($translate->_('_su_sistema_esta_actualizado'))."</h3>";
                            
                            }             
                        }

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_actualizaciones')) ; ?></h1>
        </div>
    </div>                        
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="alert <?php echo $estilo;?>">
                    <h3><?php echo ucfirst($translate->_('_version_actual')) ; ?>:&nbsp;<b><?php echo $version;?></b></h3>
                    <p><a href="index.php/upgradeAdmin/nueva/">Comprobar actualizacion</a></p>
                    <?php
                        echo $mensaje;
                    ?>
                </div>
            </div>
        </div><!-- /.row -->
    </div> 
</div>
