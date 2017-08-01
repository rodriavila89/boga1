<?php

/*******************************************************************************
  * @ Lunes, 31 de Marzo de 2014 9:06:16
  * @package  
  * @author Adrián
  * @tribunalesAdminController.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

Class tribunalesAdminController Extends baseController {
    
    public function index(){

        $tribunales_obj = new juzgadosModel();
        $tribunales = $tribunales_obj->_list();
        foreach ($tribunales as $key=>$value) {
            $tribunales[$key]['casos'] = $tribunales_obj-> _getCasosCount($value['id']);	
        }
        $data['tribunales'] = $tribunales;
        $this->registry->template->show('listaTribunalesAdmin',$data);
    }
    
    public function view(){

    }    
    
    public function edit(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $tribunales_obj = new juzgadosModel();
            $tribunales = $tribunales_obj->_get($id);
            $data['tribunal'] = $tribunales[0]; 
        }
        $this->registry->template->show('formTribunalesAdmin',$data);
    }    
    
    public function edit_bd(){

        $tribunales_obj = new juzgadosModel();
        if (!isset($_POST['id'])){
            $res = $tribunales_obj->_insert($_POST);
        }else{
            $res = $tribunales_obj->_update($_POST);
        }
        header("location:".__SITIO."index.php/tribunalesAdmin/");
    }     

    
    public function delete(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $tribunales_obj = new juzgadosModel();
            $tribunales = $tribunales_obj->_get($id);
            $data['tribunal'] = $tribunales[0]; 
        }
        $this->registry->template->show('deleteTribunalesAdmin',$data);
    
    }  
    
    public function deleteBd($data){
        
        if (isset($_POST)){
            $data = $_POST;
            $tribunales_obj = new juzgadosModel();
            $res = $tribunales_obj->_delete($data['id']);
            $casos_obj = new casosModel();
            $casos = $casos_obj->_updateDeleteJuzgado($data['id']);            
        }
        header("location:".__SITIO."index.php/tribunalesAdmin/");
    }   
    
    
    public function listcasos(){

        $id = $this->registry->router->id;
        if (isset($id) and ($id != '')){
            $tribunales_obj = new juzgadosModel();
            $tribunales = $tribunales_obj->_get($id);
            $data['tribunal'] = $tribunales[0]; 
            $casos = $tribunales_obj->_getCasos($id);
            $data['casos'] = $casos; 
        }
        $this->registry->template->show('listaTribunalesCasosAdmin',$data);
    }  
    
    
    public function recorrida(){

        $recorrida_obj = new recorridaModel();
        $recorrida = $recorrida_obj->_lista();
        $data['recorrida'] = $recorrida;
        $this->registry->template->show('listaRecorridaTribunales',$data);
    }

    public function limpiar(){

        $this->registry->template->show('deleteRecorridaTribunales',$data);
    }

    public function limpiarTodo(){

        if (isset($_POST)){
            $tribunales_obj = new recorridaModel();
            $res = $tribunales_obj->_deleteLista();
        }
        header("location:".__SITIO."index.php/recorridaAdmin/recorrida/");
    }


}            
?>