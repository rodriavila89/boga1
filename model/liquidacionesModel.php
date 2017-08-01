<?php
/*******************************************************************************
  * @ sábado, 25 de marzo de 2017 13:15:42
  * @package  
  * @author Adrian
  * @liquidacionesModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrian   
*******************************************************************************/    

class liquidacionesModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list(){
    
        $sql = "select * from liquidaciones order by id desc";  
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _get($id){
        
        $sql = "select *
                from liquidaciones
                where id = ".$id."
                order by id desc "; //echo $sql;
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value) {
            $aux_dias = $value['capital_inicial'] / 365;
            $aux_porcentaje = $aux_dias * ($value['interes_anual'] / 100 );
            $aux_porcentaje = $aux_porcentaje * $value['dias'];
            $res[$key]['interes_anual_total'] = $aux_porcentaje;
            $aux_porcentaje = $aux_dias * ($value['interes_punitorio_anual'] / 100 );
            $aux_porcentaje = $aux_porcentaje * $value['dias'];
            $res[$key]['interes_punitorio_anual_total'] = $aux_porcentaje;
            $total_interes = $res[$key]['interes_punitorio_anual_total'] + $res[$key]['interes_anual_total'];
            $res[$key]['interes_iva_total'] = $total_interes * ($value['iva'] / 100);
            $res[$key]['total_cabecera'] = $total_interes + $res[$key]['interes_iva_total'] + $value['capital_inicial'];
            $res[$key]['items'] = $this->_getItems($value['id']);
        }
        return $res;
    } 
    
    public function _insert($data){

        $res = $this->db->insert('liquidaciones',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('liquidaciones', $data, $where)->affectedRows();
        return $res;
    } 
    
    public function _getCasos($id){

        $sql = "select *   
                from liquidaciones 
                where id_caso = ".$id." 
                order by id desc "; //echo $sql;
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value) {
            $aux_dias = $value['capital_inicial'] / 365;
            $aux_porcentaje = $aux_dias * ($value['interes_anual'] / 100 );
            $aux_porcentaje = $aux_porcentaje * $value['dias'];
            $res[$key]['interes_anual_total'] = $aux_porcentaje;
            $aux_porcentaje = $aux_dias * ($value['interes_punitorio_anual'] / 100 );
            $aux_porcentaje = $aux_porcentaje * $value['dias'];            
            $res[$key]['interes_punitorio_anual_total'] = $aux_porcentaje;
            $total_interes = $res[$key]['interes_punitorio_anual_total'] + $res[$key]['interes_anual_total'];
            $res[$key]['interes_iva_total'] = $total_interes * ($value['iva'] / 100);
            $res[$key]['total_cabecera'] = $total_interes + $res[$key]['interes_iva_total'] + $value['capital_inicial'];	
        }
        return $res;   
    }   
    
    public function _delete($id){

        $delete = array('id'=>$id);
        # borramos    
        $where = $delete; 
        $res = $this->db->delete('liquidaciones',$where)->affectedRows();
        return $res;  
    }

    public function _insertItems($data){

        $res = $this->db->insert('items_liquidaciones',$data)->getLastInsertId();
        return $res;
    }


    public function _deleteItems($id){

        $sql = "select id_liquidacion
                from items_liquidaciones
                where id = ".$id;
        $aux = $this->db->pdoQuery($sql)->results();
        $delete = array('id'=>$id);
        # borramos
        $where = $delete;
        $res = $this->db->delete('items_liquidaciones',$where)->affectedRows();
        return $aux[0]['id_liquidacion'];
    }


    public function _getItems($id){

        $sql = "select *
                from items_liquidaciones
                where id_liquidacion = ".$id."
                order by id desc ";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }
    
               
    
    
    
}
?>
