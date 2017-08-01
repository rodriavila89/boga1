<?php

/*******************************************************************************
  * @ Jueves, 17 de Abril de 2014 12:29:42
  * @package  
  * @author Adrián
  * @upgradeAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

Class upgradeAdminController Extends baseController {
    
    public function index(){

        # version
        $upgrade_obj = new upgradeModel();
        $version = $upgrade_obj->_version();
        $data['version'] = $version; 
        $this->registry->template->show('upgradeAdmin',$data);
    }
    
    public function nueva(){

        # version
        $upgrade_obj = new upgradeModel();
        $version = $upgrade_obj->_version();
        $nueva_version = $upgrade_obj->_ultmaVersion();
        $data['version'] = $version;
        $data['nueva_version'] = $nueva_version;
        $this->registry->template->show('upgradeAdmin',$data);
    }    
    
    public function actualizar(){

        # version
        $upgrade_obj = new upgradeModel();
        $act = $upgrade_obj->_actualizar();
        $version = $upgrade_obj->_version();
        $nueva_version = $upgrade_obj->_ultmaVersion();
        $data['version'] = $version;
        $data['nueva_version'] = $nueva_version;
        $this->registry->template->show('upgradeAdmin',$data);
    }     

}            
?>