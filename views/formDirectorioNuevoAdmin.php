<?php
    
    $hidden = '';
    $action = 'New';
    $action_id = '-1';    
    
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_directorio')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.ucfirst($translate->_('_nuevo')).'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-right">
                         <a class="btn btn-info" href="index.php/directorioAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                        <form role="form" action="index.php/directorioAdmin/edit_bd/" method=post>
                            <?php echo $hidden; ?>

                            <div class="form-group">
                                <label for="apellido"><?php echo ucfirst($translate->_('_apellido')) ; ?></label>
                                    <input type='text' class="form-control" name="apellido" required />
                            </div>
                            <div class="form-group">
                                <label for="nombres"><?php echo ucfirst($translate->_('_nombres')) ; ?></label>
                                    <input type='text' class="form-control" name="nombres" required />
                            </div>
                            <div class="form-group">
                            	 <label for="tipo"><?php echo ucfirst($translate->_('_tipo')) ; ?></label>
                                <select name="tipo" id="tipo" required>
                                    <?php
                                       echo "<option value='CONTACTO' >".strtoupper($translate->_('_tipo_contacto'))."</option>";
                                       echo "<option value='CLIENTE' >".strtoupper($translate->_('_tipo_cliente'))."</option>";
                                    ?>
                                </select> 
                            </div>
                            <div class="form-group">
                            	<label for="personeria"><?php echo ucfirst($translate->_('_personeria')) ; ?></label>
                                <select name="personeria" id="personeria" required>
                                    <?php
                                       echo "<option value='FISICA' >".strtoupper($translate->_('_personeria_fisica'))."</option>";
                                       echo "<option value='JURIDICA' >".strtoupper($translate->_('_personeria_juridica'))."</option>";
                                    ?>
                                </select> 
                            </div>                            
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                            <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                          </div>
            			</form>
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>


<script type="text/javascript">

    
    $(document).ready(function() {
        $("#tipo").select2({ width: '100%',height:'55px' });
    });
    $(document).ready(function() {
        $("#personeria").select2({ width: '100%',height:'55px' });
    });

    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/directorioAdmin/');
    }); 
    
                      

</script>