<?php
    
    $hidden = '';
    if(isset($roles)){
        $hidden = "<input type='hidden' value=".$roles['id']." name='id' >";
        $action_id = '1';
    }else{
        $action_id = '-1';
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_roles')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$roles['nombre'].'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <div class="text-right">
                             <a class="btn btn-info" href="index.php/rolesAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                        <?php
                            if($action_id =='1' ){
                        ?>  
                             <a class="btn btn-danger" href="index.php/rolesAdmin/delete/<?php echo $roles['id'] ?>/"><i class="fa fa-trash-o"></i>&nbsp;<?php echo ucfirst($translate->_('_eliminar')) ; ?></a>
                        <?php
                            }
                        ?>
                        </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
            			<form role="form" action="index.php/rolesAdmin/edit_bd/" method=post>
                            <?php echo $hidden; ?>
            				<div class="form-group">
            					 <label for="nominacion"><?php echo ucfirst($translate->_('_nombre')) ; ?></label><input value="<?php  echo  sanitize($roles['nombre']) ;?>"  type="text" class="form-control" id="nombre" name="nombre"  required />
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

    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/rolesAdmin/');
    });
 
</script> 
