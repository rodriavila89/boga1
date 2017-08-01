<?php
/*******************************************************************************
  * @ martes, 01 de marzo de 2016 03:05:21 p.m.
  * @package
  * @author Adrian
  * @conceptosModel.php
  * @version 1.0
  * @copyright (c) 2015,  Adrian
*******************************************************************************/
class conceptosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _get($id){

        $sql = "select * from conceptos where id = ".$id;
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }

    public function _lista(){

        $sql = "select *,
                case accion
                    when '1' then 'Ingreso'
                    when '-1' then 'Egreso'
                end as accion  from conceptos where sistema <> 1 order by nombre";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }

    public function _list($id_padre){

        $sql = "select *,
                case accion
                    when '1' then 'Debe'
                    when '-1' then 'Haber'
                end as accion  from conceptos where id_padre = ".$id_padre;
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }
    
    public function _insert($data){
        
        $res = $this->db->insert('conceptos',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('conceptos', $data, $where)->affectedRows();
        return $res;
    }  
    
    public function _delete($id){

        $where = array('id'=>$id);  
        # borramos
        $res = $this->db->delete('conceptos',$where)->affectedRows();
        return $res;  
    }  

    public function _buscar($id_padre,$param){

        $sql = "select id,nombre as text
                from conceptos where
                nombre like '%".$param."%'
                and id_padre = '".$id_padre."'
                and sistema = 0
                order by nombre";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }
    
}

?>