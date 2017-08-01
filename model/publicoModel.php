<?php

/*******************************************************************************
  * @ martes, 23 de agosto de 2016 12:37:46 p.m.
  * @package
  * @author Adrian
  * @publicoModel.php
  * @version 1.0
  * @copyright (c) 2016,  Adrian
*******************************************************************************/
class publicoModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list($directorio){
        
        $sql = "select * from casos where id in (
                    select distinct(casos.id)
                    from casos, movimientos,partes
                    where
                    casos.id = movimientos.id_caso
                    and casos.id = partes.id_caso
                    and partes.id_persona = ".$directorio."
                    and movimientos.publico = 1
                    ) ";
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value) {
            $sql = "select * from movimientos
                    where movimientos.id_caso = ".$value['id']."
                    and movimientos.publico = 1 ";
            $r = $this->db->pdoQuery($sql)->results();
        	$res[$key]['MOVIMIENTOS'] = $r;
        }

        return $res;
    }    


    
    public function _login($param){
    
        $sql = "select id,concat(apellido,', ',nombres ) as text 
                from directorio where
                clave = '".$param."' limit 1 ";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }        

    
}

?>