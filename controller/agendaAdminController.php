<?php

/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 14:50:09
  * @package  
  * @author Adrián
  * @agendaAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

Class agendaAdminController Extends baseController {
    
    public function index(){

        $agenda_obj = new agendaModel();
        $agenda = $agenda_obj->_list();
        $agenda = utf8_array_decode($agenda);
        $data['agenda'] = json_encode($agenda);
        $data2['agenda2'] = json_encode($agenda2);
        $this->registry->template->show('agendaAdmin',$data);
    }

}            
?>