<?php
/*******************************************************************************
  * @ miércoles, 02 de marzo de 2016 03:11:33 p.m.
  * @package
  * @author Adrian
  * @conveniosModel.php
  * @version 1.0
  * @copyright (c) 2015,  Adrian
*******************************************************************************/
class conveniosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _get($id){

        $sql = "select * from convenios
                where id = ".$id;
        $res = $this->db->pdoQuery($sql)->results();
        $sql = "select count(id) as  c
                from cuotas_convenios
                where id_convenio = ".$id;
        $aux = $this->db->pdoQuery($sql)->results();
        $total =  $aux[0]['c'];
        $sql = "select count(id) as  c
                from cuotas_convenios
                where id_convenio = ".$id." and pagado = 1";
        $aux = $this->db->pdoQuery($sql)->results();
        $pagadas =  $aux[0]['c'];
        $res[0]['total_cuotas'] = $total;
        $res[0]['total_cuotas_pagadas'] = $pagadas;
        foreach ($res as $key=>$value) {
        	$sql = "select * from cuotas_convenios
                    where id_convenio = ".$value['id'];
            $aux = $this->db->pdoQuery($sql)->results();
            $res[$key]['cuotas_convenio'] = $aux;
        }
        return $res;
    }

    public function _list_por_caso($id_caso){

        $sql = "select * from convenios
                where id_caso = ".$id_caso;
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value) {
        	$sql = "select * from cuotas_convenios
                    where id_convenio = ".$value['id'];
            $aux = $this->db->pdoQuery($sql)->results();
            $res[$key]['cuotas_convenio'] = $aux;
        }
        return $res;
    }

    public function _list_por_caso_abiertos($id_caso){

        $sql = "select * from convenios
                where id_caso = ".$id_caso." and cerrado = 0"; 
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value) {
        	$sql = "select * from cuotas_convenios
                    where id_convenio = ".$value['id']." and pagado = 0";
           $aux = $this->db->pdoQuery($sql)->results();
            $res[$key]['cuotas_convenio'] = $aux;
        }
        return $res;
    }

    // muestra la siguiente cuota a pagar segun el convenio pasado por parametro
    public function _siguiente_cuota($id_convenio){

        $sql = "select * from cuotas_convenios
                where id_convenio = ".$id_convenio." and pagado = 0 order by
                orden,id asc limit 1";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    }

    // muestra la siguiente cuota a pagar segun el convenio pasado por parametro
    public function _pago_cuota($datos){

        // ponemos la cuota como pagada
        $data['pagado'] = 1;
        $where = array('id'=>$datos['id_cuota_convenio']);
        $res = $this->db->update('cuotas_convenios', $data, $where)->affectedRows();
        // vemos si es la ultima cuota
        $siguiente = $this->_siguiente_cuota($datos['id_convenio']);
        if (empty($siguiente)){
            $dat['cerrado'] = 1;
            $dat['id'] = $datos['id_convenio'];
            $cerramos = $this->_update($dat);    
        }
        return $res;
    }



    // agrega un convenio y todas las cuotas  a la base de datos
    public function _insert($data){

        $agenda_obj = new agendaModel();
        $data['id_caso'] = $data['id'];
        $cantidad_cuotas = $data['cantidad_cuotas'] + 1;
        unset($data['id']);
        $data['dia_primera_cuota'] = validar_fecha_insert($data['dia_primera_cuota']);
        $res = $this->db->insert('convenios',$data)->getLastInsertId();
        # insertamos las cuotas
        # el porcentaje lo dividimos por 12
        $porcentaje = $data['porcentaje_anual'] / 12;
        $aux = $data['monto'] / $data['cantidad_cuotas'];
        $data;
        $c = array();
        $auxilio = $aux + (($aux * $porcentaje) / 100);
        $c['monto_cuota'] = ''.round($auxilio, 2).'';
        $c['id_convenio'] = $res;
        $c['pagado'] = 0;
        for ($i=1; $i< $cantidad_cuotas; $i++){
            $c['orden'] = $i;
            if ($i == 1){
                $c['fecha'] = $data['dia_primera_cuota'];
                $fecha_agenda = $data['dia_primera_cuota'];
            }else{
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $c['fecha']) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
                $c['fecha'] = $nuevafecha;
                $fecha_agenda = $nuevafecha;
            }
            //insertamos en la agenda
            $agenda['hora_inicio'] = $fecha_agenda;
            $agenda['hora_fin'] = $fecha_agenda;
            $agenda['titulo'] = 'Cuota convenio';
            $agenda['descripcion'] = 'Convenio '.$data['nombre'];
            $agenda_publico = $agenda_obj->_insert($agenda);
            //insertamos en las cuotas del convenio
            $res_cuota = $this->db->insert('cuotas_convenios',$c)->getLastInsertId();
        }
        return $res;
    }  
    

    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('convenios', $data, $where)->affectedRows();
        return $res;
    }  
    

    public function _delete($id){

        $where = array('id'=>$id);  
        # borramos
        $res = $this->db->delete('convenios',$where)->affectedRows();
        return $res;  
    }  
    
    
    public function _casosConConvenios(){
        
        $sql = "select id,caso from casos
                where id in (select DISTINCT(id_caso) 
                from convenios where cerrado = 0)";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
        
    
    }


    
}

?>