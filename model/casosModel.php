<?php

/*******************************************************************************
  * @ Jueves, 27 de Marzo de 2014 12:39:37
  * @package  
  * @author Adrián
  * @casosModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  

class casosModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
        $this->db = parent::getInstance();           
    }
    
    public function _get($id){
        
        $sql = "select casos.*,
                juzgados.nominacion,naturalezas_casos.nombre as naturaleza
                from casos
                left join juzgados on juzgados.id = casos.radicacion_actual
                left join naturalezas_casos on naturalezas_casos.id = casos.id_naturaleza
                where casos.id = ".$id;
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    } 
    
    public function _insert($data){
    
        $data = $_POST;
        if (isset($data['fecha_ingreso'])){
            $data['fecha_ingreso'] = validar_fecha_insert($data['fecha_ingreso']);
        }
        $res = $this->db->insert('casos',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        if (isset($data['fecha_ingreso'])){
            $data['fecha_ingreso'] = validar_fecha_insert($data['fecha_ingreso']);
        } 
        if (isset($data['archivado'])){
            if ($data['archivado'] = 'on'){
                $data['archivado'] =1;
            }else{
                $data['archivado'] =0;
            }
        }else{
            $data['archivado'] =0;
        }   
        $res = $this->db->update('casos', $data, $where)->affectedRows();
        return $res;
    }   
    
    // @todo 
    public function _updateDeleteNaturaleza($id_naturaleza){

        $sql = "select id from casos where id_naturaleza = ".$id_naturaleza."";
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value){
            $data['id'] = $value['id'];
            $data['id_naturaleza'] = 0 ;
            $res_update = $this->_update($data);	
        }
        return $res;
    }    
    
    // @todo 
    public function _updateDeleteJuzgado($id_juzgado){

        $sql = "select id from casos where radicacion_actual = ".$id_juzgado."";
        $res = $this->db->pdoQuery($sql)->results();
        foreach ($res as $key=>$value){
            $data['id'] = $value['id'];
            $data['radicacion_actual'] = 0 ;
            $res_update = $this->_update($data);	
        }
        return $res;
    }                 
    
    public function _list($order=1,$desde=0,$hasta=20,$busqueda=''){

        $orden = " order by id ";
        if ($order !=''){
            $orden = " order by ".$order;
        }
        if (is_array($busqueda)){
            $fecha_desde =  $busqueda[0];
            $fecha_hasta =  $busqueda[1];
            $movimiento =  $busqueda[2];
            $in = "";
            $tipo = "";
            if ($movimiento ==0){
                $in = " not ";
            }
            if ($movimiento ==1){
                $tipo = " and tipo_estado ='_no_procesal' ";
            }
            if ($movimiento ==2){
                $tipo = " and tipo_estado ='_procesal' ";
            }
            if ($movimiento ==3){
                $tipo = " and tipo_estado ='_otro' ";
            }
            $sql_busqueda = "  casos.id ".$in." in (
                                select distinct(id_caso)
                                from movimientos
                                where fecha >='".$fecha_desde."'
                                and fecha <= '".$fecha_hasta."' ".$tipo.")";
        }else{
            $sql_busqueda = " caso like '%".$busqueda."%'  ";
        }
        $sql = "select casos.*,
                juzgados.nominacion,naturalezas_casos.nombre as naturaleza
                from casos
                left join juzgados on juzgados.id = casos.radicacion_actual
                left join naturalezas_casos on naturalezas_casos.id = casos.id_naturaleza
                where
                ".$sql_busqueda.$orden." LIMIT ".$desde." , ".$hasta.""; //echo $sql;// die;
        $res_data = $this->db->pdoQuery($sql)->results();
        $movimiento_obj = new movimientosModel();
        $recorrida_obj = new recorridaModel();
        foreach ($res_data as $key=>$value) {
            $aux = $movimiento_obj->_list_por_caso($value['id'],1);
            $recorrida = $recorrida_obj->_getCaso($value['id']);
        	$res_data[$key]['movimiento'] = $aux[0];
            $res_data[$key]['recorrida'] = $recorrida;
        }        
        $sql = " select count(id) as c from casos where ".$sql_busqueda;
        $res_cantidad = $this->db->pdoQuery($sql)->results();
        $res['cantidad'] = $res_cantidad[0]['c'];
        $res['data'] = $res_data;        
        return $res;
    } 
    
    
    public function _delete($data){

        $delete = array('id'=>$data['id']);
        $where_aux = array('id_caso'=>$data['id']);
        #agenda
        $res = $this->db->delete('agenda',$where_aux)->affectedRows();            
        #partes
        $res = $this->db->delete('partes',$where_aux)->affectedRows();    
        #movimientos
        $res = $this->db->delete('movimientos',$where_aux)->affectedRows();    
        #radicacion anterior
        $res = $this->db->delete('radicacion_anterior',$where_aux)->affectedRows();  
        #ultimos vistos
        $res = $this->db->delete('ultimos_vistos',$where_aux)->affectedRows();            
        # borramos el caso  
        $where = $delete; 
        $res = $this->db->delete('casos',$where)->affectedRows();
        return $res;  
    }   
    
    public function _listPorDirectorio($id_parte,$order=1,$desde=0,$hasta=20){

        $orden = " order by id ";
        if ($order !=''){
            $orden = " order by ".$order;
        }
        $sql = "select casos.* 
                from casos,partes 
                where 
                partes.id_persona = ".$id_parte."
                and partes.id_caso = casos.id
                ".$orden."
                LIMIT ".$desde." , ".$hasta.""; 
        $res_data = $this->db->pdoQuery($sql)->results();
        $sql = "select count(casos.id) as c from casos,partes 
                where partes.id_persona = ".$id_parte."
                and partes.id_caso = casos.id";
        $res_cantidad = $this->db->pdoQuery($sql)->results();
        $res['cantidad'] = $res_cantidad[0]['c'];
        $res['data'] = $res_data;        
        return $res; 
    }  
    
    
    public function _listRecorrida($id_caso){

        $sql = "select casos.*,
                juzgados.nominacion,naturalezas_casos.nombre as naturaleza
                from casos
                left join juzgados on juzgados.id = casos.radicacion_actual
                left join naturalezas_casos on naturalezas_casos.id = casos.id_naturaleza
                where
                casos.id = ".$id_caso; 
        $res_data = $this->db->pdoQuery($sql)->results();
        $movimiento_obj = new movimientosModel();
        $recorrida_obj = new recorridaModel();
        foreach ($res_data as $key=>$value) {
            $aux = $movimiento_obj->_list_por_caso($value['id'],1);
        	$res_data[$key]['movimiento'] = $aux[0];
        }        
        $res = $res_data;        
        return $res;
    }


    public function _lista_homeMovimientos(){

        $tiempo_menos_15_dias = mktime(0, 0, 0, date("m") , date("d")-15, date("Y"));
        $hoy = mktime(0, 0, 0, date("m") , date("d"), date("Y")); // 2017-03-23
        $fecha_15_dias =  date("Y-m-d", $tiempo_menos_15_dias);// 2017-03-23
        $fecha_hoy = date("Y-m-d", $hoy);
        $sql = "select casos.*, juzgados.nominacion,naturalezas_casos.nombre as naturaleza
                from casos left join juzgados on juzgados.id = casos.radicacion_actual
                left join naturalezas_casos on naturalezas_casos.id = casos.id_naturaleza
                where casos.id not in ( select distinct(id_caso)
                from movimientos where fecha >='".$fecha_15_dias."'
                and fecha <= '".$fecha_hoy."'
                and tipo_estado ='_procesal' )
                order by id desc LIMIT 0 , 500 ";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;

    }
    
    
    
          
    
}
?>