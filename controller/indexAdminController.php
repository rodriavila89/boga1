<?php

/*******************************************************************************
  * @ Miércoles, 12 de Febrero de 2014 13:49:06
  * @package  
  * @author Adrián
  * @indexAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/   

Class indexAdminController Extends baseController {


    public function index() {
    }
    
    public function config(){

        $config_obj = new configModel();
        $config = $config_obj->_get();
        $data['config'] = $config[0];
        $lenguajes = archivos_contenidos(__SITE_PATH.'/languages');
        $data['lenguajes'] = $lenguajes;
        $this->registry->template->show('config',$data);
    }
    
    public function edit_config(){

        $data = $_POST;
        if (isset($data['lenguaje_automatic'])){
            $data['lenguaje_automatic'] = 1;   
        }else{
            $data['lenguaje_automatic'] = 0;
        }
        if (isset($data['show_search_in_home'])){
            $data['show_search_in_home'] = 1;   
        }else{
            $data['show_search_in_home'] = 0;
        }        
        $config_obj = new configModel();
        $config = $config_obj->_update($data);
        header('location:'.__SITIO.'index.php/indexAdmin/config/');
    }    
    
    public function profile(){

        $user_obj = new usersModel();
        $user = $user_obj->_get();
        $data['user'] = $user; 
        $this->registry->template->show('profile',$data);
    }    
    
    public function edit_bd(){

        $data = $_POST;
        $user_obj = new usersModel();
        $user = $user_obj->_update($data);
        header('location:'.__SITIO.'index.php/indexAdmin/profile/');
    }    
    
    public function acerca(){

        $this->registry->template->show('acerca',$data);
    }    
    
}            
?>
