<?php

    $hidden = '<input type="hidden" value="'.$directorio['id'].'" name="id" id="id_directorio">';
    
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class='inline'><?php echo ucfirst($translate->_('_directorio')).'</h1>&nbsp;&nbsp;<i class="fa fa-angle-double-right blueiconcolor"></i>&nbsp;&nbsp;<small>'.$directorio['nombres']." ".$directorio['apellido'].'</small>' ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-right">
                         <a class="btn btn-info" href="index.php/directorioAdmin/"><i class="fa fa-list"></i>&nbsp;<?php echo ucfirst($translate->_('_lista')) ; ?></a>
                         <a class="btn btn-success" href="index.php/directorioAdmin/view/<?php echo $directorio['id'] ?>/"><i class="fa fa-eye"></i>&nbsp;<?php echo ucfirst($translate->_('_ver')) ; ?></a>
                         <a class="btn btn-danger" href="index.php/directorioAdmin/delete/<?php echo $directorio['id'] ?>/"><i class="fa fa-trash-o"></i>&nbsp;<?php echo ucfirst($translate->_('_eliminar')) ; ?></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="panel-body" id='panel_main'>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">  
                                <li>
                                <a href="#home" data-toggle="tab" id='tab_home'><?php echo ucfirst($translate->_('_casos')) ; ?></a>
                                </li>
                                <li><a href="#datos" data-toggle="tab"><?php echo ucfirst($translate->_('_datos')) ; ?></a>
                                </li>
                                <li><a href="#notas" data-toggle="tab"><?php echo ucfirst($translate->_('_notas')) ; ?></a>
                                </li>
                                <li class="active"><a href="#agenda" id='tab_agenda' data-toggle="tab"><?php echo ucfirst($translate->_('_agenda')) ; ?></a>
                                </li>                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content"> 
                                <div class="tab-pane fade in" id="home">
                                  <br>
                                <?php
                                
                                    if (empty($casos)){
                                        echo '<br /><h3>'.ucfirst($translate->_('_no_hay_casos_asociados_directorio')).'</h3>';
                                    }
                                    
                                    foreach ($casos as $key=>$value){
                                        $archivado = '';
                                        if($value['archivado']== 1){
                                            $archivado = '<span>'.ucfirst($translate->_('_caso_archivado')).'</span>';
                                        }
                                        echo '<div class="media">';
                                                echo "<div class='text-right'>
                                                      <a href='index.php/casosAdmin/edit/".$value['id']."/'><i class='fa fa-pencil-square-o fa-lg'></i></a></span>&nbsp;
                                                      <a href='index.php/casosAdmin/view/".$value['id']."/'><i class='fa fa-camera-retro fa-lg'></i></a>
                                                      <a href='index.php/casosAdmin/delete/".$value['id']."/'><i class='fa fa-trash-o fa-lg'></i></a>&nbsp;
                                                      </div>";                            
                                            echo '<div class="media-body" style="border-bottom:1px solid">';//
                                                echo '<p class="lead"><a href="index.php/casosAdmin/view/'.$value['id'].'/" style="color:black">'.$value['caso'].'</a></p>';
                                                echo '<div>'.nl2br($value['description']).'</div>';
                                                echo '<ul class="list-inline">
                                                       <li><b><span class="text-primary">'.ucfirst($translate->_('_nro_carpeta')).":</span></b> ".$value['nro_carpeta'].'</li>
                                                       <li><b><span class="text-primary">'.ucfirst($translate->_('_naturaleza')).":</span></b> ".$value['naturaleza'].'</li>
                                                       <li><b><span class="text-primary">'.ucfirst($translate->_('_nro_expediente')).":</span></b> ".$value['expediente'].'</li>
                                                      </ul>';
                                                //echo '<p class="text-success"><b>'.ucfirst($translate->_('_editorial')).':</b>&nbsp;<a href="index.php/editorialesAdmin/list_books/'.$value['id_editorial'].'/">'.$value['name'].'</a></p>';
                                                // <button type="button" class="btn btn-warning btn-circle"><i class="fa fa-star"></i></button>
                                            echo '</div>';
                                        echo '</div>';
                                    	
                                    }
                                
                                ?>

                                    

                                </div>
                                <!-- tab de objeto -->
                                <div class="tab-pane fade" id="datos">
                                
                                    <form role="form" action="index.php/directorioAdmin/edit_bd/" method=post>
                                        <?php echo $hidden; ?>
                                        <br>
                                        <div class="form-group">
                                        	 <label for="apellido"><?php echo ucfirst($translate->_('_apellido')) ; ?></label>
                                             <input value="<?php echo sanitize($directorio['apellido']) ;?>" type="text" class="form-control" id="apellido" name="apellido"  />
                                        </div> 
                                        <div class="form-group">
                                        	 <label for="nombres"><?php echo ucfirst($translate->_('_nombres')) ; ?></label>
                                             <input value="<?php echo sanitize($directorio['nombres']) ;?>" type="text" class="form-control" id="nombres" name="nombres"  />
                                        </div> 
                                        <div class="form-group">
                                        	 <label for="cuit"><?php echo ucfirst($translate->_('_cuit')) ; ?></label>
                                             <input value="<?php echo sanitize($directorio['cuit']) ;?>" type="text" class="form-control" id="cuit" name="cuit"  />
                                        </div>    
                                        <div class="form-group">
                                        	 <label for="cuil"><?php echo ucfirst($translate->_('cuil')) ; ?></label>
                                             <input value="<?php echo sanitize($directorio['cuil']) ;?>" type="text" class="form-control" id="cuil" name="cuil"  />
                                        </div>    
                                        <div class="form-group">
                                        	 <label for="dni"><?php echo ucfirst($translate->_('dni')) ; ?></label>
                                             <input value="<?php echo sanitize($directorio['dni']) ;?>" type="text" class="form-control" id="dni" name="dni"  />
                                        </div>  
                                        <div class="form-group">
                                        	 <label for="dni"><?php echo ucfirst($translate->_('_claveingreso')) ; ?></label>
                                             <input value="<?php echo sanitize($directorio['clave']) ;?>" type="text" class="form-control" id="clave" name="clave"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_nacimiento"><?php echo ucfirst($translate->_('_fecha_nacimiento')) ; ?></label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' id="fecha_nacimiento" name ="fecha_nacimiento" class="form-control" value="<?php echo mostrar_fecha_esp($directorio['fecha_nacimiento']) ;?>" />
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
                                <!-- fin tab de objeto -->
                                <!-- tab de partes -->
                                <div class="tab-pane fade" id="notas">

                                    <form role="form" action="index.php/directorioAdmin/edit_bd/" method=post>
                                        <?php echo $hidden; ?>
                                        <br>
                                        <div class="form-group">
                                        	 <label for="description"><?php echo ucfirst($translate->_('_notas')) ; ?></label><textarea style="height:350px" class="form-control" id="observaciones" name="observaciones"  /><?php echo sanitize($directorio['observaciones']) ;?></textarea>
                                        </div>
                                      <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary"><?php echo ucfirst($translate->_('_aceptar')) ; ?></button>
                                        <button type="button" class="btn btn-warning" id="btn_cancel"><?php echo ucfirst($translate->_('_cancelar')) ; ?></button>
                                      </div>
                        			</form>
                                    
                                </div>
                                <!-- fin tab de partes -->
                                <!-- tab de o -->
                                <div class="tab-pane fade in active" id="agenda">
                                    <br><br>
                                    <div id='calendar'></div>
                                </div>                                
                            </div>


                            </div>         
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>


