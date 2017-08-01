<?php

/*******************************************************************************
  * @ jueves, 10 de abril de 2014 10:59:09
  * @package  
  * @author Adrian
  * @ultimosVistosModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrian   
*******************************************************************************/  
class ultimosVistosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _listCasos(){
    
        $sql = "select distinct(casos.id), casos.caso
                from ultimos_vistos 
                left join casos on casos.id = ultimos_vistos.id_caso 
                where id_directorio = 0
                order by ultimos_vistos.id desc limit 5";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _listDirectorio(){
    
        $sql = "select distinct(directorio.id), directorio.nombres,directorio.apellido
                from ultimos_vistos 
                left join directorio on directorio.id = ultimos_vistos.id_directorio
                where id_caso = 0 
                order by ultimos_vistos.id desc limit 5";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                  
    }     
    
   
    public function _insert($data){
        
        $data['fecha_hora'] = date("Y-m-d H:i:s",time()); //tomo fecha y hora actual
        $res = $this->db->insert('ultimos_vistos',$data)->getLastInsertId();
        return $res;
    }  
    
           
    
}
?>
