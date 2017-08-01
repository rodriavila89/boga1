<?php
    
    $hidden = '';
    if(isset($tribunal)){
        $hidden = "<input type='hidden' value=".$tribunal['id']." name='id' >";
        $action = "Edit";
        $action_id = '1';
    }else{
        $action = "New";
        $action_id = '-1';
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_tribunal')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$tribunal['nominacion'].'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <div class="text-right">
                             <a class="btn btn-info" href="index.php/tribunalesAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                        <?php
                            if($action_id =='1' ){
                        ?>  
                             <a class="btn btn-success" href="index.php/tribunalesAdmin/view/<?php echo $tribunal['id'] ?>/"><i class="fa fa-eye"></i>&nbsp;<?php echo ucfirst($translate->_('_ver')) ; ?></a>
                             <a class="btn btn-danger" href="index.php/tribunalesAdmin/delete/<?php echo $tribunal['id'] ?>/"><i class="fa fa-trash-o"></i>&nbsp;<?php echo ucfirst($translate->_('_eliminar')) ; ?></a>
                        <?php
                            }
                        ?>
                        </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
            			<form role="form" action="index.php/tribunalesAdmin/edit_bd/" method=post>
                            <?php echo $hidden; ?>
            				<div class="form-group">
            					 <label for="nominacion"><?php echo ucfirst($translate->_('_nombre')) ; ?></label><input value="<?php  echo  sanitize($tribunal['nominacion']) ;?>"  type="text" class="form-control" id="nominacion" name="nominacion"  required />
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
        window.location.replace('index.php/tribunalesAdmin/');
    });
 
</script> 
