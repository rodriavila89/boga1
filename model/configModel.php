<?php

/*******************************************************************************
  * @ domingo, 09 de marzo de 2014 16:20:08
  * @package  
  * @author Adrian
  * @configModel.php
  * @version 1.0 
  * @copyright (c) 2014,  Adrian   
*******************************************************************************/  
class configModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }
    
    
    public function _get(){
        
        $sql = "SELECT * FROM config ";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }    
    
    public function _update($data){

        $where = array('id'=>1);
        $res = $this->db->update('config', $data, $where)->affectedRows();
        return $res;
    }          
    
}
?>