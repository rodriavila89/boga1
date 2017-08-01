<?php

/*******************************************************************************
  * @ Jueves, 27 de Marzo de 2014 13:57:28
  * @package  
  * @author Adrián
  * @naturalezasCasosModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

class naturalezasCasosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list(){
    
        $sql = "select * from naturalezas_casos 
                order by nombre";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }  
    
    public function _get($id){
    
        $sql = "select * from naturalezas_casos 
                where id =".$id;  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }   
    
    public function _insert($data){
        
        $res = $this->db->insert('naturalezas_casos',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('naturalezas_casos', $data, $where)->affectedRows();
        return $res;
    } 
    
    public function _delete($id){

        $delete = array('id'=>$id);
        # borramos    
        $where = $delete; 
        $res = $this->db->delete('naturalezas_casos',$where)->affectedRows();
        return $res;  
    }       
          
    
}
?>
