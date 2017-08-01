<?php

/*******************************************************************************
  * @ martes, 04 de marzo de 2014 14:01:33
  * @package  
  * @author Adrian
  * @estadisticasModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrian   
*******************************************************************************/    

class estadisticasModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
        $this->db = parent::getInstance();           
    }
    
    public function _listaByEditorial(){
        
        $sql = "select count(book.id)as value,editorial.name  as label
                from book
                left join editorial on book.id_editorial = editorial.id
                group by book.id_editorial  ";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    } 
    
    public function _countCasos(){
        
        $sql = "select count(casos.id)as c
                from casos";
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['c'];
    }   
    
    public function _countDirectorio(){
        
        $sql = "select count(directorio.id)as c
                from directorio";
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['c'];
    }    
    
    public function _countAgendaHoy(){
        
        $sql = "select count(agenda.id) as c 
                from agenda where DATE(agenda.hora_inicio) =  CURDATE()";
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['c'];
    }  
    
    public function _listaByTribunal(){
        
        $sql = "select count(casos.id)as value,COALESCE(juzgados.nominacion,'No asignado')  as label
                from casos
                left join juzgados on casos.radicacion_actual = juzgados.id
                group by casos.radicacion_actual ";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }          
    
   
    
          
    
}
?>