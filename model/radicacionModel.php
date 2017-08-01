<?php

/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 12:16:01
  * @package  
  * @author Adrián
  * @radicacionModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class radicacionModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _listBycaso($id_caso){
    
        $sql = "select 
                radicacion_anterior.id, radicacion_anterior.nro_expediente,
                juzgados.nominacion,juzgados.id as id_juzgado
                from radicacion_anterior,juzgados
                where radicacion_anterior.id_juzgado = juzgados.id
                and id_caso = ".$id_caso." 
                order by id desc";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _get($id){
        
        $where = array('id ='=>$id);
        $res = $this->db->select('radicacion_anterior','',$where)->results();
        return $res;
    } 
    
    public function _insert($data){
        
        $res = $this->db->insert('radicacion_anterior',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('radicacion_anterior', $data, $where)->affectedRows();
        return $res;
    }   
    
    public function _delete($id){

        $where = array('id'=>$id);  
        # borramos la editorial        
        $res = $this->db->delete('radicacion_anterior',$where)->affectedRows();
        return $res;  
    }         
    
        
    
}

?>