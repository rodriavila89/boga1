<?php

/*******************************************************************************
  * @ Martes, 01 de Abril de 2014 13:46:55
  * @package  
  * @author Adrián
  * @rolesModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class rolesModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list(){
    
        $sql = "select * from roles order by nombre";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _get($id){
        
        $where = array('id ='=>$id);
        $res = $this->db->select('roles','',$where)->results();
        return $res;
    } 
    
    public function _insert($data){
        
        $res = $this->db->insert('roles',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('roles', $data, $where)->affectedRows();
        return $res;
    }    
    
    public function _getCantidadPartes($id){

        $sql = "select count(*) as c
                from partes 
                where partes.id_rol = ".$id;
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['c'];
    }  
    
    public function _delete($id){

        $where = array('id'=>$id);  
        # borramos la editorial        
        $res = $this->db->delete('roles',$where)->affectedRows();
        return $res;  
    }            
    
}
?>
