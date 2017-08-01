<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_configuracion')) ; ?></h1>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">        
                        <form role="form" action="index.php/indexAdmin/edit_config/" method=post>
                          <div class="form-group">
                            <label><?php echo ucfirst($translate->_('_nombre_del_sitio')) ; ?></label>
                            <input class="form-control input-lg" name="name_site" value="<?php echo sanitize($config['name_site']); ?>" required >
                          </div>
                          <hr>
                          <div class="form-group">
                          <label><?php echo ucfirst($translate->_('_lenguaje')) ; ?></label>
                         <div class="checkbox">
                            <label>
                              <?php $check = ""; if ($config['lenguaje_automatic'] == 1){ $check = " checked=checked ";}  ?>  
                              <input <?php echo $check; ?> type="checkbox" id="lenguaje_automatic" name="lenguaje_automatic"><?php echo ucfirst($translate->_('_automatico')) ; ?>
                            </label>
                          </div>  
                            
                            <select class="form-control select-lg" name="lenguaje" id="lenguaje" >
                                <?php
                                    foreach ($lenguajes as $value){
                                        $value = str_replace('.php','',$value); 
                                        $value_show = $value;
                                        $sel = "";
                                        if ($value =='en'){
                                            $value_show = 'English';                                            
                                        }
                                        if ($value =='es'){
                                            $value_show = 'Spanish';                                            
                                        }             
                                        if($config['lenguaje'] == $value){
                                            $sel = " selected = selected ";
                                        }                           
                                        echo "<option ".$sel." value='".$value."'>".$value_show."</option>";	
                                    }                   
                                
                                ?>
                            </select>
                          </div> 
                          <hr>                                                                           
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                            <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                          </div>
                        </form>
                    </div>                  
               </div>
          </div><!-- /.row -->
     </div> 
</div>

<script type="text/javascript">
 
    $( document ).ready(function() {

        selLeng();
        selShow();

        $("#lenguaje_automatic").change(function() {
            if(this.checked) {
               $("#lenguaje").prop( "disabled", true );
            }else{
               $("#lenguaje").prop( "disabled", false ); 
            }
        });            
        
        $("#show_search_in_home").change(function() {
            if(this.checked) {
               $("#texto_home").prop( "disabled", true );
            }else{
               $("#texto_home").prop( "disabled", false ); 
            }
        });                
    });
    
    function selLeng(){
    
         if($('#lenguaje_automatic').attr('checked')) {
            $("#lenguaje").prop( "disabled", true );
        } else {
            $("#lenguaje").prop( "disabled", false );
        }    
    }
    
    function selShow(){
    
         if($('#show_search_in_home').attr('checked')) {
            $("#texto_home").prop( "disabled", true );
        } else {
            $("#texto_home").prop( "disabled", false );
        }    
    }    

</script>
