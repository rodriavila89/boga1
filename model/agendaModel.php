<?php
/*******************************************************************************
  * @ Viernes, 28 de Marzo de 2014 14:59:16
  * @package  
  * @author Adrián
  * @agendaModel.php
  * @version 1.0 
  * @copyright (c) 2013,  Adrián   
*******************************************************************************/  
class agendaModel extends db {

    var $db;
    
    #Cuando se crea el objeto se realiza la conexion a la base de datos 
    public function __construct(){
    
        $this->db = parent::getInstance();           
    }

    public function _list(){
    
        $sql = "select agenda.id,titulo as title,hora_inicio as start,hora_fin as end,
                 case dia_completo
                        when '1' then 'true'
                        when '0' then 'false'
                    end as allDay,casos.caso,directorio.nombres,directorio.apellido 
                    from agenda 
                    left join casos
                    on agenda.id_caso = casos.id
                    left join directorio
                    on agenda.id_persona = directorio.id 
                    order by agenda.id";                    
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    } 
    
    public function _listHoy(){
    
        $sql = "select agenda.id,titulo as title,hora_inicio as start,hora_fin as end,
                 case dia_completo
                        when '1' then 'true'
                        when '0' then 'false'
                    end as allDay,casos.caso,directorio.nombres,directorio.apellido ,id_caso,id_persona
                    from agenda 
                    left join casos
                    on agenda.id_caso = casos.id
                    left join directorio
                    on agenda.id_persona = directorio.id 
                    where date(hora_inicio) = curdate()
                    order by agenda.hora_inicio";                    
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }     
    
    public function _get($id){
        
        $sql = "select agenda.id,hora_inicio as start,hora_fin as end,
                 case dia_completo
                        when '1' then 'true'
                        when '0' then 'false'
                    end as allDay,casos.caso,id_caso,id_persona,
                    directorio.nombres,directorio.apellido,
                    agenda.titulo,agenda.descripcion 
                    from agenda 
                    left join casos
                    on agenda.id_caso = casos.id
                    left join directorio
                    on agenda.id_persona = directorio.id 
                    where agenda.id = ".$id; 
        $res = $this->db->pdoQuery($sql)->results();
        return $res;
    } 
    
    public function _insert($data){

        $res = $this->db->insert('agenda',$data)->getLastInsertId();
        return $res;
    }  
    
    public function _update($data){

        $where = array('id'=>$data['id']); 
        unset($data['id']); 
        $res = $this->db->update('agenda', $data, $where)->affectedRows();
        return $res;
    }  
    
    public function _listDirectorio($id_directorio){
    
        $sql = "select agenda.id,titulo as title,hora_inicio as start,hora_fin as end,
                 case dia_completo
                        when '1' then 'true'
                        when '0' then 'false'
                    end as allDay,directorio.nombres,directorio.apellido 
                    from agenda 
                    left join directorio
                    on agenda.id_persona = directorio.id
                    where directorio.id = ".$id_directorio." 
                    order by agenda.id";                    
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }        
    
    
    public function _listCaso($id_caso){
    
        $sql = "select agenda.id,titulo as title,hora_inicio as start,hora_fin as end,
                 case dia_completo
                        when '1' then 'true'
                        when '0' then 'false'
                    end as allDay,casos.caso 
                    from agenda 
                    left join casos
                    on agenda.id_caso = casos.id
                    where casos.id = ".$id_caso." 
                    order by agenda.id";                    
        $res = $this->db->pdoQuery($sql)->results();
        return $res;                 
    }


    public function _listDay($fecha){

        $sql = "select agenda.id,hora_inicio as start,hora_fin as end,agenda.descripcion,
                 case dia_completo
                        when '1' then 'true'
                        when '0' then 'false'
                    end as allDay,casos.caso,id_caso,id_persona,
                    directorio.nombres,directorio.apellido,
                    agenda.titulo,agenda.descripcion 
                    from agenda 
                    left join casos
                    on agenda.id_caso = casos.id
                    left join directorio
                    on agenda.id_persona = directorio.id 
					where date(agenda.hora_inicio) ='".$fecha."'
                    order by agenda.hora_inicio";
        $res = $this->db->pdoQuery($sql)->results();
        return $res;

    }

    public function _delete($id){

        $where = array('id'=>$id);  
        # borramos la editorial        
        $res = $this->db->delete('agenda',$where)->affectedRows();
        return $res;  
    }  
    
}

?>