<script type="text/javascript">

    $('#mytabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
         
    })
    
    $(document).ready(function() {
        $("#id_naturaleza").select2({ width: '100%',height:'55px' });
    });

    $(document).on("click", "#btn_cancel", function(event){
        window.location.replace('index.php/directorioAdmin/');
    }); 
    
    $(document).on("click", "#tab_agenda", function(event){  
        $('#calendar').fullCalendar('today');
    });     
    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'es',pickTime: false
        });
    }); 
            
//---------------------
//  
    function partes(){
    
        $.post(base+"/ajax/agregarPartes.php",{ id : 1},
            function(data){
                $("#div_nueva_parte").html(data);   
            }
        ); 
    }
    
    function ver_home(){
    
        $("#tab_home").click();
    }   
    
$(document).ready(function() {  

   setTimeout ('ver_home()', 10); 
   calendario(); 
      
});





    function calendario(){  //alert(1);

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar').fullCalendar({
        firstDay: 1,
        defaultView: 'agendaWeek',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		buttonText: {
			prev: '&nbsp;&#9668;&nbsp;',
			next: '&nbsp;&#9658;&nbsp;',
			prevYear: '&nbsp;&lt;&lt;&nbsp;',
			nextYear: '&nbsp;&gt;&gt;&nbsp;', 
			today: 'hoy',
			month: 'mes',
			week: 'semana',
			day: 'dia'
		},		
		titleFormat: {
			month: 'MMMM yyyy',
			week: "d [ yyyy]{ '&#8212;'[ MMM] d MMM yyyy}",
			day: 'dddd, d MMM, yyyy'
		},
		columnFormat: {
			month: 'ddd',
			week: 'ddd d/M',
			day: 'dddd d/M'
		},
		allDayText: 'Todo el dia',
		axisFormat: 'H:mm',
		timeFormat: {
			'': 'H(:mm)',
			agenda: 'H:mm{ - H:mm}'
		},
        
    editable: true,
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
    events: <?php echo $agenda; ?>,
    // Convert the allDay from string to boolean
    eventRender: function(event, element, view) { 
        if (event.allDay === 'true' || event.allDay === true) {
            event.allDay = true;
        }else {
            event.allDay = false;
        }
    },
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDay) { 

        var start_param = start;
        var end_param = end;
        var allDay_param = allDay;
        $.post(base+"/ajax/verCitaCalendario.php",
                function(data){  

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_agregar_cita_agenda')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) { 
                                var titulo_param = $('#titulo').val();
                                var descrip_param = $('#descripcion_modal').val();
                                var start = $.fullCalendar.formatDate(start_param, "yyyy-MM-dd HH:mm:ss");
                                var end = $.fullCalendar.formatDate(end_param, "yyyy-MM-dd HH:mm:ss");
                                var id_directorio_param = $("#id_directorio").val();                             
                                $.post(base+"/ajax/agregarCitaCalendarioBd.php",{id_persona:id_directorio_param,titulo:titulo_param,descripcion:descrip_param,hora_inicio:start,hora_fin:end },
                                    function(data){
                                        dialogItself.close();
                                        var id_retorno = data;
                                        
                                        calendar.fullCalendar('renderEvent',{
                                            title: titulo_param,
                                            id: id_retorno,
                                            start: start_param,
                                            end: end_param,
                                            allDay: allDay_param
                                        },
                                        true // make the event "stick"
                                       );                                         
                                        
                                    })
                                       
                                     
                                       //calendar.fullCalendar('unselect');                                     
                            }
                        }, {
                            label: '<?php echo ucfirst($translate->_('_cancelar')) ; ?>',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    }); 
            
                }
        );     
       calendar.fullCalendar('unselect');
    },
    editable: true,
    eventDrop: function(event, delta) {
        var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
        $.ajax({
            url: base+"/ajax/editarCitaCalendarioBd.php",
            data: 'titulo='+ event.title+'&hora_inicio='+ start +'&hora_fin='+ end +'&id='+ event.id ,
            type: "POST",
            success: function(json) {
                //alert("Updated Successfully");
            }
        });
    },
    eventResize: function(event) {
        var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
        $.ajax({
            url: base+"/ajax/editarCitaCalendarioBd.php",
            data: 'titulo='+ event.title+'&hora_inicio='+ start +'&hora_fin='+ end +'&id='+ event.id ,
            type: "POST",
            success: function(json) {
                //alert("Updated Successfully");
            }
        });
    },
    // click en el evento
    eventClick: function(calEvent, jsEvent, view) {
    
    
        var start_param = calEvent.start;
        var end_param = calEvent.end;
        var allDay_param = calEvent.allDay;
        var id_param  = calEvent.id;
        $.post(base+"/ajax/geteventosCalendario.php",{ id : calEvent.id},
            function(data){ 

                    BootstrapDialog.show({
                        title: '<?php echo ucfirst($translate->_('_editar_cita_agenda')) ; ?>',
                        message: data,
                        buttons: [{
                            label: '<?php echo ucfirst($translate->_('_eliminar')) ; ?>',
                            action: function(dialogItself){

                                 $.post(base+"/ajax/eliminarCitaCalendarioBd.php",{id:id_param },
                                    function(data){
                                        dialogItself.close();
                                    })
                                        calendar.fullCalendar("removeEvents", id_param);
                            },cssClass: 'btn-danger'
                        },{
                            label: '<?php echo ucfirst($translate->_('_aceptar')) ; ?>',
                            action: function(dialogItself) { 
                                var titulo_param = $('#titulo').val();
                                var descrip_param = $('#descripcion').val();
                       
                                $.post(base+"/ajax/editarCitaCalendarioBd.php",{titulo:titulo_param,descripcion:descrip_param,id:id_param },
                                    function(data){
                                        dialogItself.close();
                                    })
                                        calendar.fullCalendar("removeEvents", id_param);
                                        
                                        calendar.fullCalendar('renderEvent',{
                                            title: titulo_param,
                                            start: start_param,
                                            id: id_param,
                                            end: end_param,
                                            allDay: allDay_param
                                        },
                                        true // make the event "stick"
                                       );                                      
                            }
                        }, {
                            label: '<?php echo ucfirst($translate->_('_cancelar')) ; ?>',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
             
        });          
    	// change the border color just for fun
    	//$(this).css('border-color', 'red');
    }    
  }); //calendar



    }  
                 
    
                    
    
                      

</script>