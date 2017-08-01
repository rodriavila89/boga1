<?php
    
    $hidden = '';
    $action = 'New';
    $action_id = '-1';    
    
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_contabilidad')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.ucfirst($translate->_('_nuevo_movimiento')).'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-right">
                         <a class="btn btn-info" href="index.php/contabilidadAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                        <form role="form" action="index.php/contabilidadAdmin/edit_bd/" method=post>
                            <?php echo $hidden; ?>

                            <div class="form-group">
                            	 <label for="name"><?php echo ucfirst($translate->_('_asentar')) ; ?></label>
                                <select name="padre" id="padre" required class="form-control">
                                    <option value=2><?php echo ucfirst($translate->_('_egreso')) ; ?></option>
                                    <option value=1><?php echo ucfirst($translate->_('_ingreso')) ; ?></option>
                                </select> 
                            </div> 
                            
                            <div class="form-group">
                                <label><?php echo ucfirst($translate->_('_concepto')) ; ?></label>
                                <span id="btn_nuevo_concepto" class="label label-primary manito"><?php echo ucfirst($translate->_('_crear_nuevo')) ; ?></span>
                                <br />
                                <input type="hidden" id="id_concepto" class="bigdrop" name="id_concepto" style="width:100%" />
                            </div>  
                            
                            <div class="form-group">
                            	 <label for="name"><?php echo ucfirst($translate->_('_monto')) ; ?></label>
                                 <input class="form-control " id="monto"  name="monto" type="text">
                            </div>                            
                            
                            
                            <div class="form-group">
                                <label for="name"><?php echo ucfirst($translate->_('_fecha_ingreso')) ; ?></label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input class="form-control" name="fecha" />
                                    <span class="input-group-addon"><span></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                            	 <label for="name"><?php echo ucfirst($translate->_('_observaciones')) ; ?></label>
                                 <textarea class="form-control " id="observaciones"  name="observaciones" style='height:150px'></textarea>
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
        //autocompletador para seleccionar una nueva parte
        $('#id_concepto').select2({
            placeholder : " <?php echo ucfirst($translate->_('_seleccione')) ; ?>",
            minimumInputLength: 2,
            ajax: {
                url: base+"/ajax/getConceptos.php",
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term,
                        z: $("#padre").val(),
                        page_limit: 10
                    };
                },
                results: function (data, page) { console.log(data);
                    return { results: data };
                }
            },
            allowClear: true,
            formatSelection: function(data) { 
                return data.text; 
            }   
        });      
    })

    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/contabilidadAdmin/');
    }); 
    
    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'es',
            defaultDate: moment().format('MM/DD/YYYY'),
            pickTime: false
        });
    });

    // boton para mostrar el modal para crear una nueva parte
    $(document).on("click", "#btn_nuevo_concepto", function(event){
            $.post(base+"/ajax/agregarConcepto.php",
                function(data){

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_nuevo_concepto')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) {agregarConceptoBd(dialogItself)}
                            //action: agregarParteBd(dialogItself)
                        }, {
                            label: '<?php echo ucfirst($translate->_('_cancelar')) ; ?>',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
                })
    });

    // funcion de retorno del dialogo para concepto
    //---------------------
    function agregarConceptoBd(dialogItself){

        var param_nombre = $("#concepto_modal").val();
        var param_padre = $("#padre").val();
        $.post(base+"/ajax/agregarConceptoBd.php",{nombre:param_nombre,id_padre:param_padre},
            function(data){
                dialogItself.close(); console.log(data);
                $("#id_concepto").select2("data", {id: data, text:param_nombre});
            }
        );
    }

    
                    
    
                      

</script>