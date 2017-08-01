<?php
    
    $a = "<a class='manito order' id='order_id'>".ucfirst($translate->_('_fecha_carga'))."</a>";
    $b = "<a class='manito order' id='order_apellido'>".ucfirst($translate->_('_alfabeticamente'))."</a>";
    
    $pos = strpos($order_list_directorio, 'desc');
    if ($pos === false){
        if ($order_list_directorio == 'id'){ $a = '<i class="fa fa-arrow-down blueiconcolor">&nbsp;'.$a.'</i>';}   
        if ($order_list_directorio == 'apellido'){ $b = '<i class="fa fa-arrow-down blueiconcolor" >&nbsp;'.$b.'</i>' ;} 
    }else{
        $aux_list = str_replace(" desc","",$order_list_directorio);
        if (trim($aux_list) == 'id'){ $a = '<i class="fa fa-arrow-up blueiconcolor">&nbsp;'.$a.'</i>';}   
        if (trim($aux_list) == 'apellido'){ $b = '<i class="fa fa-arrow-up blueiconcolor" >&nbsp;'.$b.'</i>' ;} 
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_directorio')) ; ?></h1>
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
                            if (isset($_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO'])){
                                echo '<a id="btn_quitar_busqueda" class="btn btn-danger" href="index.php/directorioAdmin/quitarfiltro/"><i class="fa fa-times"></i>&nbsp;'.ucfirst($translate->_('_quitar_filtro')).'</a>';
                            } 
                         ?>
                         <a id="btn_ver_buscar" class="btn btn-primary manito"><i class="fa fa-search"></i>&nbsp;<?php echo ucfirst($translate->_('_buscar')) ; ?></a>                    
                         <a class="btn btn-info" href="index.php/directorioAdmin/add/"><i class="fa fa-plus"></i>&nbsp;<?php echo ucfirst($translate->_('_agregar')) ; ?></a>
                    </div>                  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                
                <div id ="div_buscar">
                
                        <form role="form" action="index.php/directorioAdmin/resultadobuscar/" method=post>
                            
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

                        foreach ($directorio as $key=>$value){

                            echo '<div class="media">';
                                    echo "<div class='text-right'>
                                          <a href='index.php/directorioAdmin/edit/".$value['id']."/'><i class='fa fa-pencil-square-o fa-lg'></i></a></span>&nbsp;
                                          <a href='index.php/directorioAdmin/view/".$value['id']."/'><i class='fa fa-camera-retro fa-lg'></i></a>
                                          <a href='index.php/directorioAdmin/delete/".$value['id']."/'><i class='fa fa-trash-o fa-lg'></i></a>&nbsp;
                                          </div>";                            
                                echo '<div class="media-body" style="border-bottom:1px solid">';
                                    echo '<p class="lead text-primary"><a href="index.php/directorioAdmin/view/'.$value['id'].'/" >'.$value['apellido'].', '.$value['nombres'].'</a></p>';
                                    echo '<ul class="list-inline">
                                            <li><b><span>'.ucfirst($translate->_('_tipo')).":</span></b> ".$value['tipo'].'</li>
                                            <li><b><span>'.ucfirst($translate->_('_personeria')).":</span></b> ".$value['personeria'].'</li>
                                            <li><b><span>'.ucfirst($translate->_('_dni')).":</span></b> ".$value['dni'].'</li>
                                          </ul>';
                                echo '</div>';
                            echo '</div>';
                        	
                        }
                    
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
                'title': "<?php echo ucfirst($translate->_('_filtrado_por')).": ".$_SESSION['DATA_BUSQUEDA_ADMIN_DIRECTORIO'] ; ?>"
        }); 
    })

    $(document).on("click", "#btn_ver_buscar", function(event){
         $('#div_buscar').toggle();
    });    
    
    $("#div_buscar").hide();
    
    $(document).on("click", ".order", function(event){
        ordenar(this.id);
    });
    
//---------------------    
    function ordenar(id_param){
        
        var id_param = id_param.replace("order_","");                                           
        $.post(base+"/ajax/setOrderDirectorioBd.php",{ order_list_directorio : id_param},
                function(data){
                     window.location.replace('index.php/directorioAdmin/');
                }
        );        
    }     


</script>