<?php

/*******************************************************************************
  * @ Lunes, 31 de Marzo de 2014 11:43:21
  * @package  
  * @author Adrián
  * @partesModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class partesModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list(){
    
        $sql = "select * from partes order by id";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _get($id){
        
        $where = array('id ='=>$id);
        $res = $this->db->select('partes','',$where)->results();
        return $res;
    } 
    
    public function _insert($data){
        
        $res = $this->db->insert('partes',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('partes', $data, $where)->affectedRows();
        return $res;
    }  
    
    public function _listByCasos($id_caso){

        $sql = "select partes.id as id_parte, roles.nombre as rol,partes.tipo,
                directorio.id,directorio.nombres,directorio.apellido  
                from partes,directorio,roles 
                where directorio.id = partes.id_persona 
                and roles.id = partes.id_rol 
                and partes.id_caso = ".$id_caso." 
                order by partes.id  ";             
        $res = $this->db->pdoQuery($sql)->results();
        return $res;  
    } 
    
    public function _delete($id){

        $where = array('id'=>$id);  
        # borramos la parte      
        $res = $this->db->delete('partes',$where)->affectedRows();
        return $res;  
    }  
    
    public function _deleteByRol($id_rol){

        $where = array('id_rol'=>$id_rol);  
        # borramos el rol       
        $res = $this->db->delete('partes',$where)->affectedRows();
        return $res;  
    }                  
    
}

?>