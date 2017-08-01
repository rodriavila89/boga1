<?php
/*******************************************************************************
  * @ martes, 01 de marzo de 2016 02:23:29 p.m.
  * @package
  * @author Adrian
  * @contabilidadModel.php
  * @version 1.0
  * @copyright (c) 2015,  Adrian
*******************************************************************************/
class contabilidadModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }
    
    public function _get($id){

        $sql = "select conceptos.nombre,contables.*,conceptos.accion,
                convenios.nombre as convenio,casos.caso
                from conceptos ,contables
                left join casos on contables.id_caso = casos.id
                left join convenios on contables.id_convenio = convenios.id
                where contables.id_concepto = conceptos.id
                and contables.id = ".$id;
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }    

    public function _list($fecha_desde="0000-00-00",$fecha_hasta="3000-00-00"){

        $sql = "select conceptos.nombre,contables.*,conceptos.accion,
                convenios.nombre as convenio,casos.caso
                from conceptos ,contables
                left join casos on contables.id_caso = casos.id
                left join convenios on contables.id_convenio = convenios.id
                where contables.id_concepto = conceptos.id
                and fecha >='".$fecha_desde."' and fecha <='".$fecha_hasta."'
                order by fecha desc,orden asc, hora desc";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }
    
    public function _list_por_caso($id_caso){

        $sql = "select conceptos.nombre,contables.*,conceptos.accion,
                convenios.nombre as convenio,casos.caso
                from conceptos ,contables
                left join casos on contables.id_caso = casos.id
                left join convenios on contables.id_convenio = convenios.id
                where contables.id_concepto = conceptos.id
                and contables.id_caso = ".$id_caso."
                order by fecha desc,orden asc, hora desc";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }  
    
    public function _ingreso_por_caso($id_caso){

        $sql = "select coalesce(sum(monto),0) as ingreso from contables,conceptos
                where
                contables.id_concepto = conceptos.id
                and contables.id_caso = ".$id_caso."
                and conceptos.accion= 1";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }   
    
    public function _egreso_por_caso($id_caso){

        $sql = "select coalesce(sum(monto),0) as egreso from contables,conceptos
                where
                contables.id_caso = ".$id_caso."
                and contables.id_concepto = conceptos.id
                and conceptos.accion= -1";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }     
    
    public function _insert($data){

        if (isset($data['fecha'])){
            $data['fecha'] = validar_fecha_insert($data['fecha']);
        }
        unset($data['padre']);
        if (isset($data['id_convenio'])){
            if ( ($data['id_convenio'] != Null) and ($data['id_convenio'] != '') ){
                $data['fecha'] = date("Y-m-d");
            }
        }
        $res = $this->db->insert('contables',$data)->getLastInsertId();
        return $res;
    }

    public function _ingreso($fecha_desde="0000-00-00",$fecha_hasta="3000-00-00"){

        $sql = "select coalesce(sum(monto),0) as ingreso from contables,conceptos
                where
                contables.fecha >= '".$fecha_desde."'
                and contables.fecha <= '".$fecha_hasta."'
                and contables.id_concepto = conceptos.id
                and conceptos.accion= 1"; 
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }


    public function _egreso($fecha_desde="0000-00-00",$fecha_hasta="3000-00-00"){

        $sql = "select coalesce(sum(monto),0) as egreso from contables,conceptos
                where
                contables.fecha >= '".$fecha_desde."'
                and contables.fecha <= '".$fecha_hasta."'
                and contables.id_concepto = conceptos.id
                and conceptos.accion= -1";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }
    
    
    public function _delete($data){

        $delete = array('id'=>$data['id']);
        # borramos    
        $where = $delete; 
        $res = $this->db->delete('contables',$where)->affectedRows();
        return $res;  
    }     

    
}

?>