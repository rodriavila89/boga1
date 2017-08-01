<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_perfil')) ; ?></h1>
        </div>
    </div>        
        
        <div class="row">
            <div class="col-lg-12">

                <ul class="nav nav-tabs">
                  <li  class='active'><a href="#home" data-toggle="tab"><?php echo ucfirst($translate->_('_usuario')) ; ?></a></li>
                  <li><a href="#profile" data-toggle="tab"><?php echo ucfirst($translate->_('_clave')) ; ?></a></li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="home"  style='padding: 35px 15px 15px'>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="index.php/indexAdmin/edit_bd/" method=post>
                              <div class="form-group">
                                <label><?php echo ucfirst($translate->_('_usuario')) ; ?></label>
                                <input class="form-control input-lg" id="name" name="name" value="<?php echo $user[0]['name']; ?>" required >
                              </div>
                              <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                              </div>
                            </form>
                        </div>                  
                   </div>                  
                  
                  </div>
                  <div class="tab-pane" id="profile"  style='padding: 35px 15px 15px'>
                    <div class="panel panel-default">
                        <div class="panel-body">        
                            <form role="form" name="form_pass"  id="form_pass" action="index.php/indexAdmin/edit_bd/" method=post>
                              <div class="form-group">
                                <label><?php echo ucfirst($translate->_('_clave')) ; ?></label>
                                <input class="form-control input-lg" name="password_old" id="password_old"  type='password'>
                              </div>
                              <div class="form-group">
                                <label><?php echo ucfirst($translate->_('_clave_nueva')) ; ?></label>
                                <input class="form-control input-lg" name="password"  id="password" type='password'>
                              </div>
                              <div class="form-group">
                                <label><?php echo ucfirst($translate->_('_clave_reingreso')) ; ?></label>
                                <input class="form-control input-lg" name="password2" id="password2"  type='password'>
                              </div>                                                            
                              <div class="form-group text-right">
                                <button type="button" id="btn_ok" class="btn btn-primary">OK</button>
                                <button type="button" class="btn btn-warning" id="btn_cancel">Cancel</button>
                              </div>
                            </form>
                        </div>                  
                   </div> 
                  
                  </div>
                </div>
                

          </div><!-- /.row -->
            <!-- /.row -->
        </div>
</div>        




<script type="text/javascript">




    $(document).on("click", "#btn_ok", function(event){
       
     var pass_old = $("#password_old").val();
     var pass = $("#password").val();
     var pass2 = $("#password2").val();
        
      if(pass_old==''){
                BootstrapDialog.show({
                    title: '<?php echo ucfirst($translate->_('_clave_modificacion')) ; ?>',
                    message: '<?php echo ucfirst($translate->_('_clave_vacia')) ; ?>'
                });
                return false;
        }; 
        
            
        var str = $("#form_pass").serialize();
        $.post(base+"/ajax/getPassUser.php",str,        
        
            function(data){
            
                if(data=='true'){   
                   if((pass=='')&&(pass2=='')){
                            BootstrapDialog.show({
                                title: '<?php echo ucfirst($translate->_('_clave_modificacion')) ; ?>',
                                message: '<?php echo ucfirst($translate->_('_clave_vacia')) ; ?>'
                            });
                            return false;
                    }else{
                        if((pass==pass2)&&(pass!='')){
                            //alert('se cambiara');
                            document.form_pass.submit();
                        }else{
                            BootstrapDialog.show({
                                title: '<?php echo ucfirst($translate->_('_clave_modificacion')) ; ?>',
                                message: '<?php echo ucfirst($translate->_('_claves_no_coinciden')) ; ?>'
                            });
                            return false;                        
                        }
                     }      
                    } else{
                        BootstrapDialog.show({
                            title: '<?php echo ucfirst($translate->_('_clave_modificacion')) ; ?>',
                            message: '<?php echo ucfirst($translate->_('_clave_actual_mal')) ; ?>'
                        });
                        return false;

                    }     
            }
        );
               
    });
    
    
    
    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/indexAdmin/profile/');
    });
    
</script> 
