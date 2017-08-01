<?php

/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 12:01:45
  * @package  
  * @author Adrián
  * @juzgadosModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

class juzgadosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list(){
    
        $sql = "select * from juzgados order by nominacion";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _get($id){
        
        $where = array('id ='=>$id);
        $res = $this->db->select('juzgados','',$where)->results();
        return $res;
    } 
    
    public function _insert($data){
        
        $res = $this->db->insert('juzgados',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('juzgados', $data, $where)->affectedRows();
        return $res;
    } 
    
    public function _getCasos($id){

        $sql = "select id,caso 
                from casos 
                where radicacion_actual = ".$id." 
                order by id desc "; 
        $res = $this->db->pdoQuery($sql)->results();
        return $res;   
    }   
    
    public function _getCasosCount($id){

        $sql = "select count(*) as c
                from casos 
                where radicacion_actual = ".$id." 
                order by id desc "; 
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['c'];   
    }      
    
    public function _buscar($param){

        $sql = "select id,nominacion as text from juzgados
                where nominacion like '%".$param."%'
                order by nominacion "; 
        $res = $this->db->pdoQuery($sql)->results();
        return $res;   
    } 
    
    public function _delete($id){

        $delete = array('id'=>$id);
        # borramos    
        $where = $delete; 
        $res = $this->db->delete('juzgados',$where)->affectedRows();
        return $res;  
    }        
    
               
    
    
    
}
?>
