<?php

/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 12:40:14
  * @package  
  * @author Adrián
  * @directorioModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class directorioModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list($order_list_directorio,$desde=0,$hasta=20,$busqueda=''){ 
        
        $orden = " order by id ";
        if ($order_list_directorio !=''){
            $orden = " order by ".$order_list_directorio;
        }
        $sql = "SELECT * from directorio
                where (apellido like '%".$busqueda."%' or nombres like '%".$busqueda."%' or dni like '%".$busqueda."%' ) 
                ".$orden."
                LIMIT ".$desde." , ".$hasta."";
        $res_data = $this->db->pdoQuery($sql)->results();
        $sql = " select count(id) as c from directorio where (apellido like '%".$busqueda."%' or nombres like '%".$busqueda."%') ";
        $res_cantidad = $this->db->pdoQuery($sql)->results();
        $res['cantidad'] = $res_cantidad[0]['c'];
        $res['data'] = $res_data;        
        return $res;
    }    
    
    public function _get($id){
        
        $where = array('id ='=>$id);
        $res = $this->db->select('directorio','',$where)->results();
        return $res;
    } 
    
    public function _insert($data){
        
        $res = $this->db->insert('directorio',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        if (isset($data['fecha_nacimiento'])){
            $data['fecha_nacimiento'] = validar_fecha_insert($data['fecha_nacimiento']);
        }           
        $res = $this->db->update('directorio', $data, $where)->affectedRows();
        return $res;
    }   
    
    public function _buscar($param){
    
        $sql = "select id,concat(apellido,', ',nombres ) as text 
                from directorio where
                apellido like '%".$param."%' order by id";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }        
    
    public function _delete($data){

        $delete = array('id'=>$data['id']);
        # borramos las vinculaciones de la agenda
        $where_aux = array('id_persona'=>$data['id']);
        $where_aux_2 = array('id_directorio'=>$data['id']);
        $res = $this->db->delete('agenda',$where_aux)->affectedRows();
        # borramos las vinculaciones de las partes
        $res = $this->db->delete('partes',$where_aux)->affectedRows();   
        # borramos de los ultimos vistos
        $res = $this->db->delete('ultimos_vistos',$where_aux_2)->affectedRows();             
        # borramos el directorio       
        $where = $delete; 
        $res = $this->db->delete('directorio',$where)->affectedRows();  
    }          
    
}

?>