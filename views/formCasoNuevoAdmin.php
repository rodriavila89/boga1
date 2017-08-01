<?php
    
    $hidden = '';
    $action = 'New';
    $action_id = '-1';    
    
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_caso')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.ucfirst($translate->_('_nuevo_caso')).'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-right">
                         <a class="btn btn-info" href="index.php/casosAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                        <form role="form" action="index.php/casosAdmin/edit_bd/" method=post>
                            <?php echo $hidden; ?>

                            <div class="form-group">
                            	 <label for="description"><?php echo ucfirst($translate->_('_caso')) ; ?></label><textarea style="height:150px" class="form-control" id="caso" name="caso"  /></textarea>
                            </div>   
                                                   
                            
                            <div class="form-group">
                            	 <label for="name"><?php echo ucfirst($translate->_('_naturaleza')) ; ?></label>
                                <select name="id_naturaleza" id="id_naturaleza" required>
                                    <option></option>
                                    <?php
                                        foreach ($naturalezas as $key=>$value) {
                                            echo "<option value=".$value['id']." ".$sel.">".$value['nombre']."</option>";                                	
                                        }
                                    ?>
                                </select> 
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo ucfirst($translate->_('_fecha_ingreso')) ; ?></label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input class="form-control" name="fecha_ingreso" />
                                    <span class="input-group-addon"><span></span>
                                    </span>
                                </div>
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
        $("#id_naturaleza").select2({ width: '100%',height:'55px' });
    });

    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/casosAdmin/');
    }); 
    
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    language: 'es',
                    defaultDate: moment().format('MM/DD/YYYY'),
                    pickTime: false
                });
            });    
    
                    
    
                      

</script>