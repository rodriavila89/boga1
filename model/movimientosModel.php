<?php

/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 12:21:29
  * @package  
  * @author Adrián
  * @movimientosModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class movimientosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list_por_caso($id_caso,$limit=50000){
    
        $sql = "select * from movimientos
                where id_caso = ".$id_caso."
                order by id desc limit ".$limit."";  
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value) {
            $archivos = archivos_contenidos(__SITE_PATH.'/files/casos/'.$id_caso.'/movimientos/'.$value['id'].'/');
            $res[$key]['archivos'] = $archivos;       	   
        }
        return $res;                 
    } 
    
    public function _get($id){
        
        $where = array('id ='=>$id);
        $res = $this->db->select('movimientos','',$where)->results();
        return $res;
    } 
    
    public function _insert($data){

        if (isset($data['fecha'])){
            $data['fecha'] = validar_fecha_insert($data['fecha']);
        }   
        unset($data['id']);        
        $res = $this->db->insert('movimientos',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        $data['fecha'] = validar_fecha_insert($data['fecha']);
        unset($data['id']); 
        $res = $this->db->update('movimientos', $data, $where)->affectedRows();
        return $res;
    }      
    
    public function _delete($id){

        $delete = array('id'=>$id);
        # borramos    
        $where = $delete; 
        $res = $this->db->delete('movimientos',$where)->affectedRows();
        return $res;  
    }        
    
}
?>