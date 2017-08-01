<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_naturaleza')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$naturalezas['nombre'].'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        
                  <div class="alert alert-danger">
                      <h2><?php echo ucfirst($translate->_('_eliminar_naturaleza')) ; ?></h2>
                      <form role="form" action="index.php/naturalezasAdmin/deleteBd/" method=post>
                        <input type='hidden' value='<?php echo $naturalezas['id']; ?>' name='id'>
                      <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                        <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('cancelar')) ; ?></button>
                      </div>                            
                     </form>
                </div>        
        
        </div>
    </div>
</div>        

<script type="text/javascript">

    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/naturalezasAdmin/');
    });
 
</script>        
