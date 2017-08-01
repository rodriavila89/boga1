<?php

# CLASE RECORRIDA DE TRIBUNALES



class recorridaModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }


    public function _lista($tribunal =''){
        
        $aux = "";    
        if ($tribunal !=''){
            $aux = " and juzgados.id =".$tribunal;
        }
        if ($tribunal == 0){
            $aux = "";
        }        
        $sql = "select recorrida.id,casos.caso ,juzgados.nominacion,casos.id as id_caso
                from recorrida, casos
                LEFT join juzgados on casos.radicacion_actual = juzgados.id
                where
                recorrida.id_caso = casos.id ".$aux;  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;    
    }      
    
    
    public function _insert($data){

        $res = $this->db->insert('recorrida',$data)->getLastInsertId();
        return $res;
    }


    public function _delete($id){

        $where = array('id'=>$id);
        # borramos
        $res = $this->db->delete('recorrida',$where)->affectedRows();
        return $res;
    }


    public function _getCaso($id){

        $sql = "select count(recorrida.id) as c
                from recorrida, casos
                where
                casos.id = ".$id."
                and recorrida.id_caso = casos.id";
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['c'];
    }

    public function _getByCaso($id){

        $sql = "select recorrida.id
                from recorrida, casos
                where
                casos.id = ".$id."
                and recorrida.id_caso = casos.id";
        $res = $this->db->pdoQuery($sql)->results();
        return $res[0]['id'];

    }

    public function _deleteLista(){

        //$sql = "delete from recorrida where id > 0";
        $res = $this->db->truncate('recorrida');
        return $res;

    }
  
 
    
}
?>
