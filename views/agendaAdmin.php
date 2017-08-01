<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo ucfirst($translate->_('_agenda')) ; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id='calendar'></div>
        </div><!-- /.row -->
    </div> 
</div>


<script>
$(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar').fullCalendar({
        defaultView: 'agendaWeek',
        firstDay: 1,
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
    events: <?php echo $agenda; ?>,//eventColor: '#378006',
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
        $.post(base+"/ajax/verCitaCalendario.php",{ id : 1,hora:start_param},
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
                                $.post(base+"/ajax/agregarCitaCalendarioBd.php",{titulo:titulo_param,descripcion:descrip_param,hora_inicio:start,hora_fin:end },
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
  
 });
  

</script>