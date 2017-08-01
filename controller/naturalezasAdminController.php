<?php

/*******************************************************************************
  * @ Miércoles, 09 de Abril de 2014 9:05:39
  * @package  
  * @author Adrián
  * @naturalezasAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

Class naturalezasAdminController Extends baseController {
    
    public function index(){

        $naturalezas_obj = new naturalezasCasosModel();
        $naturalezas = $naturalezas_obj->_list();
        $data['naturalezas'] = $naturalezas;
        $this->registry->template->show('listaNaturalezasAdmin',$data);
    }
    
    public function view(){

    }    
    
    public function edit(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $naturalezas_obj = new naturalezasCasosModel();
            $naturalezas = $naturalezas_obj->_get($id);
            $data['naturalezas'] = $naturalezas[0]; 
        }
        $this->registry->template->show('formNaturalezasAdmin',$data);
    }    
    
    public function edit_bd(){

        $naturalezas_obj = new naturalezasCasosModel();
        if (!isset($_POST['id'])){
            $res = $naturalezas_obj->_insert($_POST);
        }else{
            $res = $naturalezas_obj->_update($_POST);
        }
        header("location:".__SITIO."index.php/naturalezasAdmin/");
    }     

    
    public function delete(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $naturalezas_obj = new naturalezasCasosModel();
            $naturalezas = $naturalezas_obj->_get($id);
            $data['naturalezas'] = $naturalezas[0]; 
        }
        $this->registry->template->show('deleteNaturalezasAdmin',$data);
    
    }  
    
    public function deleteBd($data){
        
        if (isset($_POST)){
            $data = $_POST;
            $naturalezas_obj = new naturalezasCasosModel();
            $res = $naturalezas_obj->_delete($data['id']);
            $casos_obj = new casosModel();
            $casos = $casos_obj->_updateDeleteNaturaleza($data['id']);
        }
        header("location:".__SITIO."index.php/naturalezasAdmin/");
    }   
    
}            
?>